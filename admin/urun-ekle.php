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
				<h1 class="page-header">Ürün Ekle</h1>
			</div>
		</div><!--/.row-->
		
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
			<?php
			
			$urun=$_POST["urun"];
			$sunucu_link=permayap($_POST["sunucu"]);
			$sunucu=$_POST["sunucu"];
			$fiyat=$_POST["fiyat"];
			$resim=$_POST["resim"];	
			$komut=$_POST["komut"];
			$detay=$_POST["detay"];
			$kategori_link=permayap($_POST["kategori"]);
			$kategori=$_POST["kategori"];
			
			if(isset($_POST['urun-ekle'])){
				$tabloya_ekle = $db->prepare("INSERT INTO Urunler (urun,sunucu,sunucu_link,fiyat,resim_url,komut,kategori,kategori_link,detay) VALUES(?,?,?,?,?,?,?,?,?)");
				$tabloya_ekle->execute(array($urun,$sunucu,$sunucu_link,$fiyat,$resim,$komut,$kategori,$kategori_link,$detay));
					echo '<div class="alert bg-success" role="alert"><svg class="glyph stroked checkmark"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-checkmark"></use></svg> Ürün başarıyla eklenmiştir! <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>';
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
                                    <td><input required name="urun" type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Ürün Fiyatı:</td>
                                    <td><input required name="fiyat" type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Ürünün Ait Olduğu Sunucu:</td>
									<td><select class="form-control" name="sunucu">
										<?php
										$sunucu_cek = $db->query("SELECT * FROM Sunucular ORDER BY id DESC");
										$sunucu_cek->execute();		
										if($sunucu_cek->rowCount() != 0){
											
											foreach ($sunucu_cek as $sunucu_oku) {

										?>
										<option name="sunucu" value="<?php echo $sunucu_oku['sunucu'] ?>"><?php echo $sunucu_oku['sunucu'] ?></option>
										<?php
										}
										}else{
										echo '<option>Sunucu Yok!</option>';
										}
										?>
									</select></td>
                                </tr>
                                <tr>
                                    <td>Ürün Kategori:</td>
									<td><select class="form-control" name="kategori">
										<?php
										$kategori_cek = $db->query("SELECT * FROM Urun_Kategori ORDER BY id DESC");
										$kategori_cek->execute();		
										if($kategori_cek->rowCount() != 0){
											
											foreach ($kategori_cek as $kategori_oku) {

										?>
										<option name="kategori" value="0">BOŞ (Zorunlu Değil!)</option>
										<option name="kategori" value="<?php echo $kategori_oku['kategori'] ?>"><?php echo $kategori_oku['kategori'] ?></option>
										<?php
										}
										}
										?>
									</select></td>
                                </tr>
                                <tr>
                                    <td>Ürün Detay:</td>
									<td><select name="detay" class="form-control">
										<option name="detay" value="0">Özel Üyelik</option>
										<option name="detay" value="1">Diğer Ürünler</option>
									</select></td>
                                </tr>
                                <tr>
                                    <td>Ürün Resim URL:</td>
                                    <td><input required name="resim" placeholder="http://resim.com/1.jpg" type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Ürün Komut:</td>
                                    <td><input required name="komut" placeholder="Ürünü satın alınınca panele yollanılacak komut" type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><button name="urun-ekle" type="submit" style="float: right; width: 100px;" class="btn btn-success">Ekle</button></td>
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
