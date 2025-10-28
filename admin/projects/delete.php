<?php
include_once "../../lib/db.php";

$id = $_GET['id'] ?? null;

if (!$id) {
    die("삭제할 프로젝트 ID가 없습니다.");
}

// 기존 이미지가 있으면 서버에서 삭제
$sql = "SELECT img FROM projects WHERE id = $id";
$result = mysqli_query($conn, $sql);
if ($row = mysqli_fetch_assoc($result)) {
    if ($row['img'] && file_exists("../../uploads/".$row['img'])) {
        unlink("../../uploads/".$row['img']);
    }
}

// DB에서 삭제
$sql = "DELETE FROM projects WHERE id = $id";
if (mysqli_query($conn, $sql)) {
    echo "<script>
            alert('프로젝트가 삭제되었습니다.');
            location.href='projects.php';
          </script>";
} else {
    echo "삭제 실패: " . mysqli_error($conn);
}
?>
