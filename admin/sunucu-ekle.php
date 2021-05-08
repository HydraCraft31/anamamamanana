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
				<h1 class="page-header">Sunucu Ekle</h1>
			</div>
		</div><!--/.row-->
		
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
			<?php
			
			$sunucu_link=permayap($_POST["sunucu"]);
			$sunucu=$_POST["sunucu"];
			$sunucu_ip=$_POST["ip"];
			$port=$_POST["port"];
			$sunucu_resim=$_POST["resim"];
			$sunucu_sifre=$_POST["sifre"];	
			
			if(isset($_POST['sunucu-ekle'])){
				$tabloya_ekle = $db->prepare("INSERT INTO Sunucular (ip,sunucu_link,sunucu,port,sunucu_resim,sunucu_sifre) VALUES(?,?,?,?,?,?)");
				$tabloya_ekle->execute(array($sunucu_ip,$sunucu_link,$sunucu,$port,$sunucu_resim,$sunucu_sifre));
					echo '<div class="alert bg-success" role="alert"><svg class="glyph stroked checkmark"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-checkmark"></use></svg> Sunucu başarıyla eklenmiştir! <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>';
					echo '<meta http-equiv="refresh" content="3;URL=sunucular.php">';
			}
				
			?>
                    <div style="overflow-x:auto;">
						<form action="" method="post">
                            <table class="ekle">
                                <tr>
                                    <td>Sunucu İsmi:</td>
                                    <td><input required name="sunucu" type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Sunucu Sayısal IP:</td>
                                    <td><input required name="ip" type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>WebSend Port:</td>
                                    <td><input required name="port" type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>WebSend Şifre:</td>
                                    <td><input required name="sifre" type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Sunucu Resim URL:</td>
                                    <td><input required name="resim" placeholder="http://resim.com/1.jpg" type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><button name="sunucu-ekle" type="submit" style="float: right; width: 100px;" class="btn btn-success">Ekle</button></td>
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
