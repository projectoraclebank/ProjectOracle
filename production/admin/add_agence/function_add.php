<?php
if(isset($_POST["save_agence"])){
    if(!empty($_POST["nom_agence"]) && !empty($_POST["phone_agence"]) && !empty($_POST["adresse_agence"]) && $_POST["type_agence"] != "Type Agence"){
        //nom_agence phone_agence type_agence adresse_agence save_agence
        $nom_agence = strip_tags(utf8_encode(htmlspecialchars(strtoupper($_POST["nom_agence"]))));
        $tel_agence = strip_tags(utf8_encode(htmlspecialchars($_POST["phone_agence"])));
        $adresse_agence = strip_tags(utf8_encode(htmlspecialchars($_POST["adresse_agence"])));
        $type_agence = strip_tags(utf8_encode(htmlspecialchars($_POST["type_agence"])));
        //actif_agence : 0 , Inactif
        //actif_agence : 1 , Actif
        
        $save_info_agence = "INSERT INTO `agence` (`idagence`, `type_agence`, `nom_agence`, `tel_agence`, `adresse_agence`, `actif_agence`) VALUES ('', '$type_agence', '$nom_agence', '$tel_agence', '$adresse_agence', '0')";
        if(mysqli_query($connexion, $save_info_agence)){
            if (!mysqli_commit($connexion)){
                //erreur commit 
                ?>
                <div class="alert alert-warning alert-dismissable">
                    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                        <strong>Alerte!</strong> Vérifier vos informations et essayer à nouveau.
                </div>
                <?php
            }else{
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                        <strong>Success!</strong> Agence ajouter avec succès.
                </div>
                <?php
            }
            
        }else{
            //erreur d'insertion
            ?>
            <div class="alert alert-warning alert-dismissable">
                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                    <strong>Alerte!</strong> Erreur insertion, essayer à nouveau.
            </div>
            <?php
        }
        //echo mysqli_error($connexion);
    }else{
        //champs vides
        ?>
        <div class="alert alert-warning alert-dismissable">
            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
            <strong>Alerte!</strong> vos champs sont vides.
        </div>
        <?php
    }
}


?>