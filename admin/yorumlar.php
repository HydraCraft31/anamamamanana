<?php
session_start();
if(!isset($_SESSION["login"])){
	header("location:login.php");
}
?>
<? $index="3" ?>
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
				<h1 class="page-header">Yorumlar</h1>
			</div>
		</div><!--/.row-->
		
<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
                        <div style="overflow-x:auto;">
                            <table>
                                <tr>
                                    <th>Tarih:</th>
                                    <th>Yorum Atan:</th>
                                    <th>Durum:</th>
                                    <th><center>#</center></th>
                                </tr>
								<?php
								$yorum_cek = $db->query("SELECT * FROM yorumlar ORDER BY id DESC");
								$yorum_cek->execute();		
								if($yorum_cek->rowCount() != 0){
									
									foreach ($yorum_cek as $yorum_oku) {

								?>
                                <tr>
                                    <td><?php echo $yorum_oku['yorum_tarih'] ?></td>
                                    <td><?php echo $yorum_oku['yorum_yazan'] ?></td>
                                    <td><?php if($yorum_oku['durum'] == "1"){ echo "Onaylandı"; } else { echo "Onay Bekliyor.."; } ?></td>
                                    <td><center><a href="yorum-onay.php?id=<? echo $yorum_oku["id"] ?>"><button type="submit" class="btn btn-success">Onayla/Sil</button></a></form></center></td>
                                </tr>
								<?php
								}
								}else{
								echo '<div class="alert bg-danger" role="alert">
					<svg class="glyph stroked cancel"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-cancel"></use></svg> Hiç yorum atılmış bir yazı yok! <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>';
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
