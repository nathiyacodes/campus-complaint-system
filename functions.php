<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
function e($v): string { return htmlspecialchars((string)($v ?? ""), ENT_QUOTES, "UTF-8"); }
function csrf(): string {
    if (empty($_SESSION["csrf_token"])) $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
    return $_SESSION["csrf_token"];
}
function check_csrf(): void {
    if (!isset($_POST["csrf_token"], $_SESSION["csrf_token"]) ||
        !hash_equals($_SESSION["csrf_token"], (string)$_POST["csrf_token"])) {
        http_response_code(400); exit("Invalid request token. Please go back and try again.");
    }
}
function need_role(string ...$roles): void {
    if (empty($_SESSION["user_id"]) || !in_array($_SESSION["role"] ?? "", $roles, true)) {
        header("Location: login.php"); exit;
    }
}
function go_role(string $role): void {
    $pages = ["student"=>"dashboard.php", "staff"=>"staff_dashboard.php", "admin"=>"admin_dashboard.php"];
    header("Location: " . ($pages[$role] ?? "login.php")); exit;
}
function flash(string $msg, string $type="success"): void { $_SESSION["flash"] = [$msg, $type]; }
function show_flash(): void {
    if (!empty($_SESSION["flash"])) {
        [$msg,$type] = $_SESSION["flash"];
        echo '<div class="alert '.e($type).'">'.e($msg).'</div>';
        unset($_SESSION["flash"]);
    }
}
function status_badge(string $s): string {
    $classes = ["Submitted"=>"submitted","Assigned"=>"assigned","In Progress"=>"progress","Resolved"=>"resolved","Rejected"=>"rejected"];
    return '<span class="status '.($classes[$s] ?? 'submitted').'">'.e($s).'</span>';
}
