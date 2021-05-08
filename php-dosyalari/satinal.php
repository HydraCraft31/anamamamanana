<?php
require_once "../ayarlar/ayar.php";
require_once "../Websend.php";

if(!isset($_SESSION["uye_id"])){
	header("location:/girisyapmalisin/");
}


	$uyeid = $_SESSION["uye_id"];
	$uye = $db->prepare("SELECT * FROM authme WHERE id = ?");
	$uye->execute(array($uyeid));	
	$uyeadi = $uye->fetch();
	
	
	$urun_id_sec = $db->prepare("SELECT * FROM Urunler WHERE id = ?");
	$urun_id_sec->execute(array($_GET["id"]));	
	$urun_id_oku = $urun_id_sec->fetch();
	
	$urun_sec = $db->prepare("SELECT * FROM Urunler WHERE urun = ?");
	$urun_sec->execute(array($urun_id_oku["urun"]));
	$urun_oku = $urun_sec->fetch();
	
	$sec = $db->prepare("SELECT * FROM Sunucular WHERE sunucu = ?");
	$sec->execute(array($urun_id_oku["sunucu"]));	
	$oku = $sec->fetch();
	
	$tarih = date('Y-m-d');
	$bir_ay_ekle = strtotime('1 months', strtotime($tarih));
	$son_tarih = date('Y-m-d', $bir_ay_ekle);
	
	if($uyeadi["kredi"] >= $urun_oku["fiyat"]){
		
	$ws = new Websend("".$oku["ip"]."");
	$ws->password = "".$oku["sunucu_sifre"]."";
	$ws->port = "".$oku["port"]."";
				    
	if($ws->connect()){

		$yenipara = $uyeadi["kredi"] - $urun_oku["fiyat"];
		$paraazalt =  $db->prepare("UPDATE authme SET kredi = ? WHERE username = ?");
		$paraazalt->execute(array($yenipara,$uyeadi["username"]));
		
		$ws->doCommandAsConsole(str_ireplace("%player%","".$uyeadi["username"]."","".$urun_oku["komut"].""));
				
			if($urun_oku["kategori"] == 0){
					
					$tabloya_ekle = $db->prepare("INSERT INTO vips (nick,sunucu,urun,son_gun) VALUES(?,?,?,?)");
					$tabloya_ekle->execute(array($uyeadi["username"],$urun_id_oku["sunucu"],$urun_id_oku["urun"],$son_tarih));
					
					$tabloya_ekle2 = $db->prepare("INSERT INTO Market (nick,sunucu,urun,tarih) VALUES(?,?,?,?)");
					$tabloya_ekle2->execute(array($uyeadi["username"],$urun_id_oku["sunucu"],$urun_id_oku["urun"],$tarih));
					
					header("location:$site_url/market/basarili/");
					
			}else{
				
				$tabloya_ekle3 = $db->prepare("INSERT INTO Market (nick,sunucu,urun,tarih) VALUES(?,?,?,?)");
				$tabloya_ekle3->execute(array($uyeadi["username"],$urun_id_oku["sunucu"],$urun_id_oku["urun"],$tarih));
				
				header("location:$site_url/market/basarili/");
				
				}

			}
			else{
				header("location:$site_url/market/hata/");
			}
		}
		else{
			header("location:$site_url/market/basarisiz/");
		}
				