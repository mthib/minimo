<div class="grid-x grid-padding-x align-center">
	<div class="large-10 cell textAlignCenter">
		<img src="assets/images/<?= $fileArticle->post_name(); ?>" class="imagePrincipale"/>
	</div>
</div>
 <div class="grid-x grid-padding-x align-center margeContenu">
	<div class="large-9 cell">
		<h2><?= strtoupper($article->post_category()); ?></h2>
		<h1><?= $article->post_title(); ?></h1>
		<p class="texte"><?= $article->post_content(); ?>
		</p>
	<!--	<h2>LEAVE A COMMENT</h2>-->
	</div>
</div>


