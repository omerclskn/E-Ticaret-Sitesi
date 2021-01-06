<?php
ob_start();
session_start(); // daha önce admin girişi yapıldı mı yapılmadı mı kontrol et
include("../config.php");
if(isset($_SESSION['adminemail'])){
    header('Location: panel/index.php');
}
?>
<!DOCTYPE html>
<html lang="en" >
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <meta charset="UTF-8">
  <title>Kafto Admin Panel</title>
  <link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<hgroup>
  <h1>Kafto Admin Panel</h1>
  <h3>Hoş geldiniz</h3>
</hgroup>
<form action="" method="post" name="giris">
  <div class="group">
    <input name="eposta" type="email" required><span class="highlight"></span><span class="bar"></span>
    <label>E-posta</label>
  </div>
    <div class="group">
        <input name="parola" type="password" required><span class="highlight"></span><span class="bar"></span>
        <label>Parola</label>
    </div>
  <button name="giris" type="submit" class="button buttonBlue">Giriş Yap
    <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
  </button>
</form>
<footer><img src="https://www.polymer-project.org/images/logos/p-logo.svg">
  <p>Kafto Collection - 2021</p>
</footer>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><script  src="./script.js"></script>

<?php $v = $db->prepare("select * from admin where eposta=? and parola=?"); ?>

<?php if(isset($_POST['giris'])){

    $eposta = strip_tags($_POST['eposta']);
    $parola = md5(strip_tags($_POST['parola']));

    $v->execute(array($eposta,$parola));

    $x = $v->fetch(PDO::FETCH_ASSOC);

    $d = $v->rowCount(); // girilen bilgilere göre sistemde gelen sonucu say

    if($d){

        // kullanıcı bilgilerini çerezlere atadık ve gerekli yerlerde kullanacağız

        $_SESSION["adminemail"] = $x["eposta"];
        $_SESSION["adminparola"] = $x["parola"];
        header('Location: panel/index.php');

    } else {

        echo '<script type="text/javascript">

Swal.fire(
                    "Hata!",
                    "Giriş bilgileri yanlış.",
                    "error"
                ).then(okay => {
                    if (okay) {
                        window.location.href = "index.php";
                    }
                });

</script>';

    } } ?>

</body>
</html>
