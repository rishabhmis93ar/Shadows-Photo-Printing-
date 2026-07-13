<?php
include_once "../../config/config.php";
include_once "../../config/functions.php";
$id = $_GET['id'];

$result = deleteRecord($conn, 'blogs', $id, '../tables.php');
?>