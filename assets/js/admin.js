function loadImage() {
	document.getElementById('imagePage').src = "assets/images/"+document.getElementById('selectImage').value;
}

function deconnexion() {
	window.location = "?deconnexion=true";
}