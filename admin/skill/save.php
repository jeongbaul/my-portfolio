<?php
include_once "../../lib/db.php";

$id = $_POST['id'] ?? null;
$title = $_POST['title'] ?? '';
$description = $_POST['description'] ?? '';
$imageFile = $_FILES['image'] ?? null;

$uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/uploads/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$stored_name = '';

// 새 이미지가 업로드된 경우
if ($imageFile && $imageFile['tmp_name']) {
    $original_name = $imageFile['name'];
    $ext = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));

    // 중복 방지용 랜덤 문자열
    $random_str = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 5);

    // 서버에 저장될 파일명
    $stored_name = date("YmdHis") . $random_str . "." . $ext;

    $target_path = $uploadDir . $stored_name;
    move_uploaded_file($imageFile['tmp_name'], $target_path);

    // 수정일 경우, 기존 파일 삭제
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

// DB 저장
if ($id) {
    // 수정
    $sql = "UPDATE skills SET 
                title = '$title', 
                description = '$description'";

    if ($stored_name) {
        $sql .= ", image = '$stored_name'";
    }

    $sql .= " WHERE id = $id";
} else {
    // 신규 등록
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
