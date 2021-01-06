<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>İletişim</title>
  </head>
  <link rel="stylesheet" href="contact.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <body>

  <?php include("header.php"); ?>

    <div class="container">
      <form name="iletisim" id="contact" action="" method="post">
        <h3 >Bize Yazın</h3>
        <fieldset>
          <input placeholder="Adınız" name="ad" type="text" tabindex="1" required autofocus>
        </fieldset>
        <fieldset>
          <input placeholder="E-Mail Adresiniz" name="email" type="email" tabindex="2" required>
        </fieldset>
        <fieldset>
          <input placeholder="Telefon Numarası" name="tel" type="tel" tabindex="3" required>
        </fieldset>
        <fieldset>
          <textarea placeholder="Mesajınızı Yazın...." name="mesajiniz" tabindex="5" required></textarea>
        </fieldset>
        <fieldset>
        <center>
            <button name="iletisim" type="submit" id="contact-submit" data-submit="...Sending">Gönder</button>
        </center>

        </fieldset>
      </form>
    </div>

  <?php

  if(isset($_POST['iletisim'])) {
      $mesajiniz = $_POST['mesajiniz'];
      $gonder = mail("info@kafto.com", "İletişim Formu", $mesajiniz);

      if($gonder){ ?>

          <script type="text/javascript">
              Swal.fire(
                  "Başarılı!",
                  "Mesajınız gönderildi.",
                  "success"
              ).then(okay => {
                  if (okay) {
                      window.location.href = "contact.php";
                  }
              });
          </script>

      <?php }

  }

  ?>

    <footer class="footer">
            <p class="mb-1" >© Kafto 2021</p>
          </footer>
  </body>
</html>
