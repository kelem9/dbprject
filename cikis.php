<?php
session_start();
session_destroy();
echo "�ikis yaptiniz.Ana sayfaya y�nlendiriliyorsunuz";
header("Refresh: 2; url=index.php");
?>