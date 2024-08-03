//Generate UUID
function generateUUID() {
    // Function to generate a UUID (version 4)
    return ('order' + -1e4 + -4e3).replace(/[018]/g, c => 
        (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
    );
}

tranx_ref = generateUUID();



document.getElementById('payNowButton').addEventListener('click', function () {
    const form = document.getElementById('checkoutForm');
    const formData = new FormData(form);
    const orderDetails = {
        firstName: formData.get('firstName'),
        lastName: formData.get('lastName'),
        email: formData.get('email'),
        phone: formData.get('phone'),
        country: formData.get('country'),
        state: formData.get('state'),
        city: formData.get('city'),
        street: formData.get('street'),
        notes: formData.get('notes'),
        subtotal: parseFloat(document.getElementById('subtotal').innerText.replace(/[^\d.]/g, '')),
        shipping: parseFloat(document.getElementById('shipping').innerText.replace(/[^\d.]/g, '')),
        total: parseFloat(document.getElementById('total').innerText.replace(/[^\d.]/g, ''))
    };

    // console.log('Order total '+orderDetails.total);
    // console.log('Order total '+tranx_ref);
    FlutterwaveCheckout({
        public_key: "FLWPUBK-c8ddaa9608d9bf66fa1af85243640f2e-X",
        tx_ref: tranx_ref,
        amount: orderDetails.total,
        currency: "NGN",
        payment_options: "card, banktransfer, ussd",
        // redirect_url: "http://yourwebsite.com/confirm_payment.php",
        redirect_url: "http://localhost:8888/bob/inc/confirm_payment.php",
        meta: {
            consumer_id: 23,
            consumer_mac: "92a3-912ba-1192a"
        },
        customer: {
            email: orderDetails.email,
            phone_number: orderDetails.phone,
            name: `${orderDetails.firstName} ${orderDetails.lastName}`,
        },
        customizations: {
            title: "Build With Bob",
            description: "Payment for items in cart",
            logo: "http://localhost:8888/bob/admin/assets/img/icon.png",
        },
        callback: function (data) { // specified callback function
            const { status, transaction_id, tx_ref } = data;
            if (status === "successful") {
                // Optionally verify transaction using AJAX or form submission to your server
                verifyTransaction(transaction_id, tx_ref);
            } else {
                alert("Payment failed. Please try again.");
            }
        }
    });
});

function verifyTransaction(transaction_id, tx_ref) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "verify_transaction.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.status === "success") {
                // Payment is verified, proceed to order confirmation
                window.location.href = "order_confirmation.php?tx_ref=" + tx_ref;
            } else {
                alert("Transaction verification failed. Please contact support.");
            }
        }
    };
    xhr.send("transaction_id=" + transaction_id + "&tx_ref=" + tx_ref);
}
