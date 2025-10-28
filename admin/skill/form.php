<?php
include_once "../../lib/db.php";

$id = $_GET['id'] ?? null;
$skill = [
    'image' => '',
    'title' => '',
    'description' => ''
];

if ($id) {
    $sql = "SELECT * FROM skills WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        $skill = $row;
    } else {
        die("해당 스킬이 존재하지 않습니다.");
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<title><?= $id ? "스킬 수정" : "스킬 등록" ?></title>
<style>
body { font-family: Arial, sans-serif; padding:20px; }
h2 { margin-bottom:15px; }
form { width:400px; }
input[type="text"], textarea { width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:4px; }
input[type="file"] { margin-bottom:10px; }
button { padding:10px 15px; background:#2ecc71; color:white; border:none; border-radius:4px; cursor:pointer; }
button:hover { background:#27ae60; }
img { max-width:100px; margin-top:10px; display:block; }
</style>
</head>
<body>

<h2><?= $id ? "스킬 수정" : "스킬 등록" ?></h2>

<form action="save.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $id ?>">

    <label>이미지 <?= $id && $skill['image'] ? '(현재 이미지 표시)' : '' ?></label>
    <input type="file" name="image">
    <?php if ($id && $skill['image']): ?>
        <img src="/uploads/<?= htmlspecialchars($skill['image']) ?>" alt="skill">
    <?php endif; ?>

    <label>제목</label>
    <input type="text" name="title" value="<?= htmlspecialchars($skill['title']) ?>" required>

    <label>설명</label>
    <textarea name="description" rows="4" required><?= htmlspecialchars($skill['description']) ?></textarea>

    <button type="submit"><?= $id ? "수정" : "등록" ?></button>
</form>

</body>
</html>
