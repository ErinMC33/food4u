<?php
setcookie('user', null, time()-3600, "/");
header("location: index.php");
?>