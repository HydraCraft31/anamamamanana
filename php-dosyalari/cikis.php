<?php
session_start();
ob_start();
session_destroy();
header("refresh: 4;  url=../index.php");

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
            <div class="icBaslik"><div class="icBaslikYazi"><i class="fa fa-user fa-3x"></i><font size="6"> PROFİL</font></div></div>
            <div class="ic">
                <div class="flag note note--success">
                    <div class="flag__image note__icon">
                        <i class="fa fa-check"></i>
                    </div>
                    <div class="flag__body note__text">
                        Başarıyla çıkış yaptınız yönlendiriliyorsunuz..
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
