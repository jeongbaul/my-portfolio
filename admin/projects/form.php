<?php
include_once "../../lib/db.php";

$id = $_GET['id'] ?? null;
$title = '';
$description = '';
$img = '';

if ($id) {
    // 수정용 데이터 조회
    $sql = "SELECT * FROM projects WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        $title = $row['title'];
        $description = $row['description'];
        $img = $row['img'];
    } else {
        die("프로젝트를 찾을 수 없습니다.");
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<title><?= $id ? '프로젝트 수정' : '프로젝트 등록' ?></title>
<style>
    body { font-family: Arial, sans-serif; padding:20px; }
    h2 { margin-bottom:20px; }
    form { max-width:600px; margin-top:20px; }
    label { display:block; margin-top:10px; font-weight:bold; }
    input[type="text"], textarea { width:100%; padding:8px; margin-top:5px; box-sizing:border-box; }
    input[type="file"] { margin-top:5px; }
    .btn { margin-top:15px; padding:8px 15px; border:none; border-radius:4px; cursor:pointer; }
    .btn-save { background:#2ecc71; color:white; }
    .btn-back { background:#95a5a6; color:white; text-decoration:none; display:inline-block; padding:8px 12px; border-radius:4px; margin-right:10px; }
    img { max-width:150px; display:block; margin-top:10px; }
</style>
</head>
<body>

<h2><?= $id ? '프로젝트 수정' : '프로젝트 등록' ?></h2>

<a href="/admin/projects/projects.php" class="btn-back">← 뒤로가기</a>

<form action="save.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $id ?>">
    
    <label for="title">Title</label>
    <input type="text" name="title" id="title" value="<?= htmlspecialchars($title) ?>" required>
    
    <label for="description">Description</label>
    <textarea name="description" id="description" rows="5" required><?= htmlspecialchars($description) ?></textarea>
    
    <label for="img">이미지 <?= $id && $img ? '(현재 이미지 표시)' : '' ?></label>
    <input type="file" name="img" id="img" accept="image/*">
    <?php if ($id && $img): ?>
        <img src="/uploads/<?= $img ?>" alt="project">
    <?php endif; ?>
    
    <button type="submit" class="btn btn-save"><?= $id ? '수정 저장' : '등록' ?></button>
</form>

</body>
</html>
