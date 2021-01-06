<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>Kafto Collection -  Arama</title>
</head>
<link rel="stylesheet" href="main.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<body>

<?php

if(!isset($_POST['kelime'])){
    header('Location: index.php');
} else {
    $kelime = htmlspecialchars(strip_tags($_POST['kelime']));
    $kelime = str_replace("'","",$kelime);
    $kelime = str_replace("<","",$kelime); // gelen $_POST verisini kontrol ederek zararlı içerikleri temizledik
    $kelime = str_replace(">","",$kelime);
    $kelime = str_replace(",","",$kelime);
}

include("header.php");
include("config.php");
if(isset($_SESSION['id'])){
    $userid = $_SESSION['id']; }
?>

<br><br>

    <?php

    $veriler = $db->prepare("SELECT * FROM urunler WHERE ad LIKE '%$kelime%'");
    $veriler->execute();
    $dizi = $veriler->fetchAll(PDO::FETCH_OBJ);

    $gelen = count($dizi);

    ?>

    <?php if($gelen == 0){
        echo "<center style='margin-top: 5em'><h2>Herhangi bir ürün bulunamadı, farklı kelimeler kullanarak tekrar aramayı deneyiniz.</h2></center>";
    } ?>

    <ul class="item-show">

        <?php
        foreach ($dizi as $item) {
            ?>

            <li class="<?php echo $item->kategori; ?>"> <div class="item-display visible <?php if($item->cinsiyet == 1){ echo "Erkek"; } else { echo "Kadın"; } ?>">
                    <a href="product.php?id=<?php echo $item->id; ?>"><img src="<?php echo $item->gorsel; ?>" alt="<?php echo $item->ad; ?>"></a>
                    <div class="prices"><?php echo $item->ad; ?> - <?php echo $item->fiyat; ?> TL</div>

                    <div class="sizeselect">


                        <?php if(isset($_SESSION['ad'])){ ?>

                            <img src="cart.png" alt="Sepet">
                            <a class="cart" href="index.php?islem=sepet&id=<?php echo $item->id; ?>">Sepete Ekle</a>

                        <?php } else {  ?>

                            <a class="cart" onclick="uyegirisiyok()">Sepete Ekle</a>

                        <?php } ?>

                    </div>
                </div> </li>


        <?php } ?>

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

<script>
    // Add active class to the current button (highlight it)
    var btns = document.getElementsByClassName("sizetype");
    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function () {
            var current = document.getElementsByClassName("sizetype");
            if (current.length > 0) {
                current[0].className = current[0].className.replace(" active2", "");
            }
            this.className += " active2";
        });
    }

</script>

</body>
</html>