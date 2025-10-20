<?php
include_once "../../lib/db.php";

if (!$conn) {
    die("DB 연결 실패: db.php 경로 확인 필요!");
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<title>스킬 관리</title>
<style>
    body { font-family: Arial, sans-serif; padding:20px; }
    h2 { margin-bottom:15px; }
    table { width:100%; border-collapse:collapse; margin-top:10px; }
    th, td { border:1px solid #ccc; padding:10px; text-align:center; }
    th { background-color:#f5f5f5; }
    img { max-width:80px; height:auto; }
    .btn { display:inline-block; padding:6px 12px; text-decoration:none; border-radius:4px; margin-right:5px; }
    .btn-add { background:#2ecc71; color:white; }
    .btn-edit { background:#3498db; color:white; }
    .btn-delete { background:#e74c3c; color:white; }
</style>
</head>
<body>

<h2>스킬 관리</h2>

<a href="http://localhost" class="btn" style="background:#95a5a6; margin-bottom:10px;">← 뒤로가기</a>

<a href="/admin/skill/form.php" class="btn btn-add">+ 스킬 등록</a>

<table>
    <tr>
        <th>ID</th>
        <th>image</th>
        <th>title</th>
        <th>설명</th>
        <th>관리</th>
    </tr>

    <?php
    $sql = "SELECT * FROM skills ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                <td>{$row['id']}</td>
                <td><img src='{$row['image']}' alt='skill'></td>
                <td>{$row['title']}</td>
                <td>{$row['description']}</td>
                <td>
                    <a href='/admin/skill/form.php?id={$row['id']}' class='btn btn-edit'>수정</a>
                    <a href='/admin/skill/delete.php?id={$row['id']}' class='btn btn-delete' onclick='return confirm(\"정말 삭제하시겠습니까?\")'>삭제</a>
                </td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>등록된 스킬이 없습니다.</td></tr>";
    }
    ?>
</table>

</body>
</html>
