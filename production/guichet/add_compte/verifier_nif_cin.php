<?php
//search nif client 
if(isset($_POST["search_nif_cin"])){
    if(!empty($_POST["no_nif"]) && !empty($_POST["no_cin"])){
        $no_nif = strip_tags(htmlspecialchars($_POST['no_nif']));
        $no_cin = strip_tags(htmlspecialchars($_POST['no_cin']));
        $requete = "SELECT * FROM client WHERE nif_client='$no_nif' OR cin_client='$cin_client'";
        $result_connexion=mysqli_query($connexion, $requete);
        $count=mysqli_num_rows($result_connexion);
        if($count>0 && $count==1){
            while($data_con=mysqli_fetch_assoc($result_connexion)){
                $idclient=strip_tags(htmlspecialchars($data_con['idclient']));  
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