<?php
session_start();
if(!isset($_SESSION["uye_id"])){
	header("location:/girisyapmalisin/");
}

	header("refresh: 4;  url=/profil/");

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
                <div class="flag note note--error">
                    <div class="flag__image note__icon">
                        <i class="fa fa-times"></i>
                    </div>
                    <div class="flag__body note__text">
                        İşlem başarısız! Hesabınızda yeterli bakiye bulunmamaktadır!
                    </div>
                </div>
            </div>
        </div>
		<?php

			include ('../right.php');

		include ('../footer.php');
		
	?>
    </div>
</body>
</html>