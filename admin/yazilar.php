<?php
session_start();
if(!isset($_SESSION["login"])){
	header("location:login.php");
}
?>
<? $index="1" ?>
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
				<h1 class="page-header">Yazılar</h1>
			</div>
		</div><!--/.row-->
		
<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
					<a href="yazi-ekle.php"><button type="submit" class="btn btn-success">Yazı Ekle +</button></a><br><br>
                        <div style="overflow-x:auto;">
                            <table>
                                <tr>
                                    <th>Tarih:</th>
                                    <th>Başlık:</th>
                                    <th>Yazar:</th>
                                    <th><center>#</center></th>
                                </tr>
								<?php
								$yazilar_cek = $db->query("SELECT * FROM yazilar ORDER BY id DESC");
								$yazilar_cek->execute();		
								if($yazilar_cek->rowCount() != 0){
									
									foreach ($yazilar_cek as $yazilar_oku) {

								?>
                                <tr>
                                    <td><?php echo $yazilar_oku['tarih'] ?></td>
                                    <td><?php echo $yazilar_oku['baslik'] ?></td>
                                    <td><?php echo $yazilar_oku['yazar'] ?></td>
                                    <td><center><a href="yazi-duzenle.php?id=<? echo $yazilar_oku["id"] ?>"><button type="submit" class="btn btn-success">Düzenle</button></a></form></center></td>
                                </tr>
								<?php
								}
								}else{
								echo '<div class="alert bg-danger" role="alert">
					<svg class="glyph stroked cancel"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-cancel"></use></svg> Hiç yazı eklenmemiş yazı eklemek için "Yazı Ekle +" butonuna tıkla! <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>';
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
