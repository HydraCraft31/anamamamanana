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

            $simdiki_zaman = date('Y-m-d H:i:s');
			$sql = $db->prepare("SELECT * FROM authme WHERE username = ?");
			$sql->execute(array($_GET["user"]));
			$result = $sql->fetch();

            if ($simdiki_zaman > $result['token_bitis']){
                echo '<meta http-equiv="refresh" content="4;URL=../sifre/sifirla/">';
				echo "<div class='flag note note--error'>
                                          <div class='flag__image note__icon'>
                                            <i class='fa fa-times'></i>
                                          </div>
                                          <div class='flag__body note__text'>
                                            Bu tokenin süresi dolmuş!
                                            </div>
                                        </div>";            
			}elseif(empty($_GET["token"]) && empty($_GET["user"])){
                echo '<meta http-equiv="refresh" content="4;URL=../sifre/sifirla/">';
				echo "<div class='flag note note--error'>
                                          <div class='flag__image note__icon'>
                                            <i class='fa fa-times'></i>
                                          </div>
                                          <div class='flag__body note__text'>
                                            Token ve user algılanamadı!
                                            </div>
                                        </div>";
            }elseif($_GET["token"] != $result['token']){
                echo '<meta http-equiv="refresh" content="4;URL=../sifre/sifirla/">';
				echo "<div class='flag note note--error'>
                                          <div class='flag__image note__icon'>
                                            <i class='fa fa-times'></i>
                                          </div>
                                          <div class='flag__body note__text'>
                                            Böyle bir token yok!
                                            </div>
                                        </div>";
			}elseif($_SERVER['REMOTE_ADDR'] != $result['simdiki_ip']){
				echo "<div class='flag note note--error'>
                                          <div class='flag__image note__icon'>
                                            <i class='fa fa-times'></i>
                                          </div>
                                          <div class='flag__body note__text'>
                                            Bu token bu IP üzerine kayıtlı değil!
                                            </div>
                                        </div>";
            }else {
				if(isset($_POST['sifre_degistir'])){
					if(($post_sifre == "") or ($sifre_tekrar == "")){
						echo "<div class='flag note note--error'>
						  <div class='flag__image note__icon'>
							<i class='fa fa-times'></i>
						  </div>
						  <div class='flag__body note__text'>
							Lütfen boş alan bırakmayın!
						  </div>
						</div>";
					}
                    elseif($sifre !== $sifre_tekrar){
                                echo "<div class='flag note note--error'>
                                          <div class='flag__image note__icon'>
                                            <i class='fa fa-times'></i>
                                          </div>
                                          <div class='flag__body note__text'>
                                            Şifreler birbirine uyuşmuyor!
                                            </div>
                                        </div>";
                            }
                       elseif(strlen($sifre) < 4){
                            echo "<div class='flag note note--error'>
                                      <div class='flag__image note__icon'>
                                        <i class='fa fa-times'></i>
                                      </div>
                                      <div class='flag__body note__text'>
                                        Şifre 4 haneden az olamaz!
                                        </div>
                                    </div>";
                        }else{
						$sifre_guncelle =  $db->prepare("UPDATE authme SET password = ?, token=null, token_bitis=null WHERE username = ?");
						$sifre_guncelle->execute(array($post_sifre,$_GET["user"]));
						}
                        if($sifre_guncelle){

                                echo '
                                        <div class="flag note note--success">
                                        <div class="flag__image note__icon">
                                            <i class="fa fa-check"></i>
                                          </div>
                                          <div class="flag__body note__text">
                                            Şifre başarıyla değiştirildi!
                                          </div>
                                        </div>';
							echo '<meta http-equiv="refresh" content="2;URL='.$site_url.'/giris/">';

						}

                }
            }
            ?>
		<div class="profil-sifre-degis"><br />
			<div style="overflow-x:auto;">
                <form action="" method="post">
                    <table class="sifre-degis-table">
                        <tr>
                            <td class="kutu"><font face="Roboto Condensed" size="4">Yeni Şifre: </font></td>
                            <td class="kutu"><input AUTOCOMPLETE="off" type="password" placeholder="Yeni şifrenizi giriniz." class="form-control" name="post_sifre" required></td>
                        </tr>
                        <tr>
                            <td class="kutu"><font face="Roboto Condensed" size="4">Yeni Şifre (Tekrar):</font></td>
                            <td class="kutu"><input AUTOCOMPLETE="off" type="password" placeholder="Yeni şifrenizi tekrar giriniz." class="form-control" name="post_sifre_tekrar" required></td>
                        </tr>
                        <tr>
                            <td class="kutu">&nbsp;</td>
                            <td class="kutu"><button type="submit" class="button-example-1 button-example-green pull-right" name="sifre_degistir"><font face="Roboto Condensed" size="4">Değiştir</font></button></td>
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
