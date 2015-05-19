<?php
    if (isset($_POST) && !empty($_POST))
    {
        echo '<pre>';
        print_r($_POST);
        die;
    }
?>

<button id="button1">Pay here</button>

<script src="jquery.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    $=jQuery;
var options = {
    "key": "rzp_test_aKlLFaLZaTwxmw",
    "amount": 60*100,
    "name": "Merchant Name",
    "description": "Purchase Description",
    "image": "/your_logo.png",
    "handler": function (response){
        alert(response.razorpay_payment_id);
    },
    "prefill": {
        "name": "Harshil Mathur",
        "email": "harshil@razorpay.com",
        "contact": "9876543210"
    },
};
var rzp1 = new Razorpay(options);

$("#button1").click(function(e){
    rzp1.open();
    e.preventDefault();
});
</script>