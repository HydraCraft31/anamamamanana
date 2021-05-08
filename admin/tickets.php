<?php
session_start();
if(!isset($_SESSION["login"])){
	header("location:login.php");
}
?>
<? $index="4" ?>
<? include("./ayar/ayar.php"); ?>
	<? include("head.php"); ?>
<body>
	<? include("header.php"); ?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Destek Talepleri</h1>
			</div>
		</div><!--/.row-->
		
<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
                        <div style="overflow-x:auto;">
                            <table>
                                <tr>
                                    <th>Tarih:</th>
                                    <th>Başlık:</th>
                                    <th>Kategori:</th>
                                    <th>Kullanıcı Adı:</th>
                                    <th><center>Durum:</center></th>
                                    <th><center>#<center></th>
                                </tr>
								<?php
								$tickets_cek = $db->query("SELECT * FROM tickets ORDER BY son_guncelleme DESC");
								$tickets_cek->execute();		
								if($tickets_cek->rowCount() != 0){
									
									foreach ($tickets_cek as $tickets_oku) {


			                        $saat= substr($tickets_oku['son_guncelleme'], 8, 2);
			                        $dk= substr($tickets_oku['son_guncelleme'], 10, 2);
			                        $gun= substr($tickets_oku['son_guncelleme'], 6, 2);
			                        $ay= substr($tickets_oku['son_guncelleme'], 4, 2);
			                        $yil= substr($tickets_oku['son_guncelleme'], 0, 4);

								?>
								
                                <tr>
                                    <td><?php echo ''.$gun.'.'.$ay.'.'.$yil.' '.$saat.':'.$dk.'' ?></td>
                                    <td><?php echo $tickets_oku['baslik'] ?></td>
                                    <td><?php echo $tickets_oku['kategori'] ?></td>
                                    <td><?php echo $tickets_oku['nick'] ?></td>
									<?php 
									if ($tickets_oku['durum'] == '0'){
									echo '<td><center><strong>Açık</strong></center></td>';
									}
									if ($tickets_oku['durum'] == '1'){
									echo '<td><center><strong>Yanıtlandı</strong></center></td>';
									}
									if ($tickets_oku['durum'] == '2'){
									echo '<td><center><strong>Kullanıcı Yanıtı</strong></center></td>';
									}
									if ($tickets_oku['durum'] == '3'){
									echo '<td><center><strong>Kapatıldı</strong></center></td>';
									}
									?>
                                    <td><center><a href="ticket-cevapla.php?id=<? echo $tickets_oku["id"] ?>"><button type="submit" class="btn btn-success">Cevapla</button></a></form></center></td>
                                </tr>

                            
								<?php
								}
								}else{
								echo '<div class="alert bg-danger" role="alert">
					<svg class="glyph stroked cancel"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-cancel"></use></svg> Hiç ticket bulunamadı! <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>';
								}
								?>
								</table>
                        </div>
					</div>
					</div>
				</div>
			</div>
	
		</div>
		</div>
	</div><!--/.row-->
</div>	<!--/.main-->

<? include("son.php"); ?>	
</body>

</html>
