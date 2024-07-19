$(document).ready(function() {
    
    // Add category to the Database begin
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
                        '<tr><td>' + categoryName + '</td><td>0</td></tr>'
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
    // Add category to the Database end


    // Add product to the database begin
    $('#productFormSubmit').click(function(e) {
        e.preventDefault();
        $.ajax({
            url: '../api/upload_product_details.php',
            type: 'POST',
            data: $('#product-details-form').serialize(),
            success: function(response) {
                const result = JSON.parse(response);
                if (result.success) {
                    window.location.href = 'add_image.php?productid=' + result.product_id;
                } else {
                    $('#error-message').text(result.error);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error(textStatus, errorThrown);
            }
        });
    });

    // Add product to the database end
    
});

// Set Thumbnail for the product begin
document.querySelectorAll('.thumbnail-form').forEach(form => {
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);
        fetch('../api/update_thumbnail.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                console.log('Thumbnail updated successfully.');

                // Remove the 'thumbnail-selected' class from all checkmark buttons
                document.querySelectorAll('.thumbnail-form button').forEach(button => {
                    button.classList.remove('thumbnail-selected');
                });

                // Add the 'thumbnail-selected' class to the clicked checkmark button
                this.querySelector('button').classList.add('thumbnail-selected');
            } else {
                console.error('Error updating thumbnail:', data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});

// Set Thumbnail for the product end


// Dropzone for image upload begin
Dropzone.options.productImagesDropzone = {
    paramName: 'file', // The name that will be used to transfer the file
    autoProcessQueue: false, // Disable automatic upload
    parallelUploads: 10,
    maxFilesize: 3, // MB
    acceptedFiles: '.png,.jpg,.jpeg,.gif',
    addRemoveLinks: true,
    success: function(file, response) {
        console.log('File uploaded successfully:', response);

        // Check if the response status is success before redirecting
        if (response.status === 'success') {
            console.log('Redirecting to:', 'thumbnail.php?productid=' + response.product_id);
            // Redirect to another page after successful upload
            window.location.href = 'thumbnail.php?productid=' + response.product_id;
        } else {
            console.log('Upload error:', response.message);
        }
    },
    error: function(file, response) {
        console.log('Error uploading file:', response);
    },
    init: function() {
        // Adding an event listener to the custom button
        const submitButton = document.querySelector("#upload-button");
        const myDropzone = this;

        submitButton.addEventListener("click", function() {
            // Process all files in the Dropzone queue
            myDropzone.processQueue();
        });

        this.on("sending", function(file, xhr, formData) {
            formData.append("product_id", document.getElementById('product_id').value);
        });
    }
};

// Dropzone for image upload end