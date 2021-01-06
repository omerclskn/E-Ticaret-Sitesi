<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <style>
        i,
        span,
        p,
        h2 {
            font-family: "Lato", sans-serif;
        }
        section {
            max-width: 1180px;
            margin: 0 auto;
        }
        h1 {
            font-family: "Lato", sans-serif;
            font-weight: 100;
            text-align: center;
            letter-spacing: 0.5rem;
            text-transform: uppercase;
            margin: 4rem 0 0 0;
        }
        .list {
            background: #fff;
            display: flex;
            flex-wrap: wrap;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            padding: 5rem 0;
        }
        .list > div {
            width: 200px;
            float: left;
            height: 300px;
            background: #fff;
            margin: 1%;
            position: relative;
        }
        .product > div {
            text-align: center;
            position: absolute;
            -webkit-transition: all 0.5s;
            -o-transition: all 0.5s;
            transition: all 0.5s;
            bottom: 0;
            height: 0;
            overflow: hidden;
            width: 100%;
            margin: 0 auto;
        }
        .product:hover > div {
            position: absolute;
            height: 300px;
            background: rgba(255, 255, 255, 0.5);
        }
        .product > img {
            margin: 0 auto;
            display: block;
            -webkit-transition: all 0.5s;
            -o-transition: all 0.5s;
            transition: all 0.5s;
        }
        .product:hover > img {
            -webkit-filter: blur(3px);
            filter: blur(3px);
        }
        .product > div > h2 {
            border-bottom: 1px solid #818181;
            padding: 0 0 1rem;
        }
        .descr {
            font-size: 0.8rem;
            padding: 2rem;
            line-height: 1.2rem;
        }
        .product > div > a > p {
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 1rem;
            line-height: 2rem;
            background: #000;
            color: #fff;
            position: absolute;
            width: 100%;
            bottom: 0;
            margin: 0 auto !important;
            -webkit-transition: all 0.2s;
            -o-transition: all 0.2s;
            transition: all 0.2s;
        }
        .product > div > a > p:hover {
            background: linear-gradient(
                    to right,
                    #ff6a00,
                    #ee0979
            );
            bottom: 5px;
            letter-spacing: 4px;
        }

    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>Kafto Collection -  Listeleme</title>
</head>
<link rel="stylesheet" href="main.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<body>

<?php
include("header.php");
include("config.php");
if(isset($_SESSION['id'])){
    $userid = $_SESSION['id']; }

if(!isset($_GET['listtype'])){
    header('Location: index.php');
} else {
    $listtype = $_GET['listtype'];
}

?>

<br><br>
<br>

<?php

$veriler = $db->prepare("SELECT * FROM urunler ORDER BY fiyat $listtype");
$veriler->execute();
$dizi = $veriler->fetchAll(PDO::FETCH_OBJ);

?>

<div class="itemdiv">

    <section>
        <center><a href="listele.php?listtype=desc" class="btn btn-success">Azalan Fiyat</a>
        <a href="listele.php?listtype=asc" class="btn btn-success">Artan Fiyat</a></center>
        <h1>KAFTO COLLECTION ÜRÜN LİSTESİ</h1>
        <div class="list">
            <?php foreach ($dizi as $item) { ?>
            <div class="product">
                <img alt="shoes1" width="150" src="<?php echo $item->gorsel; ?>">
                <div><h2><?php echo $item->ad; ?></h2>
                    <p class="price"><?php echo $item->fiyat; ?> TL</p>
                    <p class="descr"><?php echo $item->kategori; ?></b></p>
                    <br>
                    <a href="#"><p></p></a></div>
            </div>
            <?php } ?>
        </div>
    </section>

</div>

<script src="main.js"></script>
<footer class="footer">

    <p class="mb-1" >© Kafto 2021</p>

</footer>

</body>
</html>