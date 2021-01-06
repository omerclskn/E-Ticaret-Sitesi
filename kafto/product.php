<?php
include("config.php");
if(isset($_GET['id'])){
    $productid = htmlspecialchars(strip_tags($_GET['id']));
    $productid = str_replace("'","",$productid);
    $productid = str_replace("<","",$productid); // gelen $_GET verisini kontrol ederek zararlı içerikleri temizledik
    $productid = str_replace(">","",$productid);
    $productid = str_replace(",","",$productid);
} else {
    header('Location: index.php');
}

$sorgula = $db->query("SELECT id FROM urunler WHERE id = '$productid'")->fetchAll();
$sorgulasay = count($sorgula);

if($sorgulasay == '0'){
    header('Location: index.php');
}

?>
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
$query = $db->query("SELECT * FROM urunler WHERE id = '{$productid}'")->fetch(PDO::FETCH_ASSOC);
?>

<br><br>
<div class="slideshow-container">

    <div class="mySlides">
        <img src="<?php echo $query['gorsel']; ?>" style="width:45%">
        <div class="text">
            <p class="uruntip"><?php echo $query['ad']; ?></p>
            <p class="uruntip"><?php echo $query['fiyat']; ?> TL<br><br>


                <a class="cart" href="product.php?islem=sepet&id=<?php echo $query['id']; ?>">Sepete Ekle</a>

            </p>

            <br><br><br><br>
            <?php if($query['cinsiyet'] == 1){ echo "Erkek Giyim"; } elseif($query['cinsiyet'] == 0){ echo "Kadın Giyim"; } else { echo "Unisex Model"; } ?>
            <p style="font-size:25px;">Mevcut Bedenler: <?php if($query['s'] != 0){ echo "[S]"; } if($query['m'] != 0){ echo "[M]"; } if($query['l'] != 0){ echo "[L]"; } ?></p>


        </div>

    </div>

</div>

<?php


if (isset($_GET['islem']) and $_GET['islem'] == 'sepet') {

    if(!isset($_SESSION['id'])){ ?>

    <script type="text/javascript">
        Swal.fire(
            "Hata!",
            "Ürünü sepete eklemek için giriş yapmanız gerekmektedir.",
            "error"
        );
    </script>

   <?php exit; }

    $userid = $_SESSION['id'];
    $productid = htmlspecialchars(strip_tags($_GET['id']));

    $sorgula = $db->query("SELECT * FROM sepet WHERE userid = '$userid' AND productid = '$productid'")->fetchAll();
    $sorgulasay = count($sorgula);

if($sorgulasay == 1){ ?>

    <script type="text/javascript">
        Swal.fire(
            "Hata!",
            "Bu ürün zaten sepetinizde mevcut.",
            "error"
        );
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
        );
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