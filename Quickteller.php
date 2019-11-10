<?php

namespace netesy\vtu\quickteller;

/**
 * @author Netesy Emmanuel <netesy1@gmail.com>
 */
class BulkSms extends \yii\base\Component
{
    public $authkey;
    public $username;
    public $password;
    public $sender;
    public $url ;


    public function getBalance()
    {
        $jsonResponse = $this->curl_call($this->url.'?username='. $this->username .'&password='. $this->password . "&action=balance");
        return $jsonResponse;
    }

    /**
    *   @var Array 
    *   sample
    *   Yii::$app->bulksms->sendMessage([
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
    *   @var Array 
    *   sample
    *   Yii::$app->bulksms->sendMessage([
    *       'number' => $number,
    *       'message' => 'message',
    *       'route' => 'route',
    *   ]);
    */
    public function sendMessage(array $option){
        $number = $option['number'];
        $message =  $option['message'];
        $route =  $option['route'];
        $content = "english";
        unset($option['number']);
        unset($option['message']);
        unset($option['route']);
        $jsonResponse = $this->curl_call($this->url.'?AUTH_KEY='. $this->authkey.'&message='.$message 
            .'&senderId='.$this->sender.'&routeId='.$route.'&mobileNos='.$this->sender.'&smsContentType='.$content, 
            $option);
        return json_decode($jsonResponse);
    }

    /**
    *   @var Array 
    *   sample
    *   Yii::$app->bulksms->sendCall([
    *       'number' => $number,
    *       'message' => 'message',
    *   ]);
    */
    public function sendCall(array $option){
        $number = $option['number'];
        $message =  $option['message'];
        unset($option['number']);
        unset($option['message']);
        $jsonResponse = $this->curl_call($this->url.'?username='. $this->username .'&password='. $this->password
                .'&message='.$message .'&sender='.$this->sender.'&mobiles='.$this->sender.'&type=call', $option);
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
        curl_setopt($ch, CURLOPT_USERAGENT, "BULKSMSAPI 1.0");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if (count($option)) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $option); 
        }
        $r = curl_exec($ch);
        if($r == false){
            $text = 'error '.curl_error($ch);
            $myfile = fopen("bulksms.log", "w") or die("Unable to open file!");
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
