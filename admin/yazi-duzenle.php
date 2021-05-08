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
	<script src="//cdn.ckeditor.com/4.7.0/full/ckeditor.js"></script>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Yazı Düzenle</h1>
			</div>
		</div><!--/.row-->
		
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
			<?php
			
			$baslik=$_POST["baslik"];
			$yazar=$_POST["yazar"];
			$yazi=$_POST["icerik"];
			$resim=$_POST["resim"];
			$kategori=$_POST["kategori"];
			$yazi_duzenle = $db->prepare("SELECT * FROM yazilar WHERE id = ?");
			$yazi_duzenle->execute(array($_GET['id']));
			$oku = $yazi_duzenle->fetch();
			
			if(isset($_POST['yazi-duzenle'])){
				$yazi_query = $db->prepare("UPDATE yazilar SET baslik = ?, yazar = ?, yazi = ?, resim = ?, kategori = ? WHERE id = ?");
				$update = $yazi_query->execute(array($baslik,$yazar,$yazi,$resim,$kategori,$_GET['id']));
				echo '<div class="alert bg-success" role="alert"><svg class="glyph stroked checkmark"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-checkmark"></use></svg> Duyuru yazısı başarıyla düzenlendi! <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>';
				echo '<meta http-equiv="refresh" content="3;URL=yazilar.php">';
			}
			
			if(isset($_POST['yazi-sil'])){
				$query = $db->prepare("DELETE FROM yazilar WHERE id = :id");
				$delete = $query->execute(array(
					 "id" => $_GET['id']
				));
				echo '<div class="alert bg-success" role="alert"><svg class="glyph stroked checkmark"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-checkmark"></use></svg> Duyuru yazısı başarıyla silindi! <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>';
				echo '<meta http-equiv="refresh" content="3;URL=yazilar.php">';
			}
				
				
			?>
                    <div style="overflow-x:auto;">
						<form action="" method="post">
                            <table class="ekle">
                                <tr>
                                    <td>Başlık:</td>
                                    <td><input required name="baslik" type="text" class="form-control" value="<? echo $oku["baslik"] ?>"></td>
                                </tr>
                                <tr>
                                    <td>Kategori:</td>
                                    <td><select required name="kategori" class="form-control" value="<? echo $oku["kategori"] ?>">
    										<option value="Duyuru">Duyuru</option>
    										<option value="Bilgi">Bilgi</option>
    										<option value="Uyarı">Uyarı</option>
    										<option value="Güncelleme">Güncelleme</option>
  									</select></td>
                                </tr>
                                <tr>
                                    <td>Yazar:</td>
                                    <td><input required name="yazar" type="text" class="form-control" value="<? echo $oku["yazar"] ?>"></td>
                                </tr>
                                <tr>
                                    <td>Resim URL:</td>
                                    <td><input required name="resim" placeholder="http://resim.com/1.jpg" type="text" class="form-control" value="<? echo $oku["resim"] ?>"></td>
                                </tr>
                                <tr>
                                    <td>İçerik:</td>
                                    <td><textarea required name="icerik" rows="5" type="text" class="form-control"><? echo $oku["yazi"] ?></textarea>        								
                                    	<script>
            								CKEDITOR.replace( 'icerik' );
        								</script></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><button name="yazi-duzenle" type="submit" style="float: right; width: 100px; margin-left: 5px;" class="btn btn-success">Kaydet</button><button name="yazi-sil" type="submit" style="float: right; width: 100px;" onclick="return confirm('Silmek istediğinize emin misiniz?')" class="btn btn-danger">Sil</button></td>
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
