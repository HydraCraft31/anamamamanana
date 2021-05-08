	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><? echo "$sunucu_isim"; ?></a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Admin <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Ayarlar</a></li>
							<li><a href="cikis.php"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Çıkış Yap</a></li>
						</ul>
					</li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<ul class="nav menu">
			<li <? if($index == "0"){ ?>class="active"<? } ?>><a href="./index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"/></svg> Ana Sayfa</a></li>
			<li <? if($index == "1"){ ?>class="active"<? } ?>><a href="./yazilar.php"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg> Yazılar</a></li>
			<li <? if($index == "3"){ ?>class="active"<? } ?>><a href="./yorumlar.php"><svg class="glyph stroked empty message"><use xlink:href="#stroked-empty-message"/></svg> Yorumlar</a></li>
			<li <? if($index == "2"){ ?>class="active"<? } ?>><a href="./sunucular.php"><svg class="glyph stroked external hard drive"><use xlink:href="#stroked-external-hard-drive"/></svg> Sunucular</a></li>
			<li <? if($index == "4"){ ?>class="active"<? } ?>><a href="./tickets.php"><svg class="glyph stroked email"><use xlink:href="#stroked-email"/></svg> Destek Talepleri</a></li>
			<li <? if($index == "5"){ ?>class="active"<? } ?>><a href="./urunler.php"><svg class="glyph stroked tag"><use xlink:href="#stroked-tag"/></svg> Ürünler</a></li>
			<li <? if($index == "6"){ ?>class="active"<? } ?>><a href="./kategoriler.php"><svg class="glyph stroked open folder"><use xlink:href="#stroked-open-folder"/></svg> Ürün Kategori</a></li>
			<li <? if($index == "7"){ ?>class="active"<? } ?>><a href="./kredi_alanlar.php"><svg class="glyph stroked star"><use xlink:href="#stroked-star"></use></svg> Kredi Alanlar</a></li>
			<li <? if($index == "8"){ ?>class="active"<? } ?>><a href="./marketi_kullananlar.php"><svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg> Marketi Kullananlar</a></li>
		</ul>

	</div><!--/.sidebar-->