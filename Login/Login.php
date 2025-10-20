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
    display:none;
  }
</style>
</head>
<body>

<div class="login-box">
  <h2>로그인</h2>
  <div id="errorMessage" class="error">아이디와 비밀번호를 입력해주세요.</div>
  <form id="loginForm" onsubmit="return validateForm()">
    <input type="text" id="username" placeholder="아이디">
    <input type="password" id="password" placeholder="비밀번호">
    <button type="submit">로그인</button>
  </form>
  <button class="back-btn" onclick="goBack()">← 뒤로가기</button>
</div>

<script>
  function validateForm() {
    const id = document.getElementById("username").value;
    const pw = document.getElementById("password").value;
    const err = document.getElementById("errorMessage");

    if (id === "" || pw === "") {
      err.style.display = "block";
      return false;
    } else {
      err.style.display = "none";
      alert("로그인 시도!");
      return false;
    }
  }

  function goBack() {
    if (document.referrer) {
      history.back();
    } else {
      window.location.href = "http://localhost";
    }
  }
</script>

</body>
</html>
