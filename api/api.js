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


    function formatPrice(amount) {
        return `₦${parseFloat(amount).toFixed(2)}`;
    }

    
    // Get or generate cart ID
    let cartId = localStorage.getItem('BWB_cart_id');
    if (!cartId) {
        cartId = generateUUID();
        localStorage.setItem('BWB_cart_id', cartId);
    }

    // Load cart from local storage
    let cart = JSON.parse(localStorage.getItem('BWB_cart')) || [];


    // Function to update cart in local storage
    function updateCartInLocalStorage() {
        localStorage.setItem('BWB_cart', JSON.stringify(cart));
        updateCartheaderDisplay(); // Refresh cart display
        updateCartPageDisplay(); // Refresh cart display
    }

     // Function to handle quantity change
     function handleQuantityChange(productId, newQty) {
        // Find the item in the cart
        const itemIndex = cart.findIndex(item => item.product_id === productId && item.cart_id === cartId);
        if (itemIndex !== -1) {
            // Update quantity
            cart[itemIndex].product_qty = newQty;
            updateCartInLocalStorage();
        }
    }

    // Handle quantity change
    $('.cart-items-container').on('click', '.input-counter__up', function() {
        const itemRow = $(this).closest('.row');
        const productId = itemRow.data('product-id');
        const inputField = itemRow.find('.input-counter__counter');
        let currentQty = parseInt(inputField.val(), 10);
        inputField.val(++currentQty);
        handleQuantityChange(productId, currentQty);
    });

    $('.cart-items-container').on('click', '.input-counter__down', function() {
        const itemRow = $(this).closest('.row');
        const productId = itemRow.data('product-id');
        const inputField = itemRow.find('.input-counter__counter');
        let currentQty = parseInt(inputField.val(), 10);
        if (currentQty > 1) { // Prevent quantity from going below 1
            inputField.val(--currentQty);
            handleQuantityChange(productId, currentQty);
        }
    });




    // Function to check if product is in cart
    function isProductInCart(productId) {
        return cart.some(item => item.product_id === productId && item.cart_id === cartId);
    }


    // Function to generate HTML for each cart item for Cart Dropdown
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
                    <button class="remove-from-cart -deep-green-1" data-product-id="${item.product_id}">
                        <img src="admin/assets/img/menus/close.svg" alt="remove icon">
                    </button>
                </div>
            </div>
        `;
    }



      // Function to generate HTML for each cart item for Cart Page
      function generateCartItemPageHTML(item) {
        return `
            <tr class="data-product-id="${item.product_id}"">
                <td class="">
                    <div class="size-100 bg-image rounded-8 js-lazy mr-10" data-bg="${item.image_path}"></div>
                </td>

                <td>
                    <div class="fw-500 text-dark-1">${item.product_name}</div>
                </td>

                <td>
                    <p class="product-price">${item.price}</p>
                </td>

                <td>
                    <div class="input-counter  js-input-counter">
                        <input class='input-counter__counter' type="number" placeholder="value..." value='${item.product_qty}' />

                        <div class="input-counter__controls">
                            <button class='input-counter__up js-down'>
                                <i class='icon' data-feather="minus"></i>
                            </button>

                            <button class='input-counter__down js-up'>
                                <i class='icon' data-feather="plus"></i>
                            </button>
                        </div>
                    </div>
                </td>

                <td>
                    <p class="product-subtotal">${(item.price * item.product_qty).toFixed(2)}</p>
                </td>


                <td>
                    <button class="remove-from-cart-page" data-product-id="${item.product_id}">
                        <i class="icon" data-feather="x"></i>
                    </button>
                </td>
            </tr>

            
        `;
    }


    

    // Populate cart items
    cart.forEach(item => {
        // Assuming `item` has properties like `image`, `name`, `price`, `quantity`, and `product_id`
        const cartItemHTML = generateCartItemPageHTML(item);
        $('.cart-items-container').append(cartItemHTML);
    });

    // Handle removal of cart items
    $('.cart-items-container').on('click', '.remove-item', function() {
        const productId = $(this).data('product-id');

        // Remove from local storage
        cart = cart.filter(item => item.product_id !== productId);
        localStorage.setItem('BWB_cart', JSON.stringify(cart));

        // Send removal request to server
        $.ajax({
            url: 'api/remove_from_cart.php', // Replace with your server endpoint for removing
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ cart_id: cartId, product_id: productCard }),
            success: function(response) {
                console.log('Removed from cart:', response);
                updateCartheaderDisplay(); // Refresh cart display
                updateCartPageDisplay(); // Refresh cart display
                updateButtonStates(); // Update button states after removal
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });

        // Remove from the DOM
        $(this).closest('.row').remove();

        // Optionally, update total or other parts of the cart UI
        updateButtonStates();
    });

    
    // Function to update the cart display

    function updateCartheaderDisplay() {
        const cartContainer = $('.header-cart .px-30.pt-30.pb-10');
    
        // Clear existing items
        cartContainer.empty();
    
        // Generate and append HTML for each item in the cart
        cart.forEach(item => {
            cartContainer.append(generateCartItemHTML(item));
        });
    
        // Update total price
        const totalPrice = cart.reduce((total, item) => total + (item.price * item.product_qty), 0);
        $('#total-price').text(formatPrice(totalPrice));
        $('#total-price2').text(formatPrice(totalPrice));
    }
        


    // Function to update the cart display
    function updateCartPageDisplay() {
        const cartContainer = $('.cart-items-container');
        // const cartContainer = $('.header-cart .px-30.pt-30.pb-10');

        // Clear existing items
        cartContainer.empty();

        let totalPrice = 0;

        // Generate and append HTML for each item in the cart
        cart.forEach(item => {
            const itemSubtotal = item.price * item.product_qty;
            totalPrice += itemSubtotal;
            cartContainer.append(generateCartItemPageHTML(item));

            // Update subtotal for each item
            const itemRow = cartContainer.find(`[data-product-id="${item.product_id}"]`);
            itemRow.find('.product-subtotal').text(`${formatPrice(itemSubtotal.toFixed(2))}`);
        });

        // Update total price
        $('#total-price').text(formatPrice(totalPrice));
        $('#total-price2').text(formatPrice(totalPrice));
    }


    // Handle toggle cart button click
    $('.toggle-cart').on('click', function() {
        const productCard = $(this).closest('.productCard');
        const productId = productCard.data('product-id');
        const price = productCard.data('price');
        const imagePath = productCard.data('image');
        const productName = productCard.data('name');
        const productQty = 1;
        const discountedPrice = productCard.data('discounted-price');

        const productData = {
            cart_id: cartId,
            price: price,
            product_id: productId,
            image_path: imagePath,
            product_name: productName,
            product_qty: productQty,
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
                    updateCartPageDisplay();
                    updateCartheaderDisplay();
                    updateButtonStates();
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
                    updateCartPageDisplay();
                    updateCartheaderDisplay();
                    updateButtonStates();
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
 

    $(document).on('click', '.remove-from-cart-page', function() {
        const productId = $(this).data('product-id'); // Use `data-product-id` directly
    
        console.log('Remove button clicked for product ID:', productId); // Debug log
    
        // Find item to remove
        cart = cart.filter(item => !(item.cart_id === cartId && item.product_id === productId));
        localStorage.setItem('BWB_cart', JSON.stringify(cart));
    
        // Send removal request to server
        $.ajax({
            url: 'api/remove_from_cart.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ cart_id: cartId, product_id: productId }),
            success: function(response) {
                console.log('Removed from cart:', response);
                updateCartPageDisplay();
                updateCartheaderDisplay();
                updateButtonStates(); // Update button states after removal
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });


    $(document).on('click', '.remove-from-cart', function() {
        const productId = $(this).data('product-id'); // Use `data-product-id` directly
    
        console.log('Remove button clicked for product ID:', productId); // Debug log
    
        // Find item to remove
        cart = cart.filter(item => !(item.cart_id === cartId && item.product_id === productId));
        localStorage.setItem('BWB_cart', JSON.stringify(cart));
    
        // Send removal request to server
        $.ajax({
            url: 'api/remove_from_cart.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ cart_id: cartId, product_id: productId }),
            success: function(response) {
                console.log('Removed from cart:', response);
                updateCartPageDisplay();
                updateCartheaderDisplay();
                updateButtonStates(); // Update button states after removal
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });
    
    


    // Populate cart display on page load
    updateCartPageDisplay();
    updateCartheaderDisplay();
    updateButtonStates();

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