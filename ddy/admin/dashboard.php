<?php
/*开始会话*/
session_start();
include('includes/config.php');
?>
	<!DOCTYPE HTML>
	<html>
	<head>
		<title>ddy | 博客系统 仪表盘</title>
		<meta name = "viewport" content = "width=device-width, initial-scale=1">
		<meta http-equiv = "Content-Type" content = "text/html; charset=utf-8"/>
		<script type = "application/x-javascript">
            addEventListener("load", function () {
                setTimeout(hideURLbar, 0);
            }, false);
		</script>
		<!-- Bootstrap-->
		<link href = "css/bootstrap.min.css" rel = 'stylesheet' type = 'text/css'/>
		<link href = "css/style.css" rel = 'stylesheet' type = 'text/css'/>
		<!--字体CSS-->
		<link href = "css/font-awesome.css" rel = "stylesheet">
		<link href = '//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel = 'stylesheet' type = 'text/css'/>
		<link href = '//fonts.googleapis.com/css?family=Montserrat:400,700' rel = 'stylesheet' type = 'text/css'>
		<script src = "js/jquery-2.1.4.min.js"></script>
	</head>
	<body>
	<div class = "page-container">
		<!--1.设置侧边栏-->
        <?php include('includes/sidebarmenu.php'); ?>
		<!--2.设置页面内容-->
		<div class = "left-content">
			<div class = "mother-grid-inner">
				<!--A1:头部-->
                <?php include('includes/header.php'); ?>
				<!--A2:设置回到首页部分-->
				<ol class = "breadcrumb">
					<li class = "breadcrumb-item"><a href = "dashboard.php">仪表盘</a> <i class = "fa fa-angle-right"></i>
					</li>
				</ol>
				<!--A3:数据统计表(自己的博客数目)-->
				<div class = "four-grids">
					<div class = "col-md-3 four-grid">
						<div class = "four-wthree">
							<div class = "icon">
								<i class = "glyphicon glyphicon-briefcase" aria-hidden = "true"></i>
							</div>
							<!--从数据库中得到所有的博客,计算row的大小-->
							<div class = "four-text">
								<h3>所有博客</h3>
                                <?php $sql1 = "SELECT BlogId from Blog";
                                $query1 = $dbh->prepare($sql1);
                                $query1->execute();
                                $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                                $cnt1 = $query1->rowCount();
                                ?>
								<h4><?php echo $cnt1; ?></h4>
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

		<!--JS-->
		<script src = "js/jquery.nicescroll.js"></script>
		<script src = "js/scripts.js"></script>
		<!-- Bootstrap JS -->
		<script src = "js/bootstrap.min.js"></script>
	</body>
	</html>
<?php ?>