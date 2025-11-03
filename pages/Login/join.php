<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/lib/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = trim($_POST['id'] ?? '');
    $pw = trim($_POST['pw'] ?? '');
    $name = trim($_POST['name'] ?? '');

    if ($id && $pw && $name) {
        $check_sql = "SELECT COUNT(*) FROM users WHERE id = ?";
        $check_stmt = mysqli_prepare($conn, $check_sql);
        mysqli_stmt_bind_param($check_stmt, "s", $id);
        mysqli_stmt_execute($check_stmt);
        mysqli_stmt_bind_result($check_stmt, $count);
        mysqli_stmt_fetch($check_stmt);
        mysqli_stmt_close($check_stmt);

        if ($count > 0) {
            echo "<script>alert('이미 존재하는 아이디입니다.'); history.back();</script>";
            exit;
        }

        $hashed_pw = password_hash($pw, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (id, pw, name, level) VALUES (?, ?, ?, 2)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $id, $hashed_pw, $name);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo "<script>alert('회원가입 완료! 로그인 페이지로 이동합니다.'); location.href='/pages/Login/login.php';</script>";
        } else {
            echo "<script>alert('회원가입 실패: 데이터베이스 오류'); history.back();</script>";
        }
    } else {
        echo "<script>alert('모든 필드를 입력해주세요.'); history.back();</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<title>회원가입 | Portfolio</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background:#f0f2f5;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
    margin:0;
  }
  .join-box {
    width:380px;
    background:#fff;
    padding:30px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
    border-radius:8px;
    text-align:center;
  }
  h2 { margin-bottom:25px; }
  input {
    width:100%;
    padding:12px;
    margin:8px 0;
    border-radius:5px;
    border:1px solid #ddd;
  }
  button {
    width:100%;
    padding:12px;
    background:#4a69bd;
    border:none;
    color:white;
    font-size:16px;
    border-radius:5px;
    cursor:pointer;
    margin-top:5px;
  }
  button:hover { background:#3b55a0; }
  .back-btn {
    background:#777;
  }
  .back-btn:hover {
    background:#555;
  }
</style>
</head>
<body>

<div class="join-box">
  <h2>회원가입</h2>
  <form method="post">
    <input type="text" name="id" placeholder="아이디" required>
    <input type="password" name="pw" placeholder="비밀번호" required>
    <input type="text" name="name" placeholder="이름" required>
    <button type="submit">가입하기</button>
  </form>
  <button class="back-btn" onclick="location.href='/pages/Login/login.php'">← 로그인으로</button>
</div>

</body>
</html>