<?php
session_start();
include_once "../../lib/db.php";

if (!$conn) {
    die("DB 연결 실패: db.php 경로 확인 필요!");
}

// 삭제 기능
$id = $_GET['id'] ?? null;
if ($id) {
    $sql = "DELETE FROM skills WHERE id=$id";
    mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<title>스킬 관리</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
<link href="/css/styles.css" rel="stylesheet" />
<style>
img { max-width:80px; height:auto; }
</style>
</head>
<body id="page-top">

<!-- 공통 사이드바 include -->
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/includes/sidebar.php'; ?>

<div class="container mt-5">
    <h2>스킬 관리</h2>
    <a href="/index.php" class="btn btn-secondary mb-3">← 뒤로가기</a>
    <a href="/admin/skill/form.php" class="btn btn-success mb-3">+ 스킬 등록</a>

    <table class="table table-striped table-bordered">
        <tr>
            <th>ID</th>
            <th>이미지</th>
            <th>Title</th>
            <th>Description</th>
            <th>관리</th>
        </tr>
        <?php
        $sql = "SELECT * FROM skills ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td><img src='{$row['image']}' alt='skill'></td>
                        <td>{$row['title']}</td>
                        <td>{$row['description']}</td>
                        <td>
                            <a href='/admin/skill/form.php?id={$row['id']}' class='btn btn-primary'>수정</a>
                            <a href='/admin/skill/delete.php?id={$row['id']}' class='btn btn-danger' onclick='return confirm(\"정말 삭제하시겠습니까?\")'>삭제</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>등록된 스킬이 없습니다.</td></tr>";
        }
        ?>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="/js/scripts.js"></script>
</body>
</html>
