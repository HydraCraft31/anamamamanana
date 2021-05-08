<?php

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
            <div class="icBaslik"><div class="icBaslikYazi"><i class="fa fa-lock fa-3x"></i><font size="6"> ŞİFREMİ UNUTTUM!</font></div></div>
            <div class="ic">
<?php

if(isset($_POST['sifre_sifirla'])){


	include "../mailer/class.phpmailer.php";


	$prepare = $db->prepare("SELECT * FROM authme WHERE username = ?");
	$prepare->execute(array($post_oyuncu));
	$result = $prepare->fetch();
	
	
    $kadi_varmi = "SELECT COUNT(username) AS num FROM authme WHERE username = :username";
    $stmt = $db->prepare($kadi_varmi);
	$stmt->bindValue(':username', $post_oyuncu);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	if(($post_oyuncu == "") or ($post_email == "")){
		echo "<div class='flag note note--error'>
					  <div class='flag__image note__icon'>
						<i class='fa fa-times'></i>
					  </div>
					  <div class='flag__body note__text'>
						Lütfen boş alan bırakmayın!
					  </div>
					</div>";
	}

	if($row['num'] == 0){
		echo "<div class='flag note note--error'>
					  <div class='flag__image note__icon'>
						<i class='fa fa-times'></i>
					  </div>
					  <div class='flag__body note__text'>
						<strong>".$post_oyuncu."</strong> adında kullanıcı bulunamadı!
					  </div>
					</div>";

	}elseif($result['email'] != $post_email){
		echo "<div class='flag note note--error'>
					  <div class='flag__image note__icon'>
						<i class='fa fa-times'></i>
					  </div>
					  <div class='flag__body note__text'>
						E-Posta ile üye uyuşmuyor!
					  </div>
					</div>";
					
	}else{

	$token = strtoupper(md5(uniqid(rand(), true)));
	$gelecek_zaman = date('Y-m-d H:i:s', time()+86400);

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Host = "".$smtp_url.""; // Your SMTP PArameter
    $mail->Port = "".$smtp_port.""; // Your Outgoing Port
    $mail->SMTPAuth = true; // This Must Be True
    $mail->Username = "".$mail_adresi.""; // Your Email Address
    $mail->Password = "".$mail_sifre.""; // Your Password
    $mail->SMTPSecure = 'SSL'; // Check Your Server's Connections for TLS or SSL

    $mail->From = $mail_adresi;
    $mail->FromName = "MineTC » E-Posta Sistemi";
    $mail->AddAddress($result["email"]);
    $mail->CharSet = 'UTF-8';

    $mail->IsHTML(true);

    $mail->Subject = 'Şifre sıfırlama onayı';

    $mail->Body = $mail_body = "<div class="m_5781324374558130936layout m_5781324374558130936one-col m_5781324374558130936fixed-width" style="margin: 0 auto; max-width: 600px; min-width: 320px; width: calc(28000vw - 173000px); word-wrap: break-word; word-break: break-word;">
<div class="m_5781324374558130936layout__inner" style="border-collapse: collapse; display: table; background-color: #ffffff;">
<div class="m_5781324374558130936column" style="text-align: left; color: #61606c; font-size: 14px; line-height: 21px; font-family: Georgia,serif; max-width: 600px; min-width: 320px; width: calc(28000vw - 173000px);">
<div style="font-size: 12px; font-style: normal; font-weight: normal;" align="center"><img class="m_5781324374558130936gnd-corner-image m_5781324374558130936gnd-corner-image-center m_5781324374558130936gnd-corner-image-top CToWUd a6T" style="border: 0; display: block; height: auto; width: 100%; max-width: 900px;" src="https://i.hizliresim.com/LnAqGz.png" alt="" width="600" />
<div class="a6S" style="opacity: 1; left: 922.5px; top: 318px;" dir="ltr">
<div id=":b3" class="T-I J-J5-Ji aQv T-I-ax7 L3 a5q" data-tooltip-class="a1V" data-tooltip="İndirin">&nbsp;</div>
</div>
</div>
<div style="margin-left: 20px; margin-right: 20px; margin-top: 20px;">
<div style="line-height: 20px; font-size: 1px;">&nbsp;</div>
</div>
<div style="margin-left: 20px; margin-right: 20px;">
<h1 class="m_5781324374558130936size-30" style="margin-top: 0; margin-bottom: 0; font-style: normal; font-weight: normal; color: #b59859; font-size: 26px; line-height: 34px; text-align: center;" lang="x-size-30"><span style="color: #61606c;">&nbsp;&mdash; Sifremi Unuttum &mdash;</span></h1>
<center>
<h2 class="m_5781324374558130936size-24" style="margin-top: 20px; margin-bottom: 16px; font-style: normal; font-weight: normal; color: #555; font-size: 20px; line-height: 28px;" lang="x-size-24">Şifreni sıfırlamak i&ccedil;in aşağıdaki butona tıklayabilirsin.</h2>
</center></div>
<div style="margin-left: 20px; margin-right: 20px;">
<div style="line-height: 5px; font-size: 1px;">&nbsp;</div>
</div>
<div style="margin-left: 20px; margin-right: 20px;"><center><button style="height: 45px; width: 150px; color: #fff; background-color: #8cc152; border: 1px solid #8CC152; border-radius: 3px; font-family: Arial;" type="submit"><span style="font-size: large;">TIKLAYIN</span></button><span style="text-decoration: underline;"></span></center></div>
</div>
<br />
<div style="margin-left: 10px; font-size: 12px; color: #b3b3b3;">Eğer butona tıklanmıyorsa; <br />$site_url/sifre/degistir/$post_oyuncu/$token/adresini adres &ccedil;ubuğunuza yazarak işlemini tamamlayabilirsiniz.</div>
<div style="margin-left: 20px; margin-right: 20px; margin-bottom: 12px;">
<div style="line-height: 5px; font-size: 1px;">&nbsp;</div>
</div>
</div>
</div>";

		$sifre_guncelle =  $db->prepare("UPDATE authme SET token = ?, token_bitis = ?, simdiki_ip = ? WHERE username = ?");
		$sifre_guncelle->execute(array($token,$gelecek_zaman,$_SERVER["REMOTE_ADDR"],$post_oyuncu));
		if($mail->Send()) {
			echo "<div class='flag note note--success'>
					  <div class='flag__image note__icon'>
						<i class='fa fa-check'></i>
					  </div>
					  <div class='flag__body note__text'>
						Mail başarıyla gönderilmiştir!
					  </div>
					</div>";
		} else {
		echo "<div class='flag note note--error'>
					  <div class='flag__image note__icon'>
						<i class='fa fa-times'></i>
					  </div>
					  <div class='flag__body note__text'>
						Mail gönderilirken bir hata oluştu!
					  </div>
					</div>";
		}

	}
}
?>
                <div class="kayit-ol">
                    <br />
                    <div style="overflow-x:auto;">
                <form action="" method="post">
                    <table>
                        <tr>
                            <td style="height: 40px;"><font face="Roboto Condensed" size="4">Kullanıcı Adı: </font></td>
                            <td style="height: 40px;"><input type="text" class="form-control" name="post_oyuncu" placeholder="Kullanıcı adınızı yazınız." required></td>
                        </tr>
                        <tr>
                            <td style="height: 40px;"><font face="Roboto Condensed" size="4">E-Mail Adresiniz: </font></td>
                            <td style="height: 40px;"><input type="email" class="form-control" name="post_email" placeholder="Hesabınıza bağlı email adresini yazınız." required></td>
                        </tr>
                        <tr>
                            <td style="height: 40px;">&nbsp;</td>
                            <td style="height: 40px;"><button type="submit" class="button-example-1 button-example-green pull-right" name="sifre_sifirla"><font face="Roboto Condensed" size="4">Gönder</font></button></td>
                        </tr>
                    </table>
                </form>
				</div>
				</div>
				<br>
                <center>Şifre sıfırlama linkiniz email adresinize e-posta olarak iletilir.</center>
                <br />
            </div>
        </div>
		<?php

			include ('../right.php');

		include ('../footer.php');
		
	?>
    </div>
</body>
</html>
