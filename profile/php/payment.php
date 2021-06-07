<?php
require("../../instamojo/Instamojo.php");
session_start();
$username=$_SESSION['username'];
$fullname = $_SESSION['buyer_name'];
$amount = $_GET['amount'];
$plan = $_GET['plan'];
$storage=$_GET['storage'];
$api = new Instamojo\Instamojo('', '', '');//some information
// echo $amount;
try {
    $response = $api->paymentRequestCreate(array(
        "purpose" => "PIC DRIVE",
        "amount" => $amount,
        "send_email" => true,
        "email" => $username,
        "buyer_name"=>$fullname,
        "phone"=>"7023756844",
        "redirect_url" => "http://localhost/picdrive/profile/php/update_storage.php?plan=".$plan."&storage=".$storage
        ));
    $payment_url = $response['longurl'];
    header("Location:$payment_url");
}
catch (Exception $e) {
    print('Error: ' . $e->getMessage());
}

?>