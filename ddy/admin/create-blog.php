<?php
session_start();
include('includes/config.php');
if (isset($_POST['submit'])) {
    $pname = $_POST['blogname'];
    $pdetails = $_POST['blogcontent'];
    /*$_FILES预定义的数组变量，用来获取通过POST方式上传到服务器的文件数据*/
    $pimage = $_FILES["blogimage"]["name"];
    echo $pimage;
    /*将文件移动到指定目录下面*/
    move_uploaded_file($_FILES["blogimage"]["tmp_name"], "blogimages/" . $_FILES["blogimage"]["name"]);
    $sql = "INSERT INTO blog(BlogName,BlogContent,BlogImage) VALUES(:pname,:pdetails,:pimage)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':pname', $pname, PDO::PARAM_STR);
    $query->bindParam(':pdetails', $pdetails, PDO::PARAM_STR);
    $query->bindParam(':pimage', $pimage, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) {
        $msg = "新博客已经上传";
    } else {
        $error = "上传失败,请重试";
    }
}
?>
	<!DOCTYPE HTML>
	<html>
	<head>
		<title>ddy | 博客系统 创建博客</title>
		<script type = "application/x-javascript"> addEventListener("load", function () {
                setTimeout(hideURLbar, 0);
            }, false);
		</script>
		<!-- Bootstrap -->
		<link href = "css/bootstrap.min.css" rel = 'stylesheet' type = 'text/css'/>
		<link href = "css/style.css" rel = 'stylesheet' type = 'text/css'/>
		<!--字体CSS-->
		<link href = "css/font-awesome.css" rel = "stylesheet">
		<link href = '//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel = 'stylesheet' type = 'text/css'/>
		<link href = '//fonts.googleapis.com/css?family=Montserrat:400,700' rel = 'stylesheet' type = 'text/css'>
		<script src = "js/jquery-2.1.4.min.js"></script>
		<!--错误成功提示CSS-->
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
			</div>
			<!--设置标题-->
			<ol class = "breadcrumb">
				<li class = "breadcrumb-item"><a href = "dashboard.php">仪表盘</a><i class = "fa fa-angle-right"></i>创建博客
				</li>
			</ol>
			<!--设置网格-->
			<div class = "grid-form">
				<div class = "grid-form1">
					<h3>创建博客</h3>
                    <?php if ($error) { ?>
						<div class = "errorWrap"><strong>错误</strong>:<?php echo $error; ?>
						</div><?php } else if ($msg) { ?>
						<div class = "succWrap"><strong>成功</strong>:<?php echo $msg; ?>
						</div><?php } ?>
					<!--表单-->
					<div class = "tab-content">
						<div class = "tab-pane active" id = "horizontal-form">
							<form class = "form-horizontal" name = "package" method = "post" enctype = "multipart/form-data">
								<!--A.博客名-->
								<div class = "form-group">
									<label for = "focusedinput" class = "col-sm-2 control-label">博客名</label>
									<div class = "col-sm-8">
										<input type = "text" class = "form-control1" name = "blogname" id = "blogname" placeholder = "博客名" required>
									</div>
								</div>
								<!--B.博客内容-->
								<div class = "form-group">
									<label for = "focusedinput" class = "col-sm-2 control-label">博客内容</label>
									<div class = "col-sm-8">
										<textarea class = "form-control" rows = "20" cols = "100" name = "blogcontent" id = "blogcontent" placeholder = "博客内容" required></textarea>
									</div>
								</div>
								<!--C.博客照片-->
								<div class = "form-group">
									<label for = "focusedinput" class = "col-sm-2 control-label">博客照片</label>
									<div class = "col-sm-8">
										<input type = "file" name = "blogimage" id = "blogimage" required>
									</div>
								</div>
								<!--D.按钮-->
								<div class = "row">
									<div class = "col-sm-8 col-sm-offset-2">
										<button type = "submit" name = "submit" class = "btn-primary btn">创建
										</button>
										<button type = "reset" class = "btn-inverse btn">重置信息</button>
									</div>
								</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

	<!--设置侧边栏搜索隐藏的脚本-->
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
	<!--js -->
	<script src = "js/jquery.nicescroll.js"></script>
	<script src = "js/scripts.js"></script>
	<!-- Bootstrap JS -->
	<script src = "js/bootstrap.min.js"></script>

	</body>
	</html>
<?php ?>