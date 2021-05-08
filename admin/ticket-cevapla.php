<?php
session_start();
if(!isset($_SESSION["login"])){
	header("location:login.php");
}
?>
<? $index="4" ?>
<? include("./ayar/ayar.php"); ?>
	<? include("head.php"); ?>
<body>
	<? include("header.php"); ?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Ticket Cevapla</h1>
			</div>
		</div><!--/.row-->
		
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
			<?php
			
			$id = @$_GET["id"];
			$cevap = $_POST["cevap"];	
			$durum = "1";
			$guncelleme = date('YmdHis');

			$ticket_cevapla = $db->prepare("SELECT * FROM tickets WHERE id = ?");
			$ticket_cevapla->execute(array($_GET['id']));
			$ticket_oku = $ticket_cevapla->fetch();
			
			if(isset($_POST['cevapla'])){

				if(($ticket_oku["durum"] == "1") or ($ticket_oku["durum"] == "2")){


				$ticket_son_id = $db->prepare("SELECT * FROM tickets_sc WHERE ticket_id = ? ORDER BY id DESC LIMIT 1");
				$ticket_son_id->execute(array($_GET["id"]));
				$ticket_son_id_oku = $ticket_son_id->fetch();

				$ticket_query = $db->prepare("UPDATE tickets_sc SET cevap = ? WHERE ticket_id = ? and id = ?");
				$update = $ticket_query->execute(array($cevap,$_GET['id'],$ticket_son_id_oku["id"]));

				$ticket_query = $db->prepare("UPDATE tickets SET durum = ?, son_guncelleme = ? WHERE id = ?");
				$update = $ticket_query->execute(array($durum,$guncelleme,$_GET['id']));

				echo '<div class="alert bg-success" role="alert"><svg class="glyph stroked checkmark"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-checkmark"></use></svg> Ticket başarıyla cevaplandı! <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>';
				echo '<meta http-equiv="refresh" content="2;URL=tickets.php">';

				}if($ticket_oku["durum"] == 0){

				$ticket_query = $db->prepare("UPDATE tickets SET cevap = ?, durum = ?, son_guncelleme = ? WHERE id = ?");
				$update = $ticket_query->execute(array($cevap,$durum,$guncelleme,$_GET['id']));
				echo '<div class="alert bg-success" role="alert"><svg class="glyph stroked checkmark"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-checkmark"></use></svg> Ticket başarıyla cevaplandı! <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>';
				echo '<meta http-equiv="refresh" content="2;URL=tickets.php">';
			}
		}
			
			if(isset($_POST['sil'])){
				$query = $db->prepare("DELETE FROM tickets WHERE id = :id");
				$delete = $query->execute(array(
					 "id" => $_GET['id']
				));
				echo '<div class="alert bg-success" role="alert"><svg class="glyph stroked checkmark"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-checkmark"></use></svg> Ticket başarıyla silindi! <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>';
				echo '<meta http-equiv="refresh" content="2;URL=tickets.php">';
			}
			if(isset($_POST['ticket-kapat'])){
				$durum = "3";
				$ticket_query = $db->prepare("UPDATE tickets SET durum = ?, son_guncelleme = ? WHERE id = ?");
				$update = $ticket_query->execute(array($durum,$guncelleme,$_GET['id']));

				echo '<div class="alert bg-success" role="alert"><svg class="glyph stroked checkmark"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-checkmark"></use></svg> Ticket başarıyla kapatıldı! <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>';
				echo '<meta http-equiv="refresh" content="2;URL=tickets.php">';
			}
				
			?>
                    <div style="overflow-x:auto;">
						<form action="" method="post">

            <div class="icBaslik"><div class="icBaslikYazi"><font color='#000000' size='5' face='Arial'>BAŞLIK:</font> <font color='#504F4F' size='5' face='Arial'><? echo $ticket_oku["baslik"]; ?> |</font> <font color='#000000' size='5' face='Arial'>KONU:</font> <font color='#504F4F' size='5' face='Arial'><? echo $ticket_oku["kategori"]; ?></font></div></div><br>
            <h4><strong>Kanıt URL:</strong> <a href="<? echo $ticket_oku["kanit"]; ?>"><? echo $ticket_oku["kanit"]; ?></a></h4><br>
					<table>

						<tr>
						<td style="width: 60px; border-right: 1px solid #ddd;"><img style="border: 0px solid #fff; border-radius: 3px;" src="http://cravatar.eu/avatar/<? echo $ticket_oku["nick"] ?>/54.png"></td>
						<td><strong><?php echo $ticket_oku["mesaj"]; ?></strong></td>
						</tr>
						<?php
							if($ticket_oku["cevap"] != NULL){
						?>
						<tr>
						<td style="width: 60px; border-right: 1px solid #ddd;"><img src="./img/destek.png" width="54px" height="54px"></td>
						<td><strong><?php echo $ticket_oku["cevap"]; ?></strong></td>
						</tr>
						<?php
						}
							$tickets_sc = $db->prepare("SELECT * FROM tickets_sc WHERE ticket_id = ?");
							$tickets_sc->execute(array($_GET["id"]));

							if($tickets_sc->rowCount() != 0){

								foreach ($tickets_sc as $tickets_sc_oku) {

									if($tickets_sc_oku["soru"] != NULL){
						?>
						<tr>
						<td style="width: 60px; border-right: 1px solid #ddd;"><img style="border: 0px solid #fff; border-radius: 3px;" src="http://cravatar.eu/avatar/<? echo $ticket_oku["nick"] ?>/54.png"></td>
						<td><strong><?php echo $tickets_sc_oku["soru"]; ?></strong></td>
						</tr>
						<?php 
							}

							if($tickets_sc_oku["cevap"] != NULL){
						?>
						<tr>
						<td style="width: 60px; border-right: 1px solid #ddd;"><img src="./img/destek.png" width="54px" height="54px"></td>
						<td><strong><?php echo $tickets_sc_oku["cevap"]; ?></strong></td>
						</tr>
						<?php
								}
							}
						}

						?>
					</table>


								<table class="ekle">
                                <tr>
                                    <td><textarea placeholder="Bir cevap yazın." rows="6" name="cevap" class="form-control"></textarea></td>
                                </tr>
                                <tr>
                                    <td><button name="cevapla" type="submit" style="float: right; width: 100px; margin-left: 5px;" class="btn btn-success">Cevapla</button><button name="ticket-kapat" type="submit" style="float: right; width: 100px; margin-left: 5px;" class="btn btn-warning">Kapat</button><button name="sil" type="submit" style="float: right; width: 100px;" onclick="return confirm('Silmek istediğinize emin misiniz?')" class="btn btn-danger">Sil</button></td>
                                </tr>
							</table>
							<input type="hidden" name="token" value="<? echo $_SESSION['token'] ?>" />
							</form>	
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
</div><!--/.row-->
</div>	<!--/.main-->

<? include("son.php"); ?>	
</body>

</html>
