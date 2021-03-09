$(document).ready(function() {
    $("#selectedvideo").on('change', function() {
        form_data = new FormData();
        form_data.append('req', "Get_Video_Info_ID");
        form_data.append('id', this.value);
        $.ajax({
            //Process the form using $.ajax()
            type: 'POST', //Method type
            url: '../../management/DB/Model/GetInfoCards.php', //Your form processing file URL
            data: form_data, //Forms name
            processData: false,
            contentType: false,
            dataType: 'JSON',
            success: function(data) {
                console.log(data); {
                    $("#movietitle").val(data[0].Title);
                    $("#moviedescription").val(data[0].Resume);
                    $("#moviereleasedate").val(data[0].ReleaseDate);

                    let str = JSON.parse(data[0].Genre);
                    $(".genre").attr("checked", false);
                    for (ctr = 0; ctr < str.length; ctr++) {
                        $("#" + str[ctr]).attr("checked", true);

                    }
                    if (data[0].Type == "Serie") {
                        $("#movietypeserie").attr("checked", true);
                    } else {
                        $("#movietypemovie").attr("checked", true);
                    }
                    if (data[0].Available == 1) {
                        $("#movievisibleyes").attr("checked", true);
                    } else {
                        $("#movievisibleno").attr("checked", true);
                    }

                    if (data[0].Classification == "G") {
                        $(".cactif").removeClass("cactif");
                        $("#c13").removeClass("c13actif");
                        $("#c16").removeClass("c16actif");
                        $("#c18").removeClass("c18actif");
                        $("#cgeneral").addClass("cgeneralactif");
                        $("#cgeneral").addClass("cactif");

                    } else if (data[0].Classification == "13+") {
                        $(".cactif").removeClass("cactif");
                        $("#cgeneral").removeClass("cgeneralactif");
                        $("#c16").removeClass("c16actif");
                        $("#c18").removeClass("c18actif");
                        $("#c13").addClass("c13actif");
                        $("#c13").addClass("cactif");

                    } else if (data[0].Classification == "16+") {
                        $(".cactif").removeClass("cactif");
                        $("#cgeneral").removeClass("cgeneralactif");
                        $("#c13").removeClass("c13actif");
                        $("#c18").removeClass("c18actif");
                        $("#c16").addClass("c16actif");
                        $("#c16").addClass("cactif");
                    } else {
                        $(".cactif").removeClass("cactif");
                        $("#cgeneral").removeClass("cgeneralactif");
                        $("#c13").removeClass("c13actif");
                        $("#c16").removeClass("c16actif");
                        $("#c18").addClass("c18actif");
                        $("#c18").addClass("cactif");
                    }


                    sessionStorage.setItem("imgmovie", data[0].Image);
                    sessionStorage.setItem("videofile", data[0].File);
                    sessionStorage.setItem("idMovie", data[0].ID);
                }
            },
            error: function(erreur, message) {
                console.log(erreur, message);
            }

        })

    })

    $("#confirmupdatemovie").click(function() {
        let form_data = new FormData();
        let title, description, movieimage, moviefile, releasedate, visible, type, classification;
        let genrefilm = getGenres();
        title = $("#movietitle").val().trim();
        title = title.replace("'", "");
        description = $("#moviedescription").val().trim();
        description = description.replace("'", "");
        movieimage = $("#movieimage").val();
        moviefile = $("#moviefile").val();
        releasedate = $("#moviereleasedate").val();
        classification = getClassification3();

        if ($("#movievisibleyes").is(":checked")) {
            visible = 1;
        } else {
            visible = 0;
        }

        if ($("#movietypemovie").is(":checked")) {
            type = "Movie";
        } else {
            type = "Serie";
        }


        if (title.length == 0) {
            alert("Le champ titre est vide !");
        } else if (title.length > 250) {
            alert("Le champ titre ne peut pas exceder 250 caracteres !");
        } else if (genrefilm.length == 0) {
            alert("Aucun genre n'a ete selectionner pour le film");
        } else if (description.length == 0) {
            alert("Le champ description ne peut pas etre vide !");
        } else if (releasedate.length == 0) {
            alert("Aucune date n'a ete specifier dans le champs date de sortie");
        } else if (classification == "") {
            alert("Aucune classification n'a ete selectionner pour le film");
        } else {

            $(".spinner-border").show();
            $("#confirmupdatemovie").attr("disabled", true);
            $("#canceladdmovie").attr("disabled", true);
            console.log("ok");
            form_data.append('title', title);
            form_data.append('description', description);
            form_data.append('releasedate', releasedate);
            form_data.append('visible', visible);
            form_data.append('type', type);
            form_data.append('genre', JSON.stringify(genrefilm));
            form_data.append('classificiations', classification);
            form_data.append('id', sessionStorage.getItem("idMovie"));


            if(movieimage == "" && moviefile == ""){
                form_data.append('req', "no_file");


            } else if (movieimage == ""){
                form_data.append('req', "no_image");
                moviefile = $("#moviefile").prop('files')[0];
                form_data.append('moviefile', moviefile);

            } else if (moviefile == ""){
                form_data.append('req', "no_video");
                movieimage = $("#movieimage").prop('files')[0];
                form_data.append('movieimage', movieimage);

            } else {
                form_data.append('req', "all");
                moviefile = $("#moviefile").prop('files')[0];
                movieimage = $("#movieimage").prop('files')[0];
                form_data.append('movieimage', movieimage);
                form_data.append('moviefile', moviefile);

            }
            $.ajax({
                //Process the form using $.ajax()
                type: 'POST', //Method type
                url: '../../management/updatevideo.php', //Your form processing file URL
                data: form_data, //Forms name
                processData: false,
                contentType: false,
                dataType: 'JSON',
                success: function(data) {
                    console.log(data);
                    window.open("adminMenu.html", "_self");
                },
                error: function(message) {
                    console.log(message);
                }

            });

        }
    });

    // $("#confirmdeletemovie").click(function() {
    //     let form_data = new FormData();
    //     let id = sessionStorage.getItem("idMovie");
    //     form_data.append('id', id);

    //     $.ajax({
    //         //Process the form using $.ajax()
    //         type: 'POST', //Method type
    //         url: '../../management/deletevideo.php', //Your form processing file URL
    //         data: form_data, //Forms name
    //         processData: false,
    //         contentType: false,
    //         dataType: 'JSON',
    //         success: function(data) {
    //             console.log(data);
    //             window.open("adminMenu.html", "_self");
    //         },
    //         error: function(message) {
    //             console.log(message);
    //         }

    //     });
    // });

    function getGenres() {
        let genrefilm = [];
        $(".genre").each(function() {
            if ($(this).is(':checked')) {
                let parentE = $(this).parent().clone();
                parentE.children(".genre").remove();
                genrefilm.push(parentE.text());
            }
        });
        return genrefilm;
    }

    function getClassification2() {
        let ID = $(".cactif").attr('id');
        if (ID == "cgeneral")
            return "G";
        else if (ID == "c13")
            return "13+";
        else if (ID == "c16")
            return "16+";
        else if (ID == "c18")
            return "18+";
        else
            return "";
    }


    function getClassification3() {
        let ID = $(".cactif").attr('id');
        if (ID == "cgeneral")
            return "G";
        else if (ID == "c13")
            return "13+";
        else if (ID == "c16")
            return "16+";
        else if (ID == "c18")
            return "18+";
        else
            return "";
    }

    $("#confirmaddmovie").click(function(e) {
        let form_data = new FormData();
        let title, description, movieimage, moviefile, releasedate, visible, type, classification;
        let genrefilm = getGenres();
        title = $("#addmovietitle").val().trim();
        title = title.replace("'", "");
        description = $("#addmoviedescription").val().trim();
        description = description.replace("'", "");
        movieimage = $("#addmovieimage").val();
        moviefile = $("#addmoviefile").val();
        releasedate = $("#addmoviereleasedate").val();
        classification = getClassification2();
        type = "Movie";

        if ($("#addmovievisibleyes").is(":checked")) {
            visible = 1;
        } else {
            visible = 0;
        }

        if (title.length == 0) {
            alert("Le champ titre est vide !");
        } else if (title.length > 250) {
            alert("Le champ titre ne peut pas exceder 250 caracteres !");
        } else if (genrefilm.length == 0) {
            alert("Aucun genre n'a ete selectionner pour le film");
        } else if (description.length == 0) {
            alert("Le champ description ne peut pas etre vide !");
        } else if (movieimage == "") {
            alert("Aucun fichier d'image n'a ete selectionner dans le champs image du film");
        } else if (moviefile == "") {
            alert("Aucun fichier video n'a ete selectionner dans le champs fichier du film");
        } else if (releasedate.length == 0) {
            alert("Aucune date n'a ete specifier dans le champs date de sortie");
        } else if (classification == "") {
            alert("Aucune classification n'a ete selectionner pour le film");
        } else {
            $(".spinner-border").show();
            $("#confirmaddmovie").attr("disabled", true);
            $("#canceladdmovie").attr("disabled", true);
            moviefile = $("#addmoviefile").prop('files')[0];
            movieimage = $("#addmovieimage").prop('files')[0];
            form_data.append('title', title);
            form_data.append('description', description);
            form_data.append('releasedate', releasedate);
            form_data.append('visible', visible);
            form_data.append('type', type);
            form_data.append('genre', JSON.stringify(genrefilm));
            form_data.append('classificiations', classification);
            form_data.append('movieimage', movieimage);
            form_data.append('moviefile', moviefile);
            $.ajax({
                //Process the form using $.ajax()
                type: 'POST', //Method type
                url: '../../management/addvideo.php', //Your form processing file URL
                data: form_data, //Forms name
                processData: false,
                contentType: false,
                dataType: 'JSON',
                success: function(data) {
                    console.log(data);
                    alert("Vidéo ajoutée avec succès");
                    window.open("adminMenu.html", "_self");
                },
                error: function(message) {
                    console.log(message);
                }

            });
        }
    });

    $("#cgeneral").click(function() {
        $(".cactif").removeClass("cactif");
        $("#c13").removeClass("c13actif");
        $("#c16").removeClass("c16actif");
        $("#c18").removeClass("c18actif");
        $("#cgeneral").addClass("cgeneralactif");
        $("#cgeneral").addClass("cactif");
    })

    $("#c13").click(function() {
        $(".cactif").removeClass("cactif");
        $("#cgeneral").removeClass("cgeneralactif");
        $("#c16").removeClass("c16actif");
        $("#c18").removeClass("c18actif");
        $("#c13").addClass("c13actif");
        $("#c13").addClass("cactif");
    })

    $("#c16").click(function() {
        $(".cactif").removeClass("cactif");
        $("#cgeneral").removeClass("cgeneralactif");
        $("#c13").removeClass("c13actif");
        $("#c18").removeClass("c18actif");
        $("#c16").addClass("c16actif");
        $("#c16").addClass("cactif");
    })

    $("#c18").click(function() {
        $(".cactif").removeClass("cactif");
        $("#cgeneral").removeClass("cgeneralactif");
        $("#c13").removeClass("c13actif");
        $("#c16").removeClass("c16actif");
        $("#c18").addClass("c18actif");
        $("#c18").addClass("cactif");
    })
})