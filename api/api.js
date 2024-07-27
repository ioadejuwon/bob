function generateUUID() {
    return 'cart-xxy-4xx'.replace(/[xy]/g, function(c) {
        const r = Math.random() * 16 | 0;
        const v = c === 'x' ? r : (r & 0x3 | 0x8);
        return v.toString(16);
    });
}

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

    // Add product to the database Begin
    $('#productFormSubmit').click(function(e) {
        e.preventDefault();

        // Clear previous error messages
        $('#error-message').text('');

        // Validate form fields
        let isValid = true;
        $('#product-details-form').find('input[required], textarea[required], select[required]').each(function() {
            if ($(this).val() === '') {
                isValid = false;
                $(this).addClass('error');  // Add a class to highlight the error (you can style it in CSS)
            } else {
                $(this).removeClass('error');
            }
        });

        if (!isValid) {
            $('#error-message').text('Please, fill all required fields.');
            return;
        }

        // Proceed with AJAX request if validation passes
        $.ajax({
            url: '../api/upload_product_details.php',
            type: 'POST',
            data: $('#product-details-form').serialize(),
            success: function(response) {
                const result = JSON.parse(response);
                if (result.success) {
                    window.location.href = 'add_image.php?productid=' + result.product_id;
                } else {
                    $('#error-message').html('An error occurred: ' + result.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('#error-message').html('An error occurred: ' + textStatus + ' - ' + errorThrown);
            }
        });
    });
    // Add product to the database end

    // Edit product in the database Begin
    $('#productFormUpdate').click(function(event) {
        event.preventDefault();

        var formData = $('#product-details-update').serialize();

        $.ajax({
            type: 'POST',
            url: '../api/update_product.php',
            data: formData,
            success: function(response) {
                var jsonResponse = JSON.parse(response);
                if (jsonResponse.success) {
                    // alert('Product updated successfully!');
                    $('#success-message').text(jsonResponse.message);
                } else {
                    $('#error-message').text(jsonResponse.message);
                }
            },
            error: function(xhr, status, error) {
                $('#error-message').text('An error occurred: ' + error);
            }
        });
    });
    // Edit product in the database end


    // Cart  JS Begin

    // Get or generate cart ID
    let cartId = localStorage.getItem('BWB_cart_id');
    if (!cartId) {
        cartId = generateUUID();
        localStorage.setItem('BWB_cart_id', cartId);
    }

    // Load cart from local storage
    let cart = JSON.parse(localStorage.getItem('BWB_cart')) || [];

    // Function to check if product is in cart
    function isProductInCart(productId) {
        return cart.some(item => item.product_id === productId && item.cart_id === cartId);
    }


    // Function to generate HTML for each cart item
    function generateCartItemHTML(item) {
        return `
            <div class="row justify-between x-gap-40 pb-20" data-product-id="${item.product_id}">
                <div class="col">
                    <div class="row x-gap-10 y-gap-10">
                        <div class="col-auto">
                            <img class="size-100 rounded-8" src="${item.image_path}" alt="<?php echo $brand_name ?>">
                        </div>
                        
                        <div class="col">
                            <div class="text-dark-1 lh-15 fw-bold">${item.product_name}</div>
                            <div class="d-flex items-center mt-10">
                                <div class="lh-12 fw-500 line-through text-light-1 mr-10">${item.discounted_price}</div>
                                <div class="text-18 lh-12 fw-500 text-dark-1">${item.price}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-auto -deep-green-1">
                    <button class="remove-from-cart -deep-green-1">
                        <img src="admin/assets/img/menus/close.svg" alt="remove icon">
                    </button>
                </div>
            </div>
        `;
    }

    // Function to update the cart display
    function updateCartDisplay() {
        const cartContainer = $('.header-cart .px-30.pt-30.pb-10');

        // Clear existing items
        cartContainer.empty();

        // Generate and append HTML for each item in the cart
        cart.forEach(item => {
            cartContainer.append(generateCartItemHTML(item));
        });

        // Update total price
        const totalPrice = cart.reduce((total, item) => total + parseFloat(item.price), 0);
        $('#total-price').text(`$${totalPrice.toFixed(2)}`);
    }


    // Handle toggle cart button click
    $('.toggle-cart').on('click', function() {
        const productCard = $(this).closest('.productCard');
        const productId = productCard.data('product-id');
        const price = productCard.data('price');
        const imagePath = productCard.data('image');
        const productName = productCard.data('name');
        const discountedPrice = productCard.data('discounted-price');

        const productData = {
            cart_id: cartId,
            price: price,
            product_id: productId,
            image_path: imagePath,
            product_name: productName,
            discounted_price: discountedPrice
        };

        if (isProductInCart(productId)) {
            // Remove from cart
            cart = cart.filter(item => !(item.cart_id === cartId && item.product_id === productId));
            localStorage.setItem('BWB_cart', JSON.stringify(cart));

            // Send removal request to server
            $.ajax({
                url: 'api/remove_from_cart.php', // Replace with your server endpoint for removing
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({ cart_id: cartId, product_id: productId }),
                success: function(response) {
                    console.log('Removed from cart:', response);
                    $(this).text('Add To Cart');
                    updateCartDisplay(); // Refresh cart display
                }.bind(this),
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        } else {
            // Add to cart
            cart.push(productData);
            localStorage.setItem('BWB_cart', JSON.stringify(cart));

            // Send addition request to server
            $.ajax({
                url: 'api/add_to_cart.php', // Replace with your server endpoint
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify(productData),
                success: function(response) {
                    console.log('Added to cart:', response);
                    $(this).text('Added to Cart');
                    updateCartDisplay(); // Refresh cart display
                }.bind(this),
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }
    });

    // Update button text based on the cart state on page load
    function updateButtonStates() {
        $('.productCard').each(function() {
            const productId = $(this).data('product-id');
            const button = $(this).find('.toggle-cart');
    
            if (isProductInCart(productId)) {
                button.text('Added to Cart');
            } else {
                button.text('Add To Cart');
            }
        });
    }


    // Function to handle removal of items from the cart
    $(document).on('click', '.remove-from-cart', function() {
        const productCard = $(this).closest('.row').data('product-id');
        
        // Find item to remove
        cart = cart.filter(item => !(item.cart_id === cartId && item.product_id === productCard));
        localStorage.setItem('BWB_cart', JSON.stringify(cart));

        // Send removal request to server
        $.ajax({
            url: 'api/remove_from_cart.php', // Replace with your server endpoint for removing
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ cart_id: cartId, product_id: productCard }),
            success: function(response) {
                console.log('Removed from cart:', response);
                updateCartDisplay(); // Refresh cart display
                updateButtonStates(); // Update button states after removal
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });


    // Populate cart display on page load
    updateCartDisplay();

    //Cart  JS End


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

// Dropzone for edit image begin
Dropzone.options.editImagesDropzone = {
    paramName: 'file', // The name that will be used to transfer the file
    autoProcessQueue: false, // Disable automatic upload
    parallelUploads: 10,
    maxFilesize: 3, // MB
    acceptedFiles: '.png,.jpg,.jpeg,.gif',
    addRemoveLinks: true,
    success: function(file, response) {
        console.log('File uploaded successfully:', response);

        if (response.status === 'success') {
            document.getElementById('success-message').innerText = response.message;
            document.getElementById('success-message').style.display = 'block';
            // Optionally redirect after displaying success message
            // window.location.href = 'thumbnail.php?productid=' + response.product_id;
        } else {
            document.getElementById('error-message').innerText = response.message;
            document.getElementById('error-message').style.display = 'block';
        }
    },
    error: function(file, response) {
        document.getElementById('error-message').innerText = response.message || 'An error occurred during the upload.';
        document.getElementById('error-message').style.display = 'block';
    },
    init: function() {
        const submitButton = document.querySelector("#upload-button");
        const myDropzone = this;

        submitButton.addEventListener("click", function() {
            myDropzone.processQueue();
        });

        this.on("sending", function(file, xhr, formData) {
            formData.append("product_id", document.getElementById('product_id').value);
        });
    }
};
// Dropzone for edit image end