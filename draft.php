<?php 
include_once('inc/connexion.inc.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Draft des personages</title>
		<link rel="stylesheet" type="text/css" href="css/style_draft.css">
	</head>

	<body>
		<h1>Draft Lottery Smash Bros</h1>
		<h2></h2>

		<!-- Blue zone -->
		<article>
			<form action="draft.php" method="post">

				<!-- liste des persos Bzone -->
				<input type="submit" name="bluePick" value="Blue Zone">

				<!-- liste des perso Rzone -->
				<input type="submit" name="redPick" value="Red Zone">
			</form>
		</article>
	</body>
</html>


<?php

// Si je click sur bluepick
if (isset($_POST['bluePick'])) {

	// requete pour selectionner un perso au hasard dans la bdd
	$brequete = $draft->query('SELECT nom_perso, serie FROM characters 
								ORDER BY rand() ASC LIMIT 1');

	// ici, on affiche le personnage qui a été tiré au sort	
	 while($blue = $brequete->fetch()) {
	 	echo '<h2>' . $blue['nom_perso'] . ' - '. $blue['serie'] . '</h2>';

	// récupération des valeurs dans les variables qui serviront à leur insertion dans la table blue_zone
	$bname = $blue['nom_perso'];
	$bserie = $blue['serie'];
	}

	// insertion du perso dans la table blue_zone
	$blue_insert = $draft->prepare('INSERT INTO blue_zone(nom_perso, serie) VALUES(:nom_perso, :serie)');
	$blue_insert->bindValue(':nom_perso',$bname,PDO::PARAM_STR);
	$blue_insert->bindValue(':serie',$bserie,PDO::PARAM_STR);
	$blue_insert->execute();

}

// Si je click sur redpick
if (isset($_POST['redPick'])) {

	// requete pour selectionner un perso au hasard dans la bdd
	$redRequete = $draft->query('SELECT nom_perso, serie FROM characters ORDER BY rand() ASC LIMIT 1');

	while($red = $redRequete->fetch()) {
		echo '<h2>' . $red['nom_perso'] . ' - '. $red['serie'] . '</h2>';

	$rname = $red['nom_perso'];
	$rserie = $red['serie'];
	}

	$red_insert = $draft->prepare('INSERT INTO red_zone(nom_perso, serie) 
									VALUES(:nom_perso, :serie)');
	$red_insert->bindValue(':nom_perso',$rname,PDO::PARAM_STR);
	$red_insert->bindValue(':serie',$rserie,PDO::PARAM_STR);
	$red_insert->execute();
}

	// ALTER TABLE blue_zone AUTO_INCREMENT=0 (remettre ID à 0)
?>