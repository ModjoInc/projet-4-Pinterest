<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/isotope.pkgd.min.js"></script>
  </head>

  <body>
<div class="container">
  <div class="grid" data-isotope='{ "itemSelector": ".grid-item", "layoutMode": "masonry" }'>

      <div class="grid-item">
        <div class="portfolio">

        <?php
        // définition des variables utilisées
        $dossier_cible = "uploads/";
        $fichier_cible = $dossier_cible . basename($_FILES["fichier_upload"]["name"]);
        $erreurs = 1;
        $type_image = pathinfo($fichier_cible,PATHINFO_EXTENSION);

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
            echo "<p>Désolé, la taille de votre fichier dépasse la limite autorisée.</p>";
            $erreurs = 0;
        }

        // vérification du type d'image
        if( $type_image != "jpg" && $type_image != "png" && $type_image != "jpeg"
        && $type_image != "gif" && $type_image != "WebP") {
            echo "<p>Désolé seuls les formats JPG, JPEG, PNG & GIF sont autorisés.</p>";
            $erreurs = 0;
        }

        // vérification erreurs
        if ($erreurs == 0) {
            echo "<p>Désolé votre fichier n'a pas pu être uploadé.</p>";

        // si pas d'erreurs upload du fichier
        } else {
            if (move_uploaded_file($_FILES["fichier_upload"]["tmp_name"], $fichier_cible)) {
                echo "<p>Le fichier <strong>". basename( $_FILES["fichier_upload"]["name"]). "</strong> a bien été uploadé.</p>";
            } else {
                echo "<p>Désolé il y a eu une erreur lors de l'upload de votre fichier.</p>";
            }
        }
        ?>
        </div>
      </div>

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

       <div class="grid-item">
         <p><a href="index.php">retour vers upload</a></p>
       </div>

     </div>
    </div>
  </body>
</html>
