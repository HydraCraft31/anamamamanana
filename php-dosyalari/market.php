<?php
session_start();
if(!isset($_SESSION["uye_id"])){
	header("location:/girisyapmalisin/");
}

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
        <div id="sol">
            <div class="icBaslik"><div class="icBaslikYazi"><i class="fa fa-shopping-cart fa-3x"></i><font size="6"> MARKET</font></div></div>
            <div class="ic">
			<?php
			
			$sunucular_cek = $db->query("SELECT * FROM Sunucular ORDER BY id");
			if($sunucular_cek->rowCount() != 0){
			echo '<div class="flag note note--warning">
			<div class="flag__image note__icon">
			<i class="fa fa-exclamation"></i>
			</div>
			<div class="flag__body note__text">
			Alışveriş yaparken, ürünü alacağınız sunucuda olmayı unutmayın!
			</div>
			</div>';
			foreach ($sunucular_cek as $sunucular_oku) {
			?>
			<center>
			<br>
			<a href="../market/<? echo $sunucular_oku['sunucu_link'] ?>"><img src="<? echo $sunucular_oku['sunucu_resim'] ?>" width="85%"></a>
			</center>
			<?php
			}
			}else{
			echo'
                <div class="flag note note--error">
                    <div class="flag__image note__icon">
                        <i class="fa fa-times"></i>
                    </div>
                    <div class="flag__body note__text">
                        Yönetici markete hiç sunucu eklememiş!
                    </div>
                </div>
			';
			}

			?>
            </div>
        </div>
		<?php

			include ('../right.php');

		include ('../footer.php');
		
	?>
    </div>
</body>
</html>