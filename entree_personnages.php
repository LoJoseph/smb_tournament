<?php
// connexion à la base de données
$DSN = 'mysql:host=localhost;dbname=super_smash_bros';
$tsukaenohito = 'root';
$mdp = '';
$options = [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
];

$smashbros = new PDO ($DSN,$tsukaenohito,$mdp,$options);

// création des variables
$nom = (!empty($_POST['nom_perso'])) ? strip_tags($_POST['nom_perso']) : '';
$color = (!empty($_POST['couleur'])) ? strip_tags($_POST['couleur']) : '';
$license = (!empty($_POST['serie'])) ? strip_tags($_POST['serie']) : '';
$amiibo = (!empty($_POST['amiibo'])) ? strip_tags($_POST['amiibo']) : '';



if(isset($_POST['ajouter'])) {

	if(!empty($nom) && !empty($color) && !empty($license) && !empty($amiibo)){

		$verif = $smashbros->prepare('SELECT nom_perso FROM characters WHERE nom_perso = :nom_perso');
		$verif->bindValue(':nom_perso',$nom,PDO::PARAM_STR);
		$verif->execute();

		if($verif->rowCount() > 0){

			$message = '<p class="alert">attention ce perso existe déjà!</P>';
			echo $message;

			
		} else {

				$ajout =  $smashbros->prepare("INSERT INTO characters(nom_perso,couleur,série,amiibo) 
													VALUES (:nom_perso,:couleur,:serie,:amiibo)");

				$ajout->bindValue(':nom_perso',$nom,PDO::PARAM_STR);
				$ajout->bindValue(':couleur',$color,PDO::PARAM_STR);
				$ajout->bindValue(':serie',$license,PDO::PARAM_STR);
				$ajout->bindValue(':amiibo',$amiibo,PDO::PARAM_STR);
				$ajout->execute();

				echo '<p class="agree">' . $_POST['nom_perso'] . ' a bien été ajouté!</P>';
		}

	} else {
		$message = 't\'as oublié un champs!';
	}
}
?>


<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8" />
		<title>Enregistrement des persos</title>
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>

		<h1>Formulaire d'entrée des persos</h1>
		<img src="img/super_smash_bros.png" >
		<main>

			<section class="formulaire">
				<form action="entree_personnages.php" method="POST" >

					<input type="text" name="nom_perso" placeholder="Nom du personnage">
					<input type="text" name="couleur" placeholder="Couleur dominante">
					<input type="text" name="serie" placeholder="Série">
					<input type="radio" id="oui" name="amiibo" value="Oui">Amiibo possédé
					<input type="radio" id="non" name="amiibo" value="Non">Pas d'amiibo pour ce perso
					<input class="submitBtn"  type="submit" name="ajouter" value="Ajouter" >
				

				</form>
			</section>
			
		</main>
		

		<script type="text/javascript" src="js/script.js"></script>
	</body>
</html>