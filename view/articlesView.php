<?php 
$compteur = 0;
foreach($articlesFiles as $element)
{
	if(($compteur % 2) == 0) // ouvre une div au premier article
		echo '<div class="grid-x grid-padding-x align-center margeContenu">
				<div class="large-9 cell">';
	
	echo '<div class="large-6 medium-6 cell">';
	echo '<img src="assets/images/'.$element[1]->post_name().'"/>'; // element[1] => objet file
	echo '<h2>'.strtoupper($element[0]->post_category()).'</h2>';	// element[0] => objet article
	echo '<h1>'.$element[0]->post_title().'</h1>';
	echo '<p class="texte">'.substr($element[0]->post_content(),0,200).'...</p>'; // affiche les 200 premiers caracteres du contenu
	echo '</div>';
	
	if(($compteur % 2) == 1)
		echo '</div></div>'; // ferme la div au deuxieme article
	
	$compteur++;
}
?>
	
		
			
			
			
			