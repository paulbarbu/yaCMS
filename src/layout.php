<?php
/**
 * @file layout.php
 * @brief HTML main file
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>

<link rel="stylesheet" type="text/css" href="css/style.css" />

<title><?php echo $modules[$module]['VL']['title'];?></title>

</head>
<body>
    <div id="header">

        <div id="login">
            <?php
            if(isset($_SESSION['uID'])){
                echo '<a href="?show=logout_user">Log out</a>';
            }
            else{
                echo '<a href="?show=login_user">Log in</a>';
            }
            ?>
        </div>

    </div>
    <div id="menu">
        <h3>Menu here</h3>
        <?php echo build_menu_from_modules($modules, $module)?>
    </div>

    <div id="content">
        <h3><?php echo $modules[$module]['VL']['title'];?></h3>
        <?php
            if(file_exists(MODULES_ROOT . $module . DIRECTORY_SEPARATOR
                            . $modules[$module]['VL']['content']) &&
                is_readable(MODULES_ROOT . $module . DIRECTORY_SEPARATOR
                . $modules[$module]['VL']['content'])){
        ?>
            <p>
        <?php
                    include MODULES_ROOT . $module . DIRECTORY_SEPARATOR
                        . $modules[$module]['VL']['content'];
            }
            else{
                echo '<h3>' , ERR_LOAD_FILE , '</h3>';
            }
        ?>

            </p>
    </div>
</body>
</html>
