<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>프로젝트 관리</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
<style>
img.thumbnail {
    max-width: 120px;
    height: auto;
    cursor: pointer;
    transition: 0.15s;
}
img.thumbnail:hover {
    transform: scale(1.05);
}
</style>
</head>
<body id="page-top">

<?php include_once $_SERVER['DOCUMENT_ROOT'].'/includes/sidebar.php'; ?>

<div class="container mt-5">
    <h2>프로젝트 관리</h2>
    <a href="/" class="btn btn-secondary mb-3">← 뒤로가기</a>
    <a href="/admin/projects/form" class="btn btn-success mb-3">+ 프로젝트 등록</a>

    <table class="table table-striped table-bordered text-center align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>썸네일</th>
                <th>Title</th>
                <th>Description</th>
                <th>관리</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM projects ORDER BY id DESC";
        $res = mysqli_query($conn, $sql);

        if ($res && mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $fname = $row['stored_name'] ?: $row['img'];
                $origPath = "/uploads/" . $fname;
                $thumbPath = "/uploads/thumbnail_" . $fname;

                $thumbExists = ($fname && file_exists($_SERVER['DOCUMENT_ROOT'] . $thumbPath));

                // 썸네일 or 원본 이미지 태그
                if ($fname) {
                    $imgSrc = $thumbExists ? $thumbPath : $origPath;
                    $imgTag = "<a href='" . htmlspecialchars($origPath) . "' target='_blank'>
                                  <img src='" . htmlspecialchars($imgSrc) . "' class='thumbnail' alt='thumb'>
                               </a>";
                } else {
                    $imgTag = "";
                }

                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$imgTag}</td>
                        <td>" . htmlspecialchars($row['title']) . "</td>
                        <td>" . nl2br(htmlspecialchars($row['description'])) . "</td>
                        <td>
                            <a href='/admin/projects/form?id={$row['id']}' class='btn btn-primary btn-sm'>수정</a>
                            <a href='/admin/projects/delete?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"정말 삭제하시겠습니까?\")'>삭제</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>등록된 프로젝트가 없습니다.</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
