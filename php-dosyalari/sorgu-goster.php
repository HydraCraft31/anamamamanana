<?php

	include ('../ayarlar/ayar.php');

	$oyuncu_ara = $db->prepare("SELECT * FROM vips WHERE nick = ? ORDER BY id DESC");
	$oyuncu_ara->execute(array($_GET["username"]));
	$aranan_oku = $oyuncu_ara->fetch();


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
            <div class="icBaslik"><div class="icBaslikYazi"><i class="fa fa-calendar fa-3x"></i><font size="6"> VIP SORGU</font></div></div>
            <div class="ic">
                <center>
                    <style type="text/css">
                        .tgProfil {
                            border-collapse: collapse;
                            border-spacing: 0;
                            border-color: #999;
                        }

                            .tgProfil th {
                                font-family: Arial, sans-serif;
                                font-size: 14px;
                                font-weight: normal;
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
                            }
                    </style>
					<?php
    $oyuncu_varmi = "SELECT COUNT(nick) AS num FROM vips WHERE nick = :nick";
    $stmt = $db->prepare($oyuncu_varmi);
	$stmt->bindValue(':nick', $_GET["username"]);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($_GET["username"] == NULL){
		echo '
                <div class="flag note note--error">
                    <div class="flag__image note__icon">
                        <i class="fa fa-times"></i>
                    </div>
                    <div class="flag__body note__text">
                        Lütfen Oyuncu Ara bölümünden yazarak arayınız!
                    </div>
                </div>
		';
	}elseif($row['num'] < 1){
		echo '
                <div class="flag note note--error">
                    <div class="flag__image note__icon">
                        <i class="fa fa-times"></i>
                    </div>
                    <div class="flag__body note__text">
                        <strong>'.$_GET['username'].'</strong> adında kayıtlı <strong>VIP</strong> bulunamadı!
                    </div>
                </div>
		';
	} else {

function tarihFark($tarih1,$tarih2,$ayrac)
{
list($y1,$a1,$g1) = explode($ayrac,$tarih1);
list($y2,$a2,$g2) = explode($ayrac,$tarih2);
$t1_timestamp = mktime('0','0','0',$a1,$g1,$y1);
$t2_timestamp = mktime('0','0','0',$a2,$g2,$y2);
if ($t1_timestamp > $t2_timestamp)
{
$result = ($t1_timestamp - $t2_timestamp) / 86400;
}
elseif ($t2_timestamp > $t1_timestamp)
{
$result = ($t2_timestamp - $t1_timestamp) / 86400;
}
return $result;
}
 
$bugun = date('Y-m-d');
$tarih = $aranan_oku["son_gun"];
$gun = tarihFark($tarih,$bugun,'-');
 
 
?>
                    <table class="tgProfil" style="table-layout: fixed; width: 100%;">
					
                        <tr>
						
                            <th class="tg-3we0">
							<center>
                                    <font face="Roboto Condensed" size="3">
                                        <strong>Kullanıcı Adı: </strong><?php echo $_GET["username"] ?>
									</font>
							</center>
							</th>
						</tr>
						<tr>
							<th class="tg-3we0">
								<center>
									<font face="Roboto Condensed" size="3">
										<strong>Üyelik: </strong><?php echo $aranan_oku["urun"]?>
									</font>
								</center>
							</th>
						</tr>
						<tr>
							<th class="tg-3we0">
								<center>
									<font face="Roboto Condensed" size="3">
										<strong>Sunucu: </strong><?php echo $aranan_oku["sunucu"]?>
									</font>
								</center>
							</th>
						</tr>
						<tr>
							<th class="tg-3we0">
								<center>
									<font face="Roboto Condensed" size="3">
										<strong>Kalan Süre: </strong>
										<?php 
										if ($bugun == $tarih )
												echo "Üyeliğiniz bugün bitecektir!"; 
										elseif ($bugun > $tarih )
												echo "Üyeliğiniz $gun gün önce sona ermiştir.";
										else
												echo "Üyeliğiniz $gun gün sonra sona erecektir.";
										
									
										?>
									</font>
								</center>
							</th>
						</tr>
                    </table>
					<br>
					<br>
			<?php } ?>		
				</div>
			</div>
		<?php

			include ('../right.php');

		include ('../footer.php');

	?>
    </div>
</body>
</html>