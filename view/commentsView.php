<?php 
$compteur = 0;
$nbComments = count($comments);

foreach($comments as $comment)
{
		// ouvre une div au premier article
		echo '<div class="grid-x grid-padding-x align-center">
				<div class="large-9 cell">';
		if($compteur == 0)	{
			echo '<h2>'.$nbComments.' COMMENT';
			
			// met un S a comment si necessaire
			if($nbComments > 1) echo 'S</h2>';
			else echo '</h2>';
		}

		echo '<h3>'.$comment->comment_name().'</h3>';
		echo '<p class="texte">'.$comment->comment_content().'</p>';

		echo '</div></div>'; // ferme la div au deuxieme article
	
	$compteur++;
}