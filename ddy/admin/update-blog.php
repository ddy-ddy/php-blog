<?php
session_start();
include('includes/config.php');
$pid = intval($_GET['pid']);
if (isset($_POST['submit'])) {
    $pname = $_POST['blogname'];
    $pdetails = $_POST['blogcontent'];
    echo $pname;
    $pimage = $_FILES["blogimage"]["name"];
    $sql = "update blog set BlogName=:pname,BlogContent=:pdetails where BlogId=:pid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':pname', $pname, PDO::PARAM_STR);
    $query->bindParam(':pdetails', $pdetails, PDO::PARAM_STR);
    $query->bindParam(':pid', $pid, PDO::PARAM_STR);
    $query->execute();
    $msg = "博客更新成功";
}

?>
	<!DOCTYPE HTML>
	<html>
	<head>
		<title>ddy | 博客系统 更新博客</title>
		<meta name = "viewport" content = "width=device-width, initial-scale=1">
		<meta http-equiv = "Content-Type" content = "text/html; charset=utf-8"/>
		<script type = "application/x-javascript"> addEventListener("load", function () {
                setTimeout(hideURLbar, 0);
            }, false);
		</script>
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
			<div class = "mother-grid-inner">
				<!--A1:头部-->
                <?php include('includes/header.php'); ?>
			</div>
			<!--A2:设置回到首页部分-->
			<ol class = "breadcrumb">
				<li class = "breadcrumb-item"><a href = "dashboard.php">仪表盘</a><i class = "fa fa-angle-right"></i>更新博客
				</li>
			</ol>
			<!--A3:博客信息-->
			<div class = "grid-form">
				<div class = "grid-form1">
					<h3>更新博客</h3>
					<div class = "tab-content">
						<div class = "tab-pane active" id = "horizontal-form">
                            <?php
                            $pid = intval($_GET['pid']);
                            $sql = "SELECT * from blog where BlogId=:pid";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':pid', $pid, PDO::PARAM_STR);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            $cnt = 1;
                            if ($query->rowCount() > 0)
                            {
                            foreach ($results

                            as $result)
                            { ?>
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
										<textarea class = "form-control" rows = "10" cols = "100" name = "blogcontent" id = "blogcontent" placeholder = "博客内容" required></textarea>
									</div>
								</div>
								<div class = "form-group">
									<label for = "focusedinput" class = "col-sm-2 control-label">博客照片</label>
									<div class = "col-sm-8">
										<img src = "blogimages/<?php echo $result->BlogImage; ?>" width = "200">&nbsp;&nbsp;&nbsp;<a href = "change-image.php?imgid=<?php echo htmlentities($result->BlogId); ?>">修改照片</a>
									</div>
								</div>
								<div class = "form-group">
									<label for = "focusedinput" class = "col-sm-2 control-label">上一次更新时间</label>
									<div class = "col-sm-8">
                                        <?php echo $result->UpdationDate; ?>
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