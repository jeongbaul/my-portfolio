<?php
$id = $_POST['id'] ?? null;
$title = $_POST['title'] ?? '';
$description = $_POST['description'] ?? '';
$link = $_POST['link'] ?? '';
$imgFile = $_FILES['img'] ?? null;

$uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/uploads/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$original_name = '';
$stored_name = '';
$ext = '';
$size = 0;

if ($imgFile && !empty($imgFile['tmp_name'])) {
    $original_name = $imgFile['name'];
    $ext = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));
    $size = $imgFile['size'];

    $random_str = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6);
    $stored_name = date("YmdHis") . $random_str . "." . $ext;
    $target_path = $uploadDir . $stored_name;

    if (!move_uploaded_file($imgFile['tmp_name'], $target_path)) {
        die("파일 업로드 실패.");
    }

    // 썸네일 생성 (thumbnail_{stored_name})
    $thumb_path = $uploadDir . "thumbnail_" . $stored_name;
    createThumbnail($target_path, $thumb_path, 300, 200); // 사이즈 필요시 조절
}

// DB 저장/수정
if ($id!="") {
    $sql = "UPDATE projects SET title='".mysqli_real_escape_string($conn,$title)."', description='".mysqli_real_escape_string($conn,$description)."', link='".mysqli_real_escape_string($conn,$link)."'";
    if ($stored_name) {
        $sql .= ", img='".mysqli_real_escape_string($conn,$stored_name)."', original_name='".mysqli_real_escape_string($conn,$original_name)."', stored_name='".mysqli_real_escape_string($conn,$stored_name)."', ext='".mysqli_real_escape_string($conn,$ext)."', size='".intval($size)."'";
    }
    $sql .= " WHERE id=" . intval($id);
    $msg = "수정";
} else {
    $sql = "INSERT INTO projects (title, description, img, original_name, stored_name, ext, size, link)
            VALUES (
                '".mysqli_real_escape_string($conn,$title)."',
                '".mysqli_real_escape_string($conn,$description)."',
                '".mysqli_real_escape_string($conn,$stored_name)."',
                '".mysqli_real_escape_string($conn,$original_name)."',
                '".mysqli_real_escape_string($conn,$stored_name)."',
                '".mysqli_real_escape_string($conn,$ext)."',
                '".intval($size)."',
                '".mysqli_real_escape_string($conn,$link)."'
            )";
    $msg = "등록";
}
if (mysqli_query($conn, $sql)) {
    echo "<script>alert('프로젝트가 성공적으로 {$msg}되었습니다.'); location.href='list';</script>";
    exit;
} else {
    echo 'DB 오류: ' . mysqli_error($conn);
    exit;
}
/**
 * createThumbnail : GD로 썸네일 생성
 * - src: 원본 전체 경로
 * - dest: 저장할 썸네일 전체 경로
 * - $maxWidth, $maxHeight : 썸네일 박스 크기 (비율 유지하여 채움)
 */
function createThumbnail($src, $dest, $maxWidth, $maxHeight) {
    if (!extension_loaded('gd')) return false;

    $info = @getimagesize($src);
    if (!$info) return false;
    $srcWidth  = $info[0];
    $srcHeight = $info[1];
    $mime = $info['mime'];

    switch ($mime) {
        case 'image/jpeg': $srcImg = imagecreatefromjpeg($src); break;
        case 'image/png':  $srcImg = imagecreatefrompng($src); break;
        case 'image/gif':  $srcImg = imagecreatefromgif($src); break;
        default: return false;
    }

    // 비율 유지해서 썸네일 크기 계산
    $ratio = min($maxWidth / $srcWidth, $maxHeight / $srcHeight);
    $thumbW = max(1, (int)($srcWidth * $ratio));
    $thumbH = max(1, (int)($srcHeight * $ratio));

    $thumb = imagecreatetruecolor($thumbW, $thumbH);

    // PNG/GIF 투명도 처리
    if ($mime === 'image/png' || $mime === 'image/gif') {
        imagecolortransparent($thumb, imagecolorallocatealpha($thumb, 0, 0, 0, 127));
        imagealphablending($thumb, false);
        imagesavealpha($thumb, true);
    }

    imagecopyresampled($thumb, $srcImg, 0, 0, 0, 0, $thumbW, $thumbH, $srcWidth, $srcHeight);

    // 항상 JPEG로 저장 (품질 85) — PNG 원본은 JPEG로 바꿔도 상관없다면 괜찮음.
    imagejpeg($thumb, $dest, 85);

    imagedestroy($srcImg);
    imagedestroy($thumb);
    return true;
}
