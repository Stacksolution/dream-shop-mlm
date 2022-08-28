<?php

namespace App\Utility;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class CashfreeUtility {
    /**
     * Create a new controller instance.
     *
     * @return void
     */ 

    public function __construct()
    {

    }
    
    public static function requestTransfer($request) {
        $tocken = CashfreeUtility::verified();
        $response = Http::withHeaders([
            'X-Client-Id'=>'CF144799CBLRP4DD73N0IMAPH5S0',
            'X-Client-Secret'=>'f43f053a9486304316003dec2ad77b3f8f2e59e2',
            'Authorization' => 'Bearer '.$tocken
        ])->post('https://payout-api.cashfree.com/payout/v1/requestTransfer',[
            "beneId"=>$request->bank_beneficiary,
            "amount"=> $request->transferAmount,
            "transferId"=>$request->transaction_id,
        ]);
        $return = $response->object();
        if(@$return->status == 'SUCCESS' && @$return->subCode == 200){
          return true;  
        }
        
        return false;
    }
    
    public static function create_beneficiary($request) {
        $tocken = CashfreeUtility::verified();
        $beneId = 'CS'.$request->account_number;
        $response = Http::withHeaders([
            'X-Client-Id'=>'CF144799CBLRP4DD73N0IMAPH5S0',
            'X-Client-Secret'=>'f43f053a9486304316003dec2ad77b3f8f2e59e2',
            'Authorization' => 'Bearer '.$tocken
        ])->post('https://payout-api.cashfree.com/payout/v1/addBeneficiary',[
            "beneId"=>'CS'.$request->account_number,
            "name"=>$request->name,
            "email"=>$request->bank_email,
            "phone"=>$request->mobile,
            "bankAccount"=>$request->account_number,
            "ifsc"=>$request->ifsc,
            "address1"=>$request->account_address
        ]);
        $return = $response->object();
        if(@$return->status == 'SUCCESS' && @$return->subCode == 200){
          return $beneId;  
        }
        
        return null;
    }

    public static function get_beneficiary($request){
        $tocken = CashfreeUtility::verified();
        
        $response = Http::withHeaders([
            'X-Client-Id'=>'CF144799CBLRP4DD73N0IMAPH5S0',
            'X-Client-Secret'=>'f43f053a9486304316003dec2ad77b3f8f2e59e2',
            'Authorization' => 'Bearer '.$tocken
        ])->get('https://payout-api.cashfree.com/payout/v1/getBeneId?bankAccount='.$request->account_number.'&ifsc='.$request->ifsc);
        $return = $response->object();
        
        if(@$return->status == 'SUCCESS' && @$return->subCode == 200){
          return $return->data->beneId;  
        }
        
        return null;
    }
    
    public static function verified(){
        $response = Http::withHeaders([
            'X-Client-Id'=>'CF144799CBLRP4DD73N0IMAPH5S0',
            'X-Client-Secret'=>'f43f053a9486304316003dec2ad77b3f8f2e59e2',
            'X-Cf-Signature'=>CashfreeUtility::getSignature()
        ])->post('https://payout-api.cashfree.com/payout/v1/authorize',[])->object();
        if(@$response->status == 'SUCCESS' && @$response->subCode == 200){
          return $response->data->token;  
        }
        return null;
    }
    
    public static function getSignature() {
        $clientId = "CF144799CBLRP4DD73N0IMAPH5S0";
        $pemfile  = file_get_contents(public_path('back-end/cashfree-pem/accountId_10855_public_key.pem'));
        $publicKey = openssl_pkey_get_public($pemfile);
        $encodedData = $clientId.".".time();
        return CashfreeUtility::encrypt_RSA($encodedData, $publicKey);
    }
    
    private static function encrypt_RSA($plainData, $publicKey) { 
        if (openssl_public_encrypt($plainData, $encrypted, $publicKey,OPENSSL_PKCS1_OAEP_PADDING))
          $encryptedData = base64_encode($encrypted);
        else return NULL;
        return $encryptedData;
    }
}