<?
session_start();
	if(!isset($_SESSION["uye_id"])){
?>
<header>
	<nav>
		<ul>
			<li><a href="<? echo $site_url ?>/index.php"><i class="fa fa-home"></i> ANASAYFA</a></li>
			<li><a href="<? echo $site_url ?>/kayit/"><i class="fa fa-user-plus"></i> KAYIT OL</a></li>
			<li><a href="<? echo $site_url ?>/girisyapmalisin/"><i class="fa fa-shopping-cart"></i> MARKET</a></li>
			<li><a href="<? echo $site_url ?>/girisyapmalisin/"><i class="fa fa-try"></i> KREDİ YÜKLE</a></li>
			<li><a href="<? echo $site_url ?>/girisyapmalisin/"><i class="fa fa-ticket"></i> DESTEK</a></li>
			<li><a href="<? echo $site_url ?>/girisyapmalisin/"><i class="fa fa-users"></i> YETKILILER</a></li>
			<li><a href="<? echo $site_url ?>/girisyapmalisin/"><i class="fa fa-file-text"></i> KURALLAR</a></li>
			<li><a href="<? echo $site_url ?>/girisyapmalisin/"><i class="fa fa-download"></i> INDIR</a></li>
			<li class="ip-copy" data-clipboard-action="copy" data-clipboard-text="<?php echo $ip ?>"><a><i class="fa fa-paper-plane"></i> <?php echo $ip ?></a></li>
		</ul>
	</nav>
</header>

<? }
	else{
?>

<header>
	<nav>
		<ul>
			<li><a href="<? echo $site_url ?>/index.php"><i class="fa fa-home"></i> ANASAYFA</a></li>
			<li><a href="<? echo $site_url ?>/profil/"><i class="fa fa-user"></i> PROFİL</a></li>
			<li><a href="<? echo $site_url ?>/market/"><i class="fa fa-shopping-cart"></i> MARKET</a></li>
			<li><a href="<? echo $site_url ?>/kredi/"><i class="fa fa-try"></i> KREDİ YÜKLE</a></li>
			<li><a href="<? echo $site_url ?>/destek/"><i class="fa fa-ticket"></i> DESTEK</a></li>
			<li><a href="<? echo $site_url ?>/yetkililer/"><i class="fa fa-users"></i> YETKILILER</a></li>
			<li><a href="<? echo $site_url ?>/kurallar/"><i class="fa fa-file-text"></i> KURALLAR</a></li>
			<li><a href="<? echo $site_url ?>/indir/"><i class="fa fa-download"></i> INDIR</a></li>
			<li class="ip-copy" data-clipboard-action="copy" data-clipboard-text="<?php echo $ip ?>"><a><i class="fa fa-paper-plane"></i> <?php echo $ip ?></a></li>
		</ul>
	</nav>
</header>

	<? } ?>