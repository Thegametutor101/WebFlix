let getUrl = window.location;
let baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1] + "/" + getUrl.pathname.split('/')[2];

let getUrlParameter = function getUrlParameter(sParam) {
    let sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;
    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};

function checkConnection() {
    if (sessionStorage.getItem("emailAccount") === null) {
        window.location.href = baseUrl + "/pages/account/login.html";
    }
}

  function includeHTML() {
    var z, i, elmnt, file, xhttp;
    /*loop through a collection of all HTML elements:*/
    z = document.getElementsByTagName("*");
    for (i = 0; i < z.length; i++) {
      elmnt = z[i];
      /*search for elements with a certain atrribute:*/
      file = elmnt.getAttribute("w3-include-html");
      if (file) {
        /*make an HTTP request using the attribute value as the file name:*/
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4) {
            if (this.status == 200) {elmnt.innerHTML = this.responseText;}
            if (this.status == 404) {elmnt.innerHTML = "Page not found.";}
            /*remove the attribute, and call this function once more:*/
            elmnt.removeAttribute("w3-include-html");
            includeHTML();
          }
        }
        xhttp.open("GET", file, true);
        xhttp.send();
        /*exit the function:*/
        return;
      }
    }
  };

// TODO  function updateProfilePicture() {
//     $("#profilePic").change(function () {
//         let formData = new FormData();
//         let files = $('#profilePic')[0].files;
//         if(files.length > 0 ) {
//             formData.append('profile', files[0]);
//             formData.append('id', getUrlParameter('isLoggedIn'));
//             $.ajax({
//                 url: "../../Management/updateProfilePicture.php",
//                 type: "POST",
//                 data: formData,
//                 dataType: "json",
//                 cache: false,
//                 contentType: false,
//                 processData: false,
//                 success:function (result) {
//                     window.location.href = baseUrl + "/Pages/UserPages/userProfile.html";
//                     location.reload();
//                 },
//                 error:function (message, er) {
//                     window.location.href = baseUrl + "/Pages/UserPages/userProfile.html";
//                     location.reload();
//                 }
//             });
//         } else {
//             alert("Veuillez soumettre une image valide.");
//         }
//     });
// }