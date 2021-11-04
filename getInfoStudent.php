<?php

class getInfoStudent {

    public static function getInfoStudent() {
        require 'csdl.php';
        $sql = "select * from thongtinhoctap";
        $rs = mysqli_query($conn, $sql);
        $data = array();
        while($row = mysqli_fetch_assoc($rs)) {
            $data['student'][] = $row;
        }
        echo json_encode($data);
    }
    
    public static function checkUsername($username) {
        require 'csdl.php';
        $username = mysqli_real_escape_string($conn, $username);

        $sql = "select * from user where username = '$username'";
        if($rs = mysqli_query($conn, $sql)) {
            if(mysqli_num_rows($rs) != 0) {
                return true;
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }
}