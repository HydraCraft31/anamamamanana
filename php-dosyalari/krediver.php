<?php
include("../ayarlar/ayar.php");

if($_POST){

	$oyuncu 	= strip_tags($_POST["user"]);
	$amount 	= strip_tags($_POST["credit"]);
	$telefon 	= $_POST["telefon"];
	$transid 	= $_POST["transid"];
	$guvenlik 	= $_POST["guvenlik"];
	$vip 		= $_POST["vipname"];
	$icon_mobil = "Mobil";
	$tarih = date('d.m.Y H:i');


	if ( $bati_host_token == $guvenlik) 
	{

		$amount = round($amount, 0, PHP_ROUND_HALF_DOWN);
		$kadi = $db->prepare("SELECT * FROM authme WHERE username = ?");
		$kadi->execute(array($oyuncu));
		$oku = $kadi->fetch();
		
		$yeniKredi = $oku["kredi"] + $amount;
		
		$kredi_guncelle =  $db->prepare("UPDATE authme SET kredi = ? WHERE username = ?");
	    $kredi_guncelle->execute(array($yeniKredi,$oyuncu));
	 
		$tabloya_ekle = $db->prepare("INSERT INTO Kredi (nick,metod,miktar,tarih) VALUES(?,?,?,?)");
		$tabloya_ekle->execute(array($oyuncu,$icon_mobil,$amount,$tarih));
		
	}
	else{
		echo "Güvenlik kodu yanlış!"
	}
}
?>
