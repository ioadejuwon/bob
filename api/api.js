$(document).ready(function() {

    // Add category to the Database
    $('#categoryForm').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission
        console.log("You clicked add category button");

        var categoryName = $('input[name="categoryname"]').val();

        $.ajax({
            type: 'POST',
            url: '../api/add_category.php', // The URL to the PHP script that handles the form submission
            data: {
                categoryname: categoryName
            },
            dataType: 'json', // Expect JSON response
            success: function(response) {
                $('#error-message').html(response.message);

                if (response.status === 'success') {
                    // Append new category to the table only if the category was created successfully
                    $('#categoryTableBody').append(
                        '<tr><td>' + categoryName + '</td><td>0</td><td>0</td></tr>'
                    );

                    setTimeout(function() {
                        $('#error-message').html('<input type="text" name="categoryname" id="category" placeholder="Enter the name of the category" required>');
                    }, 3000); // 3000 milliseconds = 3 seconds
                } else {
                    // setTimeout(function() {
                    //     $('#error-message').html('');
                    // }, 3000); // 3000 milliseconds = 3 seconds
                    setTimeout(function() {
                        $('#error-message').html('<input type="text" name="categoryname" id="category" placeholder="Enter the name of the category" required>');
                    }, 3000); // 3000 milliseconds = 3 seconds
                }
            },
            error: function(xhr, status, error) {
                $('#error-message').html('An error occurred: ' + xhr.responseText);
                setTimeout(function() {
                    $('#error-message').html('');
                }, 3000); // 3000 milliseconds = 3 seconds
            }
        });
    });

});


Dropzone.autoDiscover = false;

const myDropzone = new Dropzone("#my-dropzone", {
    url: "../api/upload_product.php",
  autoProcessQueue: false,
  addRemoveLinks: true,
  maxFilesize: 3,
  maxFiles: 5,
  parallelUploads: 5,
  acceptedFiles: 'image/*',
  init: function() {
    const submitButton = document.querySelector("#submit");
    const myDropzone = this;

    submitButton.addEventListener("click", function(e) {
      e.preventDefault();
      e.stopPropagation();

      if (myDropzone.getQueuedFiles().length > 0) {
        myDropzone.processQueue(); // Process the file upload queue
      } else {
        myDropzone.uploadFiles([]); // Send form without files
      }
    });

    this.on("sending", function(file, xhr, formData) {
      // Append form data to the request
      const form = document.querySelector("#my-dropzone");
      Array.from(form.elements).forEach(element => {
        if (element.name) {
          formData.append(element.name, element.value);
        }
      });
    });

    this.on("success", function(file, response) {
      console.log(response); // Handle successful upload response
    });

    this.on("error", function(file, response) {
      console.error(response); // Handle error response
    });
  }
});


