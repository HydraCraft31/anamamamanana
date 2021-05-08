<?php
	include ('../ayarlar/ayar.php');
	
	if(isset($_POST["vip-sorgu"])){
	header("Location: ../sorgu/ara/$post_oyuncu/");
	}

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
            <div class="icBaslik"><div class="icBaslikYazi"><i class="fa fa-calendar fa-3x"></i><font size="6"> VIP SORGU</font></div></div>
            <div class="ic">
                <div class="indir">
                    <br>
                    <br>
                    <center>
                    <form action="" method="post">
                        <input required type="text" class="form-control" name="post_oyuncu" style="min-width: 190px; height: 32px;" placeholder="Oyuncunun adını girin.">
                        <button type="submit" name="vip-sorgu" class="button-example-1 button-example-green" style="margin-top:8px; height: 34px; margin-bottom: 10px;"><font face="Roboto Condensed" size="4">Sorgula</font></button>
					</form>
                    </center>
                    <br>
                    <br>
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
