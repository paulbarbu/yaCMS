<html>
<head>
<style>
#content{
	text-align: left;
	
	width: 90%;
	
	position: relative;
	left:10.1%;
	
	border: #FBF9E2;
	border-style: solid;
	border-width: 1px;
	
	background-color: #FBF9E2;
}

#menu{
	width: 10%;
	
	float: left;
	
	border: #E6E6FA;
	border-style: solid;
	border-width: 1px;
	
	background-color: #E6E6FA;
}
</style>

<title><?php echo $pages[$page]['title'];?></title>

</head>
<body>
	<div id="menu">
		<h3>Menu here</h3>
		<?php echo build_menu_from_pages($pages, $page)?>
	</div>
	
	<div id="content">
		<h3>Content here</h3>
		<p><?php include __DIR__ . '/pages/' . $pages[$page]['content'];?></p>
	</div>
</body>
</html>