function login(email, password) {
    let messages = $(".messages");
    messages.empty();
    $.ajax({
        url:"../../management/login.php",
        type:"POST",
        data: {
            'email': email,
            'password': password
        },
        dataType:"json",
        success: function (result) {
            let answer = result["item"];
            if (answer === "password") {
                messages.append("<div>Votre mot de passe est invalide.</div><br><hr>");
            } else if (answer === "email") {
                messages.append("<div>Votre courriel est invalide.</div><br><hr>");
            } else if (answer === "empty") {
                messages.append("<div>Veuillez remplir les champs.</div><br><hr>");
            } else if (typeof answer[0] !== 'undefined') {
                sessionStorage.setItem("emailAccount", answer["Email"]);
                sessionStorage.setItem("phoneAccount", answer["Phone"]);
                sessionStorage.setItem("screenNameAccount", answer["ScreenName"]);
                sessionStorage.setItem("passwordAccount", answer["Password"]);
                sessionStorage.setItem("adminAccount", answer["Admin"]);
                window.open("../index.html", "_self");
            } else {
                messages.append("<div>Erreur lors de votre requête. " +
                    "Veuillez réessayer plus tard.</div><br><hr>");
            }
        },
        error: function (message, error) {
            messages.append("<div>Erreur lors de votre requête. " +
                "Veuillez réessayer plus tard.</div><br><hr>");
            console.log(message, error);
        }
    });
}
function signup(email, password, phone, screenName) {
    let messages = $(".messages");
    messages.empty();
    $.ajax({
        url:"../../management/signup.php",
        type:"POST",
        data: {
            'email': email,
            'password': password,
            'phone': phone,
            'screenName': screenName
        },
        dataType:"json",
        success: function (result) {
            let answer = result["item"];
            if (answer === "ok") {
                sessionStorage.setItem("emailAccount", email);
                sessionStorage.setItem("phoneAccount", phone);
                sessionStorage.setItem("screenNameAccount", screenName);
                sessionStorage.setItem("passwordAccount", password);
                sessionStorage.setItem("adminAccount", "0");
                window.open("../index.html", "_self");
            } else if (answer === "screenName") {
                messages.append("<div>Malheureusement, ce nom d'utilisateur est déjà pris.</div><br><hr>");
            } else if (answer === "email") {
                messages.append("<div>Il semble déjà exister un compte sous cette adresse courriel.</div><br><hr>");
            } else if (answer === "empty") {
                messages.append("<div>Veuillez remplir les champs.</div><br><hr>");
            } else {
                messages.append("<div>Erreur lors de votre requête. " +
                    "Veuillez réessayer plus tard.</div><br><hr>");
            }
        },
        error: function (message, error) {
            messages.append("<div>Erreur lors de votre requête. " +
                "Veuillez réessayer plus tard.</div><br><hr>");
            console.log(message, error);
        }
    });
}
function updateProfilePicture() {
    $("#profilePic").change(function () {
        let formData = new FormData();
        let files = $('#profilePic')[0].files;
        let messages = $(".messages");
        messages.empty();
        if(files.length > 0 ) {
            formData.append('profile', files[0]);
            formData.append('email', sessionStorage.getItem("emailAccount"));
            $.ajax({
                url: "../../management/updateProfilePicture.php",
                type: "POST",
                data: formData,
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                success:function (result) {
                    if (result["message"] === "file delete error" ||
                        result["message"] === "file upload error") {
                        messages.append("<div>Une erreur est survenue lors de la gestion de votre fichier<br>" +
                            "Veuillez éssayer de nouveau plus tard.</div><br><hr>");
                    } else if (result["message"] === "ok") {
                        sessionStorage.setItem("profile", result["link"]);
                        location.reload();
                    }
                },
                error:function (message, er) {
                    messages.append("<div>Une erreur est survenue lors de la gestion de votre fichier<br>" +
                        "Veuillez éssayer de nouveau plus tard.</div><br><hr>");
                }
            });
        } else {
            messages.append("<div>Veuillez soumettre une image valide<br>" +
                "Sous format jpeg, jpg ou png.</div><br><hr>");
        }
    });
}