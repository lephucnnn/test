<?php

class checkToken {

    public static function getToken($token) {
        // check so luong cua token
        if(checkToken::countToken($token)) {
            // check signature cua token
            if(checkToken::checkSignature($token)) {
                $payload = explode('.', $token)[1];
                $payloadAfterReplace = str_replace(['-', '_', ''], ['+', '/', '='], $payload);
                $decodeBase64Payload = base64_decode($payloadAfterReplace);
                return json_decode($decodeBase64Payload);
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }

    public static function checkSignature($token) {
        $key = "lehoangphuc&nguyenvuanhminh_DHHTTT13AB_IUH_DHCNTPHCM_KHOA_CNTT";

        $header = explode('.', $token)[0];
        $payload = explode('.', $token)[1];
        $signature = explode('.', $token)[2];
    
        $headerAfterReplace = str_replace(['-', '_', ''], ['+', '/', '='], $header);
        $signatureAfterReplace = str_replace(['-', '_', ''], ['+', '/', '='], $signature);
    
        $decodeBase64Header = base64_decode($headerAfterReplace);
        $decodeBase64Signature = base64_decode($signatureAfterReplace);
    
        $decodeJsonHeader = json_decode($decodeBase64Header);
    
        // dung signature nay de check
        $signatureToCheck = hash_hmac($decodeJsonHeader->alg, $header . "." . $payload, $key, true);
    
        if($signatureToCheck == $decodeBase64Signature) {
            return true;
        }
        else {
            return false;
        }
    }

    public static function countToken($token) {
        if(count(explode('.', $token)) != 3) {
            return false;
        }
        else {
            return true;
        }
    }
}