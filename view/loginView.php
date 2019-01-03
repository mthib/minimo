 <!DOCTYPE html>
<html>
  <head>
    <title>TP : Mini jeu de combat</title>
    
    <meta charset="utf-8" />
  </head>
  <body>
		<p>Nombre de personnages créés : <?= $nbPersonnages;?></p>
	<?php  if (isset($message)) // On a un message à afficher ?
	{
	  echo '<p>', $message, '</p>'; // Si oui, on l'affiche.
	}
	?>
		<form action="" method="post">
		  <p>
			Nom : <input type="text" name="nom" maxlength="50" />
			Type : <select name="type">
					  <option value="magicien">Magicien</option>
					  <option value="guerrier">Guerrier</option>
					</select>
			<input type="submit" value="Créer ce personnage" name="creer" />
			<input type="submit" value="Utiliser ce personnage" name="utiliser" />
		  </p>
		</form>
	</body>
</html>
<?php
if (isset($perso)) // Si on a créé un personnage, on le stocke dans une variable session afin d'économiser une requête SQL.
{
  $_SESSION['perso'] = $perso;
}