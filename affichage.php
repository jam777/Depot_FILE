<?php

function affiche($filePath){
?>
    <!-- Affiche des images téléchargées dans upload sous forme de vignettes -->
      <div class="col-md-4 thumb">
          <div>
            <img src=<?php echo "$filePath"; ?> alt="Generic placeholder thumbnail" class="img-thumbnail"/>
          </div>              
          <form action="delete.php" method="post">
            <button type="submit" class="btn btn-danger form-control" value=<?php echo "$filePath"; ?> name="delete">Delete</button>
          </form>
      </div>
<?php

}
?>