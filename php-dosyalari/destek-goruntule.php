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
<style>
  .bubble {
    position: relative;
	margin-left: 90px;
    width: 78%;
    height: 100px;
    padding: 10px;
    background: #eee;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
	color: #313131;
	margin-top: 12px;
	margin-bottom: 12px;
}

  .bubble:after {
    content: "";
    position: absolute;
    top: 30px;
    left: -17px;
    border-style: solid;
    border-width: 15px 17px 15px 0;
    border-color: transparent #eee;
    display: block;
    width: 0;
    z-index: 1;
}

#ticketIc { 
width: auto;
min-height:250px;
height: auto;

}

.icBolge{

    float:left;

    margin-right: 10px;

    margin-left: 4px;

</style>
        <div id="sol">
		<?php
		
		$ticket_kontrol = $db->prepare("SELECT * FROM tickets WHERE id = ? and nick = ?");
		$ticket_kontrol->execute(array($_GET["id"],$oyuncu_oku["username"]));	
		$ticket_oku = $ticket_kontrol->fetch();	
			if($ticket_kontrol->rowCount() != 0){
			
		?>
            <div class="icBaslik"><div class="icBaslikYazi"><font color='#000000' size='5' face='Oswald'>BAŞLIK:</font> <font color='#504F4F' size='5' face='Oswald'><? echo $ticket_oku["baslik"]; ?> |</font> <font color='#000000' size='5' face='Oswald'>KONU:</font> <font color='#504F4F' size='5' face='Oswald'><? echo $ticket_oku["kategori"]; ?></font></div></div>
				<div class="ic">
					<div id="ticketIc">
						<div class="icBolge" style="padding-top: 22px; padding-right: 18px; padding-left: 25px;">

						<img style="border: 0px solid #fff; border-radius: 3px;" src="http://cravatar.eu/avatar/<? echo $ticket_oku["nick"] ?>/54.png"></div>
						<div class="bubble , icBolge">
						<?php echo $ticket_oku["mesaj"]; ?>
						</div>
						<?php
							if($ticket_oku["cevap"] != NULL){
						?>
						<div class="icBolge">
						<img style="margin-top: 22px; padding-right: 18px; padding-left: 25px;" src="../img/destek.png" width="54px" height="54px"></div>
						<div class="bubble , icBolge">
						<?php echo $ticket_oku["cevap"]; ?>
						</div>
						<?php } ?>
						<?php
							$tickets_sc = $db->prepare("SELECT * FROM tickets_sc WHERE nick = ? and ticket_id = ?");
							$tickets_sc->execute(array($oyuncu_oku["username"],$_GET["id"]));

							if($tickets_sc->rowCount() != 0){

								foreach ($tickets_sc as $tickets_sc_oku) {

									if($tickets_sc_oku["soru"] != NULL){
						?>
						<div class="icBolge" style="padding-top: 22px; padding-right: 18px; padding-left: 25px;">

						<img style="border: 0px solid #fff; border-radius: 3px;" src="http://cravatar.eu/avatar/<? echo $ticket_oku["nick"] ?>/54.png"></div>
						<div class="bubble , icBolge">


						<?php
							echo $tickets_sc_oku["soru"];

						?>
						</div>
						<?php 
								
								}
							if($tickets_sc_oku["cevap"] != NULL){
						?>
						<div class="icBolge">
						<img style="margin-top: 22px; padding-right: 18px; padding-left: 25px;" src="../img/destek.png" width="54px" height="54px"></div>
						<div class="bubble , icBolge">
						<?php echo $tickets_sc_oku["cevap"]; ?>
						</div>


						<?php
								}
							}
						}

						?>
				</div>
            </div>
<style>
.yorum-at-table{
	border-collapse: collapse;
	border-spacing: 0;
	border-color: #999;
	}
		
.yorum-at-table .kutu {background-color: #fff; width: 100%; padding-top: 20px; padding-left: 20px; padding-right: 20px;}
.yorum-at-table .kutu2 {background-color: #fff; width: 100%;height: 40px; line-height:40px; border-top: 2px solid #313131;padding-left: 20px; padding-right: 20px;}
.yorum-at-table .gonder {background-color: #fff; padding: 5px; padding-right: 22px; padding-bottom: 10px;}
.yorum-at-table th {background-color: #313131; color: #fff; width: 100%; padding: 15px; text-align: left;}
</style>
<?php

if($ticket_oku["durum"] != 3){

$token = new token();
if(isset($_POST['soru_gonder'])){
$token_test = $_POST["spam_token"];
$soru 		= strip_tags($_POST['soru']);
$durum 		= "2";
$guncelleme = date('YmdHis');

if($token->tokenSorgula($token_test) == false){
	die("TOKEN YANLIŞ!");
}

if($_POST["soru"] == ""){
	echo '
                <div class="flag note note--error" style="margin-bottom: 20px;">
                    <div class="flag__image note__icon">
                        <i class="fa fa-times"></i>
                    </div>
                    <div class="flag__body note__text">
                        Boş alan bırakmayın!
                    </div>
                </div>
	';
}
else{
		$cevap_gonder = $db->prepare("INSERT INTO tickets_sc (nick,ticket_id,soru) VALUES(?,?,?)");
		$cevap_gonder->execute(array($oyuncu_oku["username"],$_GET["id"],$soru));

		$durum_guncelle =  $db->prepare("UPDATE tickets SET durum = ?, son_guncelleme = ? WHERE nick = ? and id = ?");
		$durum_guncelle->execute(array($durum,$guncelleme,$oyuncu_oku["username"],$_GET["id"]));

		echo '<meta http-equiv="refresh" content="0;URL='.$site_url.'/destek/gonderildi/">';
}
}
?>
<table>
<tr>
<th style="height: 10px;"></th>
</tr>
</table>
<table class="yorum-at-table" style="padding-top: 50px;">
<form action="" method="post">
	<tr>
		<th>CEVAP YAZ</th>
	</tr>
	<tr>
		<td class="kutu"><textarea required name="soru" style="width: 98%; border: 1px solid #909090; border-radius: 4px; padding-left: 10px; padding-top: 10px;" placeholder="Destek ekibimize bırakmak istediğiniz mesajı yazınız." rows="5"></textarea></td>
	</tr>
	<tr>
		<td class="gonder"><button name="soru_gonder" type="submit" class="button-example-1 button-example-green pull-right"><font face="Roboto Condensed" size="4">Gönder</font></button></td>
	</tr>
	<input type="hidden" name="spam_token" value="<? echo $_SESSION['spam_token'] ?>" />
</form>
</table>
	
			<? }  }else{ ?>
		<div class="icBaslik"><div class="icBaslikYazi"><font color='#000000' size='5' face='Oswald'>HATA!</font></div></div>
			<div class="ic">
                <div class="flag note note--error">
                    <div class="flag__image note__icon">
                        <i class="fa fa-times"></i>
                    </div>
                    <div class="flag__body note__text">
                        Hata!
                    </div>
                </div>
			</div>
			<? } ?> 
			</div>		
		<?php
		
			include ('../right.php');

		include ('../footer.php');

	?>
    </div>
</body>
</html>
