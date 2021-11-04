<?php

require 'csdl.php';

// Get username from db to create token
$username = mysqli_real_escape_string($conn, $_REQUEST['username']);
$password = mysqli_real_escape_string($conn, $_REQUEST['password']);

$sql = "select * from user where username = '$username' and password = md5('$password')";
$rs = mysqli_query($conn,$sql);
$data = array();
while($row = mysqli_fetch_assoc($rs)) {
    $data['token']['id'] = $row['id'];
    $data['token']['username'] = $row['username'];
    $data['token']['phanquyen'] = $row['phanquyen'];
}

// Secretkey
$key = "lehoangphuc&nguyenvuanhminh_DHHTTT13AB_IUH_DHCNTPHCM_KHOA_CNTT";
// Create token header as a JSON string sha256, sha384, sha512
$header = json_encode(['typ' => 'JWT', 'alg' => 'sha256']);
// Create token payload as a JSON string
$payload = json_encode($data);

// Encode Header to Base64Url String
$base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
// Encode Payload to Base64Url String
$base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

// Create Signature Hash
$signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $key, true);
// Encode Signature to Base64Url String
$base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

// Create JWT
$jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

echo $jwt;