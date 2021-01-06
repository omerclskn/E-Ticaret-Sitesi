<?php
include("config.php");
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>Sepet</title>
  </head>
<link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <body>

  <?php include("header.php");
  if(!isset($_SESSION['ad'])){
      header('Location: index.php');
  }
  $userid = $_SESSION['id'];
  ?>

<?php
$sorgula = $db->query("SELECT * FROM sepet WHERE userid = '$userid'")->fetchAll();
$sorgulasay = count($sorgula);

?>

    <div class="row" style="width:80%;padding:70px;margin-top:30px;">
            <div class="col-md-4 order-md-2 mb-4">
              <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Sepetiniz</span>
                <span class="badge badge-secondary badge-pill"><?php echo $sorgulasay; ?></span>
              </h4>
              <ul class="list-group mb-3">
                    <?php $toplam = 0; ?>
                  <?php for($sayi = 0; $sayi < $sorgulasay; $sayi++) { ?>

                          <?php

                      $query = $db->query("SELECT * FROM urunler WHERE id = '{$sorgula[$sayi]['productid']}'")->fetch(PDO::FETCH_ASSOC);
                      $toplam += $query['fiyat'];
                      ?>

                <li class="list-group-item d-flex justify-content-between lh-condensed">
                  <div>

                    <h6 class="my-0"><img src="<?php echo $query['gorsel']; ?>" width="15%" style="border-radius: 50%"><?php echo $query['ad']; ?> (<?php if($query['cinsiyet'] == 1){ echo "Erkek"; } elseif($query['cinsiyet'] == 0){ echo "Kadın"; } else { echo "Unisex"; } ?> Giyim)  <a href="basket.php?islem=sil&id=<?php echo $query['id']; ?>"><img width="5%" src="delete.png"></a></h6>
                      <select class="form-control" id="exampleFormControlSelect1">
                          <option value="s" <?php if($query['s'] == 0){ echo "disabled"; } ?>>S</option>
                          <option value="m" <?php if($query['m'] == 0){ echo "disabled"; } ?>>M</option>
                          <option value="l" <?php if($query['l'] == 0){ echo "disabled"; } ?>>L</option>
                      </select>
                  </div>
                  <span class="text-muted">₺<?php echo $query['fiyat']; ?></span>
                </li>

                <?php } ?>

                <li class="list-group-item d-flex justify-content-between">
                  <span>Toplam (TL)</span>
                  <strong>₺<?php echo $toplam; ?></strong>
                </li>
              </ul>

                <?php

                if (isset($_GET['islem']) and $_GET['islem'] == 'sil') {

                    try {
                        $query = $db->prepare("DELETE FROM sepet WHERE userid = :userid AND productid = :productid");
                        $delete = $query->execute(array(
                            'userid' => $_SESSION['id'],
                            'productid' => $_GET['id']
                        ));

                        ?>

                            <script type="text/javascript">
                                Swal.fire(
                                    'Başarılı',
                                    'Ürün sepetinizden silindi!',
                                    'success',
                                ).then(function(){
                                    window.location.href = "basket.php";
                                });
                            </script>

                <?php

                    } catch (Exception $e) {
                        die($e);
                    }



                }

                ?>

            </div>
            <div class="col-md-8 order-md-1">
              <h4 class="mb-3">Ödeme Sayfası</h4>
              <form name="siparis" method="post" action="" class="needs-validation" novalidate="">
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="firstName">İsim</label>
                    <input type="text" name="ad" class="form-control" id="firstName" value="<?php echo $_SESSION['ad']; ?>" required>
                    <div class="invalid-feedback">
                      Geçerli Bir İsim Gerekli.
                    </div>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="lastName">Soyisim</label>
                    <input type="text" class="form-control" name="soyad" id="lastName" value="<?php echo $_SESSION['soyad']; ?>" required>
                    <div class="invalid-feedback">
                      Geçerli Bir Soyisim Gerekli
                    </div>
                  </div>
                </div>

                <div class="mb-3">
                  <label for="email">E-posta</label>
                  <input type="email" name="email" class="form-control" id="email" value="<?php echo $_SESSION['eposta']; ?>" required placeholder="you@example.com">
                  <div class="invalid-feedback">
                    Geçerli Bir Mail Adresi Giriniz.
                  </div>
                </div>

                <div class="mb-3">
                  <label for="address">Adres</label>
                  <input type="text" name="adres" class="form-control" id="address" placeholder="1234 Main St" required>
                  <div class="invalid-feedback">
                    Lütfen Teslimat Adresi Giriniz.
                  </div>
                </div>

                <div class="mb-3">
                  <label for="address2">Adres 2 <span class="text-muted">(Opsiyonel)</span></label>
                  <input type="text" name="adres2" class="form-control" id="address2" placeholder="Apartman veya Daire">
                </div>

                <div class="row">
                  <div class="col-md-5 mb-3">
                    <label for="country">Şehir</label>
                    <select name="sehir" class="custom-select d-block w-100" id="country" required>
                        <option>Seçiniz</option>
                        <option value="1">Adana</option>
                        <option value="2">Adıyaman</option>
                        <option value="3">Afyonkarahisar</option>
                        <option value="4">Ağrı</option>
                        <option value="5">Amasya</option>
                        <option value="6">Ankara</option>
                        <option value="7">Antalya</option>
                        <option value="8">Artvin</option>
                        <option value="9">Aydın</option>
                        <option value="10">Balıkesir</option>
                        <option value="11">Bilecik</option>
                        <option value="12">Bingöl</option>
                        <option value="13">Bitlis</option>
                        <option value="14">Bolu</option>
                        <option value="15">Burdur</option>
                        <option value="16">Bursa</option>
                        <option value="17">Çanakkale</option>
                        <option value="18">Çankırı</option>
                        <option value="19">Çorum</option>
                        <option value="20">Denizli</option>
                        <option value="21">Diyarbakır</option>
                        <option value="22">Edirne</option>
                        <option value="23">Elazığ</option>
                        <option value="24">Erzincan</option>
                        <option value="25">Erzurum</option>
                        <option value="26">Eskişehir</option>
                        <option value="27">Gaziantep</option>
                        <option value="28">Giresun</option>
                        <option value="29">Gümüşhane</option>
                        <option value="30">Hakkâri</option>
                        <option value="31">Hatay</option>
                        <option value="32">Isparta</option>
                        <option value="33">Mersin</option>
                        <option value="34">İstanbul</option>
                        <option value="35">İzmir</option>
                        <option value="36">Kars</option>
                        <option value="37">Kastamonu</option>
                        <option value="38">Kayseri</option>
                        <option value="39">Kırklareli</option>
                        <option value="40">Kırşehir</option>
                        <option value="41">Kocaeli</option>
                        <option value="42">Konya</option>
                        <option value="43">Kütahya</option>
                        <option value="44">Malatya</option>
                        <option value="45">Manisa</option>
                        <option value="46">Kahramanmaraş</option>
                        <option value="47">Mardin</option>
                        <option value="48">Muğla</option>
                        <option value="49">Muş</option>
                        <option value="50">Nevşehir</option>
                        <option value="51">Niğde</option>
                        <option value="52">Ordu</option>
                        <option value="53">Rize</option>
                        <option value="54">Sakarya</option>
                        <option value="55">Samsun</option>
                        <option value="56">Siirt</option>
                        <option value="57">Sinop</option>
                        <option value="58">Sivas</option>
                        <option value="59">Tekirdağ</option>
                        <option value="60">Tokat</option>
                        <option value="61">Trabzon</option>
                        <option value="62">Tunceli</option>
                        <option value="63">Şanlıurfa</option>
                        <option value="64">Uşak</option>
                        <option value="65">Van</option>
                        <option value="66">Yozgat</option>
                        <option value="67">Zonguldak</option>
                        <option value="68">Aksaray</option>
                        <option value="69">Bayburt</option>
                        <option value="70">Karaman</option>
                        <option value="71">Kırıkkale</option>
                        <option value="72">Batman</option>
                        <option value="73">Şırnak</option>
                        <option value="74">Bartın</option>
                        <option value="75">Ardahan</option>
                        <option value="76">Iğdır</option>
                        <option value="77">Yalova</option>
                        <option value="78">Karabük</option>
                        <option value="79">Kilis</option>
                        <option value="80">Osmaniye</option>
                        <option value="81">Düzce</option>
                    </select>
                    <div class="invalid-feedback">
                      Geçerli Bir Şehir Seçiniz.
                    </div>
                  </div>
                </div>
                <hr class="mb-4">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="save-info">
                  <label class="custom-control-label" for="save-info">Bilgileri Kaydet</label>
                </div>
                <hr class="mb-4">

                <h4 class="mb-3">Ödeme</h4>

                <div class="d-block my-3">
                  <div class="custom-control custom-radio">
                    <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked="" required>
                    <label class="custom-control-label" for="credit">Kredi Kartı</label>
                  </div>
                  <div class="custom-control custom-radio">
                    <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                    <label class="custom-control-label" for="debit">Banka Kartı</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="cc-name">Kart Üzerindeki İsim</label>
                    <input type="text" name="ki" class="form-control" id="cc-name" placeholder="" required>
                    <small class="text-muted">Kartta görüntülendiği şekliyle tam isim.</small>
                    <div class="invalid-feedback">
                      Kart Üzerindeki İsim Gerekli
                    </div>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="cc-number">Kart Numarası</label>
                    <input type="text" name="kn" class="form-control" id="cc-number" placeholder="" required>
                    <div class="invalid-feedback">
                      Kart Numarası Gerekli
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3 mb-3">
                    <label for="cc-expiration">Son Kullanma Tarihi</label>
                    <input type="text" class="form-control" name="skt" id="cc-expiration" placeholder="12/21" maxlength="5" required>
                    <div class="invalid-feedback">
                      Son Kullanma Tarihi Gerekli
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="cc-cvv">CVV</label>
                    <input type="text" class="form-control" id="cc-cvv" name="cvv" placeholder="" maxlength="3" required>
                    <div class="invalid-feedback">
                      CVV Kodu Gerekli
                    </div>
                  </div>
                </div>
                <hr class="mb-4">
                <button name="siparis" class="btn btn-primary btn-lg btn-block" type="submit">Ödemeyi Onayla</button>
              </form>

                <?php

                if(isset($_POST['siparis'])){
                    $ad = $_POST['ad'];
                    $soyad = $_POST['soyad'];
                    $eposta = $_POST['eposta'];
                    $adres = $_POST['adres'];

                    if(isset($_POST['adres2'])){
                        $adres2 = $_POST['adres2'];
                    }

                    $sehir = $_POST['sehir'];

                    $ki = sha1(md5($_POST['ki']));
                    $kn = sha1(md5($_POST['kn']));
                    $skt = sha1(md5($_POST['skt']));
                    $cvv = sha1(md5($_POST['cvv']));

                    $yenisiparis = mail("info@kafto.com", "Yeni Siparis Var!", $ad.' '.$soyad.' '.$eposta.' '.$adres.' '.$sehir.' ');

                    if($yenisiparis){ ?>

                        <script type="text/javascript">
                            Swal.fire(
                                "Başarılı!",
                                "Sipariş verilmiştir.",
                                "success"
                            ).then(okay => {
                                if (okay) {
                                    window.location.href = "index.php";
                                }
                            });
                        </script>

                   <?php } else { ?>

                        <script type="text/javascript">
                            Swal.fire(
                                "Hata!",
                                "Sipariş esnasında bir hata meydana geldi.",
                                "error"
                            ).then(okay => {
                                if (okay) {
                                    window.location.href = "index.php";
                                }
                            });
                        </script>

                   <?php }

                }

                ?>

            </div>
          </div>
          <footer class="footer">
                  <p class="mb-1" >© Kafto 2021</p>
                </footer>
  </body>
</html>
