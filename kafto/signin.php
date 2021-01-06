<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);
include("config.php");
if(isset($_SESSION['id'])){
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <title>Kafto Collection -  Üyelik</title>
</head>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="signin.css">
<body>

<?php include("header.php"); ?>

<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form name="kayitol" method="post" action="">
			<h1>Hesabını Oluştur!</h1>
			<input required maxlength="40" type="text" name="ad" placeholder="Ad" />
			<input required maxlength="40" type="surname" name="soyad" placeholder="Soyad" />
			<input required maxlength="80" type="email" name="eposta" placeholder="E-Posta" />
			<input maxlength="40" required type="password" name="parola" placeholder="Parola" />
			<input onkeypress="return numbersonly(this, event)" maxlength="10" required type="text" name="ceptelefonu" placeholder="Cep Telefonu (başında 0 olmadan)" />
			<button type="submit" name="kayitol">Kayıt Ol</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form name="girisyap" method="post" action="">
			<h1>Giriş Yap</h1>
			<input required name="eposta" maxlength="70" type="email" placeholder="E-Posta" />
			<input required name="parola" max="50" type="password" placeholder="Parola" />
			<button name="girisyap" type="submit">GİRİŞ YAP</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Tekrar Hoş geldiniz!</h1>
				<p>Zaten bir üyeliğe sahipseniz lütfen giriş yapınız.</p>
				<button class="ghost" id="signIn">GİRİŞ YAP</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Hoş geldiniz!</h1>
				<p>Kayıt olun ve güvenli alışverişin tadını çıkarın!</p>
				<button class="ghost" id="signUp">Kayıt Ol</button>
			</div>
		</div>
	</div>
</div>

    <script src="signin.js"></script>
    <footer class="footer">
            <p class="mb-1" >© Kafto 2021</p>
          </footer>
  </body>
</html>

<!-- Kayıt Olma İşlemi -->

<?php

if(isset($_POST['kayitol'])){

    $ad = $_POST['ad']; // ad bilgisini değişkene atadık
    $soyad = $_POST['soyad']; // soyad bilgisini değişkene atadık
    $eposta = $_POST['eposta']; // eposta bilgisini değişkene atadık
    $parola = md5($_POST['parola']); // parola bilgisini değişkene atadık
    $ceptelefonu = $_POST['ceptelefonu']; // cep telefonu bilgisini değişkene atadık

    $stmt = $db->prepare("SELECT eposta, ceptelefonu FROM uyeler WHERE eposta=:eposta OR ceptelefonu=:ceptelefonu");
    $stmt->execute(array(':eposta'=>$eposta, ':ceptelefonu'=>$ceptelefonu));
    $row=$stmt->fetch(PDO::FETCH_ASSOC);

    if($row['eposta']==$eposta) { // eposta sistemde mevcutsa hata ver
        echo '<script type="text/javascript">

Swal.fire(
                    "Hata!",
                    "E-posta adresi sistemde kayıtlı.",
                    "error"
                ).then(okay => {
                    if (okay) {
                        window.location.href = "signin.php";
                    }
                });

</script>';
        exit;
    }

    else if($row['ceptelefonu']==$ceptelefonu) { // cep telefonu sistemde mevcutsa hata ver
        echo '<script type="text/javascript">

Swal.fire(
                    "Hata!",
                    "Cep telefonu sistemde kayıtlı.",
                    "error"
                ).then(okay => {
                    if (okay) {
                        window.location.href = "signin.php";
                    }
                });

</script>';
        exit;
    }

    // tüm işlemler başarılıysa kayıt olma işlemini yap

    $query = $db->prepare("INSERT INTO uyeler SET
ad = ?,
soyad = ?,
eposta = ?,
parola = ?,
ceptelefonu = ?");
    $insert = $query->execute(array(
        $ad, $soyad, $eposta, $parola, $ceptelefonu
    ));
    // kayıt işlemi sonucuna göre mesaj ver
    if ( $insert ){
        $last_id = $db->lastInsertId();
        echo '<script type="text/javascript">alert("Aramıza Hoş Geldiniz!");</script>';
    } else {
        echo '<script type="text/javascript">alert("Hata!");</script>';
    }
}

?>


<?php $v = $db->prepare("select * from uyeler where eposta=? and parola=?"); ?>

<!-- Giriş Yapma İşlemi -->

<?php if(isset($_POST['girisyap'])){

    $eposta = strip_tags($_POST['eposta']);
    $parola = md5(strip_tags($_POST['parola']));

    $v->execute(array($eposta,$parola));

    $x = $v->fetch(PDO::FETCH_ASSOC);

    $d = $v->rowCount(); // girilen bilgilere göre sistemde gelen sonucu say

    if($d){

        // kullanıcı bilgilerini çerezlere atadık ve gerekli yerlerde kullanacağız

        $_SESSION["id"] = $x["id"];
        $_SESSION["ad"] = $x["ad"];
        $_SESSION["soyad"] = $x["soyad"];
        $_SESSION["eposta"] = $x["eposta"];
        $_SESSION["ceptelefonu"] = $x["ceptelefonu"];
        $id = $_SESSION["id"];
        header('Location: index.php');

    } else {

        echo '<script type="text/javascript">

Swal.fire(
                    "Hata!",
                    "Giriş bilgileri yanlış.",
                    "error"
                ).then(okay => {
                    if (okay) {
                        window.location.href = "signin.php";
                    }
                });

</script>';

    } } ?>
