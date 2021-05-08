<?php
	include ('../ayarlar/ayar.php');

	$oyuncu_ara = $db->prepare("SELECT * FROM authme WHERE username = ?");
	$oyuncu_ara->execute(array($_GET["oyuncu_yola"]));
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
	<?php
    $oyuncu_varmi = "SELECT COUNT(username) AS num FROM authme WHERE username = :username";
    $stmt = $db->prepare($oyuncu_varmi);
	$stmt->bindValue(':username', $_GET["oyuncu_yola"]);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($_GET["oyuncu_yola"] == NULL){
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
                        <strong>'.$_GET['oyuncu_yola'].'</strong> adında kayıtlı kullanıcı bulunamadı!
                    </div>
                </div>
		';
	} else 
	{
		?>
                    <table class="tgProfil" style="table-layout: fixed; width: 100%;">
                        <colgroup>
                            <col style="width: 30%">
                            <col style="width: 40%">
                            <col style="width: 30%">
                        </colgroup>
                        <tr>
                            <th class="tg-3we0">
                                <center>
                                    <img width='135' height='260' src="https://mcapi.ca/skin/2d/<?php echo $_GET["oyuncu_yola"] ?>">
                                </center>
                            </th>
                            <th class="tg-3we0">
                                <center>
                                    <font face="Roboto Condensed" size="3">
                                        <strong>Kullanıcı Adı: </strong><?php echo $_GET["oyuncu_yola"] ?>
                                        <br><strong>Mevcut Kredisi: </strong><?php if($aranan_oku["kredi"] == NULL){echo "0"; }else{ echo $aranan_oku["kredi"]; }?>
                                        <br><strong>Kayıt Tarihi: </strong><?php if($aranan_oku["tarih"] == NULL){echo "Bilinmiyor!"; }else{ echo $aranan_oku["tarih"]; }?>
                                        <br><strong>Skype: </strong><?php if($aranan_oku["skype"] == NULL){echo "Bilinmiyor!"; }else{ echo $aranan_oku["skype"]; }?>
                                        <br><strong>Facebook: </strong><?php if($aranan_oku["facebook"] == NULL){echo "Bilinmiyor!"; }else{ echo $aranan_oku["facebook"]; }?>
                                        <br><strong>Steam: </strong><?php if($aranan_oku["steam"] == NULL){echo "Bilinmiyor!"; }else{ echo $aranan_oku["steam"]; }?>
                                        <br><strong>Sevdiği Oyun: </strong><?php if($aranan_oku["oyun"] == NULL){echo "Bilinmiyor!"; }else{ echo $aranan_oku["oyun"]; }?>
                                        <br>
										</center>
                            </th>
                            <th class="tg-3we0">
                                <center>
                                    <img width='135' height='260' src="https://mcapi.ca/skin/2d/<?php echo $_GET["oyuncu_yola"] ?>">
                                </center>
                            </th>
                        </tr>
                    </table>
					<br>
				<? } ?>
				</div>
			</div>
		<?php

			include ('../right.php');

		include ('../footer.php');

	?>
    </div>
</body>
</html>