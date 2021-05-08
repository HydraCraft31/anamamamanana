<?php
	header("refresh: 4;  url=/giris/");

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
            <div class="icBaslik"><div class="icBaslikYazi"><i class="fa fa-sign-in fa-3x"></i><font size="6"> GİRİŞ YAP!</font></div></div>
            <div class="ic">
                <div class="flag note note--error">
                    <div class="flag__image note__icon">
                        <i class="fa fa-times"></i>
                    </div>
                    <div class="flag__body note__text">
                        Bu sayfayı görüntüleyebilmek için giriş yapmalısınız! Yönlendiriliyorsunuz..
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