<?php

	include ('../ayarlar/ayar.php');

	$sayfa = intval($_GET["s"]);
	
	if(!$sayfa){
		$sayfa = 1;
	}
	
	$say = $db->query("SELECT * from yazilar");
	$toplamveri = $say->rowCount();
	$sayfa_sayisi = ceil($toplamveri/$yazi_limit);
	
	if($sayfa > $sayfa_sayisi){
		$sayfa = 1;
	}
	
	$goster = $sayfa * $yazi_limit - $yazi_limit;
	$gorunensayfa = 6;

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
        <div id="sol" style="margin-top: 8px;">
			<?php
			$duyuru_cek = $db->query("SELECT * FROM yazilar ORDER BY id DESC limit $goster,$yazi_limit");
			$duyuru_cek->execute();		
			if($duyuru_cek->rowCount() != 0){

				foreach ($duyuru_cek as $duyuru_oku) {

			?>
            <div class="haberBaslik">
                <div class="haberBaslikYazi"><?php echo $duyuru_oku['baslik'] ?></div>
                <div class="haberBaslikTarih"><?php echo $duyuru_oku['tarih'] ?></div>
            </div>
            <div class="haberIcerik">
                <img src="<?php echo $duyuru_oku['resim'] ?>" style="margin-left: 12px; margin-right:8px" width="149" height="150" border="0" align="left">
					<?php 
					$detay = $duyuru_oku['yazi'];
					$uzunluk = strlen($detay); 
					$limit = 500;
					if ($uzunluk > $limit) { 
					$detay = substr($detay,0,$limit) . "..."; 
					} 
					echo $detay ?>
				</div>
            <div class="cizgi"></div>
            <div class="haberBilgi">
                <div class="haberBilgiYazi"><i class="fa fa-edit"></i><strong> Yazan: </strong><?php echo $duyuru_oku['yazar'] ?> | <i class="fa fa-calendar"></i><strong> Tarih: </strong><?php echo $duyuru_oku['tarih'] ?><div class="pull-right"><a href="<?php echo "../haber/".$duyuru_oku["id"]."/" ?>"><font face="Roboto Condensed" size="3">DEVAMINI OKU </font><font style="margin-right: 8px;" face="Roboto Condensed" size="5" color="#E62117">»</font></a></div></div>
            </div>
			<?php
			}
			}else{
			echo'<div class="flag note note--error">
			  <div class="flag__image note__icon">
				<i class="fa fa-times"></i>
			  </div>
			  <div class="flag__body note__text">
				Yönetici tarafından henüz duyuru eklenmedi!
			  </div>
			</div>
			';
			}

			?>
			<?php if($sayfa > 1){ ?>
			<a class="sayfa-button" style="float:left; margin-right: 30px;" href="/sayfa/<?php echo $sayfa - 1 ?>/">Önceki</a>
			<?php } ?>
			
			<?php
				
				for ($i = $sayfa - $gorunensayfa; $i < $sayfa + $gorunensayfa + 1; $i++){
					
					if($i > 0 and $i <= $sayfa_sayisi){
						
						if($i == $sayfa){
							
						?>
						<a class="sayfa-buttons" style="float:left; background-color: #ccc;" href="/sayfa/<?php echo $i ?>/"><?php echo $i ?></a>
						<?php } else{ ?>
						<a class="sayfa-buttons" style="float:left;" href="/sayfa/<?php echo $i ?>/"><?php echo $i ?></a>
						<?php
						}
						
					}
				}
				
			?>
			
			<?php if($sayfa != $sayfa_sayisi){ ?>
			<a class="sayfa-button pull-right" href="/sayfa/<?php echo $sayfa + 1 ?>/">Sonraki</a>
			<?php } ?>
        </div>
		<?php

			include ('../right.php');

		include ('../footer.php');
		
	?>
    </div>
</body>
</html>
