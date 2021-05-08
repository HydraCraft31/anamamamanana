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
				<h1 class="page-header">Sunucu Düzenle</h1>
			</div>
		</div><!--/.row-->
		
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
			<?php
			
			$sunucu_link=permayap($_POST["sunucu"]);
			$sunucu=$_POST["sunucu"];
			$port=$_POST["port"];
			$sunucu_resim=$_POST["resim"];
			$sunucu_sifre=$_POST["sifre"];
			$ip=$_POST["ip"];
			$sunucu_duzenle = $db->prepare("SELECT * FROM Sunucular WHERE id = ?");
			$sunucu_duzenle->execute(array($_GET['id']));
			$sunucu_oku = $sunucu_duzenle->fetch();
			
			if(isset($_POST['sunucu-duzenle'])){
				$sunucu_query = $db->prepare("UPDATE Sunucular SET sunucu_link = ?, sunucu = ?, port = ?, sunucu_resim = ?, ip = ?, sunucu_sifre = ? WHERE id = ?");
				$update = $sunucu_query->execute(array($sunucu_link,$sunucu,$port,$sunucu_resim,$ip,$sunucu_sifre,$_GET['id']));
				echo '<div class="alert bg-success" role="alert"><svg class="glyph stroked checkmark"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-checkmark"></use></svg> Sunucu başarıyla düzenlendi! <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>';
				echo '<meta http-equiv="refresh" content="3;URL=sunucular.php">';
			}
			
			if(isset($_POST['sunucu-sil'])){
				$query = $db->prepare("DELETE FROM Sunucular WHERE id = :id");
				$delete = $query->execute(array(
					 "id" => $_GET['id']
				));
				echo '<div class="alert bg-success" role="alert"><svg class="glyph stroked checkmark"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-checkmark"></use></svg> Sunucu başarıyla silindi! <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>';
				echo '<meta http-equiv="refresh" content="3;URL=sunucular.php">';
			}
				
				
			?>
                    <div style="overflow-x:auto;">
						<form action="" method="post">
                            <table class="ekle">
                                <tr>
                                    <td>Sunucu İsmi:</td>
                                    <td><input required name="sunucu" type="text" class="form-control" value="<? echo $sunucu_oku["sunucu"] ?>"></td>
                                </tr>
                                <tr>
                                    <td>WebSend Sayısal IP</td>
                                    <td><input required name="ip" type="text" class="form-control" value="<? echo $sunucu_oku["ip"] ?>"></td>
                                </tr>
                                <tr>
                                    <td>WebSend Port:</td>
                                    <td><input required name="port" type="text" class="form-control" value="<? echo $sunucu_oku["port"] ?>"></td>
                                </tr>
                                <tr>
                                    <td>WebSend Şifre:</td>
                                    <td><input required name="sifre" type="text" class="form-control" value="<? echo $sunucu_oku["sunucu_sifre"] ?>"></td>
                                </tr>
                                <tr>
                                    <td>Sunucu Resim URL:</td>
                                    <td><input required name="resim" placeholder="http://resim.com/1.jpg" type="text" class="form-control" value="<? echo $sunucu_oku["sunucu_resim"] ?>"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><button name="sunucu-duzenle" type="submit" style="float: right; width: 100px; margin-left: 5px;" class="btn btn-success">Kaydet</button><button name="sunucu-sil" type="submit" style="float: right; width: 100px;" onclick="return confirm('Silmek istediğinize emin misiniz?')" class="btn btn-danger">Sil</button></td>
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
