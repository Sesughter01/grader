<?php include 'includes_2/controller/authcontroller.php' ?>

<?php
    
    // redirect user to login page if they're not logged in
      if (empty($_SESSION['id'])) {
        header('location:logout.php');
}

?>
<?php 
if(isset($_POST['pay']))

{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $myamount = $_POST['amount'];
    $noc = $_POST['number_of_copies'];
   

    $curl = curl_init();
    
    $customer_email = $email;
    $amount = $myamount;  
    $currency = "NGN";
    $txref = time(); // ensure you generate unique references per transaction.
    $PBFPubKey = "FLWPUBK_TEST-b712bb69a456d9da4d3dcad2cedcc5ec-X"; // get your public key from the dashboard.
    $redirect_url = "https://localhost/partnership2021/project1/success.php";
   // $payment_plan = "pass the plan id"; // this is only required for recurring payments.
   
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/hosted/pay",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => json_encode([
        'amount'=>$amount,
        'customer_email'=>$customer_email,
        'currency'=>$currency,
        'txref'=>$txref,
        'PBFPubKey'=>$PBFPubKey,
        'redirect_url'=>$redirect_url,
       // 'payment_plan'=>$payment_plan
      ]),
      CURLOPT_HTTPHEADER => [
        "content-type: application/json",
        "cache-control: no-cache"
      ],
    ));
    
    $response = curl_exec($curl);
   
    $err = curl_error($curl);
    
    if($err){
      // there was an error contacting the rave API
      die('Curl returned error: ' . $err);
    }
    
    $transaction = json_decode($response);
    
    if(!$transaction->data && !$transaction->data->link){
      // there was an error from the API
      print_r('API returned error: ' . $transaction->message);
    }
    
    // uncomment out this line if you want to redirect the user to the payment page
    //print_r($transaction->data->message);
    
    
    // redirect to page so User can pay
    // uncomment this line to allow the user redirect to the payment page
    header('Location: ' . $transaction->data->link);
   // What happens when the user completes the transaction on the page?
   // When the user enter's their payment details, rave would validate then charge the card. Once the charge is completed we would:
    
   // Call your redirect url and post the response to you, we also append your reference and our unique reference as query params to the url.
    
   // Call your hook url (if one is set).
    
   // Send an email to you and your customer on the successful payment. If email to customers is turned off we wouldn't send emails.
    
   // Before you give value to the customer, please make a server-side call to our verification endpoint to confirm the status and properties of the transaction.
    
    //Step 3: Handling payment response / verifying transaction.
    //When a transaction is completed we send an event to your hook url and also append the reference to your redirect url you can use either of both responses to verify payment and give value to the customer.
    
    
    //Remember to check
    
   // if using .htaccess, remember to add the trailing / to the url you set.
   // Do a test post to your URL and ensure the script gets the post body.
   // Only set a publicly available url (http://localhost cannot receive!)
   // You can pick up the reference or use the post body send to your redirect url to verify transaction and give value. In this example we would use the reference from the url.
    
}
?>