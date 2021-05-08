<?php
session_start();
if(!isset($_SESSION["uye_id"])){
	header("location:/girisyapmalisin/");
}

	include ('../ayarlar/ayar.php');

	header("refresh: 4;  url=/destek/");

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
            <div class="icBaslik"><div class="icBaslikYazi"><i class="fa fa-life-ring fa-3x"></i><font size="6"> DESTEK</font></div></div>
            <div class="ic">
                <div class="flag note note--success">
                    <div class="flag__image note__icon">
                        <i class="fa fa-check"></i>
                    </div>
                    <div class="flag__body note__text">
                        Mesajınız bize başarıyla ulaşmıştır. En kısa zamanda yönetici tarafından cevaplanacaktır.
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
