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
            include 'notification.php';
            $device_token = str_replace(array("\r", "\n"), '',file_get_contents("token.txt"));
            $detail = [
                "orderId" => 123,
                "foodId" => 443,
                "shouldSave" => 1,
                "id" => 1234
            ];
            $notify = new Notification($device_token,$detail);
            $result = $notify->callNotification();
            if($result){
                echo "Message Sent";
                echo "</p>";
            }else{
                echo "Message Not Sent";
                echo "</p>";
            }
        }

    ?>

    </body>
</html>