<?php
$debug = true;

function safeParam($param) {
    return preg_replace("/[^a-zA-Z0-9_-]/", "", $param);
}

$context1 = $_GET['context1'] ?? "";
$context2 = $_GET['context2'] ?? "";
$action   = $_GET['action']   ?? "";

$context1 = safeParam($context1);
$context2 = safeParam($context2);
$action   = safeParam($action);

include __DIR__ . "/includes/header.php";

$basePath = __DIR__ . "/pages";

if ($context1 === "" && $context2 === "" && $action === "") {
    $pagePath = $basePath . "/main.php";

} elseif ($context1 === "api") {
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

if (file_exists($pagePath)) {
    include $pagePath;
} else {
    http_response_code(404);
    include $basePath . "/error.php";
}

include __DIR__ . "/includes/footer.php";
?>
