<?php
// définition des variables: chemin vers dossier et array reprenant les uploads
  $uploads = './uploads';
  $fichier = scandir($uploads,1);

// boucle foreach pour afficher les images contenues dans l'array
  foreach ($fichier as $key) {
     echo '<div class="grid-item">';
     echo '<div class="portfolio">';
     echo '<img src="'.$uploads.'/'.$key.'">';
     echo '</div>';
     echo '</div>';
  }
?>
