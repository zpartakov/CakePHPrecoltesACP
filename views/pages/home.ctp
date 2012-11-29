<h1>Accueil</h1>
La plupart des services se trouvent en passant par le menu "Outils" 	
		<? 
		echo $html->image("potiron.gif", array('url' => '#', 'alt' => 'Outils', 'title' => 'Outils', 'style'=>'width: 27px'));
		?>
<h2>Entrer des récoltes</h2>
Commencer par 
<?php echo $html->link('créer la fiche de récolte', '/recoltes'); ?>
, puis entrer la <?php echo $html->link('récolte de légumes', '/recolteslegumes'); ?>
<h2>Voir des récoltes</h2>
Utiliser le bouton <?php echo $html->link('Statistiques légumes', '/recolteslegumes/statistiques', array('title'=>'Statistiques légumes')); ?> (sous-menu "Récoltes" - le panier)
<h2>Divers</h2>
S'il manque des terrains, légumes, catégories ou autres, les entrer <em>via</em> le menu "Outils" 
<h2>ToDos / A faire</h2>
<pre>
Format pour impression
exportation (téléchargement) excel
</pre>
