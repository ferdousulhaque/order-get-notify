<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

try{
    file_put_contents('token.txt', $_GET['token']);die;
}catch(\Exception $ex){
    echo $ex->getMessage();die;
}
