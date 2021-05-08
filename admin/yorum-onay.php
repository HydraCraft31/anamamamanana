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
				<h1 class="page-header">Yorum Onayla/Sil</h1>
			</div>
		</div><!--/.row-->
		
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
			<?php

			$durum_onay = "1";
			$yorum_cek = $db->prepare("SELECT * FROM yorumlar WHERE id = ?");
			$yorum_cek->execute(array($_GET['id']));
			$yorum_oku = $yorum_cek->fetch();
			
			if(isset($_POST['yorum-onayla'])){
				$urun_query = $db->prepare("UPDATE yorumlar SET durum = ? WHERE id = ?");
				$update = $urun_query->execute(array($durum_onay,$_GET['id']));
				echo '<div class="alert bg-success" role="alert"><svg class="glyph stroked checkmark"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-checkmark"></use></svg> Yorum başarıyla onaylandı! <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>';
				echo '<meta http-equiv="refresh" content="3;URL=yorumlar.php">';
			}
			
			if(isset($_POST['yorum-sil'])){
				$query = $db->prepare("DELETE FROM yorumlar WHERE id = :id");
				$delete = $query->execute(array(
					 "id" => $_GET['id']
				));
				echo '<div class="alert bg-success" role="alert"><svg class="glyph stroked checkmark"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-checkmark"></use></svg> Yorum başarıyla silindi! <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>';
				echo '<meta http-equiv="refresh" content="3;URL=yorumlar.php">';
			}
				
			?>
                    <div style="overflow-x:auto;">
						<form action="" method="post">
                            <table class="ekle">
                                <tr>
                                    <td>Tarih:</td>
                                    <td><? echo $yorum_oku["yorum_tarih"] ?></td>
                                </tr>
                                <tr>
                                    <td>Yorum Yazan:</td>
                                    <td><? echo $yorum_oku["yorum_yazan"] ?></td>
                                </tr>
                                <tr>
                                    <td>Yorum:</td>
                                    <td><? echo $yorum_oku["yorum"] ?></td>
                                </tr>
                                <tr>
                                    <td>Durum:</td>
                                    <td><?php if($yorum_oku['durum'] == "1"){ echo "Onaylandı"; } else { echo "Onay Bekliyor.."; } ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><button name="yorum-onayla" type="submit" style="float: right; width: 100px; margin-left: 5px;" class="btn btn-success">Onayla</button> <button name="yorum-sil" type="submit" style="float: right; width: 100px;" class="btn btn-danger">Sil</button></td>
                                </tr>
							</table>
							<input type="hidden" name="token" value="<? echo $_SESSION['token'] ?>" />
							</form>	
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
