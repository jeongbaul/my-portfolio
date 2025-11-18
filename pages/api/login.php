<?php
header("Content-Type: application/json");

// DB 연결
$conn = new mysqli("localhost", "root", "", "portfolio");
$conn->set_charset("utf8");

// JSON 입력 받기
$json = file_get_contents("php://input");
$data = json_decode($json, true);

$id = $data["id"] ?? "";
$pw = $data["pw"] ?? "";

// DB 조회 (id, pw 컬럼 사용)
$sql = "SELECT * FROM users WHERE id = ? AND pw = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $id, $pw);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // 로그인 성공
    $_SESSION["user_id"] = $id;
    echo json_encode(["status" => "success"]);
} else {
    // 로그인 실패
    echo json_encode(["status" => "error"]);
}
