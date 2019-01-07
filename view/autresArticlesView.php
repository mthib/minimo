<?php 
$compteur = 0;
$nbArticles = count($articlesFiles);

foreach($articlesFiles as $element)
{
	if(($compteur % 3) == 0)
	{		// ouvre une div au premier article
		echo '<div class="grid-x grid-padding-x align-center">
				<div class="large-9 cell backgroundGrey">';
		if($compteur == 0)	echo '<h2>YOU MAY ALSO LIKE</h2>';
		echo	'<div class="grid-x grid-padding-x">';
	}
	
	echo '<div class="large-4 medium-4 cell">';
	echo '<img src="assets/images/'.$element[1]->post_name().'"/>'; // element[1] => objet file
	echo '<h1 class="petitH1">'.$element[0]->post_title().'</h1>';
	echo '</div>';
	
	if(($compteur % 3) == 2 || $compteur == $nbArticles - 1)
		echo '</div></div></div>'; // ferme la div au deuxieme article
	
	$compteur++;
}

		
			
	