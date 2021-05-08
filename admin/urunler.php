<?php
session_start();
if(!isset($_SESSION["login"])){
	header("location:login.php");
}
?>
<? $index="5" ?>
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
				<h1 class="page-header">Ürünler</h1>
			</div>
		</div><!--/.row-->
		
<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
					<a href="urun-ekle.php"><button type="submit" class="btn btn-success">Ürün Ekle +</button></a><br><br>
                        <div style="overflow-x:auto;">
                            <table>
                                <tr>
                                    <th>Ürün:</th>
                                    <th>Sunucu:</th>
                                    <th>Resim URL:</th>
                                    <th><center>Fiyat:</center></th>
                                    <th><center>#</center></th>
                                </tr>
								<?php
								$urunler_cek = $db->query("SELECT * FROM Urunler ORDER BY id DESC");
								$urunler_cek->execute();		
								if($urunler_cek->rowCount() != 0){
									
									foreach ($urunler_cek as $urunler_oku) {

								?>
                                <tr>
                                    <td><?php echo $urunler_oku['urun'] ?></td>
                                    <td><?php echo $urunler_oku['sunucu'] ?></td>
                                    <td><?php echo $urunler_oku['resim_url'] ?></td>
                                    <td><center><?php echo $urunler_oku['fiyat'] ?></center></td>
                                    <td><center><a href="urun-duzenle.php?id=<? echo $urunler_oku["id"] ?>"><button type="submit" class="btn btn-success">Düzenle</button></a></form></center></td>
                                </tr>
								<?php
								}
								}else{
								echo '<div class="alert bg-danger" role="alert">
					<svg class="glyph stroked cancel"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-cancel"></use></svg> Hiç ürün eklenmemiş yazı eklemek için "Ürün Ekle +" butonuna tıkla! <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>';
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
