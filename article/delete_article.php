<?php
session_start();
require "../functions.php";
$articleId = $_GET["article_id"];

HapusData($articleId);
?>