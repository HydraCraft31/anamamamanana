<?php

session_start();
ob_start();

$admin_username = "ErenBeyefendi";
$admin_sifre    = "erenkeremeren09";
$admin_username2 = "KeremWhoTR";
$admin_sifre2   = "serefkerem1905";

define("CSRF_PROTECTED", true);

include('../ayarlar/baglan.php');

date_default_timezone_set('Europe/Istanbul');


$sunucu_isim	= "Turquality | Yonetim";
$panel_baslik	= "Turquality | Yonetim";
$site_url		= "http://www.minetc.com/admin/";
$ip 			= "play.minetc.net";

// Token //

	class token{
		
		public function __construct(){
			
			if(!$_SESSION["spam_token"]){
				$this->tokenOlustur();
			}
			
		}
		
		public function tokenOlustur(){
			$token = strtoupper(md5(uniqid(rand(), true)));
			$_SESSION["spam_token"] = $token;
		}
		
		public function tokenSorgula($token_test){
			if($token_test == $_SESSION["spam_token"]){
				$this->tokenOlustur();
				return true;
			}
			
			return false;
		}
		
	}
	
///////////////////////////////////////

// Token //
if (empty($_SESSION['token']) || !isset($_SESSION['token'])) {
	$_SESSION['token'] = strtoupper(md5(uniqid(rand(), true)));
}
if (CSRF_PROTECTED != false) {
	if ($_POST) {
		if ($_POST['token'] != $_SESSION['token']) {
			header("Location: $site_url/index.php");
			die();
		}
	}
}

function permayap($deger) {
$turkce=array("ş","Ş","ı","(",")","'","ü","Ü","ö","Ö","ç","Ç"," ","/","*","?","ş","Ş","ı","ğ","Ğ","İ","ö","Ö","Ç","ç","ü","Ü");
$duzgun=array("s","S","i","","","","u","U","o","O","c","C","-","-","-","","s","S","i","g","G","I","o","O","C","c","u","U");
$deger=str_replace($turkce,$duzgun,$deger);
$deger = preg_replace("@[^A-Za-z0-9\-_]+@i","",$deger);
return $deger;
}  

 ?>