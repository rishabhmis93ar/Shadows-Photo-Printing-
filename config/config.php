<?php
define("BASE_URL", "/shadowsphotoprinting-main/");
define("ADMIN_URL", BASE_URL . "admin/");

$conn = new mysqli("localhost", "root", "", "shadowphotoprinting");

if(!$conn) {
    die("Connection Failed : " . mysqli_connect_error());
}

?>