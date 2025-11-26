<?php
header("Content-Type: application/json; charset=utf-8");

$id = $_GET['id'] ?? "";

if ($id === "baul") {
    echo json_encode([
        "name" => "정바울",
        "Age"  => "19"
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

// 기본 응답
echo json_encode([
    "error" => "invalid id"
], JSON_UNESCAPED_UNICODE);
