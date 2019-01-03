 <!DOCTYPE html>
<html>
  <head>
    <title>TP : Mini jeu de combat</title>
    
    <meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="public/css/style.css">
	 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" >
  </head>
  <body>
    <p><a href="?deconnexion=1">Déconnexion</a></p>
	<?php  if (isset($message)) // On a un message à afficher ?
	{
	  echo '<p><i class="fas fa-exclamation-triangle"></i> ', $message, '</p>'; // Si oui, on l'affiche.
	}
	?>
  
      <h2>Mes informations</h2>
      <p class="info">
	  
       <?= htmlspecialchars($perso->nom()) ?>&nbsp;
        
		<?php if($perso->type() == "magicien") echo '<i class="fas fa-hat-wizard"></i>';?>
	   <?php if($perso->type() == "guerrier") echo '<i class="fas fa-shield-alt"></i>';?>
                 <?= $perso->atout(); ?>&nbsp;
        <i class="fas fa-user-injured"></i> <?= $perso->degats() ?><br />
      </p>
    
	
	 <h2>Qui Frapper ?</h2>
<?php


  if (empty($persos))
  {
    echo 'Personne à frapper !';
  }
  elseif($perso->timeEndormi() > time() + 3600){
      echo "Un magicien vous a endormi. Heure du réveil : ";
      $date = date("H:i:s",$perso->timeEndormi());
      echo $date;
  }
  else
  {
	 ?>
		<table>
			<thead>
			<tr>
				<th>Nom</th>
				<th>Type</th>
				<th>Dégâts</th>
				
			</tr>
			</thead>
			<tbody>
	 <?php
    foreach ($persos as $unPerso)
    {
		if($unPerso->timeEndormi() > time() + 3600) echo '<tr class="endormi" >';
		else echo "<tr>";
	
      echo '<td><a href="?frapper=', $unPerso->id(), '" title="Frapper">', htmlspecialchars($unPerso->nom()),
      '</a></td><td>'.$unPerso->type().'</td><td>', $unPerso->degats(),
        '</td>';
        if($perso->type() == "magicien") echo '<td><a href="?lancerSort=',$unPerso->id(),'" title="Lancer un sort"><i class="fas fa-magic"></i></a></td>';
		
		if($unPerso->timeEndormi() > time() + 3600) echo '<td><i class="fas fa-lock"></i></td>';
		
        echo "</tr>";
    }
	?>
			</tbody>
		</table>
	<?php
  }
?>
     
  </body>
</html>
<?php
if (isset($perso)) // Si on a créé un personnage, on le stocke dans une variable session afin d'économiser une requête SQL.
{
  $_SESSION['perso'] = $perso;
}