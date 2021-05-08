<html>
	<head>
		<meta charset="utf8" />
	</head>
<?php 
session_start();
ob_start();
include("ayar.php"); // malik panel içindir. 
include("config.php"); // malik panel içindir. 
if(!$girismalikty)
{
	echo "Bu alanı sadece giriş yapmış kullanıcılarımız görebilir."; 
}
else
{	
?>
    <link rel="stylesheet" href="http://super.paywant.com/tema/remodal/jquery.remodal.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://super.paywant.com/tema/remodal/jquery.remodal.js"></script></head>
	<div align="center"><a href='#paywantModal' ><img style="margin-left:-7px"src="http://www.paywant.com/dosya/paywant200x100.jpg" border="0"/></a></div>
	<div class="remodal" data-remodal-id="paywantModal"> 
	<div class="login-body">
	<?php

					date_default_timezone_set('Europe/Istanbul');
						include("paywant/paywant.lib.php"); // yardımcı fonksiyon(lar)
						/* Malik Panel için bilgileri çekelim */
						connect_db('acc');
						$kullanicisorgula = mssql_query("SELECT JID,Email FROM SRO_VT_ACCOUNT.dbo.TB_User WHERE StrUserID='$kullanmalikatgelx'");
						if(mssql_num_rows($kullanicisorgula) == 1)
							$getirjid = mssql_fetch_array($kullanicisorgula);
						
						$apiKey = "2VZ1-PAY-WANT-59KR58U3-4I45"; // Paywant Mağaza Key
						$apiSecret = "3CVBO1E12L11"; // Paywant Mağaza Secret
						$userID = $getirjid["JID"]; // Kullanıcı ID, kullanan kişinin(*)
						$returnData =$kullanmalikatgelx; // Kullanıcı adı, kullanan kişinin(*)
						$userEmail = $getirjid["Email"]; // Kullanıcı mail, kullanan kişinin(*)
						$userIPAddress = getIPAdresi(); // IP adresi gönderimi zorunludur. Aksi takdirde kullanıcı ödeme ekranını göremez
					
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
							
								<iframe seamless="seamless" style="display:block; width:800px; height:100vh;" frameborder="0" scrolling='yes' src="<?php echo $jsonDecode->Message?>" id='odemeFrame'></iframe>
						
							<?php
						  }else{
							echo $response;
						  }

						}

						
						?>
	</div>
</div>
<?php
}?>