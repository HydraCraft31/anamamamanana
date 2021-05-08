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
            <div class="icBaslik"><div class="icBaslikYazi"><i class="fa fa-life-ring fa-3x"></i><font size="6"> DESTEK</font></div></div>
            <div class="ic">
                <br>
                <a href="../destek/olustur/"><button style="margin-left: 18px;" class="button-example-1 button-example-green"><font face="Roboto Condensed" size="4">Yeni Destek Bildirimi Oluştur +</font></button></a>
                <br>
                <br>
                <center>
                    <style type="text/css">
                        .tgDestek {
                            border-collapse: collapse;
                            border-spacing: 0;
                            border-color: #ccc;
                        }

                            .tgDestek td {
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

                            .tgDestek th {
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

                            .tgDestek .tg-baqh {
                                text-align: center;
                                vertical-align: top;
                            }

                            .tgDestek .tg-qgsu {
                                font-size: 15px;
                                vertical-align: top;
                            }

                            .tgDestek .tg-f4we {
                                font-weight: bold;
                                font-size: 15px;
                                font-family: Arial, Helvetica, sans-serif !important;
                                ;
                                text-align: center;
                                vertical-align: top;
                            }

                            .tgDestek .tg-ygzf {
                                font-weight: bold;
                                font-size: 15px;
                                text-align: center;
                                vertical-align: top;
                            }

                            .tgDestek .tg-yw4l {
                                vertical-align: top;
                            }

                            .tgDestek .tg-e9v8 {
                                font-size: 15px;
                                text-align: center;
                                vertical-align: top;
                                padding-top: 18px;
                            }
							.tgDestek td .success a{float: left;margin-right: 10px; margin-left: 34px;background-color: #2eb82e; color: #fff;}
							.tgDestek td .success a:hover{background-color: #248f24;}
							
							.tgDestek td .error a{float: left;background-color: red; color: #fff;}
							.tgDestek td .error a:hover{background-color: #cc0000;}
                    </style>
					<div style="overflow-x:auto;">
                    <table class="tgDestek" style="table-layout: fixed; width: 98%;">
                        <colgroup>
                            <col style="width: 20%">
                            <col style="width: 28%">
                            <col style="width: 18%">
                            <col style="width: 16%">
                            <col style="width: 18%">
                        </colgroup>
                        <tr>
                            <th class="tg-f4we"><i class="fa fa-calendar"></i> Tarih</th>
                            <th class="tg-f4we"><i class="fa fa-bullhorn"></i> Başlık</th>
                            <th class="tg-f4we"><i class="fa fa-th-large"></i> Kategori</th>
                            <th class="tg-f4we"><i class="fa fa-eye"></i> Durum</th>
                            <th class="tg-f4we">İşlemler</th>
                        </tr>
                    </table>
					<?php

					$ticket_ogren = $db->prepare("SELECT * FROM tickets WHERE nick = ? ORDER BY son_guncelleme DESC LIMIT 10");
					$ticket_ogren->execute(array($oyuncu_oku["username"]));		
						if($ticket_ogren->rowCount() != 0){

							foreach ($ticket_ogren as $ticket_cek) {

                        $saat= substr($ticket_cek['son_guncelleme'], 8, 2);
                        $dk= substr($ticket_cek['son_guncelleme'], 10, 2);
                        $gun= substr($ticket_cek['son_guncelleme'], 6, 2);
                        $ay= substr($ticket_cek['son_guncelleme'], 4, 2);
                        $yil= substr($ticket_cek['son_guncelleme'], 0, 4);

					?>
                        <table class="tgDestek" style="table-layout: fixed; width: 98%;">

                        <colgroup>
                            <col style="width: 20%">
                            <col style="width: 28%">
                            <col style="width: 18%">
                            <col style="width: 16%">
                            <col style="width: 18%">
                        </colgroup>
                            <tr>
								<td class="tg-liste"><center><strong><?php echo ''.$gun.'.'.$ay.'.'.$yil.' '.$saat.':'.$dk.'' ?></strong></center> </td>
								<td class="tg-liste"><center><strong><?php echo $ticket_cek['baslik'] ?></strong></center></td>
								<td class="tg-liste"><center><strong><?php echo $ticket_cek['kategori'] ?></strong></center></td>
								<?php 
								if ($ticket_cek['durum'] == '0'){
								echo '<td class="tg-liste"><center><strong><a style="background-color: red; padding: 6px; color: #fff; border: 0px solid; border-radius: 5px;">Cevaplanmadı</a></strong></center></td>';
								}
								if ($ticket_cek['durum'] == '1'){
								echo '<td class="tg-liste"><center><strong><a style="background-color: #2eb82e; padding: 6px; color: #fff; border: 0px solid; border-radius: 5px;">Yanıtlandı</a></strong></center></td>';
								}
                                if ($ticket_cek['durum'] == '2'){
                                echo '<td class="tg-liste"><center><strong><a style="background-color: #F3B80A; padding: 6px; color: #fff; border: 0px solid; border-radius: 5px;">Kullanıcı Yanıtı</a></strong></center></td>';
                                }
                                if ($ticket_cek['durum'] == '3'){
                                echo '<td class="tg-liste"><center><strong><a style="background-color: red; padding: 6px; color: #fff; border: 0px solid; border-radius: 5px;">Kapatıldı</a></strong></center></td>';
                                }
								?>

								<td class="tg-liste"><center><font size="4"><div class="success"><a style="padding: 5px; border: 0px solid; border-radius: 5px;" href="<?php echo "../destek/goruntule/".$ticket_cek['id']."/"; ?>"><i class="fa fa-eye"></i></a></div><div class="error"><a style="padding: 5px; padding-right: 7px; padding-left: 7px; border: 0px solid; border-radius: 5px;"" href="<?php echo "../destek/sil/".$ticket_cek['id']."/"; ?>"><i onclick="return confirm('Silmek istediğinize emin misiniz?')" class="fa fa-times"></i></a></div></center></td>
								</tr>
                        </table>
						<?php
						}
						}else{
						echo"<div style='width: 98%; padding-top: 20px; padding-bottom: 20px;' class='flag note note--error'><center>Daha önce hiç destek bildirimi oluşturmamışsınız!</center></div>";
						}
						?>
                </center>
                <br />
			</div>
		</div>
		<?php

			include ('../right.php');

		include ('../footer.php');
		
	?>
    </div>
</body>
</html>
