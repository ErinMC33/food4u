<?php
setcookie('user', null, time()-3600, "/");
header("location: food4u.php");
?>