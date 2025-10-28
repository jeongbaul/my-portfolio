<?php
session_start();
include_once "../../lib/db.php";

if (!$conn) {
    die("DB 연결 실패: db.php 경로 확인 필요!");
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<title>프로젝트 관리</title>
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
    <h2>프로젝트 관리</h2>
    <a href="/index.php" class="btn btn-secondary mb-3">← 뒤로가기</a>
    <a href="/admin/projects/form.php" class="btn btn-success mb-3">+ 프로젝트 등록</a>

    <table class="table table-striped table-bordered">
        <tr>
            <th>ID</th>
            <th>이미지</th>
            <th>Title</th>
            <th>Description</th>
            <th>관리</th>
        </tr>
        <?php
        $sql = "SELECT * FROM projects ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $link = $row['link'] ?? '#'; // 링크 없으면 #으로
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>".($row['img'] ? "<img src='/uploads/{$row['img']}' alt='project'>" : "")."</td>
                        <td><a href='".htmlspecialchars($link)."' target='_blank'>{$row['title']}</a></td>
                        <td>{$row['description']}</td>
                        <td>
                            <a href='/admin/projects/form.php?id={$row['id']}' class='btn btn-primary'>수정</a>
                            <a href='/admin/projects/delete.php?id={$row['id']}' class='btn btn-danger' onclick='return confirm(\"정말 삭제하시겠습니까?\")'>삭제</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>등록된 프로젝트가 없습니다.</td></tr>";
        }
        ?>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="/js/scripts.js"></script>
</body>
</html>
