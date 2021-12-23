<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>ddy | 博客系统 所有博客</title>
	<meta name = "viewport" content = "width=device-width, initial-scale=1">
	<meta http-equiv = "Content-Type" content = "text/html; charset=utf-8"/>
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
	<script>
        new WOW().init();
	</script>
</head>
<body>
<?php include('includes/header.php'); ?>

<div class = "rooms">
	<div class = "container">
		<div class = "room-bottom">
			<!--得到所有的博客信息-->
            <?php $sql = "SELECT * from blog";
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
							<a href = "blog-detail.php?pkgid=<?php echo($result->BlogId); ?>" class = "view">具体内容</a>
						</div>
						<div class = "clearfix"></div>
					</div>
                <?php }
            } ?>
		</div>
	</div>
</div>
</body>
</html>