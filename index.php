<?php
$debug = true;

function safeParam($param) {
    return preg_replace("/[^a-zA-Z0-9_-]/", "", $param);
}

$context1 = isset($_GET['context1']) ? safeParam($_GET['context1']) : "";
$context2 = isset($_GET['context2']) ? safeParam($_GET['context2']) : "";
$action   = isset($_GET['action'])   ? safeParam($_GET['action'])   : "";

$basePath = __DIR__ . "/pages";

// API 여부 판단
$isApi = ($context1 === "api");

// API 요청은 header/footer 제외
if (!$isApi) {
    include __DIR__ . "/includes/header.php";
}

// 라우팅
if ($context1 === "" && $context2 === "" && $action === "") {

    $pagePath = $basePath . "/main.php";

} elseif ($isApi) {

    $pagePath = $basePath . "/api";

    if ($context2 !== "") $pagePath .= "/" . $context2;
    if ($action !== "") {
        $pagePath .= "/" . $action . ".php";
    } else {
        $pagePath .= ".php";
    }

} elseif ($context1 === "Login") {

    $pagePath = $basePath . "/Login/" . $context2 . ".php";

} else {

    $pagePath = $basePath;

    if ($context1 !== "") $pagePath .= "/" . $context1;
    if ($context2 !== "") $pagePath .= "/" . $context2;

    if ($action !== "") {
        $pagePath .= "/" . $action . ".php";
    } else {
        $pagePath .= "/list.php";
    }
}

// 파일 include
if (file_exists($pagePath)) {
    include $pagePath;
} else {
    http_response_code(404);
    include $basePath . "/error.php";
}

// API가 아니면 footer 추가
if (!$isApi) {
    include __DIR__ . "/includes/footer.php";
}
?>
