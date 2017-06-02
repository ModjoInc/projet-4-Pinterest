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
      <h1>PINTEREST-LIKE</h1>
    </header>
<div class="container-fluid">
  <div class="remodal-bg">
       <div class="row">
         <div class="col-md-12">
           <form class="form-inline" action="" method="post" enctype="multipart/form-data">
             <div class="form-group">
               <h2>1</h2><label class="btn btn-primary" for="fichier_upload">Parcourir</label><input class="browse" type="file" name="fichier_upload" id="fichier_upload">
             </div>
             <div class="form-group">
              <h2>2</h2><button type="submit" class="btn btn-primary" value="Upload Image" name="submit">Placez votre image</button>
            </div>
           </form>
         </div>

       </div>
       <div class="row">
         <div class="col-md-12">
          <h1>Portfolio</h1>
        </div>
      </div>
       <div class="grid" data-isotope='{ "itemSelector": ".grid-item", "getSortData": { "name": ".name", "category": "[data-category]" }, "masonry": { "columnWidth": 200 } }'>

         <?php
         include 'assets/php/upload.php'
         ?>

       </div>
     </div>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../libs/jquery/dist/jquery.min.js"><\/script>')</script>
    <script src="assets/modal/dist/remodal.js"></script>
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <script src="assets/modal/dist/remodal.min.js"></script>
    <script src="assets/js/loading.js"></script>
    <script src="assets/js/imagesloaded.pkgd.js"></script>
    <script>
      $('[data-remodal-id=modal2]').remodal({
      modifier: 'with-red-theme'
      });
    </script>



  </body>
</html>
