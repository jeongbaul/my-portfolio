<?php

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = trim($_POST['username'] ?? '');
    $pw = trim($_POST['password'] ?? '');

    if ($id === "" || $pw === "") {
        $error = "아이디와 비밀번호를 모두 입력해주세요.";
    } else {
        $stmt = mysqli_prepare($conn, "SELECT pw, name, level FROM users WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) === 1) {
            mysqli_stmt_bind_result($stmt, $hashed_pw, $name, $level);
            mysqli_stmt_fetch($stmt);

            if (password_verify($pw, $hashed_pw)) {
                $_SESSION['user_id'] = $id;
                $_SESSION['user_name'] = $name;
                $_SESSION['user_level'] = $level;

                echo "<script>alert('로그인 성공!'); location.href='/index.php';</script>";
                exit;
            } else {
                $error = "비밀번호가 일치하지 않습니다.";
            }
        } else {
            $error = "존재하지 않는 아이디입니다.";
        }
        mysqli_stmt_close($stmt);
    }
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<title>로그인 | Portfolio</title>
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
  .login-box {
    width:360px;
    background:#fff;
    padding:30px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
    border-radius:8px;
    text-align:center;
  }
  h2 {
    text-align:center;
    margin-bottom:25px;
  }
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
  button:hover {
    background:#3b55a0;
  }
  .back-btn {
    background:#777;
  }
  .back-btn:hover {
    background:#555;
  }
  .error {
    color:red;
    font-size:14px;
    margin-bottom:10px;
  }
</style>
</head>
<body>

<div class="login-box">
  <h2>로그인</h2>

  <?php if ($error): ?>
    <div class="error"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form method="POST" action="">
    <input type="text" name="username" placeholder="아이디" required>
    <input type="password" name="password" placeholder="비밀번호" required>
    <button type="submit">로그인</button>
  </form>

  <button class="back-btn" onclick="goBack()">← 뒤로가기</button>
</div>

<script>
function goBack() {
  if (document.referrer) history.back();
  else window.location.href = "http://localhost";
}
</script>

</body>
</html>