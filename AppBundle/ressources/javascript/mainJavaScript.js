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