<?php
session_start();
session_destroy();
header("Location: http://localhost/article-pdo/pages/index.php");
?>