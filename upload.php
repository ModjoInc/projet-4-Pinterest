<?php
ini_set('post_max_size', '10M');
ini_set('upload_max_filesize', '10M');
ini_set('memory_limit', '1000M');
ini_set('max_execution_time', '1920');
ini_set('file_uploads', 'On');
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
print_r($target_file);
print_r($imageFileType);
print_r($uploadOk);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "<p>Le fichier est une image - " . $check["mime"] . " .</p>";
        $uploadOk = 1;
    } else {
        echo "<p>Le fichier n'est pas une image.</p>";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "<p>Désolé, le fichier existe déjà.</p>";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "<p>Désolé, la taille de votre fichier dépasse la limite autorisée.</p>";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "WebP") {
    echo "<p>Désolé seuls les formats JPG, JPEG, PNG & GIF sont autorisés.</p>";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "<p>Désolé votre fichier n'a pas pu être uploadé.</p>";

// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "<p>Le fichier ". basename( $_FILES["fileToUpload"]["name"]). " a bien été uploadé.</p>";
    } else {
        echo "<p>Désolé il y a eu une erreur lors de l'upload de votre fichier.</p>";
    }
}

$uploads = './uploads';
$fichier = scandir($uploads,1);

echo "<pre>";
print_r($fichier);
echo "</pre>";
?>


<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
   <p><a href="index.php"></a></p>
  </body>
</html>
