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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <meta charset="UTF-8">
    <title>Kafto - Slider Düzenle</title>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
    <link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<?php include("header.php"); ?>
<div class="col-md-9 animated bounce">
    <h1 class="page-header">Ürün Ekle</h1>
    <ul class="breadcrumb">
        <li><span class="glyphicon glyphicon-home">&nbsp;</span>Admin Panel</li>
        <li><a href="slider.php">Ürün Ekle</a></li>
    </ul>

    <form action="" method="post" name="kaydet">
        <h4>Ürün Adı</h4>
        <input required class="form-control" type="text" name="ad" placeholder="Ürün Adı" required>
        <h4>Kategori</h4>
        <select class="form-control" name="urunkategori" id="exampleFormControlSelect1" required>
            <option value="tshirt">Tshirt</option>
            <option value="sweatshirt">Sweatshirt</option>
            <option value="kapuson">Kapşon</option>
        </select>
        <h4>Cinsiyet</h4>
        <select class="form-control" name="cinsiyet" id="exampleFormControlSelect1" required>
            <option value="1">Erkek</option>
            <option value="0t">Kadın</option>
            <option value="2">Diğer</option>
        </select>
        <h4>Fiyat</h4>
        <input required class="form-control" type="text" name="fiyat" placeholder="Ürün Fiyatı">
        <h4>Görsel Dosya Adı</h4>
        <input required class="form-control" type="text" name="gorselurl" placeholder="128412.jpg" required>
        <h4>S Beden</h4>
        <select class="form-control" name="sbeden" id="exampleFormControlSelect1" required>
            <option value="99">Var</option>
            <option value="0">Yok</option>
        </select>
        <h4>M Beden</h4>
        <select class="form-control" name="mbeden" id="exampleFormControlSelect1" required>
            <option value="99">Var</option>
            <option value="0">Yok</option>
        </select>
        <h4>L Beden</h4>
        <select class="form-control" name="lbeden" id="exampleFormControlSelect1" required>
            <option value="99">Var</option>
            <option value="0">Yok</option>
        </select>
        <br>
        <button name="kaydet" type="submit" class="btn btn-success">Ekle</button>

    </form>

    <?php
    if(isset($_POST['kaydet'])){

        $ad = $_POST['ad'];
        $urunkategori = $_POST['urunkategori'];
        $cinsiyet = $_POST['cinsiyet'];
        $fiyat = $_POST['fiyat'];
        $gorselurl = $_POST['gorselurl'];
        $sbeden = $_POST['sbeden'];
        $mbeden = $_POST['mbeden'];
        $lbeden = $_POST['lbeden'];

        $query = $db->prepare("INSERT INTO urunler SET
ad = ?,
kategori = ?,
cinsiyet = ?,
fiyat = ?,
gorsel = ?,
s = ?,
m = ?,
l = ?");
        $insert = $query->execute(array(
            $ad,$urunkategori,$cinsiyet,$fiyat,$gorselurl,$sbeden,$mbeden,$lbeden
        ));

        if ( $insert ){

            echo '<script type="text/javascript">

Swal.fire(
                    "Başarılı",
                    "Ürün eklendi.",
                    "success"
                ).then(okay => {
                    if (okay) {
                        window.location.href = window.location;
                    }
                });

</script>';

        } else {
            echo '<script type="text/javascript">

Swal.fire(
                    "Hata",
                    "Ürün eklenemedi.",
                    "error"
                ).then(okay => {
                    if (okay) {
                        window.location.href = window.location;
                    }
                });

</script>';
        }

    }
    ?>

</div>
</div>

</div>
<!-- partial -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>
</body>
</html>