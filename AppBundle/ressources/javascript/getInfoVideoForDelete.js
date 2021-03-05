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

    $("#confirmdeletemovie").click(function() {
        let form_data = new FormData();
        let id = sessionStorage.getItem("idMovie");
        form_data.append('id', id);
        alert($("#selectedvideo").val());
        if($("#selectedvideo").val() == null){
            alert("aucun film selectionner");
        } else {
        $.ajax({
            //Process the form using $.ajax()
            type: 'POST', //Method type
            url: '../../management/deletevideo.php', //Your form processing file URL
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
    }

})