<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Minimo</title>
    
		<link rel="stylesheet" href="assets/css/foundation.css">
		<link rel="stylesheet" type="text/css" href="assets/css/app.css">
		<link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet"> 
		<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

		
	</head>
	<body>

	<div class="grid-container">
      <div class="grid-x grid-padding-x align-center">
		<div class="large-10 cell">
		<div class="grid-x grid-padding-x header">
			<div class="large-3 medium-3 small-12 cell">
				<a href="<?= $_SERVER['PHP_SELF'];?>"><img src="assets/images/logo_minimo.png" class="logo"/></a>
			</div>
			<div class="large-9 medium-9 small-12 cell">
				<ul class="vertical medium-horizontal menu">
					<?php
				foreach($categories as $category)
					echo '<li><a href="?category='.$category.'">'.strtoupper($category).'</a></li>';
					?>
				</ul>	
			</div>
        </div>
        </div>
      </div>
	 
	  