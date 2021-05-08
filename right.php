<div class="sag">
		<?php
		session_start();
		if(!isset($_SESSION["uye_id"])){
		?>
            <div class="yanTarafTane">
                <div class="yanTarafBaslik">GİRİŞ YAP</div>
                <div class="yanTarafAlt">
<?php
	$token = new token();
	if(isset($_POST['giris-yaptir'])){

		$token_test = $_POST["spam_token"];
	
		if($token->tokenSorgula($token_test) == false){
			die("TOKEN HATALI!");
		}

	    $kadi_varmi = "SELECT COUNT(username) AS num FROM authme WHERE username = :username";
	    $stmt = $db->prepare($kadi_varmi);
		$stmt->bindValue(':username', $post_oyuncu);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$token_test = $_POST["token"];
		$sorgu = $db->prepare("SELECT * FROM authme WHERE username = ? and password = ?");
		$sorgu->execute(array($post_oyuncu, $post_sifre));
		$islem = $sorgu->fetch();
		
		if($post_oyuncu == "" || $post_sifre == ""){
			echo "<div class='flag note note--error'><br>
				Lütfen boş alan bırakmayın!
			<br><br></div>";
		}elseif($row['num'] == 0){
			echo'<div class="flag note note--error"><br><strong>'.$post_oyuncu.'</strong> adında kayıtlı oyuncu bulunamadı!<br><br></div>';
		}elseif($sorgu->rowCount() > 0){
			$_SESSION['uye_id'] = $islem['id'];
			echo'<div class="flag note note--success"><br>Giriş başarılı yönlendirliyorsunuz..<br><br></div>';
			echo '<meta http-equiv="refresh" content="3;URL='.$site_url.'/profil/">';
		} else{
			echo'<div class="flag note note--error"><br>Kullanıcı adını veya şifreyi yanlış girdiniz!<br><br></div>';
		}
	}
?>
                    <div class="giris">
                        <form action="" method="post" style="margin-left: 32px; margin-right: 32px; margin-top: 20px;">
                            <font size="4" face="Roboto Condensed">Kullanıcı Adı:</font><br />
                            <input required type="text" name="post_oyuncu" class="form-control" placeholder="Kullanıcı Adınızı Giriniz." /><br><br>
                            <font size="4" face="Roboto Condensed">Şifre:</font> <a href="../sifre/sifirla/"><font size="3" face="Roboto Condensed" color="#ff00">(Şifremi Unuttum!)</a></font>
                            <input required type="password" AUTOCOMPLETE="off" name="post_sifre" class="form-control" placeholder="Şifrenizi Giriniz." /><br>
                            <center><button name="giris-yaptir" type="submit" style="margin-top: 8px;" class="button-example-1 button-example-green"><font face="Roboto Condensed" size="4">Giriş Yap</font></button></center>
                            <br><center><font size="2" face="Roboto Condensed">Hala sitemizde kayıtlı değil misin? Çok şey kaçırıyorsun. Hemen kayıt olmak için <a href="../kayit/"><strong>tıklayın!</strong></a></font></center>
                            <br>
                            <a href="../sifre/sifirla/"><font face="Roboto Condensed" color="#ff00" style="margin-left: 30px;" size="3">Şifreni hatırlamıyorsan tıkla!</font></a>

                            <input type="hidden" name="spam_token" value="<? echo $_SESSION['spam_token'] ?>" />

						</form>
                        <br>
                    </div>
                </div>
            </div>
			<?
			 }else{
			 ?>
            <div class="yanTarafTane">
                <div class="yanTarafBaslik">PROFİL</div>
					<div class="yanTarafAlt">
						<div class="giris">
							<center>
							<?php
							
							$oyuncu_id_right = $_SESSION["uye_id"];
							$oyuncu_cek_right = $db->prepare("SELECT * FROM authme WHERE id = ?");
							$oyuncu_cek_right->execute(array($oyuncu_id_right));
							$oyuncu_oku_right = $oyuncu_cek_right->fetch();

							?>
							<img alt="<?php echo $sunucu_ismi ?> Profil" style="margin-bottom: 15px; margin-top: 10px; -webkit-box-shadow: 0 0 6px 4px #5B5B5B; -moz-box-shadow: 0 0 6px 4px #5B5B5B; box-shadow: 0 0 6px 4px #5B5B5B; border: 0px solid; border-radius: 4px;" src="http://cravatar.eu/avatar/<?php echo $oyuncu_oku_right["username"] ?>/64.png">
							<br>Merhaba, <strong><?php echo $oyuncu_oku_right["username"] ?></strong><br>
							<strong>Kredin: </strong><i class="fa fa-try"></i><?php if($oyuncu_oku_right["kredi"] == NULL){ echo"0"; }else{ echo $oyuncu_oku_right["kredi"]; } ?> <a href="../kredi/" data-toggle="tooltip" data-placement="right" title="" data-original-title="Kredi Ekle" class="tooltip-a fa fa-plus-circle"></a>
							</center><br>
							<center>
							<a href="../profil/"><button name="profil" class="profil"><font face="Roboto Condensed" size="4"><i class="fa fa-fw fa-user"></i> Profil</font></button></a><br><br>
							<a href="../kredi/"><button name="krediyukle" class="krediyukle"><font face="Roboto Condensed" size="4"><i class="fa fa-fw fa-money"></i> Kredi Yükle</font></button></a><br><br>
							<a href="../market/"><button name="market" class="market"><font face="Roboto Condensed" size="4"><i class="fa fa-fw fa-shopping-cart"></i> Market</font></button></a><br><br>
							<a href="/cikis/"><button onclick="return confirm('Çıkış yapmak istediğinize emin misiniz?')" name="cikis" class="cikis"><font face="Roboto Condensed" size="4"><i class="fa fa-fw fa-sign-out"></i> Çıkış Yap</font></button></a><br><br>
							</center>
						</div>
                	</div>
            	</div>
			 <?php } ?>
            <div class="yanTarafTane">
                <div class="yanTarafBaslik">SUNUCU DURUMU</div>
                	<div class="yanTarafSunucu">
                    	<table class="sunucu-durumu">
	                        <colgroup>
	                            <col width="33%" />
	                            <col width="34%" />
	                            <col width="33%" />
	                        </colgroup>
                       		<tr>
	                            <td class="sunucu-kayit">
	                                <center>
	                                    <font color="#FFFFFF"><i class="fa fa-edit fa-3x"></i></font>
	                                    <font color="#FFFFFF" face="Oswald" size="3"><p style="margin-top: 5px;"><strong>
											<?php
											$kayit_cek = $db->prepare("SELECT * FROM authme ORDER BY id DESC LIMIT 1");
											$kayit_cek->execute();
											$kayit_oku = $kayit_cek->fetch();
											
											if($kayit_cek->rowCount() != 0){
												echo $kayit_oku["id"];
											}
											else{
												echo "0";
											}
											?>
										</strong></p></font>
	                                    <font color="#FFFFFF" face="Arial" size="1"><p style="margin-top: 1px;">Kayıtlı Oyuncu</p></font>
	                                </center>
	                            </td>
	                            <td class="sunucu-online">
	                                <center>
	                                    <font color="#FFFFFF"><i class="fa fa-users fa-3x"></i></font>
	                                    <font color="#FFFFFF" face="Oswald" size="3"><strong><div style="margin-top: 4px;" id="numplayers"></div></strong></font>
	                                    <font color="#FFFFFF" face="Arial" size="1"><p style="margin-top: 1px;">Çevrimiçi Oyuncu</p></font>
	                                </center>
	                            </td>
	                            <td class="sunucu-surum">
	                                <center>
	                                    <font color="#FFFFFF"><i class="fa fa-area-chart fa-3x"></i></font>
	                                    <font color="#FFFFFF" face="Oswald" size="3"><p style="margin-top: 5px;"><strong><?php echo "$surum" ?></strong></p></font>
	                                    <font color="#FFFFFF" face="Arial" size="1"><p style="margin-top: 1px;">Sunucu Sürümü</p></font>
	                                </center>
	                            </td>
                        	</tr>
                    	</table>
               		</div>
            	</div>
            <div class="yanTarafTane">
                <div class="yanTarafBaslik">DISCORD</div>
                	<div class="yanTarafAlt">
                			<iframe src="https://discordapp.com/widget?id=319767892092518411&theme=dark" width="322" height="500" allowtransparency="true" frameborder="0"></iframe>
                	</div>
            	</div>
            <div class="yanTarafTane">
                <div class="yanTarafBaslik">KREDI ALANLAR</div>
                	<div class="yanTarafAlt">
                        <div style="overflow-x:auto;">
                            <table class="kredi-alanlar">
								<colgroup>
									<col style="width: 40px">
									<col style="width: 150px">
									<col style="width: 75px">
									<col style="width: 75px">
								</colgroup>
                                <tr>	
                                    <th><center>#</center></th>
                                    <th>Kullanıcı Adı</th>
                                    <th><center>Miktar</center></th>
                                    <th><center>Method</center></th>
                                </tr>
								</table>
								<?php
								$kredi_tablo = $db->query("SELECT * FROM Kredi ORDER BY id DESC LIMIT 5");
								$kredi_tablo->execute();		
								if($kredi_tablo->rowCount() != 0){
									
									foreach ($kredi_tablo as $kredi_tablo_oku) {

								?>
							<table class="kredi-alanlar">
								<colgroup>
									<col style="width: 40px">
									<col style="width: 150px">
									<col style="width: 75px">
									<col style="width: 75px">
								</colgroup>
								
                                <tr>
								
                                    <td><a href="<?php echo $site_url ?>/profil/ara/<?php echo $kredi_tablo_oku['nick'] ?>"><center><img alt="<?php echo $kredi_tablo_oku["nick"] ?> Profil" style="border: 0px solid; border-radius: 4px;" src="http://cravatar.eu/avatar/<?php echo $kredi_tablo_oku['nick'] ?>/28.png" /></a></center></td>
                                    <td><a href="<?php echo $site_url ?>/profil/ara/<?php echo $kredi_tablo_oku['nick'] ?>"><?php echo $kredi_tablo_oku['nick'] ?></a></td>
                                    <td><a href="<?php echo $site_url ?>/profil/ara/<?php echo $kredi_tablo_oku['nick'] ?>"><center><?php echo $kredi_tablo_oku['miktar'] ?></center></a></td>
                                    <td><a href="<?php echo $site_url ?>/profil/ara/<?php echo $kredi_tablo_oku['nick'] ?>"><center><?php if($kredi_tablo_oku['metod'] == "Mobil"){ echo "<font size='6'><i class='fa fa-mobile'></i></font>"; }else { echo "<font size='4'><i class='fa fa-credit-card-alt'></i></font>"; } ?></center></a></td>
                                
								</tr>
								

                            </table>
								<?php
								}
								}else{
								echo'<div class="flag note note--error"><br>Henüz kredi satın alan yok!<br><br></div>';
								}
								?>
                        </div>
                    </div>
            </div>
            <div class="yanTarafTane">
                <div class="yanTarafBaslik">MARKETI KULLANANLAR</div>
                	<div class="yanTarafAlt">
                   		<div style="overflow-x:auto;">
                        	<table class="kredi-alanlar">
								<colgroup>
									<col style="width: 40px">
									<col style="width: 150px">
									<col style="width: 75px">
									<col style="width: 75px">
								</colgroup>
                            <tr>
                                <th><center>#</center></th>
                                <th>Kullanıcı Adı</th>
                                <th><center>Sunucu</center></th>
                                <th><center>Ürün</center></th>
                            </tr>
						</table>
								<?php
								$market_tablo = $db->query("SELECT * FROM Market ORDER BY id DESC LIMIT 5");
								$market_tablo->execute();		
								if($market_tablo->rowCount() != 0){

									foreach ($market_tablo as $market_tablo_oku) {

								?>
						<table class="kredi-alanlar">
								<colgroup>
									<col style="width: 40px">
									<col style="width: 150px">
									<col style="width: 75px">
									<col style="width: 75px">
								</colgroup>
                            <tr>
                                <td><a href="<?php echo $site_url ?>/profil/ara/<?php echo $market_tablo_oku['nick'] ?>"><center><img alt="<?php echo $market_tablo_oku["nick"] ?> Profil" style="border: 0px solid; border-radius: 4px;" src="http://cravatar.eu/avatar/<?php echo $market_tablo_oku['nick'] ?>/28.png" /></center></a></td>
                                <td><a href="<?php echo $site_url ?>/profil/ara/<?php echo $market_tablo_oku['nick'] ?>"><?php echo $market_tablo_oku['nick'] ?></a></td>
                                <td><a href="<?php echo $site_url ?>/profil/ara/<?php echo $market_tablo_oku['nick'] ?>"><center><?php echo $market_tablo_oku['sunucu'] ?></center></a></td>
                                <td><a href="<?php echo $site_url ?>/profil/ara/<?php echo $market_tablo_oku['nick'] ?>"><center><?php echo $market_tablo_oku['urun'] ?></center></a></td>
                            </tr>
                        </table>
							<?php
							}
							}else{
							echo'<div class="flag note note--error"><br>Henüz marketi kullanan yok!<br><br></div>';
							}
							?>
                    </div>
                </div>
            </div>
            <div class="yanTarafTane">
                <div class="yanTarafBaslik">OYUNCU ARA</div>
                	<div class="yanTarafAlt">
	                    <form action="" method="post">
	                        <input required type="text" class="form-control" name="post_oyuncu" style="min-width: 190px; height: 32px;" placeholder="Oyuncunun adını girin.">
	                        <button type="submit" name="ara" class="button-example-1 button-example-green" style="margin-top:8px; height: 34px; margin-bottom: 10px;"><font face="Roboto Condensed" size="4">Ara <i class="fa fa-search"></i></font></button>
						</form>
                	</div>
            	</div>
       	 </div>