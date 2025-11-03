<?php

$id = $_POST['id'] ?? null;
$title = $_POST['title'] ?? '';
$description = $_POST['description'] ?? '';
$imageFile = $_FILES['image'] ?? null;

$uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/uploads/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$stored_name = '';

if ($imageFile && $imageFile['tmp_name']) {
    $original_name = $imageFile['name'];
    $ext = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));

    $random_str = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 5);

    $stored_name = date("YmdHis") . $random_str . "." . $ext;

    $target_path = $uploadDir . $stored_name;
    move_uploaded_file($imageFile['tmp_name'], $target_path);

    if ($id) {
        $sqlOld = "SELECT image FROM skills WHERE id = $id";
        $resOld = mysqli_query($conn, $sqlOld);
        if ($rowOld = mysqli_fetch_assoc($resOld)) {
            $oldFile = $uploadDir . $rowOld['image'];
            if ($rowOld['image'] && file_exists($oldFile)) {
                unlink($oldFile);
            }
        }
    }
}

if ($id) {
    $sql = "UPDATE skills SET 
                title = '$title', 
                description = '$description'";

    if ($stored_name) {
        $sql .= ", image = '$stored_name'";
    }

    $sql .= " WHERE id = $id";
} else {
    $sql = "INSERT INTO skills (title, description, image) 
            VALUES ('$title', '$description', '$stored_name')";
}

if (mysqli_query($conn, $sql)) {
    echo "<script>
            alert('스킬이 성공적으로 저장되었습니다.');
            location.href='skill.php';
          </script>";
} else {
    echo 'DB 오류: ' . mysqli_error($conn);
}
?>