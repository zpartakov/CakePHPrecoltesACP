<!-- menu/navigation -->
<div id="cakephp-global-navigation">
<ul id="menuDeroulant">
<!-- ########################### Home ######################## -->

<li style="width: 50px;">
	<?php 
			echo $html->image("home/ghome.png", array('url' => '/', 'alt' => 'Accueil', 'title' => 'Accueil', 'style'=>'width: 30px; position: absolute; top: 1px; left: 13px;'));
	?>
</li>
<!-- ########################### TOOLS ######################## -->
	<li style="width: 50px;">
		<? 
		//http://www.fortat.fr/produit.htm
		echo $html->image("potiron.gif", array('url' => '/legumes', 'alt' => 'Outils', 'title' => 'Outils', 'style'=>'width: 27px'));
		?>
	<ul class="sousMenu">
		<li><?php echo $html->link('Légumes', '/legumes', array('title'=>'Légumes')); ?></li>
		<li><?php echo $html->link('Unités', '/unites', array('title'=>'Unités pour les légumes')); ?></li>
		<li><?php echo $html->link('Classifications', '/classifications', array('title'=>'Classifications des légumes')); ?></li>
		<li><?php echo $html->link('Caisses', '/caisses', array('title'=>'Caisses')); ?></li>
		<li><?php echo $html->link('Terrains / Tunnels', '/terrains/index/page:1/sort:Terrain.lib/direction:asc', array('title'=>'Terrains')); ?></li>
		<li><?php echo $html->link('Prix Légumes', 'http://www.agrigate.ch/fr/prix-de-marche/prix-vente-directe/legumes/', array('title'=>'Recommandations de prix pour la vente directe')); ?></li>

	</ul>
</li>
<!-- ########################### TOOLS ######################## -->
	<li style="width: 50px;">
		<? 
		//http://www.fortat.fr/produit.htm
		echo $html->image("recolte.jpg", array('url' => '/recoltes', 'alt' => 'Récoltes', 'title' => 'Récoltes', 'style'=>'width: 27px'));
		?>
	<ul class="sousMenu">
			<li><?php echo $html->link('Statistiques', '/recolteslegumes/statistiques', array('title'=>'Statistiques légumes')); ?></li>
			<li><?php echo $html->link('Toutes les récoltes', '/recoltes/all', array('title'=>'Statistiques légumes')); ?></li>

	<!--	<li><?php echo $html->link('Nouvelle récolte', '/recoltes/add', array('title'=>'Récoltes légumes')); ?></li>

		<li><?php echo $html->link('Récoltes légumes', '/recolteslegumes', array('title'=>'Récoltes légumes')); ?></li>-->
	</ul>
</li>
	<li style="width: 50px;">
		<? 
		echo $html->image("toolbar/add.png", array('url' => '/recoltes/add', 'alt' => 'Nouvelle feuille de relevé hebdomadaire de légumes', 'title' => 'Nouvelle feuille de relevé hebdomadaire de légumes'));
		?>
	</li>
<!-- ########################### WEATHER FORECAST ######################## -->
<li style="width: 50px;">
			<a href="http://www.meteosuisse.admin.ch/web/fr/meteo/previsions_en_detail.html"  target="_blank"><img src="http://www.cocagne.ch/intranet/cultures/img/meteo.gif" alt="Météo" title="Météo" style="width: 27px" /></a>
</li>
</ul>	  
</div>
