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
    *   @var Array 
    *   sample
    *   Yii::$app->vtpass->setusername('username')
    *          ->setPassword('password')
    *          ->setCallback('http://example.com');
    */
    public function setUsername($username){
        $this->username = $username;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function setCallback($url){
        $this->sender = $url;
    }

    public function isLive(bool $live){
        if($live == true){
            $this->url = "https://vtpass.com/api/";
        }elseif($live == false){
            $this->url = "https://sandbox.vtpass.com/api/";
        }else{
                $this->url = "https://vtpass.com/api/";
        }
    }

    /**
    * @var Array
    *  sample
    * Yii::$app->vtpass->getBalance();
    */
    public function getBalance()
    {
        $jsonResponse = $this->curl_call($this->url.'?username='. $this->username .'&password='. $this->password . "&action=balance");
        return $jsonResponse;
    }

        /**
    * @var Array
    *  sample
    * Yii::$app->vtpass->getBouquet();
    */
    public function getBouquet(array $option)
    {
        $serviceID = $option['serviceID'];
        $jsonResponse = $this->curl_call($this->url.'/service-variations?serviceID'. $this->serviceID);
        unset($option['serviceID']);
        return $jsonResponse;
    }

   /**
    *@var Array
    * sample 
    * Yii::$app->vtpass->checkTransaction([
    *     'request_id' => $request_id, // the transaction reference number
    * ]);
    *
    */
    public function checkTransaction(array $option){
        ///$host = "http://"
        $request_id = $option['request_id'];
        $jsonResponse = $this->call_api($this->url.'/requery', $option);
        unset($option['request_id']);
        return $jsonResponse;
    }

    /**
    *@var Array
    * sample 
    * Yii::$app->vtpass->verifyNumber([
    *     'billersCode' => $smartcardnumber, // the smartcard number or meter number for sandbox use 1212121212
    *     'serviceID' => $provider, // the service provider e.g dstv, gotv, startimes or jed 
    * ]);
    *
    */
    public function verifyNumber(array $option){
        $billersCode = $option['billersCode'];
        $serviceID = $option['serviceID'];
        $jsonResponse = $this->call_api($this->url.'/merchant-verify', $option);
        unset($option['billersCode']);
        unset($option['serviceID']);
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
        $billersCode = $option['billersCode'];
        $variation_code = $option['variation_code'];
        $amount = $option['amount'];
        $phone =  $option['phone'];


        $jsonResponse = $this->call_api($this->url.'/pay', $option);
        
        unset($option['request_id']);
        unset($option['serviceID']);
        unset($option['billersCode']);
        unset( $option['variation_code']);
        unset($option['amount']);
        unset($option['phone']);
        return json_decode($jsonResponse);
    } 
    } 

    /**
    *   @var Array 
    *   sample
    *   Yii::$app->vtpass->buyPower([
    *       'request_id' => $request_id, //string ref id
    *       'serviceID' => 'serviceID', //string e.g ikeja electric
    *       'billersCode' => '', //meter number
    *       'variation_code' => '',//metrer typev e.g prepaid
    *       'amount' => $amount, //int 
    *       'phone' => 'phone', //int
    *   ]);
    */
    public function buyPower(array $option){
        $request_id = $option['request_id'];
        $serviceID =  $option['serviceID'];
        $billersCode = $option['billersCode'];
        $variation_code = $option['variation_code'];
        $amount = $option['amount'];
        $phone =  $option['phone'];


        $jsonResponse = $this->call_api($this->url.'/pay', $option);
        
        unset($option['request_id']);
        unset($option['serviceID']);
        unset($option['billersCode']);
        unset( $option['variation_code']);
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
    *       'billersCode'  => '$billersCode', //string e.g decoder number
    *       'variation_code' => '$variation_code', //string the bouquet code
    *       'amount' => $amount, //int 
    *       'phone' => 'phone', //int
    *   ]);
    */
    public function buyTv(array $option){
        $request_id = $option['request_id'];
        $serviceID =  $option['serviceID'];
        $billersCode = $option['billersCode'];
        $variation_code = $option['variation_code'];
        $amount = $option['amount'];
        $phone =  $option['phone'];


        $jsonResponse = $this->call_api($this->url.'/pay', $option);
        
        unset($option['request_id']);
        unset($option['serviceID']);
        unset($option['billersCode']);
        unset( $option['variation_code']);
        unset($option['amount']);
        unset($option['phone']);
        return json_decode($jsonResponse);
    } 
    
    private function call_api($url, $option=array(),$header=array()){
    $curl  = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10, 
	CURLOPT_USERPWD => $this->username.":" .$this->password,
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
}
