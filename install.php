<?php

if(file_exists('./ayarlar/baglan.php')){
	die("Kurulum zaten yapilmis!");
}
else{

$adim = $_GET['adim'];

if ($adim == "1"){
	if ($_POST){
		
		$host = $_POST["host"];
		$username = $_POST["username"];
		$pass = $_POST["pass"];
		$veritabani = $_POST["db"];

		try {

$sql = "
CREATE TABLE IF NOT EXISTS `Kredi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nick` varchar(255) NOT NULL,
  `miktar` varchar(255) NOT NULL,
  `metod` varchar(255) NOT NULL,
  `tarih` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
";
$sql2 = "
CREATE TABLE IF NOT EXISTS `Market` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nick` varchar(255) NOT NULL,
  `sunucu` varchar(255) NOT NULL,
  `tarih` varchar(255) NOT NULL,
  `urun` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
";
$sql3 = "
CREATE TABLE IF NOT EXISTS `Urun_Kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(255) NOT NULL,
  `resim` text NOT NULL,
  `sunucu` varchar(255) NOT NULL,
  `sunucu_link` varchar(255) NOT NULL,
  `kategori_link` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
";
$sql4 = "
CREATE TABLE IF NOT EXISTS `Sunucular` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sunucu_resim` text NOT NULL,
  `ip` varchar(255) NOT NULL,
  `sunucu` varchar(255) NOT NULL,
  `port` varchar(255) NOT NULL,
  `sunucu_sifre` varchar(255) NOT NULL,
  `sunucu_link` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
";
$sql5 = "
CREATE TABLE IF NOT EXISTS `Urunler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(255) NOT NULL,
  `urun` varchar(255) NOT NULL,
  `sunucu` varchar(255) NOT NULL,
  `komut` varchar(255) NOT NULL,
  `resim_url` text NOT NULL,
  `fiyat` varchar(255) NOT NULL,
  `detay` varchar(255) NOT NULL,
  `sunucu_link` varchar(255) NOT NULL,
  `kategori_link` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
";
$sql6 = "
CREATE TABLE IF NOT EXISTS `authme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ip` varchar(40) NOT NULL DEFAULT '127.0.0.1',
  `lastlogin` bigint(20) DEFAULT '0',
  `x` double NOT NULL DEFAULT '0',
  `y` double NOT NULL DEFAULT '0',
  `z` double NOT NULL DEFAULT '0',
  `world` varchar(255) DEFAULT 'world',
  `email` varchar(255) DEFAULT 'your@email.com',
  `isLogged` smallint(6) NOT NULL DEFAULT '0',
  `tarih` text NOT NULL,
  `skype` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `steam` varchar(255) NOT NULL,
  `oyun` varchar(255) NOT NULL,
  `kredi` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `token_bitis` varchar(255) NOT NULL,
  `simdiki_ip` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
";
$sql7 = "
CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nick` varchar(255) NOT NULL,
  `baslik` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `mesaj` text NOT NULL,
  `durum` varchar(255) NOT NULL,
  `son_guncelleme` varchar(255) NOT NULL,
  `kanit` text NOT NULL,
  `cevap` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
";
$sql8 = "
CREATE TABLE IF NOT EXISTS `tickets_sc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nick` varchar(255) NOT NULL,
  `soru` text NOT NULL,
  `cevap` text NOT NULL,
  `ticket_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
";
$sql9 = "
CREATE TABLE IF NOT EXISTS `vips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nick` varchar(255) NOT NULL,
  `sunucu` varchar(255) NOT NULL,
  `urun` varchar(255) NOT NULL,
  `son_gun` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
";
$sql10 = "
CREATE TABLE IF NOT EXISTS `yazilar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `baslik` varchar(255) NOT NULL,
  `resim` text NOT NULL,
  `yazi` text NOT NULL,
  `yazar` varchar(255) NOT NULL,
  `tarih` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
";
$sql11 = "
CREATE TABLE IF NOT EXISTS `yorumlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `haber_id` int(11) NOT NULL,
  `yorum` text NOT NULL,
  `yorum_yazan` varchar(255) NOT NULL,
  `yorum_tarih` varchar(255) NOT NULL,
  `durum` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
";
$sql12 = "
CREATE TABLE IF NOT EXISTS `ayar` (
  `sunucu_adi` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `surum` text NOT NULL,
  `baslik` varchar(255) NOT NULL,
  `aciklama` varchar(255) NOT NULL,
  `anahtar_kelimeler` varchar(255) NOT NULL,
  `site_url` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `youtube` varchar(255) NOT NULL,
  `resim1` varchar(255) NOT NULL,
  `resim2` varchar(255) NOT NULL,
  `resim3` varchar(255) NOT NULL,
  `resim4` varchar(255) NOT NULL,
  `yazi_limit` varchar(255) NOT NULL,
  `sifreleme_turu` varchar(255) NOT NULL,
  `kayit_limit` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
";

		     $db = new PDO("mysql:host=$host;dbname=$veritabani;charset=utf8", "$username", "$pass");
		     $db->query($sql);
		     $db->query($sql2);
		     $db->query($sql3);
		     $db->query($sql4);
		     $db->query($sql5);
		     $db->query($sql6);
		     $db->query($sql7);
		     $db->query($sql8);
		     $db->query($sql9);
		     $db->query($sql10);
		     $db->query($sql11);

		} catch ( PDOException $e ){

        echo '<br><br><center><font size="6" color="red" face="Arial">MySQL Veritabanina baglanilamadi!</font></center>';

        header("refresh:2;url=./install.php");

		}
		if($db){

			$olustur = touch("./ayarlar/baglan.php");

			if($olustur){
				$ac     = fopen('./ayarlar/baglan.php', 'w');
				$icerik = '
<?php

// MySQL Bağlantı Ayarları //
$host        = "'.$host.'"; // MySQL Sunucunuzun IP Adresi //
$kullanici   = "'.$username.'"; // MySQL Sunucunuzun Kullanıcı Adı //
$sifre       = "'.$pass.'"; // MySQL Sunucunuzun Şifresi //
$veritabani  = "'.$veritabani.'";; // MySQL Sunucunuzun Veritabanı Adı //

try {
     $db = new PDO("mysql:host=$host;dbname=$veritabani;charset=utf8", "$kullanici", "$sifre");
} catch ( PDOException $e ){
     print $e->getMessage();
}

?>
';

				$kaydet = fwrite($ac, $icerik);

				echo '<br><br><center><font size="6" color="green" face="Arial">Sistem basariyla kurulmustur!</font></center>';

        header("refresh:2;url=./index.php");


			}

		}


	}else{
		header("Location: install.php");
	}
}else{

?>

<br>
<br>
<br>
<center>
<div style="width: 50%; background-color: #ddd; height: 50%; font-family: Arial;">
<br><br>
<center>
<h1>LeaderOS Script Kurulum</h1>
<br><br>
<form action="install.php?adim=1" method="post">
<table>
	<tr>
		<td>MySQL Adres:</td>
		<td><input type="text" name="host" placeholder="Örn: localhost" /></td>
	</tr>
	<tr>
		<td>MySQL Kullanıcı Adı:</td>
		<td><input type="text" name="username" placeholder="Örn: root" /></td>
	</tr>
	<tr>
		<td>MySQL Şifre:</td>
		<td><input type="password" name="pass" /></td>
	</tr>
	<tr>
		<td>MySQL Veritabanı:</td>
		<td><input type="text" name="db"/></td>
	</tr>
	<tr>
		<td></td>
		<td><button type="submit" style="float: right;">Kuruluma Başla</button></td>
	</tr>
</table>
</form>
</center>
</div>
</center>
<?php } } ?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>LeaderOS v2.9</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<script src='https://www.google.com/recaptcha/api.js'></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>
<body>
  
  <div class="row">
    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
      <div class="login-panel panel panel-default">
        <div class="panel-heading">Giriş Yap</div>
        <div class="panel-body">
        <? 
        $token = new token();
        if(isset($_POST['giris-yap'])){
          $token_test = $_POST["spam_token"];
          
        if($token->tokenSorgula($token_test) == false){
          die("TOKEN HATALI!");
        
        }elseif(($_POST["nick"]==$admin_username2) and ($_POST["password"]==$admin_sifre2)){
            $_SESSION["login"] = "true";
            header("Location: index.php");
          }else{
            echo "Şifreyi veya kullanıcı adını yanlış girdiniz!<br><br>";

          }
          }
        ?>
          <form action="" method="post">
            <fieldset>
              <div class="form-group">
                <input class="form-control" placeholder="Kullanıcı Adı" name="nick" type="text" autofocus="">
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Şifre" AUTOCOMPLETE="off" name="password" type="password" value="">
              </div>
              <button name="giris-yap" type="submit" class="btn btn-primary pull-right">Giriş Yap</button>
            </fieldset>
          <input type="hidden" name="spam_token" value="<? echo $_SESSION['spam_token'] ?>" />
          <input type="hidden" name="token" value="<? echo $_SESSION['token'] ?>" />
          </form>
        </div>
      </div>
    </div><!-- /.col-->
  </div><!-- /.row -->  
  
    

  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/chart.min.js"></script>
  <script src="js/chart-data.js"></script>
  <script src="js/easypiechart.js"></script>
  <script src="js/easypiechart-data.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script>
    !function ($) {
      $(document).on("click","ul.nav li.parent > a > span.icon", function(){      
        $(this).find('em:first').toggleClass("glyphicon-minus");    
      }); 
      $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
    }(window.jQuery);

    $(window).on('resize', function () {
      if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
    })
    $(window).on('resize', function () {
      if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
    })
  </script> 
</body>

</html>