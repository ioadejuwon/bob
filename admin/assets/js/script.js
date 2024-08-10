// Sign Up and Login show password
function Pass() {
    var x = document.getElementById("loginPassword");
    var passwordeyeicon = document.getElementById("loginPasswordicon");
    if (x.type === "password") {
        x.type = "text";
        passwordeyeicon.innerHTML = "<i class='fa-regular fa-eye'></i>";
    } else {
        x.type = "password";
        passwordeyeicon.innerHTML = "<i class='fa-regular fa-eye-slash'></i>";
    }
}

function confirmPass() {
    var confirmPassword = document.getElementById("confirmPassword");
    var confirmpasswordeyeicon = document.getElementById("confirmPasswordicon");
    if (confirmPassword.type === "password") {
        confirmPassword.type = "text";
        confirmpasswordeyeicon.innerHTML = "<i class='fa-regular fa-eye'></i>";
    } else {
        confirmPassword.type = "password";
        confirmpasswordeyeicon.innerHTML = "<i class='fa-regular fa-eye-slash'></i>";
    }
}





// document.addEventListener('DOMContentLoaded', function() {
//     var currentUrl = window.location.href;
//      console.log('Current URL:', currentUrl);

//     var sidebarLinks = document.querySelectorAll('.sidebar__item a');
//     console.log('Sidebar links:', sidebarLinks);

//     sidebarLinks.forEach(function(link) {
//         // Check if the current URL starts with the link's href
//         if (currentUrl.startsWith(link.href)) {
//             link.parentElement.classList.add('-is-active');
//         }
//     });
// });


  
document.addEventListener('DOMContentLoaded', function() {
    var currentUrl = window.location.href;
    console.log('Current URL:', currentUrl);

    var sidebarLinks = document.querySelectorAll('.sidebar__item a');
    console.log('Sidebar links:', sidebarLinks);

    sidebarLinks.forEach(function(link) {
        // Extract the base part of the link's URL for comparison
        var linkHref = new URL(link.href).pathname;
        console.log('Link Href:', linkHref);
        var currentPathname = new URL(currentUrl).pathname;
        console.log('currentPathname:', currentPathname);

        // Check if the current path contains the link's path as a substring
        if (currentPathname.includes(linkHref)) {
            link.parentElement.classList.add('-is-active');
        }
    });
});



