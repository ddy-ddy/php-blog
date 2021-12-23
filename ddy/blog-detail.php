<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>ddy | 博客系统 博客</title>
	<meta name = "viewport" content = "width=device-width, initial-scale=1">
	<meta http-equiv = "Content-Type" content = "text/html; charset=utf-8"/>
	<!--js懒加载-->
	<script type = "applijewelleryion/x-javascript">
		 addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }

	</script>
	<link href = "css/bootstrap.css" rel = 'stylesheet' type = 'text/css'/>
	<link href = "css/style.css" rel = 'stylesheet' type = 'text/css'/>
	<link href = '//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel = 'stylesheet' type = 'text/css'>
	<link href = '//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel = 'stylesheet' type = 'text/css'>
	<link href = '//fonts.googleapis.com/css?family=Oswald' rel = 'stylesheet' type = 'text/css'>
	<link href = "css/font-awesome.css" rel = "stylesheet">
	<script src = "js/jquery-1.12.0.min.js"></script>
	<script src = "js/bootstrap.min.js"></script>
	<!--动画-->
	<link href = "css/animate.css" rel = "stylesheet" type = "text/css" media = "all">
	<script src = "js/wow.min.js"></script>
	<link rel = "stylesheet" href = "css/jquery-ui.css"/>
	<script>
        new WOW().init();
	</script>
	<script src = "js/jquery-ui.js"></script>
</head>
<body>
<!-- 头部-->
<?php include('includes/header.php'); ?>
<!--- 内容 ---->
<div class = "selectroom">
	<div class = "container">
        <?php
        $pid = intval($_GET['pkgid']);
        /*从数据库中获取id号博客*/
        $sql = "SELECT * from blog where BlogId=:pid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':pid', $pid, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        $cnt = 1;
        /*输出博客信息*/
        if ($query->rowCount() > 0) {
            foreach ($results as $result) { ?>
				<form name = "book" method = "post">
					<div class = "selectroom_top">
						<!--博客图像-->
						<div class = "col-md-4 selectroom_left wow fadeInLeft animated" data-wow-delay = ".5s">
							<img src = "admin/blogimages/<?php echo $result->BlogImage; ?>" class = "img-responsive" alt = "">
						</div>
						<!--博客名字-->
						<div class = "col-md-8 selectroom_right wow fadeInRight animated" data-wow-delay = ".5s">
							<h2><?php echo $result->BlogName; ?></h2>
							<div class = "clearfix"></div>
						</div>
						<!--博客时间-->
						<div class = "col-md-8 selectroom_right wow fadeInRight animated" data-wow-delay = ".5s">
							<h2><?php echo $result->Creationdate; ?></h2>
							<div class = "clearfix"></div>
						</div>
						<!--博客内容-->
						<p style = "padding-top: 1%"><?php echo $result->BlogContent; ?> </p>
						<div class = "clearfix"></div>
					</div>
				</form>
            <?php }
        } ?>
	</div>
</div>
</body>
</html>