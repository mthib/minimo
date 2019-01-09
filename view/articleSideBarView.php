<div class="grid-x grid-padding-x align-center">
	<div class="large-10 cell textAlignCenter">
		<img src="assets/images/<?= $fileArticle->post_name(); ?>" class="imagePrincipale"/>
	</div>
</div>
 <div class="grid-x grid-padding-x align-center ">
	<div class="large-9 large-offset-1 cell">
		<div class="grid-x grid-padding-x align-center margeContenu">
		<div class="large-9 cell">
			<h2><?= strtoupper($article->post_category()); ?></h2>
			<h1><?= $article->post_title(); ?></h1>
			<p class="texte"><?= $article->post_content(); ?>
			</p>
			<span class="barShare">
				<h2 class="h2Inline">SHARE</h2>&nbsp;&nbsp;&nbsp;
				<i class="fab fa-facebook-f"></i>&nbsp;
				<i class="fab fa-twitter"></i>&nbsp;
				<i class="fab fa-google-plus-g"></i>&nbsp;
				<i class="fab fa-pinterest-p"></i>&nbsp;&nbsp;
			</span>
		</div>
		<div class="large-3 cell">
			<img src="assets/images/photo1.jpg" />
			<h1 class="petitH1">About Me</h1>
			<p class="texte">Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.
			</p>
			<i class="fab fa-facebook-f"></i>&nbsp;
			<i class="fab fa-instagram"></i>&nbsp;
			<i class="fab fa-pinterest-p"></i>&nbsp;
			<h2>TOP POSTS</h2>
			<ul>
			<?php 
			//comment[0] => titre de l'article
			//comment[1] => nombre de commentaires de l'article
			//comment[2] => id de l'article
				foreach($comments as $comment)
				{
					echo '<li><a href="?post_id='.$comment[2].'" class="couleurLien">'.$comment[0].'</a></li>';
					echo '<h4>'.$comment[1].' COMMENTS</h4>';
				}
			?>
			</ul>
	
		</div>
		</div>
	</div>
</div>
