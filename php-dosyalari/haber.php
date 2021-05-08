<?php
	include ('../ayarlar/ayar.php');
?>
<?php
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
        <div id="sol" style="margin-top: 8px;">
			<?php
			$duyuru_cek = $db->prepare("SELECT * FROM yazilar WHERE id = ?");
			$duyuru_cek->execute(array($_GET["id"]));
			$duyuru_oku = $duyuru_cek->fetch();
			if($duyuru_cek->rowCount() != 0){
			?>
            <div class="haberBaslik">
                <div class="haberBaslikYazi"><?php echo $duyuru_oku['baslik'] ?></div>
                <div class="haberBaslikTarih"><?php echo $duyuru_oku['tarih'] ?></div>
            </div>
            <div class="haberIcerik">
                <img src="<?php echo $duyuru_oku['resim'] ?>" style="margin-left: 12px; margin-right:8px" width="149" height="150" border="0" align="left">
					<?php echo $duyuru_oku['yazi'] ?>
				</div>
            <div class="cizgi"></div>
            <div class="haberBilgi">
                <div class="haberBilgiYazi"><i class="fa fa-edit"></i><strong> Yazan: </strong><?php echo $duyuru_oku['yazar'] ?> </div>
            </div>
<?php
}else{
echo'<div class="flag note note--error">
  <div class="flag__image note__icon">
    <i class="fa fa-times"></i>
  </div>
  <div class="flag__body note__text">
    Haber yazısı bulunamadı!
  </div>
</div>
';
}

?>
﻿<?php
$token = new token();
if(isset($_POST['yorum_gonder'])){
$token_test = $_POST["spam_token"];
$yorum 		= strip_tags($_POST['yorum']);
$tarih 		= date('d.m.Y H:i');
$durum 		= "0";

if($token->tokenSorgula($token_test) == false){
	die("TOKEN YANLIŞ!");
}

if($_POST["yorum"] == ""){
	echo '
                <div class="flag note note--error" style="margin-bottom: 20px;">
                    <div class="flag__image note__icon">
                        <i class="fa fa-times"></i>
                    </div>
                    <div class="flag__body note__text">
                        Boş alan bırakmayın!
                    </div>
                </div>
	';
}
else{
		$yorum_olustur = $db->prepare("INSERT INTO yorumlar (yorum_yazan,haber_id,yorum_tarih,yorum,durum) VALUES(?,?,?,?,?)");
		$yorum_olustur->execute(array($oyuncu_oku["username"],$_GET["id"],$tarih,$yorum,$durum));
		echo '
                <div class="flag note note--success" style="margin-bottom: 20px;">
                    <div class="flag__image note__icon">
                        <i class="fa fa-check"></i>
                    </div>
                    <div class="flag__body note__text">
                        Yorum başarıyla gönderildi! Yönetici tarafından onaylanınca herkese açık olacakdır!
                    </div>
                </div>
		';
}
}
?>
<style>
.yorum-at-table{
	border-collapse: collapse;
	border-spacing: 0;
	border-color: #999;
	}
		
.yorum-at-table .kutu {background-color: #fff; width: 100%; padding-top: 20px; padding-left: 20px; padding-right: 20px;}
.yorum-at-table .kutu2 {background-color: #fff; width: 100%;height: 40px; line-height:40px; border-top: 2px solid #313131;padding-left: 20px; padding-right: 20px;}
.yorum-at-table .gonder {background-color: #fff; padding: 5px; padding-right: 22px; padding-bottom: 10px;}
.yorum-at-table th {background-color: #313131; color: #fff; width: 100%; padding: 15px; text-align: left;}
</style>
<?php
if(!isset($_SESSION["uye_id"])){
?>
<table class="yorum-at-table">
	<tr>
		<th>YORUM GÖNDER</th>
	</tr>
	<tr>
		<td class="kutu" style="padding-bottom: 20px;">Yorum atabilmek için giriş yapmanız gerekiyor!</td>
	</tr>
</table>
<?php
}else{
?>
<table class="yorum-at-table">
<form action="" method="post">
	<tr>
		<th>YORUM GÖNDER</th>
	</tr>
	<tr>
		<td class="kutu"><textarea required name="yorum" style="width: 98%; border: 1px solid #909090; border-radius: 4px; padding-left: 10px; padding-top: 10px;" placeholder="Buraya bir yorum bırakabilirsiniz." rows="5"></textarea></td>
	</tr>
	<tr>
		<td class="gonder"><button name="yorum_gonder" type="submit" class="button-example-1 button-example-green pull-right"><font face="Roboto Condensed" size="4">Gönder</font></button></td>
	</tr>
	<input type="hidden" name="spam_token" value="<? echo $_SESSION['spam_token'] ?>" />
</form>
</table>
<?php } ?>

	<?php
	$yorum_cek = $db->prepare("SELECT * FROM yorumlar WHERE haber_id = ? ORDER BY id DESC");
	$yorum_cek->execute(array($_GET["id"]));		
		if($yorum_cek->rowCount() != 0){

			foreach ($yorum_cek as $yorum_oku) {
				
				if($yorum_oku["durum"] == "1"){

	?>
<table class="yorum-at-table" style="margin-top: 20px;">
	<tr>
		<td class="kutu" style="padding-bottom: 20px;"><a href="../profil/ara/<?php echo $yorum_oku["yorum_yazan"] ?>"><img style="margin-right: 15px;" src="http://cravatar.eu/avatar/<?php echo $yorum_oku["yorum_yazan"] ?>/60.png" border="0" align="left"></a><font size="4"><?php echo $yorum_oku["yorum"] ?></font></td>
	</tr>
	<tr>
		<td class="kutu2"><i class="fa fa-edit"></i><strong> Yazan:</strong> <a href="../profil/ara/<?php echo $yorum_oku["yorum_yazan"] ?>"><?php echo $yorum_oku["yorum_yazan"] ?></a> </td>
	</tr>
</table>
		<?php
		}
		}
		}
		?>

        </div>
		<?php
			include ('../right.php');
		?>
		
	<?php
		include ('../footer.php');
	?>
    </div>
</body>
</html>
