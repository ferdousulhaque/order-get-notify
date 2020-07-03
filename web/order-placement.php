<?php
$message = $_POST["message"];
?>

<html>
    <head>
        <title>Send Message to Kitchen</title>
    </head>
    <body>
        <?php
        
        if (!isset($_POST['submit']))
        {
        ?>
        <p>
            <form method="post" action="<?php echo $PHP_SELF;?>">
                Message: <input type="text" name="message">
                <br /><input type="submit" value="submit" name="submit">
            </form>
        </p>

        <?
        }
        else
        {
            // display the output
            echo "<p>";
            $url = 'https://fcm.googleapis.com/fcm/send';

            $fields = array (
                    'to' => str_replace(array("\r", "\n"), '',file_get_contents("token.txt")),
                    'collapse_key' => "type_a",
                    'data' => array (
                        "body" => $message,
                        "description" => $message,
                        "title" => $message,
                        "orderId" => 123,
                        "foodId" => 443,
                        "shouldSave" => 1,
                        "id" => 1234,
                        "click_action" => 'FLUTTER_NOTIFICATION_CLICK',
                        "status" => 'done'
                    ),
                    'notification' => array(
                        "body" => $message,
                        "description" => $message,
                        "title" => $message,
                        "orderId" => 123,
                        "foodId" => 443,
                        "shouldSave" => 1,
                        "id" => 1234,
                        "click_action" => 'FLUTTER_NOTIFICATION_CLICK'
                    )
            );

            $fields = json_encode ( $fields );
        
            $headers = array (
                    'Authorization: key=' . "AAAAxAr10vg:APA91bGuiArULRZzbGntMfo7esWZcF5wyksp5DfWy5mW4ouYIggOa5dxxkGS8vqI_54k_bCbA0-54C7HoMKdU4VRaypaU9G1qEydqySxQkkgJY4Oa-4gFHL1hFrKD_O_38a6B0i7Fwgx",
                    'Content-Type: application/json'
            );
        
            $ch = curl_init ();
            curl_setopt ( $ch, CURLOPT_URL, $url );
            curl_setopt ( $ch, CURLOPT_POST, true );
            curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
            curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
        
            $result = curl_exec ( $ch );
            //echo $result;
            curl_close ( $ch );
            echo "Message Sent";
            echo "</p>";
        }
        
    ?>

    </body>
</html>