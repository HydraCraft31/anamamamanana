<?php
session_start();
if(!isset($_SESSION["login"])){
	header("location:login.php");
}
?>
<? $index="7" ?>
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
				<h1 class="page-header">Kredi Alanlar</h1>
			</div>
		</div><!--/.row-->
		
<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
                        <div style="overflow-x:auto;">
                            <table>
                                <tr>
                                    <th>Kullanıcı Adı:</th>
                                    <th>Tarih:</th>
                                    <th>Miktar:</th>
                                    <th>Metod:</th>
                                </tr>
								<?php
								$kredi_cek = $db->query("SELECT * FROM Kredi ORDER BY id DESC");
								$kredi_cek->execute();		
								if($kredi_cek->rowCount() != 0){
									
									foreach ($kredi_cek as $kredi_oku) {

								?>
                                <tr>
                                    <td><?php echo $kredi_oku['nick'] ?></td>
                                    <td><?php echo $kredi_oku['tarih'] ?></td>
                                    <td><?php echo $kredi_oku['miktar'] ?></td>
                                    <td><?php echo $kredi_oku['metod'] ?></td>
                                </tr>
								<?php
								}
								}else{
								echo '<div class="alert bg-danger" role="alert">
					<svg class="glyph stroked cancel"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-cancel"></use></svg> Henüz kimse kredi satın almamış! <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>';
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
