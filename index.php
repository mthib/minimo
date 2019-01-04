<?php

require('controller/frontend.php');

createHeader();
firstArticle();
displayArticles();
displayFormNewsletter();

include 'view/footer.php';