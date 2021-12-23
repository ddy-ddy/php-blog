<?php
session_start();
include('includes/config.php');
$pid = intval($_GET['pid']);   /*获取变量的整数值*/
$sql = "delete from blog where BlogId=$pid";
$query = $dbh->prepare($sql);
$query->execute();
header("location:manage-blog.php");
?>