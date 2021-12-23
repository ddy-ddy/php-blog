<?php
session_start();
error_reporting(0);
include('includes/config.php');
$imgid = intval($_GET['imgid']);
if (isset($_POST['submit'])) {
    $pimage = $_FILES["blogimage"]["name"];
    /*把上传的文件移动到新位置*/
    move_uploaded_file($_FILES["blogimage"]["tmp_name"], "blogimages/" . $_FILES["blogimage"]["name"]);
    $sql = "update blog set BlogImage=:pimage where Blogid=:imgid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':imgid', $imgid, PDO::PARAM_STR);
    $query->bindParam(':pimage', $pimage, PDO::PARAM_STR);
    $query->execute();
    $msg = "图像修改成功";
}
?>
	<!DOCTYPE HTML>
	<html>
	<head>
		<title>ddy | 博客系统 上传照片</title>
		<meta name = "viewport" content = "width=device-width, initial-scale=1">
		<meta http-equiv = "Content-Type" content = "text/html; charset=utf-8"/>
		<script type = "application/x-javascript"> addEventListener("load", function () {
                setTimeout(hideURLbar, 0);
            }, false);</script>
		<link href = "css/bootstrap.min.css" rel = 'stylesheet' type = 'text/css'/>
		<link href = "css/style.css" rel = 'stylesheet' type = 'text/css'/>
		<link href = "css/font-awesome.css" rel = "stylesheet">
		<script src = "js/jquery-2.1.4.min.js"></script>
		<link href = '//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel = 'stylesheet' type = 'text/css'/>
		<link href = '//fonts.googleapis.com/css?family=Montserrat:400,700' rel = 'stylesheet' type = 'text/css'>

	</head>
	<body>
	<div class = "page-container">
		<!--1.设置页面左边内容-->
        <?php include('includes/sidebarmenu.php'); ?>
		<!--2.设置页面右边内容-->
		<div class = "left-content">
			<!--A1:头部-->
            <?php include('includes/header.php'); ?>
			<!--A2:设置回到首页部分-->
			<ol class = "breadcrumb">
				<li class = "breadcrumb-item"><a href = "dashboard.php">仪表盘</a><i class = "fa fa-angle-right"></i>更新博客照片
				</li>
			</ol>
			<!--A3:图片内容-->
			<div class = "grid-form">
				<div class = "grid-form1">
					<h3>更新博客照片</h3>
					<div class = "tab-content">
						<div class = "tab-pane active" id = "horizontal-form">
							<form class = "form-horizontal" name = "package" method = "post" enctype = "multipart/form-data">
                                <?php
                                $imgid = intval($_GET['imgid']);
                                $sql = "SELECT BlogImage from blog where BlogId=:imgid";
                                $query = $dbh->prepare($sql);
                                $query->bindParam(':imgid', $imgid, PDO::PARAM_STR);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) { ?>
										<div class = "form-group">
											<label for = "focusedinput" class = "col-sm-2 control-label">博客照片</label>
											<div class = "col-sm-8">
												<img src = "blogimages/<?php echo $result->BlogImage; ?>" width = "200">
											</div>
										</div>
										<div class = "form-group">
											<label for = "focusedinput" class = "col-sm-2 control-label">新的照片</label>
											<div class = "col-sm-8">
												<input type = "file" name = "blogimage" id = "blogimage" required>
											</div>
										</div>
                                    <?php }
                                } ?>
								<div class = "row">
									<div class = "col-sm-8 col-sm-offset-2">
										<button type = "submit" name = "submit" class = "btn-primary btn">更新
										</button>
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
					<!-- Bootstrap Core JavaScript -->
					<script src = "js/bootstrap.min.js"></script>
	</body>
	</html>
<?php ?>