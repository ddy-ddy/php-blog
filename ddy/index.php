<?php
session_start();
error_reporting(0);
include('includes/config.php');    /*导入config配置*/
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>ddy | 博客</title>
	<meta name = "viewport" content = "width=device-width, initial-scale=1">
	<meta http-equiv = "Content-Type" content = "text/html; charset=utf-8"/>
	<link href = "css/bootstrap.css" rel = 'stylesheet' type = 'text/css'/>
	<link href = "css/style.css" rel = 'stylesheet' type = 'text/css'/>
	<link href = '//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel = 'stylesheet' type = 'text/css'>
	<link href = '//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel = 'stylesheet' type = 'text/css'>
	<link href = '//fonts.googleapis.com/css?family=Oswald' rel = 'stylesheet' type = 'text/css'>
	<link href = "css/font-awesome.css" rel = "stylesheet">
	<!-- JS -->
	<script src = "js/jquery-1.12.0.min.js"></script>
	<script src = "js/bootstrap.min.js"></script>
</head>
<body>

<!--A.头部-->
<?php include('includes/header.php'); ?>


<!--B.博客系统+照片-->
<div class = "banner">
	<div class = "container">
		<h1 class = "wow zoomIn animated animated" data-wow-delay = ".5s" style = "visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;">
			ddy | 博客系统</h1>
	</div>
</div>

<!---C.展示博客---->
<div class = "container">
	<div class = "holiday">
		<h3>博客列表</h3>
		<!--从数据库中读取博客,限制数量为4-->
        <?php $sql = "SELECT * from blog order by rand() limit 4";
        $query = $dbh->prepare($sql);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        $cnt = 1;
        if ($query->rowCount() > 0) {
            foreach ($results as $result) { ?>
				<div class = "rom-btm">
					<div class = "col-md-3 room-left wow fadeInLeft animated" data-wow-delay = ".5s">
						<img src = "admin/blogimages/<?php echo($result->BlogImage); ?>" class = "img-responsive" alt = "">
					</div>
					<div class = "col-md-6 room-midle wow fadeInUp animated" data-wow-delay = ".5s">
						<h4>博客名字: <?php echo($result->BlogName); ?></h4>
					</div>
					<div class = "col-md-3 room-right wow fadeInRight animated" data-wow-delay = ".5s">
						<a href = "blog-detail.php?pkgid=<?php echo($result->BlogId); ?>" class = "view">具体信息</a>
					</div>
					<div class = "clearfix"></div>
				</div>
            <?php }
        } ?>
		<div><a href = "blog-list.php" class = "view">查看更多的博客</a></div>
	</div>
</div>
</body>
</html>