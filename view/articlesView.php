<?php 
$compteur = 0;
$nbArticles = count($articlesFiles);
foreach($articlesFiles as $element)
{
	if($compteur % 2 == 0) // ouvre une div au premier article
		echo '<div class="grid-x grid-padding-x align-center margeContenu">
				<div class="large-9 cell">
					<div class="grid-x grid-padding-x">';
	
	echo '<div class="large-6 medium-6 cell">';
	echo '<a href="?post_id='.$element[0]->id().'"><img src="assets/images/'.$element[1]->post_name().'"/></a>'; // element[1] => objet file
	echo '<h2>'.strtoupper($element[0]->post_category()).'</h2>';	// element[0] => objet article
	echo '<a href="?post_id='.$element[0]->id().'"><h1>'.$element[0]->post_title().'</h1></a>';
	echo '<p class="texte">'.substr($element[0]->post_content(),0,200).'...</p>'; // affiche les 200 premiers caracteres du contenu
	echo '</div>';
	
	if($compteur % 2 == 1 || $compteur == $nbArticles - 1)
		echo '</div></div></div>'; // ferme la div au deuxieme article
	
	$compteur++;
}

		
			
			
			
			