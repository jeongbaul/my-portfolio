<?php
include_once "../../lib/db.php";

$id = $_POST['id'] ?? null;
$image = $_POST['image'] ?? '';
$title = $_POST['title'] ?? '';
$description = $_POST['description'] ?? '';

if ($id) {
    $sql = "UPDATE skills SET image='$image', title='$title', description='$description' WHERE id=$id";
} else {
    $sql = "INSERT INTO skills (image, title, description) VALUES ('$image', '$title', '$description')";
}

if (mysqli_query($conn, $sql)) {
    header("Location: skill.php");
    exit;
} else {
    echo "오류 발생: " . mysqli_error($conn);
}
?>
