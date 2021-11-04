<?php 
require 'checkToken.php';
require 'getInfoStudent.php';
header('Content-Type: application/json; charset=UTF-8');


if(isset($_REQUEST['token'])){
    $token = $_REQUEST['token'];
    if($payload = checkToken::getToken($token)) {
        if(getInfoStudent::checkUsername($payload->token->username)) {
            print_r(getInfoStudent::getInfoStudent());
        }
        else {
            echo "username khong ton tai";
        }
    }
    else {
        echo "payload that bai";
    }
}
else{
    echo "khong co token";
}
