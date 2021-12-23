<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
	<!DOCTYPE HTML>
	<html>
	<head>
		<title>ddy | 博客系统 管理博客信息</title>
		<meta name = "viewport" content = "width=device-width, initial-scale=1">
		<meta http-equiv = "Content-Type" content = "text/html; charset=utf-8"/>
		<script type = "application/x-javascript"> addEventListener("load", function () {
                setTimeout(hideURLbar, 0);
            }, false)
		</script>
		<!-- Bootstrap -->
		<link href = "css/bootstrap.min.css" rel = 'stylesheet' type = 'text/css'/>
		<link href = "css/style.css" rel = 'stylesheet' type = 'text/css'/>
		<!--字体的CSS-->
		<link href = "css/font-awesome.css" rel = "stylesheet">
		<link href = '//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel = 'stylesheet' type = 'text/css'/>
		<link href = '//fonts.googleapis.com/css?family=Montserrat:400,700' rel = 'stylesheet' type = 'text/css'>
		<!--表格的CSS-->
		<link rel = "stylesheet" type = "text/css" href = "css/table-style.css"/>
		<script src = "js/jquery-2.1.4.min.js"></script>
	</head>
	<body>
	<div class = "page-container">
		<!--1.设置页面左边内容-->
        <?php include('includes/sidebarmenu.php'); ?>
		<!--2.设置页面右边内容-->
		<div class = "left-content">
			<!--A1:头部-->
			<div class = "mother-grid-inner">
                <?php include('includes/header.php'); ?>
			</div>
			<!--A2:设置回到首页部分-->
			<ol class = "breadcrumb">
				<li class = "breadcrumb-item"><a href = "dashboard.php">仪表盘</a><i class = "fa fa-angle-right"></i>修改博客信息
				</li>
			</ol>
			<!--A3:设置博客列表-->
			<div class = "agile-grids">
				<div class = "agile-tables">
					<div class = "w3l-table-info">
						<h2>修改博客信息</h2>
						<table id = "table">
							<thead>
							<tr>
								<th>#</th>
								<th>博客名字</th>
								<th>博客创建时间</th>
								<th>按钮1</th>
								<th>按钮2</th>
							</tr>
							</thead>
							<tbody>
                            <?php $sql = "SELECT * from blog";
                            $query = $dbh->prepare($sql);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            $cnt = 1;
                            if ($query->rowCount() > 0) {
                                foreach ($results as $result) { ?>
									<tr>
										<td><?php echo $cnt; ?></td>
										<td><?php echo $result->BlogName; ?></td>
										<td><?php echo $result->Creationdate; ?></td>
										<!--更新博客信息-->
										<td>
											<a href = "update-blog.php?pid=<?php echo $result->BlogId; ?>">
												<button type = "button" class = "btn btn-primary btn-block">修改博客
												</button>
											</a></td>
										<!--删除博客？？？-->
										<td>
											<a href = "delete.php?pid=<?php echo $result->BlogId; ?>">
												<button type = "button" onclick = "return confirm('确定要删除吗?')" class = "btn btn-primary btn-block">
													删除博客
												</button>
											</a></td>
									</tr>
                                    <?php $cnt = $cnt + 1;
                                }
                            } ?>
							</tbody>
						</table>
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