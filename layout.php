<?php
require_once "functions.php";
$title = $title ?? "CampusCare";
$role = $_SESSION["role"] ?? "";
$name = $_SESSION["user_name"] ?? "Account";
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title><?=e($title)?> | CampusCare</title><link rel="stylesheet" href="style.css"><script src="script.js" defer></script></head><body>
<header class="topbar"><a class="brand" href="index.php"><span class="logo">C</span><span>Campus<span class="green">Care</span><small>SMART CAMPUS SERVICES</small></span></a><nav><?php if($role): ?><span class="pill"><?=e(ucfirst($role))?></span><span class="nav-name"><?=e($name)?></span><a class="btn btn-quiet" href="logout.php">Log out</a><?php else: ?><a class="btn btn-primary" href="login.php">Sign in ↗</a><?php endif; ?></nav></header><main class="container"><?php show_flash(); ?>
