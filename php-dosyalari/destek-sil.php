<?php
session_start();
if(!isset($_SESSION["uye_id"])){
	header("location:/girisyapmalisin/");
}

	include ('../ayarlar/ayar.php');

	header("refresh: 3;  url=/destek/");

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
				<?php

				$sec = $db->prepare("SELECT * FROM tickets WHERE id = ?");
				$sec->execute(array($_GET["id"]));
				$secim = $sec->fetch();

				if($secim["nick"] == $oyuncu_oku["username"]){
				$query = $db->prepare("DELETE FROM tickets WHERE id = ? and nick = ?");
				$delete = $query->execute(array($_GET["id"],$oyuncu_oku["username"]));
				?>
                <div class="flag note note--success">
                    <div class="flag__image note__icon">
                        <i class="fa fa-check"></i>
                    </div>
                    <div class="flag__body note__text">
                        Destek talebi başarıyla silinmiştir..
                    </div>
                </div>
				<?php
				}
				else{
				?>
                <div class="flag note note--error">
                    <div class="flag__image note__icon">
                        <i class="fa fa-times"></i>
                    </div>
                    <div class="flag__body note__text">
                        Size ait olmayan destek bildirimlerini silemezsiniz!
                    </div>
                </div>
					<?php

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
