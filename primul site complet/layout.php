<html>
<head>

<link rel="stylesheet" type="text/css" href="css/style.css" />

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