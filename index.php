<!DOCTYPE html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

<!-- Bootstrap CSS -->
<link
rel="stylesheet"
href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
crossorigin="anonymous"/>
<link href="style.css" rel="stylesheet" />
<title>UPLOAD FILE</title>
</head>
<!-- ---------------------------------BODY-------------------------------------- -->
<body>
  
<?php
    include 'affichage.php';
    include 'msgErreur.php';
    $display="none";
    $msgErreur=[];
   
    if(!empty($_FILES)){      
      $erreur = $_FILES['fichier']['error'];
      $size = $_FILES['fichier']['size'];
      $type = $_FILES['fichier']['type'];
      $name = $_FILES['fichier']['name'];

      //On affiche uniquement les fichiers n'ayant aucune erreur
      foreach ($erreur as $key => $er) {

          if ($er == 0 && ($size[$key] < 1000000) &&
              (($type[$key] === "image/gif") ||
              ($type[$key] === "image/jpeg") ||
              ($type[$key] === "image/png"))) {

              // chemin vers un dossier sur le serveur qui va recevoir les fichiers uploadés (attention ce dossier doit être accessible en écriture)
              $uploadDir = 'upload';

              //On récupère l'extension a partir du type mime
              $extension = explode("/", $_FILES['fichier']['type'][$key])[1];

              //Les nouveaux noms de fichiers sont placés dans le tableau $uploadFile[]
              $uploadFile = $uploadDir . '/' . 'image' . uniqid() . '.' . $extension;

              // on déplace les fichiers temporaires vers le nouvel emplacement ici upload sur le serveur.
              move_uploaded_file($_FILES['fichier']['tmp_name'][$key], $uploadFile);

          } //end if $er==0 et taille et type
          else {
              $tmpErreur=msgErreur($key,$name[$key],$er,$size[$key],$type[$key]);
              $msgErreur[$key]=$tmpErreur;
          }
      } //fin foreach erreur
    }//fin if isset $_FILES
    /******************** Affichage à partir du dossier upload**********************/

      $fileInUpload = [];
      $it = new FilesystemIterator('upload');
      foreach ($it as $fileinfo) {
          array_push($fileInUpload, $fileinfo->getFilename());
          sort($fileInUpload);
      } 
         
  ?>

<!-------------------Bloc div gestion d'erreurs ------------------>
<div class="container-fluid">
   <h3 class="text-center">TELECHARGER FICHIER(S)</h3>
   <div class="row">

   <?php if (!empty($msgErreur)) { 
   $display="block";   
   ?>     
  
    <div class="error w-100" style="display:<?php echo $display ?>;">
      <ul>
      <?php 
        foreach ($msgErreur as $key => $er) {
       
      ?>
        <li class="font-weight-bold">
          <?php echo "$er[msgFile]"; ?>         
        </li>
        <span><?php echo "$er[msgErreur]"; ?></span>
        <span><?php echo "$er[msgSize]"; ?></span>
        <span><?php echo "$er[msgType]"; ?></span>

      <?php } ?>

      </ul>
    </div>

  <?php 
  $msgErreur=[];
  } ?>
    <!--------------------fin error ----------------------------->

    <!------ -----Formulaire de saisie des fichiers à télécharger dans upload ------->
    <form action="" method="post" enctype="multipart/form-data" class="col-12 form d-flex justify-content-between">
      <input type="file" name="fichier[]" multiple="multiple" class="file "/>
      <div>
        <input type="submit" value="Envoyer" class="bg-primary text-white h-100 rounded" />
        <a href="http://localhost:8000/index.php">
          <input type="button" value="Annuler" class="bg-primary text-white h-100 rounded" />
        </a>
      </div>
    </form>
    
    <!------ -----Fin Formulaire de saisie ------------------------------------------>

    <?php 
    //Affichons les vignettes
    if (!empty($fileInUpload)) {

      foreach ($fileInUpload as $file) {
        $file = 'upload/' . $file;
        affiche($file);
      }
    }    
    ?>  
  </div><!-- fin row -->
</div> <!-- fin container -->
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
