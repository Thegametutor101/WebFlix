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
                window.open("myAccount.html", "_self");
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
                window.open("myAccount.html", "_self");
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