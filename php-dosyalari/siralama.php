<?php
session_start();
if(!isset($_SESSION["uye_id"])){
	header("location:/girisyapmalisin/");
}

	include ('../ayarlar/ayar.php');


    if(isset($_POST["siralama-ara"])){
    	header ("Location:/ara/siralama/$post_oyuncu/");
    }

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
            <div class="icBaslik"><div class="icBaslikYazi"><i class="fa fa-list fa-3x"></i><font size="6"> SIRALAMA</font></div></div>
            <div class="ic">
<?php
if(isset($_POST["siralama-ara"])){
	
	if($post_oyuncu == ""){
		echo "<div class='flag note note--error'>
					  <div class='flag__image note__icon'>
						<i class='fa fa-times'></i>
					  </div>
					  <div class='flag__body note__text'>
						Lütfen boş alan bırakmayın!
					  </div>
					</div>";
	}
}

?>
			<form action="" method="post">
			<button type="submit" name="siralama-ara" class="button-example-1 button-example-green" style="margin-top: 15px; height: 36px; margin-bottom: 10px; float: right; margin-right: 15px;"><font face="Roboto Condensed" size="4">Ara <i class="fa fa-search"></i></font></button>
            <input required type="text" class="form-control" name="post_oyuncu" style="min-width: 250px; height: 36px; float: right; margin-top: 15px; margin-right: 5px;" placeholder="Oyuncunun adını girin.">
			</form>
			<br>
			<br>
			<br>
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
                        <table class="siralama-table" style="table-layout: fixed; width: 100%;">
                            <colgroup>
                                <col style="width: 8%">
                                <col style="width: 10%">
                                <col style="width: 28%">
                                <col style="width: 17%">
                                <col style="width: 17%">
                                <col style="width: 17%">
                            </colgroup>
                            <tr>
                                <th class="baslik" align=center>Sıra</th>
                                <th class="baslik" style="text-align: left; padding-left: 18px;">#</th>
                                <th class="baslik" style="text-align: left;">Kullanıcı Adı</th>
                                <th class="baslik">Öldürme</th>
                                <th class="baslik">Ölüm</th>
                                <th class="baslik">K/D</th>
                            </tr>
                        </table>
					<table class="siralama-table" style="table-layout: fixed; width: 100%;">
							<?php
							$factions_siralama = $db->prepare("SELECT * FROM ".$factions_db." ORDER BY ".$factions_sirala." DESC LIMIT 0,100");
							$factions_siralama->execute();		
								if($factions_siralama->rowCount() != 0){
									$i = 1;
									foreach ($factions_siralama as $factions_siralama_cek) {

							?>
                        
                            <colgroup>
                                <col style="width: 8%">
                                <col style="width: 10%">
                                <col style="width: 28%">
                                <col style="width: 17%">
                                <col style="width: 17%">
                                <col style="width: 17%">
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
							echo"<div style='width: 100%; padding-top: 20px; padding-bottom: 20px;' class='flag note note--error'><center>Sunucuya ait sıralama verileri bulunamadı!</center></div>";
							}
							?>
                        </table>
                    </div>
                    <div id="tab-2" class="tab-content">
                        <table class="siralama-table" style="table-layout: fixed; width: 100%;">
                            <colgroup>
                                <col style="width: 8%">
                                <col style="width: 10%">
                                <col style="width: 28%">
                                <col style="width: 17%">
                                <col style="width: 17%">
                                <col style="width: 17%">
                            </colgroup>
                            <tr>
                                <th class="baslik" align=center>Sıra</th>
                                <th class="baslik" style="text-align: left; padding-left: 18px;">#</th>
                                <th class="baslik" style="text-align: left;">Kullanıcı Adı</th>
                                <th class="baslik">Öldürme</th>
                                <th class="baslik">Ölüm</th>
                                <th class="baslik">Kazanma</th>
                            </tr>
                        </table>
						<table class="siralama-table" style="table-layout: fixed; width: 100%;">
							<?php
							$sg_siralama = $db->prepare("SELECT * FROM ".$sg_db." ORDER BY ".$sg_sirala." DESC LIMIT 0,100");
							$sg_siralama->execute();		
								if($sg_siralama->rowCount() != 0){
									$i = 1;
									foreach ($sg_siralama as $sg_siralama_cek) {

							?>
                        
                            <colgroup>
                                <col style="width: 8%">
                                <col style="width: 10%">
                                <col style="width: 28%">
                                <col style="width: 17%">
                                <col style="width: 17%">
                                <col style="width: 17%">
                            </colgroup>
                            <tr>
                                <td> <center><?=$i++;?></center> </td>
                                <td><img style="border: 1px solid #fff; border-radius: 25px;" src="http://cravatar.eu/avatar/<? echo $sg_siralama_cek[''.$sg_db_username.''] ?>" /></td>
                                <td class="satir"><? echo $sg_siralama_cek[''.$sg_db_username.''] ?></td>
                                <td class="satir"><center><? echo $sg_siralama_cek[''.$sg_db_kills.''] ?></center> </td>
                                <td class="satir"> <center><? echo $sg_siralama_cek[''.$sg_db_deaths.''] ?></center> </td>
                                <td class="satir"> <center><? echo $sg_siralama_cek[''.$sg_db_wins.''] ?></center> </td>
                            </tr>
							<?php
							}
							}else{
							echo"<div style='width: 100%; padding-top: 20px; padding-bottom: 20px;' class='flag note note--error'><center>Sunucuya ait sıralama verileri bulunamadı!</center></div>";
							}
							?>
                        </table>
                    </div>
                    <div id="tab-3" class="tab-content">
                        <table class="siralama-table" style="table-layout: fixed; width: 100%;">
                            <colgroup>
                                <col style="width: 8%">
                                <col style="width: 10%">
                                <col style="width: 28%">
                                <col style="width: 17%">
                                <col style="width: 17%">
                                <col style="width: 17%">
                            </colgroup>
                            <tr>
                                <th class="baslik" align=center>Sıra</th>
                                <th class="baslik" style="text-align: left; padding-left: 18px;">#</th>
                                <th class="baslik" style="text-align: left;">Kullanıcı Adı</th>
                                <th class="baslik">Öldürme</th>
                                <th class="baslik">Ölüm</th>
                                <th class="baslik">K/D</th>
                            </tr>
                        </table>
					<table class="siralama-table" style="table-layout: fixed; width: 100%;">
							<?php
							$pvp_siralama = $db->prepare("SELECT * FROM ".$pvp_db." ORDER BY ".$pvp_sirala." DESC LIMIT 0,100");
							$pvp_siralama->execute();		
								if($pvp_siralama->rowCount() != 0){
									$i = 1;
									foreach ($pvp_siralama as $pvps_siralama_cek) {

							?>
                        
                            <colgroup>
                                <col style="width: 8%">
                                <col style="width: 10%">
                                <col style="width: 28%">
                                <col style="width: 17%">
                                <col style="width: 17%">
                                <col style="width: 17%">
                            </colgroup>
                            <tr>
                                <td> <center><?=$i++;?></center> </td>
                                <td><img style="border: 1px solid #fff; border-radius: 25px;" src="http://cravatar.eu/avatar/<? echo $pvp_siralama_cek[''.$pvp_db_username.''] ?>" /></td>
                                <td class="satir"><? echo $pvp_siralama_cek[''.$pvp_db_username.''] ?></td>
                                <td class="satir"><center><? echo $pvp_siralama_cek[''.$pvp_db_kills.''] ?></center> </td>
                                <td class="satir"> <center><? echo $pvp_siralama_cek[''.$pvp_db_deaths.''] ?></center> </td>
                                <td class="satir"> <center><? echo $pvp_siralama_cek[''.$pvp_db_ratio.''] ?></center> </td>
                            </tr>
							<?php
							}
							}else{
							echo"<div style='width: 100%; padding-top: 20px; padding-bottom: 20px;' class='flag note note--error'><center>Sunucuya ait sıralama verileri bulunamadı!</center></div>";
							}
							?>
                        </table>
                    </div>
                    <div id="tab-4" class="tab-content">
                        <table class="siralama-table" style="table-layout: fixed; width: 100%;">
                            <colgroup>
                                <col style="width: 8%">
                                <col style="width: 10%">
                                <col style="width: 28%">
                                <col style="width: 17%">
                                <col style="width: 17%">
                                <col style="width: 17%">
                            </colgroup>
                            <tr>
                                <th class="baslik" align=center>Sıra</th>
                                <th class="baslik" style="text-align: left; padding-left: 18px;">#</th>
                                <th class="baslik" style="text-align: left;">Kullanıcı Adı</th>
                                <th class="baslik">Öldürme</th>
                                <th class="baslik">Ölüm</th>
                                <th class="baslik">Kazanma</th>
                            </tr>
                        </table>
                        <table class="siralama-table" style="table-layout: fixed; width: 100%;">
                            <colgroup>
									<col style="width: 8%">
									<col style="width: 10%">
									<col style="width: 28%">
									<col style="width: 17%">
									<col style="width: 17%">
									<col style="width: 17%">
                            </colgroup>
                            <tr>
                                <td> <center>1</center> </td>
                                <td><img style="border: 0px solid; border-radius: 25px;" src="http://cravatar.eu/avatar/yok" /></td>
                                <td class="satir">Yok</td>
                                <td class="satir"><center>0</center> </td>
                                <td class="satir"> <center>0</center> </td>
                                <td class="satir"> <center>0</center> </td>
                            </tr>
                        </table>
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
