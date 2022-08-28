<!DOCTYPE html>
<html>
   <head>
      <title>Please wait.......</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <style type="text/css">
         @-webkit-keyframes pulsate {
         0% {
         transform: scale(0.75);
         }
         50% {
         transform: scale(1.75);
         }
         100% {
         transform: scale(0.75);
         }
         }
         @-moz-keyframes pulsate {
         0% {
         transform: scale(0.75);
         }
         50% {
         transform: scale(1.75);
         }
         100% {
         transform: scale(0.75);
         }
         }
         @-o-keyframes pulsate {
         0% {
         transform: scale(0.75);
         }
         50% {
         transform: scale(1.75);
         }
         100% {
         transform: scale(0.75);
         }
         }
         @keyframes pulsate {
         0% {
         transform: scale(0.75);
         }
         50% {
         transform: scale(1.75);
         }
         100% {
         transform: scale(0.75);
         }
         }
         @-webkit-keyframes rotate {
         0% {
         transform: rotate(0deg);
         }
         100% {
         transform: rotate(360deg);
         }
         }
         @-moz-keyframes rotate {
         0% {
         transform: rotate(0deg);
         }
         100% {
         transform: rotate(360deg);
         }
         }
         @-o-keyframes rotate {
         0% {
         transform: rotate(0deg);
         }
         100% {
         transform: rotate(360deg);
         }
         }
         @keyframes rotate {
         0% {
         transform: rotate(0deg);
         }
         100% {
         transform: rotate(360deg);
         }
         }
         .payment-loader-container {
         margin: 25vh auto 0;
         }
         .payment-loader-container .payment-loader {
         width: 125px;
         height: 125px;
         margin: 0 auto;
         }
         .payment-loader-container .payment-loader .payment-circle {
         text-align: center;
         width: 100%;
         height: 100%;
         border-radius: 50%;
         border: 5px solid lightgray;
         }
         .payment-loader-container .payment-loader .payment-circle .payment-inner-circle {
         position: relative;
         left: -12.5%;
         top: 35%;
         width: 125%;
         height: 25%;
         background-color: white;
         -webkit-animation: rotate 2s infinite linear;
         animation: rotate 2s infinite linear;
         }
         .payment-loader-container .payment-loader .payment-circle h1 {
         position: relative;
         color: darkgray;
         top: -0.25em;
         font-family: "Raleway";
         -webkit-animation: pulsate 1.25s infinite ease;
         animation: pulsate 1.25s infinite ease;
         }
      </style>
   </head>
   <body onload="document.frm1.submit()">
      <div class="payment-loader-container">
         <div class="payment-loader">
            <div class="payment-circle">
               <div class="payment-inner-circle">
               </div>
               <h1>
                  {{$payment["orderCurrency"]}}
               </h1>
            </div>
         </div>
      </div>
      <div style="text-align: center;margin-top: 3%;">
           Please wait.......
      </div>
      @php
      $mode = env('CASHFREE_MODE') == "TEST" ? "TEST":"PROD"; //<------------ Change to TEST for test server, PROD for production
      $secretKey = env('APP_SECRET');
      ksort($payment);
      $signatureData = "";
      foreach ($payment as $key => $value){
      $signatureData .= $key.$value;
      }
      $signature = hash_hmac('sha256', $signatureData, $secretKey,true);
      $signature = base64_encode($signature);
      if ($mode == "PROD") {
      $url = "https://www.cashfree.com/checkout/post/submit";
      } else {
      $url = "https://test.cashfree.com/billpay/checkout/post/submit";
      }
      @endphp
      <form action="<?php echo $url; ?>" name="frm1" method="post">
         <input type="hidden" name="signature" value='{{ $signature }}'/>
         <input type="hidden" name="orderNote" value='{{$payment["orderNote"]}}'/>
         <input type="hidden" name="orderCurrency" value='{{$payment["orderCurrency"]}}'/>
         <input type="hidden" name="customerName" value='{{$payment["customerName"]}}'/>
         <input type="hidden" name="customerEmail" value='{{$payment["customerEmail"]}}'/>
         <input type="hidden" name="customerPhone" value='{{$payment["customerPhone"]}}'/>
         <input type="hidden" name="orderAmount" value='{{$payment["orderAmount"]}}'/>
         <input type ="hidden" name="notifyUrl" value='{{$payment["notifyUrl"]}}'/>
         <input type ="hidden" name="returnUrl" value='{{$payment["returnUrl"]}}'/>
         <input type="hidden" name="appId" value='{{$payment["appId"]}}'/>
         <input type="hidden" name="orderId" value='{{$payment["orderId"]}}'/>
      </form>
   </body>
</html>