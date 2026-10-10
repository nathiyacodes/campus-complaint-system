<?php
require "db.php"; require "functions.php";
if (!empty($_SESSION["user_id"])) go_role($_SESSION["role"] ?? "");
$error="";
if($_SERVER["REQUEST_METHOD"]==="POST"){
 check_csrf(); $email=strtolower(trim($_POST["email"]??"")); $password=$_POST["password"]??"";
 $q=$pdo->prepare("SELECT id,full_name,email,password_hash,role,is_approved FROM users WHERE email=? LIMIT 1"); $q->execute([$email]); $u=$q->fetch();
 if($u && password_verify($password,$u["password_hash"])){
  if($u["role"]==="staff" && (int)$u["is_approved"]!==1) $error="Your staff account is awaiting administrator approval.";
  else { session_regenerate_id(true); $_SESSION["user_id"]=(int)$u["id"]; $_SESSION["user_name"]=$u["full_name"]; $_SESSION["role"]=$u["role"]; go_role($u["role"]); }
 } else $error="Invalid email or password.";
}
$title="Sign in"; require "layout.php"; ?>
<section class="auth"><div class="auth-side"><div class="eyebrow">WELCOME BACK</div><h1>Good to see<br>you <span>again.</span></h1><p>Sign in to report issues, follow requests, or help keep your campus running smoothly.</p><p>✓ Private student reports</p><p>✓ Clear complaint updates</p><p>✓ One connected campus</p></div><div class="auth-form"><div class="eyebrow">YOUR CAMPUS ACCOUNT</div><h2>Sign in to CampusCare</h2><p class="muted">Enter your account details to continue.</p><?php if($error):?><div class="alert error"><?=e($error)?></div><?php endif;?>
<form method="post" class="form"><input type="hidden" name="csrf_token" value="<?=e(csrf())?>"><label>Email address</label><input name="email" type="email" placeholder="you@college.edu" required value="<?=e($_POST["email"]??"")?>"><label>Password</label><input name="password" type="password" placeholder="Enter your password" required><button class="btn btn-primary full">Sign in ↗</button></form><div class="links"><p>New student? <a href="register.php">Create an account</a></p><p>Staff member? <a href="staff_register.php">Register for staff access</a></p><p><a href="admin_login.php">Administrator sign in ↗</a></p></div></div></section><?php require "end.php"; ?>
