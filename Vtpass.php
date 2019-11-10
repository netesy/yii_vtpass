<?php

namespace netesy\vtpass;

/**
 * This is just an example.
 */
class Vtpass extends \yii\base\Widget
{
    public $authkey;
    public $username;
    public $password;
    public $sender;
    public $url ;
    

    /**
    * @var Array
    *  sample
    * Yii::$app->vtapp->getBalance();
    */
    public function getBalance()
    {
        $jsonResponse = $this->curl_call($this->url.'?username='. $this->username .'&password='. $this->password . "&action=balance");
        return $jsonResponse;
    }

        /**
    * @var Array
    *  sample
    * Yii::$app->vtapp->getBouquet();
    */
    public function getBouquet(array $option)
    {
        $serviceID = $option['serviceID'];
        $jsonResponse = $this->curl_call($this->url.'/service-variations?serviceID'. $this->serviceID);
        unset($option['serviceID']);
        return $jsonResponse;
    }

    /**
    *   @var Array 
    *   sample
    *   Yii::$app->vtpass->sendMessage([
    *       'number' => $number,
    *       'message' => 'message',
    *   ]);
    */
    public function sendMessage(array $option){
        $number = $option['number'];
        $message =  $option['message'];
        unset($option['number']);
        unset($option['message']);
        $jsonResponse = $this->curl_call($this->url.'?username='. $this->username .'&password='. $this->password
                .'&message='.$message .'&sender='.$this->sender.'&mobiles='.$this->sender, $option);
        return json_decode($jsonResponse);
    } 

   /**
    *@var Array
    * sample 
    * Yii::vtpass->checkTransaction([
    *     'request_id' => $request_id, // the transaction reference number
    * ]);
    *
    */
    public function checkTransaction(array $option){
        ///$host = "http://"
        $request_id = $option['request_id'];
        $jsonResponse = $this->call_api($this->url.'/requery');
        unset($option['request_id']);
        return $jsonResponse;
    }

    /**
    *@var Array
    * sample 
    * Yii::vtpass->verifyNumber([
    *     'billersCode' => $smartcardnumber, // the smartcard number or meter number for sandbox use 1212121212
    *     'serviceID' => $provider, // the service provider e.g dstv, gotv, startimes or jed 
    * ]);
    *
    */
    public function verifyNumber(array $option){
        $billersCode = $option['smartcard'];
        $serviceID = $option['provider'];
        $jsonResponse = $this->call_api($this->url.'/merchant-verify', $option);
        unset($option['smartcard']);
        unset($option['provider']);
        return $jsonResponse;
    }

    /**
    *   @var Array 
    *   sample
    *   Yii::$app->vtpass->buyAirtime([
    *       'request_id' => $request_id, //string ref id
    *       'serviceID' => 'serviceID', //string e.g mtn,glo, 9mobile, airtel
    *       'amount' => $amount, //int 
    *       'phone' => 'phone', //int e.g for sandbox 08011111111
    *   ]);
    */
    public function buyAirtime(array $option){
        $request_id = $option['request_id'];
        $serviceID =  $option['serviceID'];
        $amount = $option['amount'];
        $phone =  $option['phone'];

        $jsonResponse = $this->call_api($this->url.'/pay', $option);
        unset($option['request_id']);
        unset($option['serviceID']);
        unset($option['amount']);
        unset($option['phone']);
        return json_decode($jsonResponse);
    } 

        /**
    *   @var Array 
    *   sample
    *   Yii::$app->vtpass->buyData([
    *       'request_id' => $request_id, //string ref id
    *       'serviceID' => 'serviceID', //string e.g mtn
    *       'amount' => $amount, //int 
    *       'phone' => 'phone', //int
    *   ]);
    */
    public function buyData(array $option){
        $request_id = $option['request_id'];
        $serviceID =  $option['serviceID'];
        $amount = $option['amount'];
        $phone =  $option['phone'];

        $jsonResponse = $this->call_api($this->url.'/pay', $option);

        unset($option['request_id']);
        unset($option['serviceID']);
        unset($option['amount']);
        unset($option['phone']);
        return json_decode($jsonResponse);
    } 

    /**
    *   @var Array 
    *   sample
    *   Yii::$app->vtpass->buyPower([
    *       'request_id' => $request_id, //string ref id
    *       'serviceID' => 'serviceID', //string e.g mtn
    *       'amount' => $amount, //int 
    *       'phone' => 'phone', //int
    *   ]);
    */
    public function buyPower(array $option){
        $request_id = $option['request_id'];
        $serviceID =  $option['serviceID'];
        $amount = $option['amount'];
        $phone =  $option['phone'];


        $jsonResponse = $this->curl_call($this->url.'/pay', $option);
        
        unset($option['request_id']);
        unset($option['serviceID']);
        unset($option['amount']);
        unset($option['phone']);
        return json_decode($jsonResponse);
    } 

       /**
    *   @var Array 
    *   sample
    *   Yii::$app->vtpass->buyTv([
    *       'request_id' => $request_id, //string ref id
    *       'serviceID' => '$serviceID', //string e.g startimes,gotv or dstv
    *       'billersCode'  => '$billersCode', //string
    *       'variation_code' => '$variation_code', //string the bouquet code
    *       'amount' => $amount, //int 
    *       'phone' => 'phone', //int
    *   ]);
    */
    public function buyTv(array $option){
        $request_id = $option['request_id'];
        $serviceID =  $option['serviceID'];
        $amount = $option['amount'];
        $phone =  $option['phone'];

        $jsonResponse = $this->curl_call($this->url.'/pay', $option);

        unset($option['request_id']);
        unset($option['serviceID']);
        unset($option['amount']);
        unset($option['phone']); 
        return json_decode($jsonResponse);
    }  

        /**
    *   @var Array 
    *   sample
    *   Yii::$app->vtpass->buyCard([
    *       'request_id' => $request_id, //string ref id
    *       'serviceID' => 'serviceID', //string e.g mtn
    *       'amount' => $amount, //int 
    *       'phone' => 'phone', //int
    *   ]);
    */
    public function buyCard(array $option){
        $request_id = $option['request_id'];
        $serviceID =  $option['serviceID'];
        $amount = $option['amount'];
        $phone =  $option['phone'];

        $jsonResponse = $this->curl_call($this->url.'/pay', $option);
        unset($option['request_id']);
        unset($option['serviceID']);
        unset($option['amount']);
        unset($option['phone']);
        return json_decode($jsonResponse);
    } 

    private function call_api($url, $option=array(),$header=array()){
    $curl  = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => $host,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10, 
	CURLOPT_USERPWD => $username.":" .$password,
	CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_USERAGENT, "VTPASSAPI 1.0",
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => $option,
    ));
    //echo curl_exec($curl);
        $r = curl_exec($curl);
        if($r == false){
            $text = 'error '.curl_error($curl);
            $myfile = fopen("vtpass.log", "w") or die("Unable to open file!");
            fwrite($myfile, $text);
            fclose($myfile);
        }
        curl_close($curl);
        return $r;
    }
    private function curl_call($url, $option=array(), $headers=array()){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_USERAGENT, "VTPASSAPI 1.0");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if (count($option)) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $option); 
        }
        $r = curl_exec($ch);
        if($r == false){
            $text = 'error '.curl_error($ch);
            $myfile = fopen("vtpass.log", "w") or die("Unable to open file!");
            fwrite($myfile, $text);
            fclose($myfile);
        }
        curl_close($ch);
        return $r;
    }

    private function curlFile($path){
        if (is_array($path))
            return $path['file_id'];

        $realPath = realpath($path);

        if (class_exists('CURLFile')){
            return new \CURLFile($realPath);
        }
        return '@' . $realPath;
    }


// /***********************************************************
// 	Payflexi methods handles serives that don't have
// 	billersCode such as mtn,airtel,glo,etisalat Service
// 	e.g http://sandbox.vtpass.com/api/services?identifier=airtime,
// 	typres can be gotten from the Get service Endpoint
// *************************************************************/ 
// $username = "*****"; //email address(sandbox@vtpass.com)
// $password = "****"; //password (sandbox)
// $host = 'http://sandbox.vtpass.com/api/payflexi';
// $data = array(
//   	'serviceID'=> $_POST['serviceID'], //integer e.g mtn,airtel
//   	'amount' =>  $_POST['amount'], // integer
//   	'phone' => $_POST['recepient'], //integer
//   	'request_id' => '901059298909' // unique for every transaction from your platform
// );
// $curl       = curl_init();
// curl_setopt_array($curl, array(
// CURLOPT_URL => $host,
// 	CURLOPT_RETURNTRANSFER => true,
// 	CURLOPT_ENCODING => "",
// 	CURLOPT_MAXREDIRS => 10,
// 	CURLOPT_USERPWD => $username.":" .$password,
// 	CURLOPT_TIMEOUT => 30,
// 	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
// 	CURLOPT_CUSTOMREQUEST => "POST",
// 	CURLOPT_POSTFIELDS => $data,
// ));
// echo curl_exec($curl);
// }


// /********************************************************************************
// 	Payfix methods handles serives that have
// 	billersCode such as gotv,dstv,eko-electric,abuja-electric Service 
// 	typres can be gotten from the services endpoint 
// 	e.g http://sandbox.vtpass.com/api/services?identifier=bills,
// 	also the variation code can be gotten from the service-variations 
// 	endpoint e.g http://sandbox.vtpass.com/api/service-variations?serviceID=dstv
// **********************************************************************************/ 
// $username = "*****"; //email address(sandbox@vtpass.com)
// $password = "****"; //password (sandbox)
// $host = 'http://sandbox.vtpass.com/api/payfix';
// $data = array(
//   	'serviceID'=> $_POST['serviceID'], //integer e.g gotv,dstv,eko-electric,abuja-electric
//   	'billersCode'=> $_POST['billersCode'], // e.g smartcardNumber, meterNumber,
//   	'variation_code'=> $_POST['variation_code'], // e.g dstv1, dstv2,prepaid,(optional for somes services)
//   	'amount' =>  $_POST['amount'], // integer (optional for somes services)
//   	'phone' => $_POST['recepient'], //integer
//   	'request_id' => '901059298909' // unique for every transaction from your platform
// );
// $curl       = curl_init();
// curl_setopt_array($curl, array(
// CURLOPT_URL => $host,
// 	CURLOPT_RETURNTRANSFER => true,
// 	CURLOPT_ENCODING => "",
// 	CURLOPT_MAXREDIRS => 10,
// 	CURLOPT_USERPWD => $username.":" .$password,
// 	CURLOPT_TIMEOUT => 30,
// 	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
// 	CURLOPT_CUSTOMREQUEST => "POST",
// 	CURLOPT_POSTFIELDS => $data,
// ));
// echo curl_exec($curl);
// }
// }
}