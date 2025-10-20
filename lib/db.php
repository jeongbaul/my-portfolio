<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "portfolio";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("DB 연결 실패: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");
?>
