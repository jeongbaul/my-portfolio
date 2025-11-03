<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'].'/lib/db.php';

if (!$conn) {
    die("DB 연결 실패: db.php 경로 확인 필요!");
}

$skills = [];
$sql_skills = "SELECT * FROM skills ORDER BY id DESC";
$result_skills = mysqli_query($conn, $sql_skills);
if ($result_skills) {
    while ($row = mysqli_fetch_assoc($result_skills)) {
        $skills[] = $row;
    }
}

$projects = [];
$sql_projects = "SELECT * FROM projects ORDER BY id DESC";
$result_projects = mysqli_query($conn, $sql_projects);
if ($result_projects) {
    while ($row = mysqli_fetch_assoc($result_projects)) {
        $projects[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<title>Stylish Portfolio - Portfolio</title>
<link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
<link href="css/styles.css" rel="stylesheet" />
</head>
<body id="page-top">

<?php include_once $_SERVER['DOCUMENT_ROOT'].'/includes/sidebar.php'; ?>