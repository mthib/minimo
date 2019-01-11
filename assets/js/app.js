
$(document).ready(function() {
  // Action qui est exécutée quand le formulaire est envoyé ( #connexion est l'ID du formulaire)
  $('#connexion').on('submit', function(e) {
    e.preventDefault(); // On empêche de soumettre le formulaire
 
    var $this = $(this); // L'objet jQuery du formulaire
 
    // Envoi de la requête HTTP en mode asynchrone
    $.ajax({
      url: $this.attr('action'), // On récupère l'action (ici action.php)
      type: $this.attr('method'), // On récupère la méthode (post)
      data: $this.serialize(), // On sérialise les données = Envoi des valeurs du formulaire
      dataType: 'json', // JSON
      success: function(json) { // Si ça c'est passé avec succès
        // ici on teste la réponse
        if(json.reponse === true) {
          
          // On actualise la page
			window.location.reload();
        } else {
          alert('Erreur : '+ json.reponse);
        }
      }
    });
 
  });
  
  $('#newsletterForm').on('submit', function(e) {
    e.preventDefault(); // On empêche de soumettre le formulaire
 
    var $this = $(this); // L'objet jQuery du formulaire
 
    // Envoi de la requête HTTP en mode asynchrone
    $.ajax({
      url: $this.attr('action'), // On récupère l'action (ici action.php)
      type: $this.attr('method'), // On récupère la méthode (post)
      data: $this.serialize(), // On sérialise les données = Envoi des valeurs du formulaire
      dataType: 'json', // JSON
      success: function(json) { // Si ça c'est passé avec succès
        // ici on teste la réponse
        if(json.reponse === true) {
			alert("Vous avez bien été inscrit à la newsletter");
			//on vide le champ apres enregistrement
			document.getElementById("emailNewsletter").value = "";
        } else {
          alert('Erreur : '+ json.reponse);
        }
      }
    });
 
  });
	  
	$("#loadMoreButton").click(function(){
	  $.ajax({
			url: "model/loadMore.php",
			success: function(result){
			var divArticles = document.getElementById("divArticles");
			divArticles.innerHTML += result;
			// masque le bouton read more si besoin
			if(document.getElementById("finArticles").value == "fin")
				document.getElementById("loadMoreButton").style.display = "none";
		  }
		 });
	});
  
});



