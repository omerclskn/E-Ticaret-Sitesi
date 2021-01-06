<?php include("../../config.php"); ?>
<?php
ob_start();
session_start();
if(!isset($_SESSION['adminemail'])){
    header('Location: ../../index.php');
}

if(!isset($_GET['id'])){
    header('Location: slider.php');
} else {
    $sliderid = $_GET['id'];
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
    <h1 class="page-header">Slider Düzenle</h1>
    <ul class="breadcrumb">
        <li><span class="glyphicon glyphicon-home">&nbsp;</span>Admin Panel</li>
        <li><a href="slider.php">Slider Düzenle</a></li>
    </ul>

    <?php
    $query = $db->query("SELECT * FROM slider WHERE id = '{$sliderid}'")->fetch(PDO::FETCH_ASSOC); // slider bilgilerini çek
    ?>

    <form action="" method="post" name="guncelle">
         <h4>Başlık</h4>
        <input required class="form-control" type="text" name="baslik" placeholder="baslik" value="<?php echo $query['baslik']; ?>">
        <h4>Açıklama</h4>
        <input required class="form-control" type="text" name="aciklama" placeholder="baslik" value="<?php echo $query['aciklama']; ?>">
        <h4>Ürün Adı</h4>
        <input required class="form-control" type="text" name="urunad" placeholder="baslik" value="<?php echo $query['urunad']; ?>">
        <h4>Görsel URL</h4>
        <input required class="form-control" type="text" name="gorsel" placeholder="baslik" value="<?php echo $query['gorsel']; ?>">
        <br>
        <button name="guncelle" type="submit" class="btn btn-success">Güncelle</button>

    </form>

    <?php
    if(isset($_POST['guncelle'])){
        $baslik = $_POST['baslik'];
        $aciklama = $_POST['aciklama'];
        $urunad = $_POST['urunad'];
        $gorsel = $_POST['gorsel'];

        $query = $db->prepare("UPDATE slider SET baslik = :baslik, aciklama = :aciklama, urunad = :urunad, gorsel = :gorsel WHERE id = :sliderid");
        $update = $query->execute(array(
            "baslik" => $baslik,
            "aciklama" => $aciklama,
            "urunad" => $urunad,
            "gorsel" => $gorsel,
            "sliderid" => $sliderid
        ));
        if ( $update ){

            echo '<script type="text/javascript">

Swal.fire(
                    "Başarılı",
                    "Slider bilgileri güncellendi.",
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
                    "Slider güncellenemedi.",
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