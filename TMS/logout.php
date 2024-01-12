<?php
echo "run";
session_start();
session_unset();
session_destroy();
header("location:/TMS/loginpage.php");
exit();

?>