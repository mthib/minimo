<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Admin Minimo</title>
    
		<link rel="stylesheet" href="assets/css/foundation.css">
		<link rel="stylesheet" type="text/css" href="assets/css/admin.css">
		
</head>
<body>
	<form action="" method="post">
		<div class="grid-x grid-padding-x align-center">
			<div class="small-12 medium-6 cell small-order-2 medium-order-1">
			  <div class="login-box-form-section">
				<h1 class="login-box-title">Identification</h1>
				<input class="login-box-input" type="text" name="username" placeholder="Pseudo" />
				<input class="login-box-input" type="password" name="password" placeholder="Mot de passe" />
				<input class="login-box-submit-button" type="submit" name="login_submit" value="Se connecter" />
				<p>Pas encore inscrit ? <a href="?creerCompte=true">Créer un compte</a></p>
				<?php if(!empty($message)) echo '<div class="errorLogin"><p>'.$message.'</p></div>';?>
			  </div>
			</div>
		</div>
	</form>
	
</body>
</html>