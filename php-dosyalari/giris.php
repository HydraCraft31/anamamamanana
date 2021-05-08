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
            <div class="icBaslik"><div class="icBaslikYazi"><i class="fa fa-sign-in fa-3x"></i><font size="6"> GİRİŞ YAP</font></div></div>
            <div class="ic">
<?php
$token = new token();
if(isset($_POST['girisYap'])){

		$token_test = $_POST["spam_token"];
	
		if($token->tokenSorgula($token_test) == false){
			die("TOKEN HATALI!");
		}

	    $kadi_varmi = "SELECT COUNT(username) AS num FROM authme WHERE username = :username";
	    $stmt = $db->prepare($kadi_varmi);
		$stmt->bindValue(':username', $post_oyuncu);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$giris_yap = $db->prepare("SELECT * FROM authme WHERE username = ? and password = ?");
		$giris_yap->execute(array($post_oyuncu, $post_sifre));
		$islem = $giris_yap->fetch();

		if($post_oyuncu == "" || $post_sifre == ""){
			echo "<div class='flag note note--error'>
			  <div class='flag__image note__icon'>
				<i class='fa fa-times'></i>
			  </div>
			  <div class='flag__body note__text'>
				Lütfen boş alan bırakmayın!
			  </div>
			</div>";
		}
		elseif($giris_yap->rowCount() > 0){
			$_SESSION['uye_id'] = $islem['id'];
			echo "<div class='flag note note--success'>
			  <div class='flag__image note__icon'>
				<i class='fa fa-check'></i>
			  </div>
			  <div class='flag__body note__text'>
				Giriş yapıldı! Yönlendiriliyorsunuz..
				</div>
			</div>";
		echo '<meta http-equiv="refresh" content="2;URL=/profil/">';
		}elseif($row['num'] == 0){
			echo "<div class='flag note note--error'>
			  <div class='flag__image note__icon'>
				<i class='fa fa-times'></i>
			  </div>
			  <div class='flag__body note__text'>
				<strong>".$post_oyuncu."</strong> adında kayıtlı oyuncu bulunamadı!
				</div>
			</div>";
		}else{
			echo "<div class='flag note note--error'>
			  <div class='flag__image note__icon'>
				<i class='fa fa-times'></i>
			  </div>
			  <div class='flag__body note__text'>
				Kullanıcı adı veya şifre yanlış!
				</div>
			</div>";
		}
	}
?>
                <div class="giris-yap">
                    <br />
                    <div style="overflow-x:auto;">
					<form action="" method="POST">
                        <table class="giris-table">
                            <tr>
                                <td class="kutu"><font face="Roboto Condensed" size="4">Kullanıcı Adı:</font></td>
                                <td class="kutu"><input type="text" name="post_oyuncu" required class="form-control" placeholder="Kullanıcı Adınızı giriniz." maxlength="16"><br></td>
                            </tr>
                            <tr>
                                <td class="kutu"><font face="Roboto Condensed" size="4">Şifre:</font></td>
                                <td class="kutu"><input required type="password" AUTOCOMPLETE="off" name="post_sifre" maxlength="32" class="form-control" placeholder="Şifrenizi Giriniz."><br></td>
                            </tr>
                        </table>
                        <table class="giris-table">
                            <tr>
                                <td class="giris-sag">
                                    <button name="girisYap" type="submit" class="button-example-1 button-example-green"><font face="Roboto Condensed" size="4">Giriş Yap</font></button>
                                </td>
                            </tr>

                            <input type="hidden" name="spam_token" value="<? echo $_SESSION['spam_token'] ?>" />
                            
							</form>
                        </table>
                        <br />
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
