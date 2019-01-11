<div class="grid-x grid-padding-x align-center">
	<div class="large-10 cell">
		<div class="grid-x grid-padding-x align-center">
			<div class="large-3 medium-3 cell">
			<ul>
				<?php 
				foreach($titles as $title) {
					// $title[0] = titre de l'article, $title[1] = id de l'article
					echo '<li><a href="?section='.$type.'s&post_id='.$title[1].'">'.$title[0].'</a></li>';
				}
				?>
			</ul>
			<button class="login-box-submit-button" onclick="window.location = window.location.href+'&newPage=true'">
			<?php	if($type == "page") echo "NOUVELLE PAGE";
					else echo "NOUVEL ARTICLE";
			?>
			</button>
			</div>
			<div class="large-9 medium-9 cell">
				<div class="login-box-form-section">
					<form action="" method="post">
						<input type="hidden" name="page_id" value="<?= $page->id();?>" />
						<input type="hidden" name="page_type" value="<?= $type;?>" />
						<div class="grid-x grid-padding-x	">
							<div class="large-9 medium-9 cell">
								<input class="login-box-input" type="text" name="page_title" value="<?= $page->post_title();?>" />
							</div>
							<div class="large-3 medium-3 cell">
								<!-- primary color is also the default color -->
								 <div class="switch-toggle-wrapper">
									<span class="publier">PUBLIER</span>
									<div class="switch">
									  <input class="switch-input" id="exampleSwitch5" name="page_publish" type="checkbox" <?php if($page->post_status() == "publish")  echo "checked"; ?>>
									  <label class="switch-paddle" for="exampleSwitch5">
										<span class="show-for-sr">push notifications</span>
									  </label>
									</div>						
								  </div>
							</div>
						</div>
						<select name="page_category">
						<?php
							/*if(isset($_GET["newPage"]) && $_GET["newPage"] == "true")
								echo '<option value="0">Sélectionner une catégorie</option>';*/
							
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
						/*	if(isset($_GET["newPage"]) && $_GET["newPage"] == "true") 
									echo '<option value="0">Sélectionner une image</option>';*/
									
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
						<div class="grid-x grid-padding-x align-center">
							<div class="small-6 cell">
								<input class="login-box-submit-button" type="submit" name="page_submit" value="ENREGISTRER" />
							</div>
							<div class="small-6 cell">
								<input class="login-box-submit-button redButton" type="submit" name="page_delete" value="SUPPRIMER" />
							</div>
						</div>
						<br/>
					</form>
				</div>
			</div>
		</div>	
	</div>
</div>