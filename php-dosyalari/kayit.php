<?php
session_start();
if(isset($_SESSION["uye_id"])){
	header("location:/profil/");
}

	function kontrol($post_oyuncu){
		return preg_match('/[^a-zA-Z0-9_]/', $post_oyuncu);
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
            <div class="icBaslik"><div class="icBaslikYazi"><i class="fa fa-user-plus fa-3x"></i><font size="6"> KAYIT-OL</font></div></div>
			<div class="ic">
<?php

$token = new token();
if(isset($_POST['kayit'])){
	$token_test = $_POST["spam_token"];
	
if($token->tokenSorgula($token_test) == false){
	die("TOKEN HATALI!");
}
else{

  $ip_code = "SELECT COUNT(username) AS num3 FROM authme WHERE ip = :ip";
  $ip_cek = $db->prepare($ip_code);
  $ip_cek->bindValue(':ip', ''.$_SERVER['REMOTE_ADDR'].'');
  $ip_cek->execute();
  $ip_varmi = $ip_cek->fetch(PDO::FETCH_ASSOC);

  $email_varmi = "SELECT COUNT(email) AS num FROM authme WHERE email = :email";
  $stmt = $db->prepare($email_varmi);
	$stmt->bindValue(':email', $post_email);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
  $kull_varmi = "SELECT COUNT(username) AS num2 FROM authme WHERE username = :username";
  $stmt2 = $db->prepare($kull_varmi);
	$stmt2->bindValue(':username', $post_oyuncu);
	$stmt2->execute();
	$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
	
if(($post_oyuncu == "") or ($post_sifre == "") or ($post_email == "") or ($sifre_tekrar == "")){
echo "<div class='flag note note--error'>
  <div class='flag__image note__icon'>
    <i class='fa fa-times'></i>
  </div>
  <div class='flag__body note__text'>
    Lütfen boş alan bırakmayın!
  </div>
</div>";
}elseif($ip_varmi['num3'] > $kayit_limit){
echo "<div class='flag note note--error'>
  <div class='flag__image note__icon'>
    <i class='fa fa-times'></i>
  </div>
  <div class='flag__body note__text'>
    En fazla <strong>".$kayit_limit."</strong> defa kayıt olabilirsiniz!
  </div>
</div>";
}elseif($sifre !== $sifre_tekrar){
echo "<div class='flag note note--error'>
  <div class='flag__image note__icon'>
    <i class='fa fa-times'></i>
  </div>
  <div class='flag__body note__text'>
    Şifreler uyuşmuyor. Lütfen tekrar kontrol edin!
  </div>
</div>";
}elseif($row2['num2'] > 0){
echo "<div class='flag note note--error'>
  <div class='flag__image note__icon'>
    <i class='fa fa-times'></i>
  </div>
  <div class='flag__body note__text'>
    <strong>".$post_oyuncu."</strong> adlı bir üye zaten mevcut!
  </div>
</div>";
}elseif($row['num'] > 0){
echo "<div class='flag note note--error'>
  <div class='flag__image note__icon'>
    <i class='fa fa-times'></i>
  </div>
  <div class='flag__body note__text'>
    <strong>".$post_email."</strong> adlı email başkası tarafından kullanılıyor!
  </div>
</div>";
}elseif(kontrol($post_oyuncu)){
echo "<div class='flag note note--error'>
  <div class='flag__image note__icon'>
    <i class='fa fa-times'></i>
  </div>
  <div class='flag__body note__text'>
    Girdiğiniz kullanıcı adı uygun olmayan karakter içeriyor!
  </div>
</div>";
}elseif(strlen($post_oyuncu) < 3){
    echo "<div class='flag note note--error'>
              <div class='flag__image note__icon'>
                <i class='fa fa-times'></i>
              </div>
              <div class='flag__body note__text'>
                Girdiğiniz kullanıcı adı 3 haneden az olamaz!
              </div>
            </div>";
}elseif(strlen($post_oyuncu) > 16){
    echo "<div class='flag note note--error'>
              <div class='flag__image note__icon'>
                <i class='fa fa-times'></i>
              </div>
              <div class='flag__body note__text'>
                Girdiğiniz kullanıcı adı 16 haneden fazla olamaz!
              </div>
            </div>";
}elseif(strlen($sifre) < 4){
    echo "<div class='flag note note--error'>
              <div class='flag__image note__icon'>
                <i class='fa fa-times'></i>
              </div>
              <div class='flag__body note__text'>
                Girdiğiniz şifre 4 haneden az olamaz!
              </div>
            </div>";
 }else{
	$tarih = date('d.m.Y');
	$kayit_ol = $db->prepare("INSERT INTO authme (username,password,ip,lastlogin,x,y,z,world,email,isLogged,tarih) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
	$kayit_ol->execute(array($post_oyuncu,$post_sifre,$_SERVER['REMOTE_ADDR'],'0','0','0','0','world',$post_email,'0',$tarih));
	$giris_yap = $db->prepare("SELECT * FROM authme WHERE username = ? and password = ?");
	$giris_yap->execute(array($post_oyuncu, $post_sifre));
	$islem = $giris_yap->fetch();
    $_SESSION['uye_id'] = $islem['id'];
    echo "<div class='flag note note--success'>
  <div class='flag__image note__icon'>
    <i class='fa fa-check'></i>
  </div>
  <div class='flag__body note__text'>
    Başarıyla Kayıt Oldunuz! Yönlendiriliyorsunuz..
  </div>
</div>";
    echo '<meta http-equiv="refresh" content="3;URL=/profil/">';
}

}

}
?>
            <div class="ic">
                <div class="kayit-ol">
                    <br />
                    <div style="overflow-x:auto;">
						<form action="" method="POST">
						<table class="kayit-ol-table">
                            <tr>
                                <td class="kutu"><font face="Roboto Condensed" size="4">Kullanıcı Adı:</font></td>
                                <td class="kutu"><input type="text" name="post_oyuncu" required class="form-control" placeholder="Kullanıcı Adını giriniz." maxlength="16"><br></td>
                            </tr>
                            <tr>
                                <td class="kutu"><font face="Roboto Condensed" size="4">Şifre:</font></td>
                                <td class="kutu"><input required type="password" AUTOCOMPLETE="off" name="post_sifre" maxlength="32" class="form-control" placeholder="Şifre Giriniz."><br></td>
                            </tr>
                            <tr>
                                <td class="kutu"><font face="Roboto Condensed" size="4">Şifre (Tekrar):</font></td>
                                <td class="kutu"><input type="password" AUTOCOMPLETE="off" name="post_sifre_tekrar" id="passtekrar" required maxlength="32" class="form-control" placeholder="Şifreyi Tekrar Giriniz."><br></td>
                            </tr>
                            <tr>
                                <td class="kutu"><font face="Roboto Condensed" size="4">E-Mail Adresi:</font></td>
                                <td class="kutu"><input type="email" name="post_email" maxlength="32" class="form-control" placeholder="Geçerli bir email giriniz." /></td>
                            </tr>
							<tr>
                                <td class="kutu"></td>
                                <td class="kutu"><button name="kayit" type="submit" class="button-example-1 button-example-green pull-right"><font face="Roboto Condensed" size="4">Kayıt Ol</font></button></td>
                            </tr>
							<input type="hidden" name="spam_token" value="<? echo $_SESSION['spam_token'] ?>" />
							</form>
                        </table>
                        <br />
                    </div>
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