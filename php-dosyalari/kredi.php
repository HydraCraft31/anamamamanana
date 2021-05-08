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
            <div class="icBaslik"><div class="icBaslikYazi"><i class="fa fa-try fa-3x"></i><font size="6"> <a href="../kredi/">KREDİ YÜKLE</a></font></div></div>
            <div class="ic">
			<?php 
				if($_SESSION["uye_id"] != "")
				{
							$oyuncu_id_t = $_SESSION["uye_id"];
							$oyuncu_cek_right = $db->prepare("SELECT * FROM authme WHERE id = ?");
							$oyuncu_cek_right->execute(array($oyuncu_id_t));
							$oyuncu_oku_right = $oyuncu_cek_right->fetch();
							
							
							$kullaniciAdi = $oyuncu_oku_right["username"];
							$kullaniciEmail = $oyuncu_oku_right["email"];
				
			
			?>
			 
	<?php
				
			
		
					
					
					$apiKey 	 = "5MZ1-PAY-WANT-70SV87F8-1S55";
					$apiSecret   = "9MHUU5D68D43";
				
	
			date_default_timezone_set('Europe/Istanbul');
			
						function getIPAdresi()	{
							if(getenv("HTTP_CLIENT_IP")) 
								$ip = getenv("HTTP_CLIENT_IP");
							else if(getenv("HTTP_X_FORWARDED_FOR")){
								$ip = getenv("HTTP_X_FORWARDED_FOR");
								if (strstr($ip, ',')){
									$tmp = explode (',', $ip); $ip = trim($tmp[0]);
								}} 
							else 
								$ip = getenv("REMOTE_ADDR");
							return $ip;
						}
						
						function paywantAntiInjection($sql){
								$sql 			= preg_replace(@sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"),"",$sql);
								$sql 			= trim($sql);
								$sql 			= strip_tags($sql);
								$sql 			= addslashes($sql);
								return $sql;
							}
	
								
						$userID = $oyuncu_id_t;
						$returnData =$kullaniciAdi;
						$userEmail = $kullaniciEmail;
						$userIPAddress = getIPAdresi(); // IP adresi gönderimi zorunludur. Aksi takdirde kullanıcı ödeme ekranını göremez
						//$userIPAddress = "81.213.43.32"; // IP adresi gönderimi zorunludur. Aksi takdirde kullanıcı ödeme ekranını göremez

						$hashYarat = base64_encode(hash_hmac('sha256',"$returnData|$userEmail|$userID".$apiKey,$apiSecret,true));


						$postData = array(
						'apiKey' => $apiKey,
						'hash' => $hashYarat,
						'returnData'=> $returnData,
						'userEmail' => $userEmail,
						'userIPAddress' => $userIPAddress,
						'userID' => $userID
						);

						$postData = http_build_query($postData);



						$curl = curl_init();

						curl_setopt_array($curl, array(
						  CURLOPT_URL => "http://api.paywant.com/gateway.php",
						  CURLOPT_RETURNTRANSFER => true,
						  CURLOPT_ENCODING => "",
						  CURLOPT_MAXREDIRS => 10,
						  CURLOPT_TIMEOUT => 30,
						  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						  CURLOPT_CUSTOMREQUEST => "POST",
						  CURLOPT_POSTFIELDS => $postData,
						));

						$response = curl_exec($curl);
						$err = curl_error($curl);

						curl_close($curl);

						if ($err) {
							echo "cURL Error #:" . $err;
						} else {
						  $jsonDecode = json_decode($response);
						  if($jsonDecode->Status == 100)
						  {
							 // echo $jsonDecode->Message;
							// Ortak odeme sayfasina yonlendir yada iFrame ile aç
							// header("Location:".$jsonDecode->Message);
							?>
							
								<iframe seamless="seamless" style="display:block; width:100%; height:100vh;" frameborder="0" scrolling='yes' src="<?php echo $jsonDecode->Message?>" id='odemeFrame'></iframe>
						
							<?php
						  }else{
							echo $response;
						  }

						}
						
			}else{
				echo "Bu alanı sadece giriş yapmış kullanıcılarımız görebilir.";
			}
			

					

						
						?>
		
				<!--
                <center>
                <br>
		
                <table class="kredi-yukle-table" style="table-layout: fixed; width: 100%;">
                    <tr>
                        <th>
                            <font face="Roboto Condensed" size="5">Lütfen yüklemek istediğiniz krediyi yazınız.</font><br><br>
                            <form class="kredi-yukle-form" action="" method="post">
                                <input type="hidden" name="odemeturu" value="kredikarti" />
                                    Yüklenecek Kredi:<br>
                                    <input style="margin-top: 4px; min-width: 218px;" type="text" name="amount" required class="form-control" placeholder="1 ila 100 TL arasında miktar giriniz." />
                                    <br><br>Yüklenecek Hesap:<br>
                                    <input required style="margin-top: 4px; min-width: 218px;" type="text" class="form-control" name="oyuncu" value="<?php echo $oyuncu_oku["username"] ?>">
                                    <input required type="hidden" name="odemeolduurl" value="<?php echo $site_url ?>/basarili/">
                                    <input required type="hidden" name="odemeolmadiurl" value="<?php echo $site_url ?>/basarisiz/">
                                    <input required type="hidden" name="vipname" value="kredi">
                                    <input required type="hidden" name="raporemail" value="<?php echo $batihost_email ?>">
                                    <input required type="hidden" name="onlyemail" value="<?php echo $batihost_email ?>">
                                    <input required type="hidden" name="posturl" value="<?php echo $site_url ?>/kredi/odeme/kart/">
                                    <input required type="hidden" name="batihostid" value="<?php echo $batihost_id ?>">
                                    <br><button name="kredi-yukle" style="margin-top: 12px;" type="submit" class="button-example-1 button-example-green"><font face="Roboto Condensed" size="4">Kredi Yükle</font></button>
							</form>
                        </th>
                </table>
                    <br />
                <font face="Roboto Condensed" size="4" color="#FF0000">*Ödemelerde asla geri iade yapılamaz.</font>
                <br>
                <br>
                </center>
				-->
            </div>
        </div>
		<?php

			include ('../right.php');

		include ('../footer.php');
		
	?>
    </div>
</body>
</html>
