document.addEventListener("DOMContentLoaded", function () {
    const progressBar = document.querySelector(".progress-bar");
    
    let progress = 0;
    const interval = setInterval(function () {
      progress += 1; // Adjust the increment as needed
      progressBar.style.width = progress + "%";
      if (progress >= 100) {
        clearInterval(interval);
        setTimeout(function () {
          document.querySelector(".progress-container").style.display = "none";
        }, 200); // Adjust the delay as needed
      }
    }, 50); // Adjust the interval as needed
  });