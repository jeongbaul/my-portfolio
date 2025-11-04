<?php
include_once "../../lib/db.php";

$id = $_GET['id'] ?? null;
if ($id) {
    $sql = "DELETE FROM skills WHERE id=$id";
    mysqli_query($conn, $sql);
}

header("Location: list");
exit;
?>