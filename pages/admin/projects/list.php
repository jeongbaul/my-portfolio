
<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<title>프로젝트 관리</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
<link href="/css/styles.css" rel="stylesheet" />
<style>
img.thumbnail {
    max-width: 80px;
    height: auto;
    cursor: pointer;
    transition: 0.2s;
}
img.thumbnail:hover {
    transform: scale(1.1);
}
</style>
</head>
<body id="page-top">

<?php include_once $_SERVER['DOCUMENT_ROOT'].'/includes/sidebar.php'; ?>

<div class="container mt-5">
    <h2>프로젝트 관리</h2>
    <a href="/index.php" class="btn btn-secondary mb-3">← 뒤로가기</a>
    <a href="/admin/projects/form.php" class="btn btn-success mb-3">+ 프로젝트 등록</a>

    <table class="table table-striped table-bordered text-center align-middle">
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
                $link = $row['link'] ?? '';
                $imgTag = $row['img'] 
                    ? "<a href='/uploads/{$row['img']}' target='_blank'>
                           <img src='/uploads/{$row['img']}' alt='project' class='thumbnail'>
                       </a>"
                    : "";
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$imgTag}</td>
                        <td><a href='".htmlspecialchars($link)."' target='_blank'>{$row['title']}</a></td>
                        <td>{$row['description']}</td>
                        <td>
                            <a href='/admin/projects/form.php?id={$row['id']}' class='btn btn-primary btn-sm'>수정</a>
                            <a href='/admin/projects/delete.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"정말 삭제하시겠습니까?\")'>삭제</a>
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
</body>
</html>