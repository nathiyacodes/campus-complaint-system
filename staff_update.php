<?php
require "db.php";require "functions.php";need_role("staff");
if($_SERVER["REQUEST_METHOD"]!=="POST"){header("Location: staff_dashboard.php");exit;}check_csrf();
$id=filter_input(INPUT_POST,"complaint_id",FILTER_VALIDATE_INT);$status=$_POST["status"]??"";$note=trim($_POST["resolution_note"]??"");
if(!$id||!in_array($status,["Assigned","In Progress","Resolved"],true)){flash("Invalid complaint update.","error");header("Location: staff_dashboard.php");exit;}
$q=$pdo->prepare("UPDATE complaints SET status=?,resolution_note=? WHERE id=? AND assigned_staff_id=?");$q->execute([$status,$note?:null,$id,(int)$_SESSION["user_id"]]);
flash($q->rowCount()?"Complaint update saved.":"No changes were needed.");header("Location: staff_dashboard.php");exit;
