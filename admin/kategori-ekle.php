<?php
session_start();
if(!isset($_SESSION["login"])){
	header("location:login.php");
}
?>
<? $index="6" ?>
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
				<h1 class="page-header">Ürün Kategori Ekle</h1>
			</div>
		</div><!--/.row-->
		
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
			<?php
			
			$kategori_link=permayap($_POST["kategori"]);
			$kategori=$_POST["kategori"];
			$sunucu_link=permayap($_POST["sunucu"]);
			$sunucu=$_POST["sunucu"];
			$resim=$_POST["resim"];	
			
			if(isset($_POST['kategori-ekle'])){
				$tabloya_ekle = $db->prepare("INSERT INTO Urun_Kategori (kategori_link,kategori,sunucu,sunucu_link,resim) VALUES(?,?,?,?,?)");
				$tabloya_ekle->execute(array($kategori_link,$kategori,$sunucu,$sunucu_link,$resim));
					echo '<div class="alert bg-success" role="alert"><svg class="glyph stroked checkmark"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-checkmark"></use></svg> Kategori başarıyla eklenmiştir! <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>';
					echo '<meta http-equiv="refresh" content="3;URL=kategoriler.php">';
			}
				
			?>
                    <div style="overflow-x:auto;">
						<form action="" method="post">
                            <table class="ekle">
                                <tr>
                                    <td>Kategori İsmi:</td>
                                    <td><input required name="kategori" placeholder="Örn: Spawnerler, Anahtarlar vb." type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Kategorinin Ait Olduğu Sunucu:</td>
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
                                    <td>Kategori Resim URL:</td>
                                    <td><input required name="resim" placeholder="http://resim.com/1.jpg" type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><button name="kategori-ekle" type="submit" style="float: right; width: 100px;" class="btn btn-success">Ekle</button></td>
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
