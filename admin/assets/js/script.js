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





document.addEventListener('DOMContentLoaded', function() {
    // console.log('Script loaded.');
  
    var currentUrl = window.location.href;
    // console.log('Current URL:', currentUrl);
  
    var sidebarLinks = document.querySelectorAll('.sidebar__item a');
    // console.log('Sidebar links:', sidebarLinks);
  
    sidebarLinks.forEach(function(link) {
        // console.log('Link HREF:', link.href);
        if (link.href === currentUrl) {
            // console.log('Match found:', link.href);
            link.parentElement.classList.add('-is-active');
        }
    });
  });

  



