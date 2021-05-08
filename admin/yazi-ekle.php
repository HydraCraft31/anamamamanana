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
				<h1 class="page-header">Yazı Ekle</h1>
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
			$tarih = date('H:i - d.m.Y');
			
			if(isset($_POST['yazi-ekle'])){
				$tabloya_ekle = $db->prepare("INSERT INTO yazilar (yazar,baslik,resim,yazi,tarih,kategori) VALUES(?,?,?,?,?,?)");
				$tabloya_ekle->execute(array($yazar,$baslik,$resim,$yazi,$tarih,$kategori));
					echo '<div class="alert bg-success" role="alert"><svg class="glyph stroked checkmark"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-checkmark"></use></svg> Duyuru yazısı başarıyla eklenmiştir! <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>';
					echo '<meta http-equiv="refresh" content="3;URL=yazilar.php">';
			}
				
			?>
                    <div style="overflow-x:auto;">
						<form action="" method="post">
                            <table class="ekle">
                                <tr>
                                    <td>Başlık:</td>
                                    <td><input required name="baslik" type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Kategori:</td>
                                    <td><select required name="kategori" class="form-control">
    										<option value="Duyuru">Duyuru</option>
    										<option value="Bilgi">Bilgi</option>
    										<option value="Uyarı">Uyarı</option>
    										<option value="Güncelleme">Güncelleme</option>
  									</select></td>
                                </tr>
                                <tr>
                                    <td>Yazar:</td>
                                    <td><input required name="yazar" type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Resim URL:</td>
                                    <td><input required name="resim" placeholder="http://resim.com/1.jpg" type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>İçerik:</td>
                                    <td>
        								<textarea required name='icerik' rows="5" type="text" class="form-control"></textarea>                                        
        								<script>
            								CKEDITOR.replace( 'icerik' );
        								</script></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><button name="yazi-ekle" type="submit" style="float: right; width: 100px;" class="btn btn-success">Ekle</button></td>
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
