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
            <div class="icBaslik"><div class="icBaslikYazi"><i class="fa fa-user fa-3x"></i><font size="6"> PROFİL</font></div></div>
            <div class="ic">
                <center>
                    <style type="text/css">
                        .tgProfil {
                            border-collapse: collapse;
                            border-spacing: 0;
                            border-color: #999;
                        }

                            .tgProfil td {
                                font-family: Arial, sans-serif;
                                font-size: 14px;
                                padding: 10px 5px;
                                border-style: solid;
                                border-width: 0px;
                                overflow: hidden;
                                word-break: normal;
                                border-color: #999;
                                color: #444;
                                background-color: #F7FDFA;
                            }

                            .tgProfil th {
                                font-family: Arial, sans-serif;
                                font-size: 14px;
                                font-weight: normal;
                                padding: 10px 5px;
                                border-style: solid;
                                border-width: 0px;
                                overflow: hidden;
                                word-break: normal;
                                border-color: #999;
                                color: #000;
                                background-color: #fff;
                                padding-top: 30px;
                            }

                            .tgProfil .tg-3we0 {
                                background-color: #ffffff;
                                vertical-align: top;
                            }
                    </style>
                    <table class="tgProfil" style="table-layout: fixed; width: 100%;">
                        <colgroup>
                            <col style="width: 30%">
                            <col style="width: 40%">
                            <col style="width: 30%">
                        </colgroup>
                        <tr>
                            <th class="tg-3we0">
                                <center>
                                    <img width='135' height='260' src="https://mcapi.ca/skin/2d/<?php echo $oyuncu_oku["username"] ?>">
                                </center>
                            </th>
                            <th class="tg-3we0">
                                <center>
                                    <font face="Roboto Condensed" size="3">
                                        <strong>Kullanıcı Adı: </strong><?php echo $oyuncu_oku["username"] ?>
                                        <br><strong>Mevcut Krediniz: </strong><?php if($oyuncu_oku["kredi"] == NULL){ echo"0"; }else{ echo $oyuncu_oku["kredi"]; } ?> <a href="../kredi/" data-toggle='tooltip' data-placement='right' title='' data-original-title='Kredi Ekle' class='tooltip-a fa fa-plus-circle'></a>
                                        <br><strong>E-Mail: </strong><?php echo $oyuncu_oku["email"] ?>
                                        <br><strong>Kayıt Tarihi: </strong><?php if($oyuncu_oku["tarih"] == NULL){ echo "Girilmedi!"; }else{ echo $oyuncu_oku["tarih"]; } ?>
                                        <br><strong>Skype: </strong><?php if($oyuncu_oku["skype"] == NULL){ echo "Girilmedi!"; }else{ echo $oyuncu_oku["skype"]; } ?>
                                        <br><strong>Facebook: </strong><?php if($oyuncu_oku["facebook"] == NULL){ echo "Girilmedi!"; }else{ echo $oyuncu_oku["facebook"]; } ?>
                                        <br><strong>Steam: </strong><?php if($oyuncu_oku["steam"] == NULL){ echo "Girilmedi!"; }else{ echo $oyuncu_oku["steam"]; } ?>
                                        <br><strong>Sevdiğim Oyun: </strong><?php if($oyuncu_oku["oyun"] == NULL){ echo "Girilmedi!"; }else{ echo $oyuncu_oku["oyun"]; } ?>
                                        <br>
                                        <a href="../profil/duzenle/"><button type="submit" class="button-example-1 button-example-green button-profil" style="margin-top: 12px;"><font face="Roboto Condensed" size="4" color="#fff"><i class="fa fa-edit"></i> Profili Düzenle</font></button></a>
                                        <br>
                                        <a href="../profil/sifre/degistir/"><button type="submit" class="button-example-1 button-example-green button-profil" style="margin-top: 12px;"><font face="Roboto Condensed" size="4" color="#fff"><i class="fa fa-lock"></i> Şifre Değiştir!</font></button></a>
                                        <br>
                                        <a href="../profil/email/"><button type="submit" class="button-example-1 button-example-green button-profil" style="margin-top: 12px;"><font face="Roboto Condensed" size="4" color="#fff"><i class="fa fa-envelope"></i> E-Mail Değiştir!</font></button></a><br>
                                </center>
                            </th>
                            <th class="tg-3we0">
                                <center>
                                    <img width='135' height='260' src="https://mcapi.ca/skin/2d/<?php echo $oyuncu_oku["username"] ?>">
                                </center>
                            </th>
                        </tr>
                    </table>
                    <br>
				<style type="text/css">
                    .siralama {
                        font-family: 'Trebuchet MS', serif;
                    }
                </style>
                <div class="siralama">
                    <ul class="tabs">
                        <li class="tab-link current" data-tab="tab-1"><center><font size="4" face="Oswald"><?php if($factions_tablo == "TRUE"){ echo "FACTIONS"; }else{echo "BOŞ";} ?></font></center></li>
                        <li class="tab-link" data-tab="tab-2"><center><font size="4" face="Oswald"><?php if($sg_tablo == "TRUE"){ echo "SURVIVAL GAMES"; }else{echo "BOŞ";} ?></font></center></li>
                        <li class="tab-link" data-tab="tab-3"><center><font size="4" face="Oswald"><?php if($pvp_tablo == "TRUE"){ echo "PVP"; }else{echo "BOŞ";} ?></font></center></li>
                        <li class="tab-link" data-tab="tab-4"><center><font size="4" face="Oswald"><?php if($skyblock_tablo == "TRUE"){ echo "SKY BLOCK"; }else{echo "BOŞ";} ?></font></center></li>
                    </ul>
                    <div id="tab-1" class="tab-content current">
                        <table class="siralama-table" style="table-layout: fixed; width: 93%;">
                            <colgroup>
                                <col style="width: 10%">
                                <col style="width: 30%">
                                <col style="width: 19%">
                                <col style="width: 19%">
                                <col style="width: 19%">
                            </colgroup>
                            <tr>
                                <th class="baslik" style="text-align: left; padding-left: 18px;">#</th>
                                <th class="baslik" style="text-align: left;">Kullanıcı Adı</th>
                                <th class="baslik">Öldürme</th>
                                <th class="baslik">Ölüm</th>
                                <th class="baslik">K/D</th>
                            </tr>
                        </table>
					<table class="siralama-table" style="table-layout: fixed; width: 94%;">
							<?php
							$factions_siralama = $db->prepare("SELECT * FROM ".$factions_db." WHERE ".$factions_db_username." = ?");
							$factions_siralama->execute(array($oyuncu_oku["username"]));		
								if($factions_siralama->rowCount() != 0){
									$i = 1;
									foreach ($factions_siralama as $factions_siralama_cek) {

							?>
                        
                            <colgroup>
                                <col style="width: 10%">
                                <col style="width: 30%">
                                <col style="width: 19%">
                                <col style="width: 19%">
                                <col style="width: 19%">
                            </colgroup>
                            <tr>
                                <td> <center><?=$i++;?></center> </td>
                                <td><img style="border: 1px solid #fff; border-radius: 25px;" src="http://cravatar.eu/avatar/<? echo $factions_siralama_cek[''.$factions_db_username.''] ?>" /></td>
                                <td class="satir"><? echo $factions_siralama_cek[''.$factions_db_username.''] ?></td>
                                <td class="satir"><center><? echo $factions_siralama_cek[''.$factions_db_kills.''] ?></center></td>
                                <td class="satir"><center><? echo $factions_siralama_cek[''.$factions_db_deaths.''] ?></center></td>
                                <td class="satir"><center><? echo $factions_siralama_cek[''.$factions_db_ratio.''] ?></center></td>
                            </tr>
							<?php
							}
							}else{
							echo"<div style='width: 93%; padding-top: 20px; padding-bottom: 20px;' class='flag note note--error'><center>Bu sistem şu anda çalışmamaktadır.</center></div>";
							}
							?>
                        </table>
                    </div>
                    <div id="tab-2" class="tab-content">
                        <table class="siralama-table" style="table-layout: fixed; width: 93%;">
                            <colgroup>
                                <col style="width: 10%">
                                <col style="width: 30%">
                                <col style="width: 19%">
                                <col style="width: 19%">
                                <col style="width: 19%">
                            </colgroup>
                            <tr>
                                <th class="baslik" style="text-align: left; padding-left: 18px;">#</th>
                                <th class="baslik" style="text-align: left;">Kullanıcı Adı</th>
                                <th class="baslik">Öldürme</th>
                                <th class="baslik">Ölüm</th>
                                <th class="baslik">Kazanma</th>
                            </tr>
                        </table>
						<table class="siralama-table" style="table-layout: fixed; width: 93%;">
							<?php
							$sg_siralama = $db->prepare("SELECT * FROM ".$sg_db." WHERE ".$sg_db_username." = ?");
							$sg_siralama->execute(array($oyuncu_oku["username"]));	
								if($sg_siralama->rowCount() != 0){
								$sg_siralama_cek = $sg_siralama->fetch();

							?>
                        
                            <colgroup>
                                <col style="width: 10%">
                                <col style="width: 30%">
                                <col style="width: 19%">
                                <col style="width: 19%">
                                <col style="width: 19%">
                            </colgroup>
                            <tr>
                                <td><img style="border: 1px solid #fff; border-radius: 25px;" src="http://cravatar.eu/avatar/<? echo $sg_siralama_cek[''.$sg_db_username.''] ?>" /></td>
                                <td class="satir"><? echo $sg_siralama_cek[''.$sg_db_username.''] ?></td>
                                <td class="satir"><center><? echo $sg_siralama_cek[''.$sg_db_kills.''] ?></center> </td>
                                <td class="satir"> <center><? echo $sg_siralama_cek[''.$sg_db_deaths.''] ?></center> </td>
                                <td class="satir"> <center><? echo $sg_siralama_cek[''.$sg_db_wins.''] ?></center> </td>
                            </tr>
							<?php
							}else{
							echo"<div style='width: 93%; padding-top: 20px; padding-bottom: 20px;' class='flag note note--error'><center>Bu sistem şu anda çalışmamaktadır.</center></div>";
							}
							?>
                        </table>
                    </div>
                    <div id="tab-3" class="tab-content">
                        <table class="siralama-table" style="table-layout: fixed; width: 93%;">
                            <colgroup>
                                <col style="width: 10%">
                                <col style="width: 30%">
                                <col style="width: 19%">
                                <col style="width: 19%">
                                <col style="width: 19%">
                            </colgroup>
                            <tr>
                                <th class="baslik" style="text-align: left; padding-left: 18px;">#</th>
                                <th class="baslik" style="text-align: left;">Kullanıcı Adı</th>
                                <th class="baslik">Öldürme</th>
                                <th class="baslik">Ölüm</th>
                                <th class="baslik">K/D</th>
                            </tr>
                        </table>
					<table class="siralama-table" style="table-layout: fixed; width: 93%;">
							<?php
							$pvp_siralama = $db->prepare("SELECT * FROM ".$pvp_db." WHERE ".$pvp_db_username." = ?");
							$pvp_siralama->execute(array($oyuncu_oku["username"]));		
								if($pvp_siralama->rowCount() != 0){
									$pvp_siralama_cek = $pvp_siralama->fetch();

							?>
                        
                            <colgroup>
                                <col style="width: 10%">
                                <col style="width: 30%">
                                <col style="width: 19%">
                                <col style="width: 19%">
                                <col style="width: 19%">
                            </colgroup>
                            <tr>
                                <td><img style="border: 1px solid #fff; border-radius: 25px;" src="http://cravatar.eu/avatar/<? echo $pvp_siralama_cek[''.$pvp_db_username.''] ?>" /></td>
                                <td class="satir"><? echo $pvp_siralama_cek[''.$pvp_db_username.''] ?></td>
                                <td class="satir"><center><? echo $pvp_siralama_cek[''.$pvp_db_kills.''] ?></center> </td>
                                <td class="satir"> <center><? echo $pvp_siralama_cek[''.$pvp_db_deaths.''] ?></center> </td>
                                <td class="satir"> <center><? echo $pvp_siralama_cek[''.$pvp_db_ratio.''] ?></center> </td>
                            </tr>
							<?php
							}else{
							echo"<div style='width: 93%; padding-top: 20px; padding-bottom: 20px;' class='flag note note--error'><center>Bu sistem şu anda çalışmamaktadır.</center></div>";
							}
							?>
                        </table>
                    </div>
                    <div id="tab-4" class="tab-content">
                        <table class="siralama-table" style="table-layout: fixed; width: 93%;">
                            <colgroup>
                                <col style="width: 10%">
                                <col style="width: 30%">
                                <col style="width: 19%">
                                <col style="width: 19%">
                                <col style="width: 19%">
                            </colgroup>
                            <tr>
                                <th class="baslik" style="text-align: left; padding-left: 18px;">#</th>
                                <th class="baslik" style="text-align: left;">Kullanıcı Adı</th>
                                <th class="baslik">Öldürme</th>
                                <th class="baslik">Ölüm</th>
                                <th class="baslik">Kazanma</th>
                            </tr>
                        </table>
                        <table class="siralama-table" style="table-layout: fixed; width: 93%;">
                            <colgroup>
                                <col style="width: 10%">
                                <col style="width: 30%">
                                <col style="width: 19%">
                                <col style="width: 19%">
                                <col style="width: 19%">
                            </colgroup>
                            <tr>
                                <td><img style="border: 0px solid; border-radius: 25px;" src="http://cravatar.eu/avatar/yok" /></td>
                                <td class="satir">Yok</td>
                                <td class="satir"><center>0</center> </td>
                                <td class="satir"> <center>0</center> </td>
                                <td class="satir"> <center>0</center> </td>
                            </tr>
                        </table>
                    </div>
					<br>
                    <style type="text/css">
                        .tgMarket {
                            border-collapse: collapse;
                            border-spacing: 0;
                            border-color: #999;
                        }

                            .tgMarket td {
                                font-family: Arial, sans-serif;
                                font-size: 14px;
                                padding: 10px 5px;
                                border-style: solid;
                                border-width: 1px;
                                overflow: hidden;
                                word-break: normal;
                                border-color: #ccc;
                                color: #333;
                                background-color: #fff;
                            }

                            .tgMarket th {
                                font-family: Arial, sans-serif;
                                font-size: 14px;
                                font-weight: normal;
                                padding: 10px 5px;
                                border-style: solid;
                                border-width: 1px;
                                overflow: hidden;
                                word-break: normal;
                                border-color: #ccc;
                                color: #333;
                                background-color: #f0f0f0;
                            }

                            .tgMarket .tg-fk9t {
                                background-color: #999999;
                                color: #EDEDED;
                                vertical-align: top;
                                font-weight: bold;
                            }

                            .tgMarket .tg-2q74 {
                                font-weight: bold;
                                background-color: #f0f0f0;
                                ;
                                color: #313131;
                                text-align: center;
                                vertical-align: top;
                            }

                            .tgMarket .tg-liste {
                                background-color: #fff;
                                color: #313131;
                            }

                            .tgMarket tr:hover td {
                                background-color: #EDEDED;
                                color: #313131;
                            }

                        .tgUst {
                            border-collapse: collapse;
                            border-spacing: 0;
                            border-color: #999;
                        }

                            .tgUst th {
                                font-family: Arial, sans-serif;
                                font-size: 14px;
                                font-weight: normal;
                                padding: 10px 5px;
                                border-style: solid;
                                border-width: 1px;
                                overflow: hidden;
                                word-break: normal;
                                border-color: #494848;
                                color: #333;
                                background-color: #f0f0f0;
                            }

                            .tgUst .tg-4dle {
                                font-weight: bold;
                                background-color: #494848;
                                text-align: center;
                                vertical-align: top;
                                color: #fff;
                            }

                        .tgMarket .tg-yw4l {
                            vertical-align: top;
                            font-weight: bold;
                        }
                    </style>
                    <table class="tgUst" style="table-layout: fixed; width: 90%">
                        <colgroup>
                            <col style="width: 30%">
                            <col style="width: 30%">
                            <col style="width: 30%">
                        </colgroup>
                        <tr>
                            <th class="tg-4dle"></th>
                            <th class="tg-4dle">KREDİ YÜKLEME GEÇMİŞİ</th>
                            <th class="tg-4dle"></th>
                        </tr>
                    </table>
                    <table class="tgMarket" style="table-layout: fixed; width: 90%">
                        <colgroup>
                            <col style="width: 30%">
                            <col style="width: 30%">
                            <col style="width: 30%">
                        </colgroup>
                        <tr>
                            <th class="tg-2q74"><i class="fa fa-money"></i> Yükleme Türü</th>
                            <th class="tg-2q74"><i class="fa fa-shopping-basket"></i> Yüklenen Kredi</th>
                            <th class="tg-2q74"><i class="fa fa-calendar"></i> Yükleme Tarihi</th>
                        </tr>
                    </table>
<?php

$kredi_yukle_ogren = $db->prepare("SELECT * FROM Kredi WHERE nick = ? ORDER BY id DESC LIMIT 5");
$kredi_yukle_ogren->execute(array($oyuncu_oku["username"]));		
	if($kredi_yukle_ogren->rowCount() != 0){

		foreach ($kredi_yukle_ogren as $kredi_yukle_cek) {

?>
                    <table class="tgMarket" style="table-layout: fixed; width: 90%">

                        <colgroup>
                            <col style="width: 30%">
                            <col style="width: 30%">
                            <col style="width: 30%">
                        </colgroup>
                        <tr>
                            <td class="tg-liste">
                                <center>
                                    <strong>
				<?php 
				if ($kredi_yukle_cek['metod'] == "Mobil"){
                echo '<i class="fa fa-mobile"></i> Mobil';
				}
				if ($kredi_yukle_cek['metod'] == "Kart"){
                echo '<i class="fa fa-credit-card-alt"></i> Kredi Kartı';
				} 
				?>
				</strong>
                                </center>
                            </td>
                            <td class="tg-liste"><center><strong><?php echo $kredi_yukle_cek['miktar'] ?></strong> <i class="fa fa-try"></center></td>
                            <td class="tg-liste"><center><strong><?php echo $kredi_yukle_cek['tarih'] ?></strong></center> </td>
                        </tr>
                    </table>
<?php
}
}else{
echo"<div style='width: 90%; padding-top: 20px; padding-bottom: 20px;' class='flag note note--error'><center>Size ait bir kredi geçmişi bulunamadı!</center></div>";
}
?>
                    <br>
                    <br>
                    <table class="tgUst" style="table-layout: fixed; width: 90%">
                        <colgroup>
                            <col style="width: 30%">
                            <col style="width: 30%">
                            <col style="width: 30%">
                        </colgroup>
                        <tr>
                            <th class="tg-4dle"></th>
                            <th class="tg-4dle">MARKET GEÇMİŞİ</th>
                            <th class="tg-4dle"></th>
                        </tr>
                    </table>
                    <table class="tgMarket" style="table-layout: fixed; width: 90%">
                        <colgroup>
                            <col style="width: 30%">
                            <col style="width: 30%">
                            <col style="width: 30%">
                        </colgroup>
                        <tr>
                            <th class="tg-2q74"><i class="fa fa-server"></i> Sunucu</th>
                            <th class="tg-2q74"><i class="fa fa-shopping-basket"></i> Ürün Adı</th>
                            <th class="tg-2q74"><i class="fa fa-calendar"></i> Satın Alınan Tarihi</th>
                        </tr>
                    </table>
<?php

$market_ogren = $db->prepare("SELECT * FROM Market WHERE nick = ? ORDER BY id DESC LIMIT 5");
$market_ogren->execute(array($oyuncu_oku["username"]));		
	if($market_ogren->rowCount() != 0){

		foreach ($market_ogren as $market_cek) {

?>
                    <table class="tgMarket" style="table-layout: fixed; width: 90%">

                        <colgroup>
                            <col style="width: 30%">
                            <col style="width: 30%">
                            <col style="width: 30%">
                        </colgroup>
                        <tr>
                            <td class="tg-liste"><center><strong><?php echo $market_cek['sunucu'] ?></strong></center> </td>
                            <td class="tg-liste"><center><strong><?php echo $market_cek['urun'] ?></strong></center></td>
                            <td class="tg-liste"><center><strong><?php echo $market_cek['tarih'] ?></strong></center> </td>
                        </tr>
                    </table>
<?php
}
}else{
echo"<div style='width: 90%; padding-top: 20px; padding-bottom: 20px;' class='flag note note--error'><center>Size ait bir market geçmişi bulunamadı!</center></div>";
}
?>
                    <br />  
                    </center>
				</div>
			</div>
		<?php

			include ('../right.php');

		include ('../footer.php');
        
	?>
    </div>
</body>
</html>