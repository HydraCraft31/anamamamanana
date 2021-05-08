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
if(isset($_POST['emailDegistir'])){
    $sql = "SELECT COUNT(email) AS num FROM authme WHERE email = :email";
    $stmt = $db->prepare($sql);
	$stmt->bindValue(':email', $post_email);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	if(($sifre == "") or ($post_email == "") or ($post_email_tekrar == "")){
		echo "<div class='flag note note--error'>
		  <div class='flag__image note__icon'>
			<i class='fa fa-times'></i>
		  </div>
		  <div class='flag__body note__text'>
			Lütfen boş alan bırakmayın!
		  </div>
		</div>";
	}elseif($post_email !== $post_email_tekrar){
		echo "<div class='flag note note--error'>
		  <div class='flag__image note__icon'>
			<i class='fa fa-times'></i>
		  </div>
		  <div class='flag__body note__text'>
			Yeni E-Mail adresleri birbirleriyle uyuşmuyor!
		  </div>
		</div>";
	}elseif($oyuncu_oku["password"] !== $post_sifre){
		echo "<div class='flag note note--error'>
		  <div class='flag__image note__icon'>
			<i class='fa fa-times'></i>
		  </div>
		  <div class='flag__body note__text'>
			Mevcut şifrenizi yanlış girdiniz!
		  </div>
		</div>";
	}elseif($row['num'] > 0){
		echo "<div class='flag note note--error'>
		  <div class='flag__image note__icon'>
			<i class='fa fa-times'></i>
		  </div>
		  <div class='flag__body note__text'>
			Email adresi başkası tarafından kullanılıyor!
		  </div>
		</div>";
	}else{
		$email_guncelle =  $db->prepare("UPDATE authme SET email = ? WHERE id = ?");
		$email_guncelle->execute(array($post_email,$oyuncu_id));
		echo "<div class='flag note note--success'>
		  <div class='flag__image note__icon'>
			<i class='fa fa-check'></i>
		  </div>
		  <div class='flag__body note__text'>
			E-Main adresiniz başarıyla değiştirilmiştir!
		  </div>
		</div>";
		echo '<meta http-equiv="refresh" content="2;URL=../profil/">';
	}
}
?>
<br>
			<div class="profil-email-degis">
			<div style="overflow-x:auto;">
                <form action="" method="post" class="form-horizontal">
                    <table class="email-degis-table">
                        <tr>
                            <td class="kutu"><font face="Roboto Condensed" size="4">Mevcut Şifre: </font></td>
                            <td class="kutu"><input type="password" AUTOCOMPLETE="off" class="form-control" name="post_sifre" placeholder="Şuanki Şifrenizi Giriniz." required></td>
                        </tr>
                        <tr>
                            <td class="kutu"><font face="Roboto Condensed" size="4">Yeni E-Mail: </font></td>
                            <td class="kutu"><input type="email" class="form-control" name="post_email" placeholder="Yeni İstediğiniz E-Mail'i Giriniz." required></td>
                        </tr>
                        <tr>
                            <td class="kutu"><font face="Roboto Condensed" size="4">Yeni E-Mail (Tekrar): </font></td>
                            <td class="kutu"><input type="email" class="form-control" name="post_email_tekrar" placeholder="Yeni E-Mail'i Tekrar Giriniz." required></td>
                        </tr>
                        <tr>
                            <td class="kutu">&nbsp;</td>
                            <td class="kutu"><button type="submit" name="emailDegistir" class="button-example-1 button-example-green pull-right"><font face="Roboto Condensed" size="4">Değiştir</font></button></td>
                        </tr>
                    </table>
                </form>
                <br>
            </div>
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
