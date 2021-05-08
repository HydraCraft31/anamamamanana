<?php
session_start();
if(!isset($_SESSION["login"])){
	header("location:login.php");
}
?>
<? $index="0" ?>
<?php
include("./ayar/ayar.php");
include("../Websend.php");
 ?>
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
				<h1 class="page-header">Ana Sayfa</h1>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-blue panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">
										<?php
										$market_cek = $db->prepare("SELECT * FROM Market ORDER BY id DESC LIMIT 1");
										$market_cek->execute();
										$market_oku = $market_cek->fetch();
										
										if($market_cek->rowCount() != 0){
											echo $market_oku["id"];
										}
										else{
											echo "0";
										}
										?>
							</div>
							<div class="text-muted">Satılan Ürün</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-orange panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">
							<?php
							$paralar_cek = $db->query("SELECT * FROM Kredi ORDER BY id");
							$paralar_cek->execute();		
							if($paralar_cek->rowCount() != 0){

							$result = $db->query('SELECT sum(miktar) FROM Kredi')->fetchColumn();

							echo $result;

							}else{
								echo "0";
							}

							?>
							</div>
							<div class="text-muted">Kazanılan Para</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-teal panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">
										<?php
										$kayit_sorgu = $db->prepare("SELECT * FROM authme ORDER BY id DESC LIMIT 1");
										$kayit_sorgu->execute();
										$kayit_yazdir = $kayit_sorgu->fetch();
										
										if($kayit_sorgu->rowCount() != 0){
											echo $kayit_yazdir["id"];
										}
										else{
											echo "0";
										}
										?>
							</div>
							<div class="text-muted">Kayıtlı Kullanıcılar</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-red panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked app-window-with-content"><use xlink:href="#stroked-app-window-with-content"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><div id="numplayers"></div></div>
							<div class="text-muted">Çevrimiçi Oyuncular</div>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		
	<center>
	<div class="panel panel-teal" style="line-height: 100px; font-family: Arial Black; font-size: 22px; color: #fff;">SUNUCU KONSOL<br>
		<div class="row" style="width: 80%;">
<?php
if(isset($_POST["komut-gonder"])){

	$sunucu = $_POST["sunucu"];
	$komut  = $_POST["komut"];
	
	$sec = $db->prepare("SELECT * FROM Sunucular WHERE sunucu = ?");
	$sec->execute(array($sunucu));
	$oku = $sec->fetch();
	
	$ws = new Websend("".$oku["ip"]."");
	$ws->password = "".$oku["sunucu_sifre"]."";
	$ws->port = "".$oku["port"]."";
				    
	if($ws->connect()){
				$ws->doCommandAsConsole($komut);
				echo '<div class="alert bg-success" role="alert"><svg class="glyph stroked checkmark"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-checkmark"></use></svg> Komut başarıyla gönderildi! <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>';
			}else{
echo '<div class="alert bg-danger" role="alert">
					<svg class="glyph stroked cancel"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-cancel"></use></svg> Sunucuya bağlanılamadı! <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>';
			}
		}
		
?>
		<form action="" method="post">
				<div class="form-group">
									<select class="form-control" name="sunucu" style="width: 100%; height: 45px;">
										<?php
										$sunucu_cek = $db->query("SELECT * FROM Sunucular ORDER BY id");
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
									</select>
								</div>
				<input type="text" required name="komut" style="width: 100%; height: 45px;" class="form-control" placeholder="Sunucuyu seçin ve göndermek istediğiniz komudu '/' olmadan yazın!" />
				<button name="komut-gonder" class="btn btn-success" style="width: 25%; margin-top: 8px; height: 45px; float: right;">Komut Gönder</button>
				<input type="hidden" name="token" value="<? echo $_SESSION['token'] ?>" />
				</form>
				<br>

			</div>
	</center>
		</div>
		</div>
		</div>
	</div><!--/.row-->
</div>	<!--/.main-->

<? include("son.php"); ?>	
</body>

</html>
