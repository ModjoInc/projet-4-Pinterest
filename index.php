<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Projet Pinterest</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/modal/dist/remodal.css">
    <link rel="stylesheet" href="assets/modal/dist/remodal-default-theme.css">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>

  <body>
    <header>
      <div class="imgH">
        <img src="img/logo.png" alt="logo">
      </div>
    </header>

  <div class="remodal-bg">

    <div class="container-fluid">
      <div class="col-md-12">
       <!--formulaire-->
        <form class="form-inline" action="" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <h2>1</h2><label class="btn btn-primary" for="fichier_upload">Parcourir</label><input class="browse" type="file" name="fichier_upload" id="fichier_upload">
          </div>
          <div class="form-group ">
            <img class="arrow" src="img/arrow.png" alt="next">
          </div>
          <div class="form-group">
            <h2>2</h2><button type="submit" class="btn btn-primary" value="Upload Image" name="submit">Placez votre image</button>
         </div>
        </form>
      </div>
        <div class="col-md-6 col-md-offset-3 infos">
<?php

            // Code PHP pour l'upload & définition des variables utilisées
  try {
    $dossier_cible = 'uploads/';
    if (isset($_POST['submit'])) {
      $fichier_cible = $dossier_cible . basename($_FILES["fichier_upload"]["name"]);
      $type_image = pathinfo($fichier_cible,PATHINFO_EXTENSION);
    }
    $erreurs = 1;
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
  }

 ?>
       </div>

        <div class="col-md-12">
          <h1>Portfolio</h1>
        </div>
      </div>
      <div class="container">


    <!--  <div class="col-md-12">-->
        <div class="grid" data-isotope='{ "itemSelector": ".grid-item", "getSortData": { "name": ".name", "category": "[data-category]" }, "masonry": { "columnWidth": 50 } }'>

<?php
   //simple image
   require 'assets/src/claviska/SimpleImage.php';


     $thumbnail = "miniatures/";
     $miniature_cible = $thumbnail . basename($_FILES["fichier_upload"]["name"]);
     $overlay = "img/overlay.png";
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
       $erreursDisplay = $err->getMessage();
     }


   //miniatures et modal

     // définition des variables: chemin vers dossier et array reprenant les uploads
       $fichier = array_diff(scandir($thumbnail,1), array('..', '.'));

     // boucle foreach pour afficher les images contenues dans l'array
       foreach ($fichier as $key) {
          echo '<div class="grid-item">';
          echo '<a href="#' . $key . '"><img src="'.$thumbnail.'/'.$key.'"></a><br></div>';
          echo '<div class="remodal" data-remodal-id="' . $key . '" role="dialog">';
          echo '<button data-remodal-action="close" class="remodal-close"></button>
          <div>
            <h2 id="modal1Title">Votre image</h2>
            <p id="modal1Desc"><a href="uploads/' . $key . '"><img class="limit" src="uploads/' .$key . '"></a><br></p>
          <br>
           <button data-remodal-action="cancel" class="remodal-cancel">Cancel</button>
           <button data-remodal-action="confirm" class="remodal-confirm">OK</button></div></div>';
        }
      } catch (Exception $e) {
        $erreursDisplay1 = $err->getMessage();
      }
?>
          </div>
        </div>

      <div class="container-fluid">
        <div class="col-md-6 col-md-offset-3 infos">
          <?php
          if ($e) {
            echo $erreursDisplay;
            echo $erreursDisplay1;
          }

            ?>
        </div>
      </div>
   </div>
 <footer>&copy; 2017 Pin-It</footer>

<!--SCRIPTS-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"><\/script>')</script>
<script src="assets/modal/dist/remodal.js"></script>
<script src="assets/js/isotope.pkgd.min.js"></script>
<script src="assets/modal/dist/remodal.min.js"></script>
<script src="assets/js/imagesloaded.pkgd.js"></script>
<script src="assets/js/loading.js"></script>
<script>
  $('[data-remodal-id=modal2]').remodal({
  modifier: 'with-red-theme'
  });
</script>
  </body>
</html>
