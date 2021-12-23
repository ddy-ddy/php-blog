<!--验证登陆-->
<?php
session_start();
include('includes/config.php');
if (isset($_POST['login'])) {
    $uname = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT UserName,Password FROM admin WHERE UserName=:uname and Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':uname', $uname, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        echo "<script type='text/javascript'> document.location = 'dashboard.php';</script>";
    } else {
        echo "<script>alert('登陆错误,请重新输入');</script>";
    }
}
?>

<!DOCTYPE HTML>
<html>
<head>
	<title>ddy | 博客系统 登陆</title>
	<meta name = "viewport" content = "width=device-width, initial-scale=1">
	<meta http-equiv = "Content-Type" content = "text/html; charset=utf-8"/>
	<script type = "application/x-javascript"> addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);
        function hideURLbar() {
            window.scrollTo(0, 1);
        } </script>
	<link href = "css/bootstrap.min.css" rel = 'stylesheet' type = 'text/css'/>
	<link href = "css/style.css" rel = 'stylesheet' type = 'text/css'/>
	<link rel = "stylesheet" href = "css/morris.css" type = "text/css"/>
	<link href = "css/font-awesome.css" rel = "stylesheet">
	<link rel = "stylesheet" href = "css/jquery-ui.css">
	<script src = "js/jquery-2.1.4.min.js"></script>
	<link href = '//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel = 'stylesheet' type = 'text/css'/>
	<link href = '//fonts.googleapis.com/css?family=Montserrat:400,700' rel = 'stylesheet' type = 'text/css'>
	<link rel = "stylesheet" href = "css/icon-font.min.css" type = 'text/css'/>
</head>

<!--登陆页面-->
<body>
<div class = "main-wthree">
	<div class = "container">
		<div class = "sin-w3-agile">
			<h2>登陆</h2>
			<!--登陆表单-->
			<form method = "post">
				<!--用户-->
				<div class = "username">
					<span class = "username">用户名:</span>
					<input type = "text" name = "username" class = "name" placeholder = "" required = "">
					<div class = "clearfix"></div>
				</div>
				<!--密码-->
				<div class = "password-agileits">
					<span class = "username">密码:</span>
					<input type = "password" name = "password" class = "password" placeholder = "" required = "">
					<div class = "clearfix"></div>
				</div>
				<div class = "login-w3">
					<input type = "submit" class = "login" name = "login" value = "登陆">
				</div>
				<div class = "clearfix"></div>
			</form>
			<!--返回首页-->
			<div class = "back">
				<a href = "../index.php">返回首页</a>
			</div>
		</div>
	</div>
</div>
</body>
</html>