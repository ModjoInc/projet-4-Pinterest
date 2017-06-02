
<?php
  // Code PHP pour l'upload & définition des variables utilisées

  $dossier_cible = "./uploads/";
  $fichier_cible = $dossier_cible . basename($_FILES["fichier_upload"]["name"]);
  $erreurs = 1;
  $type_image = pathinfo($fichier_cible,PATHINFO_EXTENSION);
  echo '<div class="hide">';

  // vérification que le fichier soit une image
  if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fichier_upload"]["tmp_name"]);
      if($check !== false) {
          echo "<p>Le fichier est une image - " . $check["mime"] . " .</p>";
          $erreurs = 1;
      } else {
          echo "<p>Le fichier n'est pas une image.</p>";
          $erreurs = 0;
      }
  }

  // vérification de doublon
  if (file_exists($fichier_cible)) {
      echo "<p>Désolé, le fichier existe déjà.</p>";
      $erreurs = 0;
  }

  // vérification de la taille de l'image max=500Kb
  if ($_FILES["fichier_upload"]["size"] > 500000) {
      echo "<p>La taille de votre fichier dépasse la limite autorisée.</p>";
      $erreurs = 0;
  }

  // vérification du type d'image
  if( $type_image != "jpg" && $type_image != "png" && $type_image != "jpeg"
  && $type_image != "gif" && $type_image != "WebP") {
      echo "<p>Seuls les formats JPG, JPEG, PNG & GIF sont autorisés.</p>";
      $erreurs = 0;
  }

  // vérification erreurs
  if ($erreurs == 0) {
      echo "<p>Votre fichier n'a pas pu être uploadé.</p>";

  // si pas d'erreurs upload du fichier
  } else {
      if (move_uploaded_file($_FILES["fichier_upload"]["tmp_name"], $fichier_cible)) {
          echo "<p>Le fichier <strong>". basename( $_FILES["fichier_upload"]["name"]). "</strong> a bien été uploadé.</p>";
      } else {
          echo "<p>Il y a eu une erreur lors de l'upload de votre fichier.</p>";
      }
  }



    //simple image
    require './assets/src/claviska/SimpleImage.php';


      $thumbnail = "./miniatures/";
      $miniature_cible = $thumbnail . basename($_FILES["fichier_upload"]["name"]);
      $overlay = "./img/overlay.png";
      $anchor = "bottom";
      $opacity = "0.7";
      $anchor = "bottom";
    try {
      $image = new \claviska\SimpleImage();
      $image->fromFile($fichier_cible);
      $image->thumbnail(200, 200);
      $image->border('#25283d', 10);
      $image->overlay($overlay, $anchor, $opacity);
      $image->toFile($miniature_cible);

      } catch(Exception $err) {
        echo $err->getMessage();
      }
      echo '</div>';


    //miniatures et modal

      // définition des variables: chemin vers dossier et array reprenant les uploads
        $fichier = array_diff(scandir($thumbnail,1), array('..', '.'));

      // boucle foreach pour afficher les images contenues dans l'array

        foreach ($fichier as $key) {
           echo '<div class="grid-item">';
           echo '<a href="#' . $key . '"><img src="'.$thumbnail.'/'.$key.'"></a><br>';
           echo '<div class="remodal" data-remodal-id="' . $key . '" role="dialog">';
           echo '<button data-remodal-action="close" class="remodal-close"></button>
           <div>
             <h2 id="modal1Title">Votre image</h2>
             <p id="modal1Desc"><a href="uploads/' . $key . '"><img src="uploads/' .$key . '"></a><br></p>
           <br>
            <button data-remodal-action="cancel" class="remodal-cancel">Cancel</button>
            <button data-remodal-action="confirm" class="remodal-confirm">OK</button></div></div></div>';
         }


?>
