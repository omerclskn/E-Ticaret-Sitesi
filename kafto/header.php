<?php
ob_start();
session_start();
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="index.php"><b>K A F T O</b>  C O L L E C T I O N</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-link" href="listele.php?listtype=asc">Ürün Listele</a>
            <a class="nav-link" href="contact.php">İletişim</a>
        </div>
    </div>

    <form name="ara" action="arama.php" method="post" class="form-inline my-2 my-lg-0">
        <input required name="kelime" class="form-control mr-sm-2" type="search" placeholder="Ürün Adı" aria-label="Arama">
        <button class="btn btn-light my-2 my-sm-0" type="submit">Ara</button>
    </form>
    &nbsp;&nbsp;
    <!-- eğer ad isimli çerez varsa kullanıcı adını ekrana yazdır, yoksa giriş yapma butonunu göster -->
        <?php if(isset($_SESSION['ad'])){ ?>
            <font color="white">Hoş geldin, <?php echo $_SESSION["ad"]; ?> </font>
            - <a style="color:white" href="basket.php"> | SEPET</a>
            - <a style="color:white" href="cikisyap.php"> | ÇIKIŞ YAP</a>
    <?php } else { ?>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="signin.php">Giriş Yap</a>
        </li>
    </ul>

    <?php } ?>


</nav>