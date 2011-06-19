<html>
<head>

<link rel="stylesheet" type="text/css" href="css/style.css" />

<title><?php echo $modules[$module]['VL']['title'];?></title>

</head>
<body>
    <div id="header">
<!--
        <div id="login">
            <?php
            if(isset($_SESSION['uID'])){
                echo '<a href="?show=logout">Log out</a>';
            }
            else{
                echo '<a href="?show=login">Log in</a>';
            }
            ?>
        </div>
--!>
    </div>
    <div id="menu">
        <h3>Menu here</h3>
        <?php echo build_menu_from_modules($modules, $module)?>
    </div>

    <div id="content">
        <h3><?php echo $modules[$module]['VL']['title'];?></h3>
        <p><?php include BASE_DIR . DIRECTORY_SEPARATOR . 'modules'
        . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR
        . $modules[$module]['VL']['content'];?></p>
    </div>
</body>
</html>
