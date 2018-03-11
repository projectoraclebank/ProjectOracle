<?php
$extension='.php';
$chemin="../utils/";
include($chemin.'connexion'.$extension);
mysqli_autocommit($connexion, false);
//search compte client 
if(isset($_POST["search_compte"])){
    if(!empty($_POST["no_compte"])){
        $no_compte=strip_tags(htmlspecialchars($_POST['no_compte']));
        $requete="SELECT * FROM compte WHERE idcompte='$no_compte'";
        $result_connexion=mysqli_query($connexion, $requete);
        $count=mysqli_num_rows($result_connexion);
        if($count>0 && $count==1){
            while($data_con=mysqli_fetch_assoc($result_connexion)){
                $id_compte=strip_tags(htmlspecialchars($data_con['idcompte']));
                print("<script type=\"text/javascript\">setTimeout('location=(\"../fiche_compte/".$id_compte."\")',0);</script>");
            } 
        }else{
            ?>
            <div class="alert alert-warning alert-dismissable">
                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                <strong>Alerte!</strong> Ce Compte n'existe pas.
            </div>
            <?php
        }
    }else{
        ?>
        <div class="alert alert-warning alert-dismissable">
            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
            <strong>Alerte!</strong> Entrer un numéro de compte.
        </div>
        <?php
    }
}



//search carte client 
if(isset($_POST["search_carte"])){
    if(!empty($_POST["no_carte"])){
        $no_carte=strip_tags(htmlspecialchars($_POST['no_carte']));
        $requete="SELECT * FROM carte WHERE idcarte='$no_carte'";
        $result_connexion=mysqli_query($connexion, $requete);
        $count=mysqli_num_rows($result_connexion);
        if($count>0 && $count==1){
            while($data_con=mysqli_fetch_assoc($result_connexion)){
                $idcarte=strip_tags(htmlspecialchars($data_con['idcarte']));
                print("<script type=\"text/javascript\">setTimeout('location=(\"../fiche_carte/".$idcarte."\")',0);</script>");
            } 
        }else{
            ?>
            <div class="alert alert-warning alert-dismissable">
                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                <strong>Alerte!</strong> Carte n'existe pas.
            </div>
            <?php
        }
    }else{
        ?>
        <div class="alert alert-warning alert-dismissable">
            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
            <strong>Alerte!</strong> Entrer un numéro de Carte.
        </div>
        <?php
    }
}


//search nif client 
if(isset($_POST["search_nif"])){
    if(!empty($_POST["no_nif"])){
        $no_nif = strip_tags(htmlspecialchars($_POST['no_nif']));
        $requete = "SELECT * FROM client WHERE idclient='$no_nif'";
        $result_connexion=mysqli_query($connexion, $requete);
        $count=mysqli_num_rows($result_connexion);
        if($count>0 && $count==1){
            while($data_con=mysqli_fetch_assoc($result_connexion)){
                $idclient=strip_tags(htmlspecialchars($data_con['idclient']));
                print("<script type=\"text/javascript\">setTimeout('location=(\"../fiche_client/".$idclient."\")',0);</script>");
            } 
        }else{
            ?>
            <div class="alert alert-warning alert-dismissable">
                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                <strong>Alerte!</strong> Client n'existe pas.
            </div>
            <?php
        }
    }else{
        ?>
        <div class="alert alert-warning alert-dismissable">
            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
            <strong>Alerte!</strong> Entrer un numéro nif.
        </div>
        <?php
    }
}



?>