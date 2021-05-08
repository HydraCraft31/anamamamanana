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
				<h1 class="page-header">Ürün Düzenle</h1>
			</div>
		</div><!--/.row-->
		
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
			<?php

			$urun=$_POST["urun"];
			$sunucu_link=permayap($_POST["sunucu"]);
			$sunucu=$_POST["sunucu"];
			$resim_url=$_POST["resim_url"];
			$fiyat=$_POST["fiyat"];	
			$komut=$_POST["komut"];
			$kategori_link=permayap($_POST["kategori"]);
			$kategori=$_POST["kategori"];
			$detay=$_POST["detay"];	
			$urun_duzenle = $db->prepare("SELECT * FROM Urunler WHERE id = ?");
			$urun_duzenle->execute(array($_GET['id']));
			$urun_oku = $urun_duzenle->fetch();
			
			if(isset($_POST['urun-duzenle'])){
				$urun_query = $db->prepare("UPDATE Urunler SET urun = ?, sunucu = ?, sunucu_link = ?, fiyat = ?, resim_url = ?, komut = ?, detay = ?, kategori = ?, kategori_link = ? WHERE id = ?");
				$update = $urun_query->execute(array($urun,$sunucu,$sunucu_link,$fiyat,$resim_url,$komut,$detay,$kategori,$kategori_link,$_GET['id']));
				echo '<div class="alert bg-success" role="alert"><svg class="glyph stroked checkmark"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-checkmark"></use></svg> Ürün başarıyla düzenlendi! <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>';
				echo '<meta http-equiv="refresh" content="3;URL=urunler.php">';
			}
			
			if(isset($_POST['urun-sil'])){
				$query = $db->prepare("DELETE FROM Urunler WHERE id = :id");
				$delete = $query->execute(array(
					 "id" => $_GET['id']
				));
				echo '<div class="alert bg-success" role="alert"><svg class="glyph stroked checkmark"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-checkmark"></use></svg> Ürün başarıyla silindi! <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>';
				echo '<meta http-equiv="refresh" content="3;URL=urunler.php">';
			}
				
			?>
			<p><strong>NOT : </strong>Komut girerken başına '/' koymayın!</p>
			<p><strong>NOT : </strong>Komutda oyuncu ismi yazdırmak için %player% yazın.</p>
                    <div style="overflow-x:auto;">
						<form action="" method="post">
                            <table class="ekle">
                                <tr>
                                    <td>Ürün İsmi:</td>
                                    <td><input required name="urun" type="text" class="form-control" value="<? echo $urun_oku["urun"] ?>"></td>
                                </tr>
                                <tr>
                                <tr>
                                    <td>Ürün Fiyatı:</td>
                                    <td><input required name="fiyat" placeholder="http://resim.com/1.jpg" type="text" class="form-control" value="<? echo $urun_oku["fiyat"] ?>"></td>
                                </tr>
                                    <td>Ürünün Ait Olduğu Sunucu:</td>
									<td><select class="form-control" name="sunucu">
										<option name="sunucu" value="<?php echo $urun_oku["sunucu"] ?>"><?php echo $urun_oku["sunucu"] ?></option>
										<?php
										
										$sunucu_cek = $db->query("SELECT * FROM Sunucular ORDER BY id DESC");
										$sunucu_cek->execute();		
										if($sunucu_cek->rowCount() != 0){
											
											foreach ($sunucu_cek as $sunucu_oku) {
												
												if($urun_oku["sunucu"] != $sunucu_oku["sunucu"]){
												
										?>

										<option name="sunucu" value="<?php echo $sunucu_oku['sunucu'] ?>"><?php echo $sunucu_oku['sunucu'] ?></option>
										<?php
										}
										}
										}else{
										echo '<option>Sunucu Yok!</option>';
										}
										?>
									</select></td>
                                </tr>
                                </tr>
                                    <td>Ürün Kategori:</td>
									<td><select class="form-control" name="kategori">
										<option name="kategori" value="<?php echo $urun_oku["kategori"] ?>"><?php echo $urun_oku["kategori"] ?></option>
										<?php
										
										$kategori_cek = $db->query("SELECT * FROM Urun_Kategori ORDER BY id DESC");
										$kategori_cek->execute();		
										if($kategori_cek->rowCount() != 0){
											
											foreach ($kategori_cek as $kategori_oku) {
												
												if($urun_oku["kategori"] != $kategori_oku["kategori"]){
												
										?>

										<option name="kategori" value="<?php echo $kategori_oku['kategori'] ?>"><?php echo $kategori_oku['kategori'] ?></option>
										<?php
										}
										}
										}
										?>
									</select></td>
                                </tr>                                
                                <tr>
                                    <td>Ürün Detay:</td>
									<td><select class="form-control" name="detay">
										<option name="detay" value="<? echo $urun_oku["detay"] ?>"><? if($urun_oku["detay"] == 0){echo "Özel Üyelik";}else{echo "Diğer Ürünler";} ?></option>
										<option name="detay" value="<?php if($urun_oku["detay"] == 0){echo "1";} if($urun_oku["detay"] == 1){echo "0";} ?>"><?php if($urun_oku["detay"] == 0){echo "Diğer Ürünler";} if($urun_oku["detay"] == 1){echo "Özel Üyelik";} ?></option>
									</select></td>
                                </tr>
                                <tr>
                                    <td>Ürün Resim URL:</td>
                                    <td><input required name="resim_url" type="text" class="form-control" value="<? echo $urun_oku["resim_url"] ?>"></td>
                                </tr>
                                <tr>
                                    <td>Ürün Komut:</td>
                                    <td><input required name="komut" type="text" class="form-control" value="<? echo $urun_oku["komut"] ?>"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><button name="urun-duzenle" type="submit" style="float: right; width: 100px; margin-left: 5px;" class="btn btn-success">Kaydet</button> <button name="urun-sil" type="submit" style="float: right; width: 100px;" onclick="return confirm('Silmek istediğinize emin misiniz?')" class="btn btn-danger">Sil</button></td>
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
