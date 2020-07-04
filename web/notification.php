<?php

/*Notification Class
* Author: A S Md Ferdousul Haque
* Email: ferdousul.haque@gmail.com
* Mobile: +8801711084714
* Calling Param: Device Token and Data Array
* Can Change the Title or Body by Passing over the Data Array with title and body
*/

class Notification
{
    private $url;
    private $fcm_key;
    private $title;
    private $body;
    private $headers;
    private $device_token;
    private $detail = [];

    /**
     * Notification constructor.
     * @param $device_token
     * @param $data
     */
    public function __construct($device_token, $data)
    {
        $this->title = "New Order Received";
        $this->body = "New Order Received";
        $this->url = 'https://fcm.googleapis.com/fcm/send';
        $this->fcm_key = "AAAAxAr10vg:APA91bGuiArULRZzbGntMfo7esWZcF5wyksp5DfWy5mW4ouYIggOa5dxxkGS8vqI_54k_bCbA0-54C7HoMKdU4VRaypaU9G1qEydqySxQkkgJY4Oa-4gFHL1hFrKD_O_38a6B0i7Fwgx";
        $this->headers = $this->generateHeaders($this->fcm_key);
        $this->device_token = $device_token;
        $this->detail = $data;
    }

    /**
     * @return bool
     */
    public function callNotification()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->generateFields()));

        $result = curl_exec($ch);
        //echo $result;
        curl_close($ch);
        return $result ? true : false;
    }

    /**
     * @param $fcm_key
     * @return array
     */
    private function generateHeaders($fcm_key)
    {
        return array(
            'Authorization: key=' . $fcm_key,
            'Content-Type: application/json'
        );
    }

    /**
     * @return array
     */
    private function generateFields()
    {
        $fields = array(
            'to' => $this->device_token,
            'collapse_key' => "type_a",
            'data' => array(
                "body" => $this->body,
                "title" => $this->title,
                "click_action" => 'FLUTTER_NOTIFICATION_CLICK',
            ),
            'notification' => array(
                "body" => $this->body,
                "title" => $this->title,
                "click_action" => 'FLUTTER_NOTIFICATION_CLICK'
            )
        );
        // Add extra details
        $fields['data'] = array_merge($fields['data'], $this->detail);
        $fields['notification'] = array_merge($fields['data'], $this->detail);
        return $fields;
    }
}

//$test = new Notification("r10vg:APA91bGuiAr", [
//    'restaurantId' => 123,
//    'orderId' => 456
//]);
//var_dump($test->callNotification());

?>