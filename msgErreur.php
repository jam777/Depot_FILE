<?php

function msgErreur($key=0,$file="",$erreur="",$size=0,$type=""){
    
       //Gestion message des erreurs upload interne
       switch ($erreur) {
            case '1':
                $msgEr="La taille du fichier téléchargé excède la valeur de upload_max_filesize, configurée dans le php.ini.<br>";
                break;
            case '2':
                $msgEr="La taille du fichier téléchargé excède la valeur de MAX_FILE_SIZE, qui a été spécifiée dans le formulaire HTML. <br>";
                break;
            case '3':
                $msgEr="Le fichier n'a été que partiellement téléchargé. <br>";
                break;
            case '4':
                $file="No file<br>";
                $msgEr="Aucun fichier n'a été téléchargé. <br>";
                break;
            default:
                $msgEr="";
                break;
        }

        //Gestion message erreur de la taille du fichier
        if ($size>=1000000) {
            $msgSize = "Taille du fichier supétieur à 1Mo<br>" ;
        }
        else{
            $msgSize="";
        }

        //Gestion  message erreur du type de fichier
        if (
            (($type != "image/gif") &&
            ($type != "image/jpeg") &&
            ($type != "image/png")  ||
            ($type == ''))
           ) 
        {
            $msgType="Extension de fichier incorrect.<br>
                      Seules sont autorisées : .jpg , .jpeg , .gif , .png<br>" ;
        }
        else{
            $msgType="";
        }
       
        
        //Message d'erreurs
        $msgErreur[$key]=[
            'msgFile' => $file,
            'msgErreur' => $msgEr ,
            'msgType' => $msgType,
            'msgSize' => $msgSize
        ];
        return $msgErreur[$key];       
}
?>