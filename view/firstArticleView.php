<div class="grid-x grid-padding-x">
	<div class="large-12 cell textAlignCenter">
		<img src="assets/images/<?= $fileFirstArticle->post_name(); ?>" class="imagePrincipale"/>
	</div>
</div>
 <div class="grid-x grid-padding-x align-center margeContenu">
	<div class="large-9 cell">
		<h2><?= strtoupper($firstArticle->post_category()); ?></h2>
		<h1><?= $firstArticle->post_title(); ?></h1>
		<p class="texte"><?= $firstArticle->post_content(); ?>
		</p>
		<h2>LEAVE A COMMENT</h2>
	</div>
</div>


