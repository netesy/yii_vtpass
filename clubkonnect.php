<?php

namespace netesy\vtu\clubkonnect;

/**
 * @author Netesy Emmanuel <netesy1@gmail.com>
 */
class ClubKonnect extends \yii\base\Component
{
    public $authkey;
    public $username;
    public $password;
    public $sender;
    public $url ;


    public function _constructor($userid, $apikey, $url){
        $this->username = $userid;
        $this->password = $apikey;
        $this->url = $url;
    }
    /**
    *   @var Array 
    *   sample
    *   Yii::$app->clubkonnect->getBalance([
    *       'UserID' => 'the club connect userid',
    *       'APIKey' => 'the api key',
    *   ]);
    */
    public function getBalance(array $option)
    {
        $jsonResponse = $this->curl_call($this->url.'/APIWalletBalanceV1.asp?UserID='. $this->username .'&APIKey='. $this->password);
        return $jsonResponse;
    }

    /**
    *   @var Array 
    *   sample
    *   Yii::$app->clubkonnect->buyAirtime([
    *       'number' => $number,
    *       'amount' => 'amount purchased',
    *       'network' => 'network',
    *       'ref' => 'reference code',
    *   ]);
    */
    public function buyAirtime(array $option){
        $number = $option['number'];
        $amount =  $option['amount'];
        $network =  $option['network'];
        $ref =  $option['ref'];
        unset($option['number']);
        unset($option['amount']);
        unset($option['network']);
        unset($option['ref']);
        $jsonResponse = $this->curl_call($this->url.'/APIAirtimeV1.asp?UserID='. $this->username .'&APIKey='. $this->password
                .'&MobileNetwork='.$network.'&Amount='.$amount.'&MobileNumber='.$number.'&RequestID='.$ref.'&CallBackURL='.$this->sender, $option);
        return json_decode($jsonResponse);
    }

    /**
    *   @var Array 
    *   sample
    *   Yii::$app->clubkonnect->buyData([
    *       'number' => $number,
    *       'plan' => 'data plan size,
    *       'network' => 'network',
    *       'ref' => 'reference code',
    *   ]);
    */
    public function buyData(array $option){
        $number = $option['number'];
        $plan =  $option['plan'];
        $network =  $option['network'];
        $ref =  $option['ref'];
        unset($option['number']);
        unset($option['amount']);
        unset($option['network']);
        unset($option['ref']);
        $jsonResponse = $this->curl_call($this->url.'/APIDatabundleV1.asp?UserID='. $this->username .'&APIKey='. $this->password
                .'&MobileNetwork='.$network.'&DataPlan='.$plan.'&MobileNumber='.$number.'&RequestID='.$ref.'&CallBackURL='.$this->sender, $option);
        return json_decode($jsonResponse);
    }

    /**
    *   @var Array 
    *   sample
    *   Yii::$app->clubkonnect->buyCable([
    *       'number' => $number,
    *       'amount' => 'amount purchased',
    *       'network' => 'network',
    *       'ref' => 'reference code',
    *   ]);
    */
    public function buyCable(array $option){
        $cable = $option['cable'];
        $bouquet =  $option['bouquet'];
        $smartcard =  $option['smartcard'];
        $ref =  $option['ref'];
        unset($option['cable']);
        unset($option['bouquet']);
        unset($option['smartcard']);
        unset($option['ref']);
        $jsonResponse = $this->curl_call($this->url.'/APICableTVV1.asp?UserID='. $this->username .'&APIKey='. $this->password
                .'&CableTV='.$cable.'&Package='.$bouquet.'&SmartCardNo='.$smartcard.'&RequestID='.$ref.'&CallBackURL='.$this->sender, $option);
        return json_decode($jsonResponse);
    }
        /**
    *   @var Array 
    *   sample
    *   Yii::$app->clubkonnect->buyPower([
    *       'electric' => 'electric company',
    *       'amount' => 'amount purchased',
    *       'metertype' => 'meter type',
    *       'meterno' => 'meter number',
    *       'ref' => 'reference code',
    *   ]);
    */
    public function buyPower(array $option){
        $electric = $option['electric'];
        $metertype =  $option['metertype'];
        $meterno =  $option['meterno'];
        $amount =  $option['amount'];
        $ref =  $option['ref'];
        unset($option['electric']);
        unset($option['metertype']);
        unset($option['meterno']);
        unset($option['amount']);
        unset($option['ref']);
        $jsonResponse = $this->curl_call($this->url.'/APIElectricityV1.asp?UserID='. $this->username .'&APIKey='. $this->password
                .'&ElectricCompany='.$electric.'&MeterType='.$metertype.'&MeterNo='.$meterno.'&Amount='.$amount.'&RequestID='.$ref.'&CallBackURL='.$this->sender, $option);
        return json_decode($jsonResponse);
    }

        /**
    *   @var Array 
    *   sample
    *   Yii::$app->clubkonnect->checkDecoder([
    *       'cable' => 'satellite provider',
    *   ]);
    */
    public function checkDecoder(array $option){
        $cable =  $option['cable'];
        $smartcard =  $option['smartcard'];
        unset($option['cable']);
        unset($option['smartcard']);
        $jsonResponse = $this->curl_call($this->url.'/APIVerifyTVV1.0.asp?UserID='. $this->username .'&APIKey='. $this->password
                .'&Cabletv='.$cable.'&smartcardno='.$smartcard, $option);
        return json_decode($jsonResponse);
    }
    /**
    *   @var Array 
    *   sample
    *   Yii::$app->clubkonnect->checkStatus([
    *       'ref' => 'reference code',
    *   ]);
    */
    public function checkStatus(array $option){
        $ref =  $option['ref'];
        unset($option['ref']);
        $jsonResponse = $this->curl_call($this->url.'/APIQueryV1.asp?UserID='. $this->username .'&APIKey='. $this->password
                .'&RequestID='.$ref, $option);
        return json_decode($jsonResponse);
    }

    /**
    *   @var Array 
    *   sample
    *   Yii::$app->clubkonnect->cancelTransaction([
    *       'ref' => 'reference code',
    *   ]);
    */
    public function cancelTransaction(array $option){
        $ref =  $option['ref'];
        unset($option['ref']);
        $jsonResponse = $this->curl_call($this->url.'/APICancelV1.asp?UserID='. $this->username .'&APIKey='. $this->password
                .'&OrderID='.$ref, $option);
        return json_decode($jsonResponse);
    }


    // public function hook()
    // {
    //     $json = file_get_contents('php://input');
    //     return json_decode($json);
    // }

    // private function array_push_assoc(&$array, $key, $value){
    //    $array[$key] = $value;
    // }

    private function curl_call($url, $option=array(), $headers=array()){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_USERAGENT, "CardBuyAPI 1.0");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if (count($option)) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $option); 
        }
        $r = curl_exec($ch);
        if($r == false){
            $text = 'error '.curl_error($ch);
            $myfile = fopen("cardbuy.log", "w") or die("Unable to open file!");
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

        if (class_exists('CURLFile'))
            return new \CURLFile($realPath);

        return '@' . $realPath;
    }
}
