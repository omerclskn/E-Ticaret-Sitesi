<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <title>Kafto Collection -  Ana Sayfa</title>
</head>
<link rel="stylesheet" href="main.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<body>

<?php
include("header.php");
include("config.php");
if(isset($_SESSION['id'])){ // session kontrol
$userid = $_SESSION['id']; }
?>

<br><br>
  <div class="slideshow-container">

      <?php

      $veriler = $db->prepare("SELECT * FROM slider");
      $veriler->execute();
      $dizi = $veriler->fetchAll(PDO::FETCH_OBJ);
      foreach ($dizi as $item) {
      ?>

<div class="mySlides">
  <img src="<?php echo $item->gorsel ?>" style="width:45%">
  <div class="text">
    <p class="uruntip"><?php echo $item->baslik ?></p>
    <br><br><br><br><br><br><br>
      <?php echo $item->aciklama ?>
    <p style="font-size:15px;"><?php echo $item->urunad ?></p>
  </div>

</div>

      <?php } ?>

<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>

</div>
<br>

<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span>
  <span class="dot" onclick="currentSlide(2)"></span>
  <span class="dot" onclick="currentSlide(3)"></span>
</div>

<div class="itemdiv">
    <ul class="category">
  <li><a onclick="clickfunction(1)" class="itemtype" >T-Shirt</a></li>
  <li><a onclick="clickfunction(2)" class="itemtype" >Sweatshirt</a></li>
  <li><a onclick="clickfunction(3)" class="itemtype" >Kapşonlu</a></li>
  <select class="selectsex" id="sex">
    <option value="0">Cinsiyet:</option>
    <option value="1">Erkek</option>
    <option value="2">Kadın</option>
  </select>
  <select class="selectsize" id="size">
    <option value="0">Beden:</option>
    <option value="1">S</option>
    <option value="2">M</option>
    <option value="3">L</option>
  </select>
  <a onclick="filter()" class="sifirla">Filtrele</a>
  <a onclick="sifirla()" class="sifirla">Sıfırla</a>


</ul>

    <?php

    $toplamVeri = $db->query("SELECT COUNT(ad) FROM urunler")->fetchColumn();
    $goster = 8; // her sayfada kaç veri olacağını belirle
    $toplamSayfa = ceil($toplamVeri / $goster);
    if(isset($_GET['s'])){
    $sayfa = $_GET["s"]; } else {
        $sayfa = 1;
    }
    if(!empty($sayfa) && !is_numeric($sayfa)){
        header('Location: index.php');
    }
    if($sayfa < 1) $sayfa = 1;
    if($sayfa > $toplamSayfa)
    {
        $sayfa = (int)$toplamSayfa;
    }
    $limit = ($sayfa - 1) * $goster;

    $veriler = $db->prepare("SELECT * FROM urunler ORDER BY id DESC LIMIT $limit, $goster");
    $veriler->execute();
    $dizi = $veriler->fetchAll(PDO::FETCH_OBJ);

    ?>

<ul class="item-show">

<?php
foreach ($dizi as $item) {
?>

  <li class="<?php echo $item->kategori; ?>"> <div class="item-display visible <?php if($item->cinsiyet == 1){ echo "Erkek"; } else { echo "Kadın"; } ?>">
    <a href="product.php?id=<?php echo $item->id; ?>"><img src="<?php echo $item->gorsel; ?>" alt="<?php echo $item->ad; ?>"></a>
    <div class="prices"><?php echo $item->ad; ?> - <?php echo $item->fiyat; ?> TL</div>

    <div class="sizeselect">

        <b>Bedenler:</b> <?php if($item->s != 0){ echo "[S]"; } ?><?php if($item->m != 0){ echo "[M]"; } ?><?php if($item->l != 0){ echo "[L]"; } ?>

        <?php if(isset($_SESSION['ad'])){ ?>

        <img src="cart.png" alt="Sepet">
        <a class="cart" href="index.php?islem=sepet&id=<?php echo $item->id; ?>">Sepete Ekle</a>

        <?php } else {  ?>

            <a class="cart" onclick="uyegirisiyok()">Sepete Ekle</a>

        <?php } ?>

    </div>
  </div> </li>


    <?php } ?>

    <?php

    for($i = 1; $i<=$toplamSayfa;$i++)
    {
        ?>

        <a style="text-align:center; font-size: 30px; float:left; margin-bottom:2em;" href="index.php?s=<?php echo $i;?>"><?php echo $i;?></a>
        <?php
    }

    ?>

</ul>

</div>

<?php


    if (isset($_GET['islem']) and $_GET['islem'] == 'sepet') {
        $productid = htmlspecialchars(strip_tags($_GET['id']));

        $sorgula = $db->query("SELECT * FROM sepet WHERE userid = '$userid' AND productid = '$productid'")->fetchAll();
        $sorgulasay = count($sorgula);

        if($sorgulasay == 1){ ?>

        <script type="text/javascript">
            Swal.fire(
                "Hata!",
                "Bu ürün zaten sepetinizde mevcut.",
                "error"
            ).then(okay => {
                if (okay) {
                    window.location.href = "index.php";
                }
            });
        </script>

        <?php exit; }

        $query = $db->prepare("INSERT INTO sepet SET
userid = ?,
productid = ?");
        $insert = $query->execute(array(
                $userid, $productid
        ));

        if ( $insert ){ ?>

            <script type="text/javascript">
                Swal.fire(
                    "Başarılı!",
                    "Ürün sepete eklendi.",
                    "success"
                ).then(okay => {
                    if (okay) {
                        window.location.href = "index.php";
                    }
                });
            </script>

        <?php }
    }


?>

<script src="main.js"></script>
<footer class="footer">

        <p class="mb-1" >© Kafto 2021</p>

      </footer>

</body>
</html>
