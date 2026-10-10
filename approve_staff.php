
<?php
session_start();
require_once "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION["role"] !== "admin") {
    http_response_code(403);
    exit("Access denied.");
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit("Method not allowed.");
}

$staffId = filter_input(INPUT_POST, "staff_id", FILTER_VALIDATE_INT);

if (!$staffId) {
    http_response_code(400);
    exit("Invalid staff ID.");
}

$stmt = $pdo->prepare(
    "UPDATE users
     SET is_approved = 1
     WHERE id = ? AND role = 'staff' AND is_approved = 0"
);

$stmt->execute([$staffId]);

header("Location: admin_dashboard.php");
exit;
