<?php
session_start();
$username = 'admin';
error_reporting(0);
include('includes/config.php');

// 修改密码
if (isset($_POST['submit'])) {
    $password = $_POST['password'];
    $newpassword = $_POST['newpassword'];
    $sql = "SELECT Password FROM admin WHERE UserName=:username and Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        $con = "update admin set Password=:newpassword where UserName=:username";
        $chngpwd1 = $dbh->prepare($con);
        $chngpwd1->bindParam(':username', $username, PDO::PARAM_STR);
        $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
        $chngpwd1->execute();
        $msg = "密码修改成功";
    } else {
        $error = "密码错误";
    }
}
?>

	<!DOCTYPE HTML>
	<html>
	<head>
		<title>ddy | 博客系统 修改密码</title>

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
		<script src = "js/jquery-2.1.4.min.js"></script>
		<link href = '//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel = 'stylesheet' type = 'text/css'/>
		<link href = '//fonts.googleapis.com/css?family=Montserrat:400,700' rel = 'stylesheet' type = 'text/css'>
		<link rel = "stylesheet" href = "css/icon-font.min.css" type = 'text/css'/>
		<script type = "text/javascript">
            function valid() {
                if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
                    alert("再次输入密码与新密码不匹配  !!");
                    document.chngpwd.confirmpassword.focus();
                    return false;
                }
                return true;
            }
		</script>
		<style>
			.errorWrap {
				padding: 10px;
				margin: 0 0 20px 0;
				background: #fff;
				border-left: 4px solid #dd3d36;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			}

			.succWrap {
				padding: 10px;
				margin: 0 0 20px 0;
				background: #fff;
				border-left: 4px solid #5cb85c;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			}
		</style>

	</head>
	<body>
	<div class = "page-container">
		<!--1.设置侧边栏-->
        <?php include('includes/sidebarmenu.php'); ?>
		<!--2.设置页面内容-->
		<div class = "left-content">
			<!--设置头部-->
			<div class = "mother-grid-inner">
                <?php include('includes/header.php'); ?>
				<div class = "clearfix"></div>
			</div>
			<!--设置标题-->
			<ol class = "breadcrumb">
				<li class = "breadcrumb-item"><a href = "dashboard.php">仪表盘</a><i class = "fa fa-angle-right"></i>更改密码
				</li>
			</ol>
			<!--设置网格-->
			<div class = "grid-form">

				<div class = "grid-form1">

                    <?php if ($error) { ?>
						<div class = "errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?>
						</div><?php } else if ($msg) { ?>
						<div class = "succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?>
						</div><?php } ?>

					<div class = "panel-body">
						<form name = "chngpwd" method = "post" class = "form-horizontal" onSubmit = "return valid();">

							<div class = "form-group">
								<label class = "col-md-2 control-label">现在的密码</label>
								<div class = "col-md-8">
									<div class = "input-group">
									<span class = "input-group-addon">
										<i class = "fa fa-key"></i>
									</span>
										<input type = "password" name = "password" class = "form-control1" id = "exampleInputPassword1" placeholder = "Current Password" required = "">
									</div>
								</div>
							</div>

							<div class = "form-group">
								<label class = "col-md-2 control-label">新密码</label>
								<div class = "col-md-8">
									<div class = "input-group">
									<span class = "input-group-addon">
										<i class = "fa fa-key"></i>
									</span>
										<input type = "password" class = "form-control1" name = "newpassword" id = "newpassword" placeholder = "New Password" required = "">
									</div>
								</div>
							</div>

							<div class = "form-group">
								<label class = "col-md-2 control-label">再次确认密码</label>
								<div class = "col-md-8">
									<div class = "input-group">
									<span class = "input-group-addon">
										<i class = "fa fa-key"></i>
									</span>
										<input type = "password" class = "form-control1" name = "confirmpassword" id = "confirmpassword" placeholder = "Confrim Password" required = "">
									</div>
								</div>
							</div>

							<div class = "col-sm-8 col-sm-offset-2">
								<button type = "submit" name = "submit" class = "btn-primary btn">提交</button>
								<button type = "reset" class = "btn-inverse btn">重置</button>
							</div>
					</div>

					</form>
				</div>
			</div>
		</div>

	</div>
	<script>
        var toggle = true;
        $(".sidebar-icon").click(function () {
            if (toggle) {
                $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
                $("#menu span").css({"position": "absolute"});
            } else {
                $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
                setTimeout(function () {
                    $("#menu span").css({"position": "relative"});
                }, 400);
            }

            toggle = !toggle;
        });
	</script>
	<script src = "js/jquery.nicescroll.js"></script>
	<script src = "js/scripts.js"></script>
	<script src = "js/bootstrap.min.js"></script>

	</body>
	</html>
<?php ?>