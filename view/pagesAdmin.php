<div class="grid-x grid-padding-x align-center">
	<div class="large-10 cell">
		<div class="grid-x grid-padding-x align-center">
			<div class="large-3 cell">
			<ul>
				<?php 
				foreach($titles as $title) {
					// $title[0] = titre de l'article, $title[1] = id de l'article
					echo '<li><a href="?section=pages&post_id='.$title[1].'">'.$title[0].'</a></li>';
				}
				?>
			</ul>
			</div>
			<div class="large-9 cell">
				<div class="login-box-form-section">
					<form action="" method="post">
						<input type="hidden" name="page_id" value="<?= $page->id();?>" />
						<input class="login-box-input" type="text" name="page_title" value="<?= $page->post_title();?>" />
						<select name="page_category">
						<?php
							foreach($categories as $category){
								echo '<option value="'.$category.'" ';
								if(strcmp($category,$page->post_category())==0) echo "selected";
								echo '>'.ucfirst($category).'</option>';
							}
							
						?>
						</select>
						<textarea rows="10" type="text" name="page_content"><?= $page->post_content();?></textarea>		
						<select id="selectImage" name="page_image" onchange="loadImage()">
						<?php
							foreach($images as $image){
								echo '<option value="'.$image.'" ';
								if(strcmp($image,$fileArticle->post_name())==0) echo "selected";
								echo '>'.ucfirst($image).'</option>';
							}
							
						?>
						</select>
						<img id="imagePage" src="assets/images/<?= $fileArticle->post_name(); ?>" />
						<br/>
						<br/>
						<input class="login-box-submit-button" type="submit" name="page_submit" value="ENREGISTRER" />
						<br/>
					</form>
				</div>
			</div>
		</div>	
	</div>
</div>