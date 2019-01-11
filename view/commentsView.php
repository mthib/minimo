<?php 
$compteur = 0;
$nbComments = count($comments);
?>

<div class="grid-x grid-padding-x align-center">
	<div class="large-9 cell ">
		<!-- comments -->
		<div class="comment-section-container">
			<?php
			// affiche le nombre de commentaires
			  if($compteur == 0)	{
				echo '<h2>'.$nbComments.' COMMENT';
				
				// met un S a comment si necessaire
				if($nbComments > 1) echo 'S</h2>';
				else echo '</h2>';
			}
			foreach($comments as $comment)
			{
				?>
				<div class="comment-section-author">
					<div class="comment-section-name">
						<h3><?= $comment->comment_name();?></h3> 
						<p>
						<?php
							$date_time = new DateTime( $comment->comment_date());	
							$intl_date_formatter = new IntlDateFormatter('fr_FR',
																		 IntlDateFormatter::FULL,
																		 IntlDateFormatter::SHORT);

							// Affichera (par exemple): Mardi 8 Janvier 2019 07:00 
							echo ucwords($intl_date_formatter->format($date_time));
							?></p>
					</div>
				</div>
				<div class="comment-section-text texte">
					<p><?= $comment->comment_content();?>
					</p>
				</div>
			<?php
				$compteur++;
			}			
			?>
		</div>
		<!--/comments-->

		<!-- comment form -->
		<form id="connexion" action="model/addComment.php" method="post">
		  <div class="comment-section-box">
			  <div class="small-12 cell">
				<h3>Ajouter un commentaire</h3>
					<input type="hidden" id="post_id" name="post_id" value="<?= $post_id;?>">
				<label>Name
				  <input type="text" id="comment_name" name="comment_name">
				</label>
				<label>Email
				  <input type="text" id="comment_email" name="comment_email">
				</label>
				<label>Comment
				  <textarea rows="5" type="text" id="comment_content" name="comment_content"></textarea>
				</label>
				<button class="button expanded couleurButton" type="submit">Envoyer</button>
			  </div>
		  </div>
		</form>
		<!--/comment box-->
	</div>
</div>
