<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Admin Minimo</title>
    
		<link rel="stylesheet" href="assets/css/foundation.css">
		<link rel="stylesheet" type="text/css" href="assets/css/admin.css">
		<link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet"> 
		<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
		
	</head>
	<body>

	<div class="grid-container">
      <div class="grid-x grid-padding-x align-center">
		<div class="large-12 cell">
		<div class="grid-x grid-padding-x header">
			<div class="large-3 medium-3 small-12 cell">
				<span><?= $_SESSION["user"];?></span>
				<button class="login-box-submit-button deconnexionButton" onclick="deconnexion()">DECONNEXION</button>
			</div>
			<div class="large-9 medium-9 small-12 cell">
				<ul class="vertical medium-horizontal menu">
					<li><a href="?section=pages">PAGES</a></li>
					<li><a href="?section=articles">ARTICLES</a></li>
					<li><a href="?section=categories">CATEGORIES</a></li>
					<li><a href="?section=medias">MEDIAS</a></li>
					<li><a href="?section=commentaires">COMMENTAIRES</a></li>
				</ul>	
			</div>
        </div>
        </div>
      </div>
	 
	  