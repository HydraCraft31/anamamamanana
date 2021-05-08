<?php
session_start();
if(!isset($_SESSION["login"])){
	header("location:login.php");
}
?>
<? $index="2" ?>
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
				<h1 class="page-header">Sunucular</h1>
			</div>
		</div><!--/.row-->
		
<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
					<a href="sunucu-ekle.php"><button type="submit" class="btn btn-success">Sunucu Ekle +</button></a><br><br>
                        <div style="overflow-x:auto;">
                            <table>
                                <tr>
                                    <th>Sunucu:</th>
                                    <th>Web Send Port:</th>
                                    <th><center>#</center></th>
                                </tr>
								<?php
								$sunucu_cek = $db->query("SELECT * FROM Sunucular ORDER BY id DESC");
								$sunucu_cek->execute();		
								if($sunucu_cek->rowCount() != 0){
									
									foreach ($sunucu_cek as $sunucu_oku) {

								?>
                                <tr>
                                    <td><?php echo $sunucu_oku['sunucu'] ?></td>
                                    <td><?php echo $sunucu_oku['port'] ?></td>
                                    <td><center><a href="sunucu-duzenle.php?id=<? echo $sunucu_oku["id"] ?>"><button type="submit" class="btn btn-success">Düzenle</button></a></form></center></td>
                                </tr>
								<?php
								}
								}else{
								echo '<div class="alert bg-danger" role="alert">
					<svg class="glyph stroked cancel"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-cancel"></use></svg> Hiç sunucu eklenmemiş yazı eklemek için "Yazı Ekle +" butonuna tıkla! <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>';
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
