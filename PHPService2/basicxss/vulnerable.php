<?php
require_once('../template/head.php');
echo('Sorry, we could not find any results for: ');
echo(htmlspecialchars($_GET['q']));
require_once('../template/foot.php');
?>
