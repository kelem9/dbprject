<?php
session_start();
session_destroy();
echo "Çikis yaptiniz.Ana sayfaya yönlendiriliyorsunuz";
header("Refresh: 2; url=index.php");
?>