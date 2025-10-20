<?php
include_once "../../lib/db.php";

$id = $_POST['id'] ?? null;
$title = $_POST['title'] ?? '';
$description = $_POST['description'] ?? '';
$imgFile = $_FILES['img'] ?? null;

// 이미지 업로드 처리
$imgName = '';
if ($imgFile && $imgFile['tmp_name']) {
    $ext = pathinfo($imgFile['name'], PATHINFO_EXTENSION);
    $imgName = time() . '_' . rand(1000,9999) . '.' . $ext;
    move_uploaded_file($imgFile['tmp_name'], "../../uploads/" . $imgName);

    // 수정일 때 기존 이미지 삭제
    if ($id) {
        $sqlOld = "SELECT img FROM projects WHERE id = $id";
        $resOld = mysqli_query($conn, $sqlOld);
        if ($rowOld = mysqli_fetch_assoc($resOld)) {
            if ($rowOld['img'] && file_exists("../../uploads/".$rowOld['img'])) {
                unlink("../../uploads/".$rowOld['img']);
            }
        }
    }
}

if ($id) {
    // 수정
    $sql = "UPDATE projects SET title='$title', description='$description'";
    if ($imgName) {
        $sql .= ", img='$imgName'";
    }
    $sql .= " WHERE id=$id";
    $msg = "수정";
} else {
    // 신규 등록
    $sql = "INSERT INTO projects (title, description, img) VALUES ('$title', '$description', '$imgName')";
    $msg = "등록";
}

if (mysqli_query($conn, $sql)) {
    echo "<script>
            alert('프로젝트가 성공적으로 {$msg}되었습니다.');
            location.href='projects.php';
          </script>";
} else {
    echo "DB 오류: " . mysqli_error($conn);
}
?>
