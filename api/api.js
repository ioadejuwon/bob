function showNotification(message, type = 'success') {
    const container = document.getElementById('notification-container');
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.textContent = message;
    container.appendChild(notification);

    // Show notification
    setTimeout(() => {
        notification.classList.add('show');
    }, 100);

    // Hide and remove notification after 3 seconds
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => {
            container.removeChild(notification);
        }, 500); // Match the transition duration
    }, 3000);
}

//Generate UUID
function generateUUID() {
    // Function to generate a UUID (version 4)
    return ('cart' + -1e2 + -4e2).replace(/[018]/g, c => 
        (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
    );
}

// Get or generate cart ID
let cartId = localStorage.getItem('BWB_cart_id');
if (!cartId) {
    cartId = generateUUID();
    localStorage.setItem('BWB_cart_id', cartId);
}



function formatCurrency(amount) {
    return `₦${amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')}`;
}



$(document).ready(function() {
    console.log('jQuery is loaded');
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
                // $('#error-message').html(response.message);
                showNotification(response.message);
                
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
                // $('#error-message').html('An error occurred: ' + xhr.responseText);
                showNotification('An error occurred: ' + xhr.responseText);
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
                    window.location.href = 'image?productid=' + result.product_id;
                } else {
                    // $('#error-message').html('An error occurred: ' + result.message);
                    showNotification('An error occurred: ' + result.message);
                    
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // $('#error-message').html('An error occurred: ' + textStatus + ' - ' + errorThrown);
                showNotification('An error occurred: ' + textStatus + ' - ' + errorThrown);
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
                    // $('#success-message').text(jsonResponse.message);
                    showNotification(jsonResponse.message);
                    // window.location.href('image')
                    
                    // Hide and remove notification after 3 seconds
                    setTimeout(() => {
                        window.location.href = 'products';
                    }, 2000);
                } else {
                    // $('#error-message').text(jsonResponse.message);
                    showNotification('An error occurred: ' + jsonResponse.message);
                }
            },
            error: function(xhr, status, error) {
                // $('#error-message').text('An error occurred: ' + error);
                showNotification('An error occurred: ' + error);
            }
        });
    });
    // Edit product in the database end


    // Submit form for paymentBegin
    $('#checkoutForm').on('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting the traditional way
    
        // Retrieve items from localStorage
        var items = JSON.parse(localStorage.getItem('bwb_cart')) || []; // Ensure it's an array
    
        // Serialize form data
        var formData = $(this).serializeArray();
    
        // Add items from localStorage to formData
        formData.push({ name: 'items', value: JSON.stringify(items) });
        formData.push({ name: 'subtotal', value: parseFloat(document.getElementById('subtotal').innerText.replace(/[^\d.]/g, '')) });
        formData.push({ name: 'shipping', value: parseFloat(document.getElementById('shipping').innerText.replace(/[^\d.]/g, '')) });
        formData.push({ name: 'total', value: parseFloat(document.getElementById('total').innerText.replace(/[^\d.]/g, '')) });
    
        // Convert formData array to an object
        var data = {};
        $.each(formData, function(index, field) {
            data[field.name] = field.value;
        });
    
        // console.log('Sending data:', data); // Debug message
    
        $.ajax({
            url: 'api/pay.php', // Replace with the path to your PHP script
            type: 'POST',
            data: data,
            success: function(response) {
                console.log('Response:', response); // Check the response from the server
                if (response.status === 'success') {
                    // Redirect to the Flutterwave payment page
                    window.location.href = response.payment_link;
                } else {
                    showNotification('Failed to store items. Please try again.');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error:', textStatus, errorThrown); // Log any errors
                showNotification('An error occurred while processing your request.');
            }
        });
    });
    // Submit form for payment end

});


document.addEventListener('DOMContentLoaded', function() {
    // Initialize Cart
    
    displayCartItems();
    displayOrderSummary();
    updateCartItemCount();

    // Add Product to Cart Begin
    document.querySelectorAll('.toggle-cart').forEach(function(button) {
        console.log('Button initialized');
        const productId = button.closest('form').dataset.productId;
        if (isProductInCart(productId)) {
            updateButton(button);
        }

        button.addEventListener('click', function() {
            const form = this.closest('form');
            const formData = new FormData(form);
            const productquantity = parseInt(formData.get('quantity'), 10);
            const productId = form.dataset.productId;
            const price = parseInt(form.dataset.price, 10);
            const image = form.dataset.image;
            const name = form.dataset.name;
            const discountedPrice = parseInt(form.dataset.discountedPrice, 10);

            const product = {
                product_id: productId,
                name: name,
                price: price,
                image: image,
                discountedPrice: discountedPrice,
                quantity: productquantity
            };

            addToCart(product, this);
        });
    });

    function addToCart(product, button) {
        console.log('Adding to cart:', product);
        let cart = JSON.parse(localStorage.getItem('bwb_cart')) || [];
        const existingProductIndex = cart.findIndex(item => item.product_id === product.product_id);

        if (existingProductIndex !== -1) {
            cart[existingProductIndex].quantity += product.quantity;
        } else {
            cart.push(product);
        }

        localStorage.setItem('bwb_cart', JSON.stringify(cart));
        showNotification('Product added to cart');
        updateButton(button);
        updateCartItemCount(); // Ensure this is called after the cart is updated
    }

    function updateButton(button) {
        button.textContent = 'Added to Cart';
        button.classList.add('-deep-green-1'); // Optional: add a class to style the button differently
        button.classList.add('text-white'); // Optional: add a class to style the button differently
        button.classList.remove('text-dark-1'); // Optional: remove a class to style the button differently
        button.classList.remove('-outline-deep-green-1'); // Optional: remove a class to style the button differently
    }

    function isProductInCart(productId) {
        const cart = JSON.parse(localStorage.getItem('bwb_cart')) || [];
        return cart.some(item => item.product_id === productId);
    }

    
    function updateCartItemCount() {
        const cart = JSON.parse(localStorage.getItem('bwb_cart')) || [];
        const itemCount = cart.length; // Count the number of unique items in the cart

        document.querySelector('.cart-item-count').textContent = itemCount;

    }

    // Display Product in Cart on the Cart Page Begin
    function displayCartItems() {
        const cartItemsContainer = document.getElementById('cartItems');
        if (!cartItemsContainer) return;

        cartItemsContainer.innerHTML = '';
        let cart = JSON.parse(localStorage.getItem('bwb_cart')) || [];

        if (cart.length === 0) {
            cartItemsContainer.innerHTML = `
                <tr>
                    <td colspan="6" class="text-center">
                        Your cart is empty!
                        <br>
                        Add items from the <a class="text-underline" href="` + shop + `">shop</a> to view them here.
                    </td>
                </tr>
            `;
            updateCartTotals(0, 0);
            return;
        }

        let subtotal = 0;

        cart.forEach(item => {
            const itemTotal = item.price * item.quantity;
            subtotal += itemTotal;
            const formattedPrice = formatCurrency(parseFloat(item.price));
            const formattedTotalPrice = formatCurrency(itemTotal);
            const productHTML = `
                <tr class="cart-item" data-product-id="${item.product_id}">
                    <td>
                        <div style="width: 100px; height: 100px; background-image: url('${item.image}'); background-size: cover; background-position: center; border-radius: 8px;"></div>
                    </td>
                    <td>
                        <div class="fw-500 text-dark-1">${item.name}</div>
                    </td>
                    <td>
                        <p>${formattedPrice}</p>
                    </td>
                    <td>
                        <div class="input-counter">
                            <button class="input-counter__down" data-product-id="${item.product_id}">
                                <i class='fa-solid fa-minus'></i>
                            </button>
                            <input type="number" class="input-counter__counter" value="${item.quantity}" min="1" />
                            <button class="input-counter__up" data-product-id="${item.product_id}">
                                <i class='fa-solid fa-plus'></i>
                            </button>
                        </div>
                    </td>
                    <td>
                        <p>${formattedTotalPrice}</p>
                    </td>
                    <td>
                        <i class='fa-solid fa-x' data-product-id="${item.product_id}"></i>
                    </td>
                </tr>
            `;
            cartItemsContainer.innerHTML += productHTML;
        });

        document.querySelectorAll('.input-counter__down').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.dataset.productId;
                updateQuantity(productId, -1);
            });
        });

        document.querySelectorAll('.input-counter__up').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.dataset.productId;
                updateQuantity(productId, 1);
            });
        });

        document.querySelectorAll('.fa-x').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.dataset.productId;
                removeFromCart(productId);
            });
        });

        updateCartTotals(subtotal, subtotal); // Assuming no additional taxes or discounts
    }

    function updateQuantity(productId, change) {
        let cart = JSON.parse(localStorage.getItem('bwb_cart')) || [];
        const productIndex = cart.findIndex(item => item.product_id === productId);

        if (productIndex !== -1) {
            cart[productIndex].quantity += change;

            if (cart[productIndex].quantity <= 0) {
                cart.splice(productIndex, 1);
            }

            localStorage.setItem('bwb_cart', JSON.stringify(cart));
            displayCartItems();
            updateCartItemCount(); // Ensure the cart item count is updated when quantities change
        }
    }

    function removeFromCart(productId) {
        let cart = JSON.parse(localStorage.getItem('bwb_cart')) || [];
        cart = cart.filter(product => product.product_id !== productId);
        localStorage.setItem('bwb_cart', JSON.stringify(cart));
        displayCartItems();
        updateCartItemCount(); // Ensure the cart item count is updated when items are removed
    }

    function updateCartTotals(subtotal, total) {
        document.getElementById('subtotal').innerText = formatCurrency(subtotal);
        document.getElementById('total-price2').innerText = formatCurrency(total);
    }

    function formatCurrency(amount) {
        return `₦${amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')}`;
    }
    // Display Product in Cart on the Cart Page End

    // Display Product in Cart on the Order Page Begin
    function displayOrderSummary() {
        const cartItemsContainer = document.getElementById('totalCartItemsContainer');
        if (!cartItemsContainer) return;

        let cart = JSON.parse(localStorage.getItem('bwb_cart')) || [];

        if (cart.length === 0) {
            cartItemsContainer.innerHTML = '<div class="px-30 py-15">Your cart is empty</div>';
            updateOrderTotals(0, 0, 0);
            return;
        }

        let subtotal = 0;

        cartItemsContainer.innerHTML = cart.map(item => {
            const itemTotal = item.price * item.quantity;
            subtotal += itemTotal;
            return `
                <div class="d-flex justify-between border-top-dark px-30">
                    <div class="py-15 text-grey">${item.name} x${item.quantity}</div>
                    <div class="py-15 text-grey">${formatCurrency(itemTotal)}</div>
                </div>
            `;
        }).join('');

        const shipping = calculateShippingCheckout(subtotal);
        const total = subtotal + shipping;

        updateOrderTotals(subtotal, shipping, total);
    }

    function updateOrderTotals(subtotal, shipping, total) {
        document.getElementById('subtotal').innerText = formatCurrency(subtotal);
        document.getElementById('shipping').innerText = formatCurrency(shipping);
        document.getElementById('total').innerText = formatCurrency(total);
    }

    function calculateShippingCheckout(subtotal) {
        const shippingRate = 1000; // Example flat rate
        return subtotal > 0 ? shippingRate : 0;
    }
    // Display Product in Cart on the Order Page End
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
                // console.log('Thumbnail updated successfully.');
                

                // Remove the 'thumbnail-selected' class from all checkmark buttons
                document.querySelectorAll('.thumbnail-form button').forEach(button => {
                    button.classList.remove('thumbnail-selected');
                });

                // Add the 'thumbnail-selected' class to the clicked checkmark button
                this.querySelector('button').classList.add('thumbnail-selected');
                showNotification('Thumbnail updated successfully.');
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
            console.log('Redirecting to:', 'thumbnail?productid=' + response.product_id);
            // Redirect to another page after successful upload
            window.location.href = 'thumbnail?productid=' + response.product_id;
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