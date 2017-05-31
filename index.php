<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Projet Pinterest</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/isotope.pkgd.min.js"></script>
  </head>

  <body>
    <div class="container-fluid">
     <h1>PINTEREST-LIKE</h1>
       <div class="row">
         <div class="col-md-12">
           <form class="form-inline" action="assets/php/upload.php" method="post" enctype="multipart/form-data">
             <div class="form-group">               
               <button type="file" class="btn btn-success" name="fichier_upload" id="fichier_upload">Parcourir Vos images</button>
             </div>
             <div class="form-group">
              <button type="submit" class="btn btn-primary" value="Upload Image" name="submit">Placez votre image</button>
            </div>
           </form>
         </div>
       </div>


       <div class="grid" data-isotope='{ "itemSelector": ".grid-item", "layoutMode": "masonry" }'>
         <div class="grid-item">
           <div class="portfolio">
            <?php include 'assets/php/traitement.php' ?>
           </div>
         </div>
       </div>
    </div>
  </body>
</html>
