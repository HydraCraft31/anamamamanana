<?php
session_start();
if(!isset($_SESSION["uye_id"])){
	header("location:/girisyapmalisin/");
}

	include ('../ayarlar/ayar.php');

	include ('../head.php');

?>
<body>
	<?php
		include('../logo.php');
	?>
    <div id="wrapper">
		<?php
			include ('../header.php');
		?>
        <div id="sol">
            <div class="icBaslik"><div class="icBaslikYazi"><i class="fa fa-user fa-3x"></i><font size="6"> PROFİL</font></div></div>
            <div class="ic">
			<?php
			if(isset($_POST['sifreDegistir'])){
				if(($post_sifre == "") or ($post_sifre_tekrar == "") or ($post_sifre_yeni == "")){
					echo "<div class='flag note note--error'>
					  <div class='flag__image note__icon'>
						<i class='fa fa-times'></i>
					  </div>
					  <div class='flag__body note__text'>
						Lütfen boş alan bırakmayın!
					  </div>
					</div>";
				}elseif ($sifre_yeni !== $post_sifre_tekrar){
					echo "<div class='flag note note--error'>
					  <div class='flag__image note__icon'>
						<i class='fa fa-times'></i>
					  </div>
					  <div class='flag__body note__text'>
						Yeni şifreler birbirleriyle uyuşmuyor!
					  </div>
					</div>";
				}elseif ($oyuncu_oku["password"] !== $post_sifre){
					echo "<div class='flag note note--error'>
					  <div class='flag__image note__icon'>
						<i class='fa fa-times'></i>
					  </div>
					  <div class='flag__body note__text'>
						Eski şifrenizi yanlış girdiniz!
					  </div>
					</div>";
				}else{
					$sifre_guncelle =  $db->prepare("UPDATE authme SET password = ? WHERE id = ?");
					$sifre_guncelle->execute(array($post_sifre_yeni,$oyuncu_id));
					echo "<div class='flag note note--success'>
					  <div class='flag__image note__icon'>
						<i class='fa fa-check'></i>
					  </div>
					  <div class='flag__body note__text'>
						Şifreniz başarıyla değiştirilmiştir!
					  </div>
					</div>";
					echo '<meta http-equiv="refresh" content="2;URL=../profil/">';
				}
			}
			?>
			<br>
			<div class="profil-sifre-degis">
			<div style="overflow-x:auto;">
                <form action="" method="post">
                    <table class="sifre-degis-table">
                        <tr>
                            <td class="kutu"><font face="Roboto Condensed" size="4">Mevcut Şifre: </font></td>
                            <td class="kutu"><input AUTOCOMPLETE="off" type="password" class="form-control" name="post_sifre" placeholder="Şuanki Şifrenizi Giriniz." required></td>
                        </tr>
                        <tr>
                            <td class="kutu"><font face="Roboto Condensed" size="4">Yeni Şifre: </font></td>
                            <td class="kutu"><input AUTOCOMPLETE="off" type="password" class="form-control" name="post_sifre_yeni" placeholder="Yeni İstediğiniz Şifreyi Giriniz." required></td>
                        </tr>
                        <tr>
                            <td class="kutu"><font face="Roboto Condensed" size="4">Yeni Şifre (Tekrar): </font></td>
                            <td><input type="password" AUTOCOMPLETE="off" class="form-control" name="post_sifre_tekrar" placeholder="Yeni Şifreyi Tekrar Giriniz." required></td>
                        <tr>
                            <td class="kutu">&nbsp;</td>
                            <td class="kutu"><button type="submit" name="sifreDegistir" class="button-example-1 button-example-green pull-right"><font face="Roboto Condensed" size="4">Değiştir</font></button></td>
                        </tr>
                    </table>
                </form>
				</div>
                <br>
            </div>
            </div>
        </div>
		<?php

			include ('../right.php');

		include ('../footer.php');
		
	?>
    </div>
</body>
</html>
