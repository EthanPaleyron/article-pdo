<?php
$base = new PDO('mysql:host=127.0.0.1;dbname=base_articles', 'root', '');
$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>