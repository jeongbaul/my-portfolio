<?php
include_once "../../lib/db.php";

$id = $_POST['id'] ?? null;
$title = $_POST['title'] ?? '';
$description = $_POST['description'] ?? '';
$link = $_POST['link'] ?? ''; // 새로 추가한 링크
$imgFile = $_FILES['img'] ?? null;

$uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/uploads/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$original_name = '';
$stored_name = '';
$ext = '';
$size = 0;

// 새 이미지가 업로드된 경우
if ($imgFile && $imgFile['tmp_name']) {
    $original_name = $imgFile['name'];
    $ext = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));
    $size = $imgFile['size'];

    // 중복 방지용 랜덤 5자리 문자열 생성
    $random_str = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 5);

    // 실제 서버 저장 파일명 (예: 20251021224211abcde.jpg)
    $stored_name = date("YmdHis") . $random_str . "." . $ext;

    // 파일 저장
    $target_path = $uploadDir . $stored_name;
    move_uploaded_file($imgFile['tmp_name'], $target_path);

    // 수정일 경우 기존 파일 삭제
    if ($id) {
        $sqlOld = "SELECT stored_name FROM projects WHERE id = $id";
        $resOld = mysqli_query($conn, $sqlOld);
        if ($rowOld = mysqli_fetch_assoc($resOld)) {
            $oldFile = $uploadDir . $rowOld['stored_name'];
            if ($rowOld['stored_name'] && file_exists($oldFile)) {
                unlink($oldFile);
            }
        }
    }
}

if ($id) {
    // 수정
    $sql = "UPDATE projects SET 
                title = '$title', 
                description = '$description',
                link = '$link'"; // 링크 추가

    if ($stored_name) { // 새 이미지가 있을 때만 업데이트
        $sql .= ",
                img = '$stored_name',
                original_name = '$original_name',
                stored_name = '$stored_name',
                ext = '$ext',
                size = '$size'";
    }

    $sql .= " WHERE id = $id";
    $msg = "수정";
} else {
    // 신규 등록
    $sql = "INSERT INTO projects (title, description, img, original_name, stored_name, ext, size, link)
            VALUES ('$title', '$description', '$stored_name', '$original_name', '$stored_name', '$ext', '$size', '$link')";
    $msg = "등록";
}

if (mysqli_query($conn, $sql)) {
    echo "<script>
            alert('프로젝트가 성공적으로 {$msg}되었습니다.');
            location.href='projects.php';
          </script>";
} else {
    echo 'DB 오류: ' . mysqli_error($conn);
}
?>
