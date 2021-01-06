<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Kafto Admin Panel</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><span class="glyphicon glyphicon-user">&nbsp;</span><?php echo $_SESSION['adminemail']; ?></a></li>

                <li><a href="cikisyap.php"><span class="glyphicon glyphicon-log-in">&nbsp;</span> Çıkış Yap</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container-fluid">
    <div class="col-md-3">

        <div id="sidebar">

            <ul class="nav navbar-nav side-bar">
                <li class="side-bar tmargin"><a href="index.php"><span class="glyphicon glyphicon-list">&nbsp;</span>Ana Sayfa</a></li>
                <li class="side-bar"><a href="slider.php"><span class="glyphicon glyphicon-flag">&nbsp;</span>Slider Yönetimi</a></li>
                <li class="side-bar"><a href="raporlama.php"><span class="glyphicon glyphicon-star">&nbsp;</span>Raporlama Modülü</a></li>
                <li class="side-bar">
                    <a href="urunekle.php"><span class="glyphicon glyphicon-certificate">&nbsp;</span>Ürün Ekle</a></li>

            </ul>
        </div>
    </div>