<?php
function allrecoltes() {

	/*extraire toutes les légumes puis faire une boucle sur la recolte des legumes*/
$sql="SELECT * FROM recoltes ORDER BY date";
$sql=mysql_query($sql);
if(!$sql) {
	echo "<br>SQL error: ".mysql_error() ."<br>"; exit;
}
if(mysql_num_rows($sql)<1) {
	echo "Pas encore de récolte";

} else {
	$i=0;
	while($i<mysql_num_rows($sql)) {
		echo "<br/><h3>Récolte du: ";
		dateSQLfr1(mysql_result($sql,$i,'recoltes.date'));
		//echo mysql_result($sql,$i,'recoltes.date');
		echo "</h3>";
		//dateSQL2fr dateen2fr
		echo "<br/>";
		recoltereclegume(mysql_result($sql,$i,'recoltes.id'),mysql_result($sql,$i,'recoltes.nb_GP'),mysql_result($sql,$i,'recoltes.nb_PP'));
			$i++;
			echo "<hr/>";
			
	}
}
//recoltelegume($recolte['Recolte']['id'],$recolte['Recolte']['nb_GP'],$recolte['Recolte']['nb_PP']);

}

/* récolte récapitulative
 * 
 */
function recoltereclegume($rid, $rnbgp, $rnbpp) {
	#print_r($Recolteslegume);
#debug($recolteslegumes);
	$i = 0;
#	echo "id recolte: " .$rid;

$sql="SELECT * FROM recolteslegumes AS rl, legumes AS l, unites AS u  	 
WHERE rl.recolte_id=".$rid ." 
AND rl.legume_id=l.id 
AND rl.unite_id=u.id 
ORDER BY l.lib
";
/*
$sql="SELECT * FROM recolteslegumes AS rl, legumes AS l, unites AS u  	 
WHERE rl.recolte_id=".$rid ." 
AND rl.legume_id=l.id 
ORDER BY l.lib
";
*/
//echo "<pre>" .nl2br($sql) ."</pre>"; //tests

$sql=mysql_query($sql);
if(!$sql) {
	echo "<br>SQL error: ".mysql_error() ."<br>"; exit;
}
if(mysql_num_rows($sql)<1) {
	echo "Pas encore de légumes pour cette récolte";
} else {
	echo "<table>
	<tr><th>Légume</th><th>Unité</th><th>QtéGP</th><th>QtéPP</th><th>QtéTotal</th><th>Prix moyen</th><th>Valeur</th></tr>";
	$i=0;
	while($i<mysql_num_rows($sql)) {
		if(($i/2)==(intval($i/2))) {
			$class="altrow";
		} else {
			$class="";
		}
	if(mysql_result($sql,$i,'u.lib')=="kg"){
		$diviseur=1000;
 }elseif (mysql_result($sql,$i,'u.lib')=="pièce"){
		$diviseur=1;
	} 

	echo "<tr class=\"".$class ."\"><td>";
		echo "<a href=\"/intranet/cultures/recolteslegumes/edit/" .mysql_result($sql,$i,'rl.id')."\">" .mysql_result($sql,$i,'l.lib') ."</a>";
	
#		echo $html->link(mysql_result($sql,$i,'l.lib'),'/recolteslegumes/edit/'.mysql_result($sql,$i,'rl.id'));
		echo  "</td><td>";
		echo mysql_result($sql,$i,'u.lib');
		echo  "</td><td>";
		if(mysql_result($sql,$i,'rl.kg_pce_par_cornet_GP')>0){
			$qGP=mysql_result($sql,$i,'rl.kg_pce_par_cornet_GP');
		} elseif (mysql_result($sql,$i,'rl.cornets_par_caisse_GP')>0){
			$qGP=mysql_result($sql,$i,'rl.cornets_par_caisse_GP');
		} else {
			$qGP=0;
		}			
		if(mysql_result($sql,$i,'rl.kg_pce_par_cornet_PP')>0){
			$qPP=mysql_result($sql,$i,'rl.kg_pce_par_cornet_PP');
		} elseif (mysql_result($sql,$i,'rl.cornets_par_caisse_PP')>0){
			$qPP=mysql_result($sql,$i,'rl.cornets_par_caisse_PP');
		} else {
			$qPP=0;
		}
		echo intval(($rnbgp*$qGP)/$diviseur);
		echo "</td><td>";
		echo intval(($rnbpp*$qPP)/$diviseur);
		echo "</td><td>";
		
		$q=intval((($rnbgp*$qGP)+($rnbpp*$qPP))/$diviseur);

		echo $q;
		echo "</td><td>";
		//calcul prix moyen
		$prixminPER=mysql_result($sql,$i,'rl.prixminPER');
		$prixmaxPER=mysql_result($sql,$i,'rl.prixmaxPER');
		$prixminBIO=mysql_result($sql,$i,'rl.prixminBIO');
		$prixmaxBIO=mysql_result($sql,$i,'rl.prixmaxBIO');
		$PER=($prixminPER+$prixmaxPER)/2;
		$BIO=($prixminBIO+$prixmaxBIO)/2;
		$pm=($PER+$BIO)/2;
		echo intval($pm*100)/100;
		echo "</td><td>";
		echo intval($pm*$q) .".-";
			#echo "</td><td>";
		?>
<?
	echo "</td>";
	echo "</tr>";
		$i++;
	}
		echo "</table>";
}
}

/*
 * recolte détaillée pour vue par récolte
 */

function recoltelegume($rid, $rnbgp, $rnbpp) {
	#print_r($Recolteslegume);
#debug($recolteslegumes);
	$i = 0;
#	echo "id recolte: " .$rid;

$sql="SELECT * FROM recolteslegumes AS rl, legumes AS l, unites AS u  	 
WHERE rl.recolte_id=".$rid ." 
AND rl.legume_id=l.id 
AND rl.unite_id=u.id 
ORDER BY l.lib
";
/*
$sql="SELECT * FROM recolteslegumes AS rl, legumes AS l, unites AS u  	 
WHERE rl.recolte_id=".$rid ." 
AND rl.legume_id=l.id 
ORDER BY l.lib
";
*/
//echo "<pre>" .nl2br($sql) ."</pre>"; //tests

$sql=mysql_query($sql);
if(!$sql) {
	echo "<br>SQL error: ".mysql_error() ."<br>"; exit;
}
if(mysql_num_rows($sql)<1) {
	echo "Pas encore de légumes pour cette récolte";
		echo "<p><a href=\"../../recolteslegumes/add1?recolte=" .$rid."\">Ajouter des légumes à cette récolte</a></p>";

} else {
	echo "<h1><a href=\"../../recolteslegumes\">Légumes récoltés</a></h1>";
		echo "<p><a href=\"../../recolteslegumes/add1?recolte=" .$rid."\">Ajouter des légumes à cette récolte</a></p>";	echo "<em>Liste à compléter selon les indications de Claude</em><br />";
	echo "<table>
	<tr><th>Légume</th><th>Unité</th><th>QtéGP</th><th>QtéPP</th><th>QtéTotal</th><th>Prix moyen</th><th>Valeur</th></tr>";
	$i=0;
	while($i<mysql_num_rows($sql)) {
		if(($i/2)==(intval($i/2))) {
			$class="altrow";
		} else {
			$class="";
		}
	if(mysql_result($sql,$i,'u.lib')=="kg"){
		$diviseur=1000;
 }elseif (mysql_result($sql,$i,'u.lib')=="pièce"){
		$diviseur=1;
	} 

	echo "<tr class=\"".$class ."\"><td>";
		echo "<a href=\"../../recolteslegumes/edit/" .mysql_result($sql,$i,'rl.id')."\">" .mysql_result($sql,$i,'l.lib') ."</a>";
	
#		echo $html->link(mysql_result($sql,$i,'l.lib'),'/recolteslegumes/edit/'.mysql_result($sql,$i,'rl.id'));
		echo  "</td><td>";
		echo mysql_result($sql,$i,'u.lib');
		echo  "</td><td>";
		if(mysql_result($sql,$i,'rl.kg_pce_par_cornet_GP')>0){
			$qGP=mysql_result($sql,$i,'rl.kg_pce_par_cornet_GP');
		} elseif (mysql_result($sql,$i,'rl.cornets_par_caisse_GP')>0){
			$qGP=mysql_result($sql,$i,'rl.cornets_par_caisse_GP');
		} else {
			$qGP=0;
		}			
		if(mysql_result($sql,$i,'rl.kg_pce_par_cornet_PP')>0){
			$qPP=mysql_result($sql,$i,'rl.kg_pce_par_cornet_PP');
		} elseif (mysql_result($sql,$i,'rl.cornets_par_caisse_PP')>0){
			$qPP=mysql_result($sql,$i,'rl.cornets_par_caisse_PP');
		} else {
			$qPP=0;
		}
		echo intval(($rnbgp*$qGP)/$diviseur);
		echo "</td><td>";
		echo intval(($rnbpp*$qPP)/$diviseur);
		echo "</td><td>";
		
		$q=intval((($rnbgp*$qGP)+($rnbpp*$qPP))/$diviseur);

		echo $q;
		echo "</td><td>";
		//calcul prix moyen
		$prixminPER=mysql_result($sql,$i,'rl.prixminPER');
		$prixmaxPER=mysql_result($sql,$i,'rl.prixmaxPER');
		$prixminBIO=mysql_result($sql,$i,'rl.prixminBIO');
		$prixmaxBIO=mysql_result($sql,$i,'rl.prixmaxBIO');
		$PER=($prixminPER+$prixmaxPER)/2;
		$BIO=($prixminBIO+$prixmaxBIO)/2;
		$pm=($PER+$BIO)/2;
		echo intval($pm*100)/100;
		echo "</td><td>";
		echo intval($pm*$q) .".-";
			#echo "</td><td>";
		?>
<?
	echo "</td>";
	echo "</tr>";
		$i++;
	}
		echo "</table>";
}
}
######### HTML tools #######

/*convert SQL date time to french date*/
function dateSQLfr1($date) {
	$date=explode("-",$date);
	$date=$date[2] ."-" .$date[1] ."-" .$date[0];
	echo $date;
}

function dateSQL2fr($date) {
	$date=explode(" ", $date);
	$hour=$date[1];
	$date=$date[0];
	$date=explode("-", $date);
//	$date=mktime(0,0,0,$date[2],$date[1],$date[0]);
	$date=mktime(0,0,0,$date[1],$date[2],$date[0]);
	echo strftime("%a, %d-%m-%Y", $date);
}	

/*same but no day name (shorter)*/
function dateSQL2frSmall($date) {
	$date=explode(" ", $date);
	$hour=$date[1];
	$date=$date[0];
	$date=explode("-", $date);
	$date=mktime(0,0,0,$date[2],$date[1],$date[0]);
	echo strftime("%d-%m-%Y", $date);
}	

/*convert english short date to french short date*/
function dateen2fr($today1) {
#mois en francais - attention à le faire dans ce sens car Mar(s) < Mardi !
$today1 = preg_replace("/Jan/", "Janvier", $today1);
$today1 = preg_replace("/Feb/", "Février", $today1);
$today1 = preg_replace("/Mar/", "Mars", $today1);
$today1 = preg_replace("/Apr/", "Avril", $today1);
$today1 = preg_replace("/May/", "Mai", $today1);
$today1 = preg_replace("/Jun/", "Juin", $today1);
$today1 = preg_replace("/Jul/", "Juillet", $today1);
$today1 = preg_replace("/Aug/", "Août", $today1);
$today1 = preg_replace("/Sept/", "Septembre", $today1);
$today1 = preg_replace("/Oct/", "Octobre", $today1);
$today1 = preg_replace("/Nov/", "Novembre", $today1);
$today1 = preg_replace("/Dec/", "Décembre", $today1);

$today1 = preg_replace("/Mon/", "Lundi", $today1);
$today1 = preg_replace("/Tue/", "Mardi", $today1);
$today1 = preg_replace("/Wed/", "Mercredi", $today1);
$today1 = preg_replace("/Thu/", "Jeudi", $today1);
$today1 = preg_replace("/Fri/", "Vendredi", $today1);
$today1 = preg_replace("/Sat/", "Samedi", $today1);
$today1 = preg_replace("/Sun/", "Dimanche", $today1);

$today1=preg_replace("/-/"," ", $today1);

return $today1;
}
?>