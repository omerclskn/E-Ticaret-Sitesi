<?php include("../../config.php"); ?>
<?php
ob_start();
session_start();
if(!isset($_SESSION['adminemail'])){
    header('Location: ../../index.php');
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kafto - Slider Yönetimi</title>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
    <link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<?php include("header.php"); ?>
<div class="col-md-9 animated bounce">
    <h1 class="page-header">Raporlama Modülü</h1>
    <ul class="breadcrumb">
        <li><span class="glyphicon glyphicon-home">&nbsp;</span>Admin Panel</li>
        <li><a href="slider.php">Raporlama Modülü</a></li>
    </ul>

    <a href="uyelerrapor.php" class="btn btn-success">Üyeler Raporu</a>
    <a href="urunlerrapor.php" class="btn btn-success">Ürünler Raporu</a>
    <a href="sliderrapor.php" class="btn btn-success">Slider Raporu</a>
    <a href="sunucurapor.php" class="btn btn-success">Sunucu Raporu</a>

</div>
</div>

</div>
<!-- partial -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>
</body>
</html>