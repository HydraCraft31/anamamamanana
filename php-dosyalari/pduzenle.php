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
            <div class="icBaslik"><div class="icBaslikYazi"><i class="fa fa-edit fa-3x"></i><font size="6"> PROFIL DÜZENLE</font></div></div>
            <div class="ic">
<?php

$skype 	  = strip_tags($_POST["skype"]);
$facebook = strip_tags($_POST["facebook"]);
$oyun 	  = strip_tags($_POST["oyun"]);
$steam 	  = strip_tags($_POST["steam"]);

if(isset($_POST['guncelle'])){
	if($post_sifre !== $oyuncu_oku["password"]){
		echo '<div class="flag note note--error">
				<div class="flag__image note__icon">
					<i class="fa fa-times"></i>
				</div>
                    <div class="flag__body note__text">
                        Mevcut şifrenizi yanlış girdiniz!
                    </div>
                </div>';
	}else{
	$profil_guncelle =  $db->prepare("UPDATE authme SET skype = ?, facebook = ?, steam = ?, oyun = ? WHERE id = ?");
    $profil_guncelle->execute(array($skype,$facebook,$steam,$oyun,$oyuncu_id));
		echo "<div class='flag note note--success'>
	  <div class='flag__image note__icon'>
		<i class='fa fa-check'></i>
	  </div>
	  <div class='flag__body note__text'>
		Profiliniz başarıyla güncellenmiştir!
	  </div>
	</div>";
		echo '<meta http-equiv="refresh" content="3;URL=../profil/">';
}
}
?>
                <br>
                <center>
                    İstediğiniz kutucuğu doldurabilirsiniz. Yazmak istemediğinizi boş bırakabilirsiniz.
                </center>
                <br>
				<div class="profil-duzenle">
				<div style="overflow-x:auto;">
                <form action="" method="POST">
                    <table class="profil-duzenle-table">
						<tr>
                            <td class="kutu"><font face="Roboto Condensed" size="4">Mevcut Şifreniz:</font></td>
                            <td class="kutu"><input required type="password" AUTOCOMPLETE="off" name="post_sifre" class="form-control"placeholder="Güvenlik nedeni ile şifrenizi giriniz." /></td>
                        </tr>
                        <tr>
                            <td class="kutu"><font face="Roboto Condensed" size="4">Skype:</font></td>
                            <td class="kutu"><input required type="text" name="skype" class="form-control" maxlength="70" <? if($oyuncu_oku["skype"] == NULL){ echo "placeholder='Skype kullanıcı adını giriniz.'"; } else { echo "value='".$oyuncu_oku["skype"]."'"; }?>/></td>
                        </tr>
                        <tr>
                            <td class="kutu"><font face="Roboto Condensed" size="4">Facebook:</font></td>
                            <td class="kutu"><input type="text" name="facebook" class="form-control" <? if($oyuncu_oku["facebook"] == NULL){ echo "placeholder='Facebook kullanıcı adını giriniz.'"; } else { echo "value='".$oyuncu_oku["facebook"]."'"; } ?>/></td>
                        </tr>
                        <tr>
                            <td class="kutu"><font face="Roboto Condensed" size="4">Steam:</font></td>
                            <td class="kutu"><input type="text" name="steam" class="form-control" <? if($oyuncu_oku["steam"] == NULL){ echo "placeholder='Steam kullanıcı adını giriniz.'"; } else { echo "value='".$oyuncu_oku["steam"]."'"; } ?>/></td>
                        </tr>
                        <tr>
                            <td class="kutu"><font face="Roboto Condensed" size="4">Sevdiğiniz Oyun:</font></td>
                            <td><input type="text" name="oyun" class="form-control" <? if($oyuncu_oku["oyun"] == NULL){ echo "placeholder='Sunucumuzda en çok beğendiğiniz oyunu yazınız. Örnek: Sky Block'"; } else { echo "value='".$oyuncu_oku["oyun"]."'"; } ?>/></td>
                        </tr>
                        <tr>
                            <td class="kutu">&nbsp;</td>
                            <td class="kutu"><button type="submit" name="guncelle" class="button-example-1 button-example-green pull-right"><font face="Roboto Condensed" size="4">Güncelle</font></button></td>
                        </tr>
                    </table>
                </form>
				</div>
				</div>
                <br>
            </div>
        </div>
		<?php

			include ('../right.php');

		include ('../footer.php');
		
	?>
    </div>
</body>
</html>
