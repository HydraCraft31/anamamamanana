<?php
session_start();
if(!isset($_SESSION["uye_id"])){
	header("location:/girisyapmalisin/");
}

	$sunucu = $_GET["sunucu"];

	include ('../ayarlar/ayar.php');

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
			$urun_cek = $db->prepare("SELECT * FROM Urunler WHERE sunucu_link = ?");
			$urun_cek->execute(array($sunucu));		
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
					<button type="submit" style="margin-top: 12px;" class="button-example-1 button-example-green" style="width: 110px;"><font face="Roboto Condensed" size="4">Satın Al</font></button>
					<button type="button" class="button-example-1 button-example-red md-close" style="width: 110px;"><font face="Roboto Condensed" size="4">İptal</font></button>
					</form>
				</center>
				</div>
			</div>
		</div>
			<? } } ?>
        <div id="sol">

            <div class="icBaslik"><div class="icBaslikYazi"><i class="fa fa-shopping-cart fa-3x"></i><font size="6"> <a href="../market/">MARKET</a> » <?php echo $urun_oku['sunucu'] ?></font></div></div>
            <div class="ic">
			<center>
			<?php
			$urun_cek = $db->prepare("SELECT * FROM Urunler WHERE sunucu_link = ? and kategori = ?");
			$urun_cek->execute(array($sunucu,"0"));
				if($urun_cek->rowCount() != 0){
					echo "<br>";
					foreach ($urun_cek as $urun_oku) {

			?>
             
			<div class="urun"><img src="<?php echo $urun_oku['resim_url'] ?>" width="170" height="160" /><br><font color="#313131" size="4" face="Roboto Condensed"><?php echo $urun_oku['urun'] ?></font><br><button data-modal="urun_<?php echo $urun_oku['id'] ?>" style="margin-top: 12px;" class="button-example-1 button-example-green md-trigger"><font face="Roboto Condensed" size="4">Satın Al</font></button></div>
                
			<?php
			}
			}

			?>
			<?php
			$kategori_cek = $db->prepare("SELECT * FROM Urun_Kategori WHERE sunucu_link = ?");
			$kategori_cek->execute(array($sunucu));
				if($kategori_cek->rowCount() != 0){
					foreach ($kategori_cek as $kategori_oku) {

			?>
             
			<div class="urun"><a href="../market/<?php echo $kategori_oku["sunucu_link"] ?>/<?php echo $kategori_oku["kategori_link"] ?>"><img src="<?php echo $kategori_oku['resim'] ?>" width="170" height="160" /><br><font color="#313131" size="4" face="Roboto Condensed"><?php echo $kategori_oku['kategori'] ?></font><br><button style="margin-top: 12px;" class="button-example-1 button-example-grey"><font face="Roboto Condensed" size="4">Ürünlere Git</font></button></a></div>
                
			<?php
			}
			}

			if(($kategori_cek->rowCount() == 0) and ($urun_cek->rowCount() == 0)){

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

		include ('../footer.php');

	?>
    </div>
		<div class="md-overlay"></div><!-- the overlay element -->
		<script src="js/classie.js"></script>
		<script src="js/modalEffects.js"></script>
		<script src="js/cssParser.js"></script>
</body>
</html>
