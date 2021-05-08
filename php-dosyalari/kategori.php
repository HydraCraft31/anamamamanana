<?php
session_start();
if(!isset($_SESSION["uye_id"])){
	header("location:/girisyapmalisin/");
}
?>

<?php
	$sunucu = $_GET["sunucu"];
	$kategori = $_GET["kategori"];
	include ('../ayarlar/ayar.php');
?>

<?php
	include ('../head.php');
?>
<body>
	<?php
		include('../logo.php');
	?>
    <div id="wrapper">
		<?php
			include ('../header.php');
		?>
			<?php
			$urun_cek = $db->prepare("SELECT * FROM Urunler WHERE sunucu_link = ? and kategori_link = ?");
			$urun_cek->execute(array($sunucu,$kategori));		
				if($urun_cek->rowCount() != 0){

					foreach ($urun_cek as $urun_oku) {

			?>
		<div class="md-modal md-effect-1" id="urun_<?php echo $urun_oku['id'] ?>">
			<div class="md-content">
				<h3><font face="Oswald">MARKET</font></h3>
				<div>
				<center>
					<img src="<?php echo $urun_oku['resim_url'] ?>" width="170" height="160"/><br><br>
					<p><font size="3">Seçmiş olduğunuz <strong><?php echo $urun_oku['urun'] ?></strong> ürününü <strong><?php echo $urun_oku['fiyat'] ?></strong> krediye satın almak istiyor musunuz?</font></p>
					<form action="../market/satinal/<?php echo $urun_oku['id'] ?>" method="post">
					<button type="submit" style="margin-top: 12px;" class="button-example-1 button-example-green" style="width: 110px;"><font face="Roboto Condensed" size="4">SATIN AL</font></button>
					<button type="button" class="button-example-1 button-example-red md-close" style="width: 110px;"><font face="Roboto Condensed" size="4">IPTAL</font></button>
					<input type="hidden" name="token" value="<? echo $_SESSION['token'] ?>" />
					</form>
				</center>
				</div>
			</div>
		</div>
			<? } } ?>
        <div id="sol">

            <div class="icBaslik"><div class="icBaslikYazi"><i class="fa fa-shopping-cart fa-3x"></i><font size="6"> <a href="../market/">MARKET</a> » <a href="../market/<?php echo $urun_oku['sunucu_link'] ?>"><?php echo $urun_oku['sunucu'] ?></a> » <?php echo $urun_oku['kategori'] ?></font></div></div>
            <div class="ic">
			<center>
			<?php
			$urun_cek = $db->prepare("SELECT * FROM Urunler WHERE sunucu_link = ? and kategori_link = ?");
			$urun_cek->execute(array($sunucu,$kategori));
				if($urun_cek->rowCount() != 0){
					echo "<br>";
					foreach ($urun_cek as $urun_oku) {

			?>
             
			<div class="urun"><img src="<?php echo $urun_oku['resim_url'] ?>" width="170" height="160" /><br><font color="#313131" size="4" face="Roboto Condensed" ><?php echo $urun_oku['urun'] ?></p> <b><?php echo $urun_oku['fiyat'] ?>₺</b></font><br><button data-modal="urun_<?php echo $urun_oku['id'] ?>" style="margin-top: 12px;" class="button-example-1 button-example-green md-trigger"><font face="Roboto Condensed" size="4">SATIN AL</font></button></div>
                
			<?php
				}
			}
			else{
			echo'<div class="flag note note--error">
			  <div class="flag__image note__icon">
				<i class="fa fa-times"></i>
			  </div>
			  <div class="flag__body note__text">
				Yönetici tarafından henüz ürün eklenmedi!
			  </div>
			</div>
			';
			}			
			?>
			</center>
            </div>
        </div>
		<?php
			include ('../right.php');
		?>
		
	<?php
		include ('../footer.php');
	?>
    </div>
		<div class="md-overlay"></div><!-- the overlay element -->
		<script src="js/classie.js"></script>
		<script src="js/modalEffects.js"></script>
		<script src="js/cssParser.js"></script>
</body>
</html>
