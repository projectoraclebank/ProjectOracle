<?php 
if(isset($_POST["save_compte"])){
    if(!empty($_POST["nom_client"]) && !empty($_POST["prenom_client"]) && !empty($_POST["cin_client"]) && !empty($_POST["nif_client"]) && !empty($_POST["sexe_client"]) && !empty($_POST["civilite_client"]) && !empty($_POST["date_naissance_client"]) && !empty($_POST["phone_prin_client"]) && !empty($_POST["mail_prin_client"]) && !empty($_POST["adresse_prin_client"]) && !empty($_POST["montant_depot_compte"]) && !empty($_POST["user_client"]) && !empty($_POST["password_client"])){
        //nom_agence phone_agence type_agence adresse_agence save_agence
        $nom_client = strip_tags(utf8_encode(htmlspecialchars(strtoupper($_POST["nom_client"]))));
        $prenom_client = strip_tags(utf8_encode(htmlspecialchars($_POST["prenom_client"])));
        $cin_client = strip_tags(utf8_encode(htmlspecialchars($_POST["cin_client"])));
        $nif_client = strip_tags(utf8_encode(htmlspecialchars($_POST["nif_client"])));
        $sexe_client = strip_tags(utf8_encode(htmlspecialchars($_POST["sexe_client"])));
        $civilite_client = strip_tags(utf8_encode(htmlspecialchars($_POST["civilite_client"])));
        $date_naissance_client = strip_tags(utf8_encode(htmlspecialchars($_POST["date_naissance_client"])));
        $phone_prin_client = strip_tags(utf8_encode(htmlspecialchars($_POST["phone_prin_client"])));
        $mail_prin_client = strip_tags(utf8_encode(htmlspecialchars($_POST["mail_prin_client"])));
        $adresse_prin_client = strip_tags(utf8_encode(htmlspecialchars($_POST["adresse_prin_client"])));
        $type_compte = strip_tags(utf8_encode(htmlspecialchars($_POST["type_compte"])));
        $type_carte = strip_tags(utf8_encode(htmlspecialchars($_POST["type_carte"])));
        $montant_depot_compte = strip_tags(utf8_encode(htmlspecialchars($_POST["montant_depot_compte"])));
        $user_client = strip_tags(utf8_encode(htmlspecialchars($_POST["user_client"])));
        $password_client = strip_tags(utf8_encode(htmlspecialchars($_POST["password_client"])));
        
        //ann verifier si moun sa t enregistrer yon compte deja nan system nou an ( si mwen gen moun sa kom client)
        $requete_get_if_exist="SELECT * FROM client WHERE nif_client='$nif_client' OR cin_client='$cin_client'";
        $result_get_if_exist=mysqli_query($connexion, $requete_get_if_exist);
        $count_get_if_exist=mysqli_num_rows($result_get_if_exist);
        if($count_get_if_exist>0){
            while($data_get_agence=mysqli_fetch_assoc($result_get_if_exist)){

                $user_id = $data_get_agence['userClientID'];
                $client_id = $data_get_agence['idclient'];
                save_new_account_info($connexion,$type_user,$type_principale,$id_employe,$id_succursale,$type_transcation,$user_id,$client_id);
            }

        }else{

            save_user_for_the_first_time($connexion,$type_user,$type_principale,$id_employe,$id_succursale,$type_transcation);
        }

    }else{

        ?>
        <div class="alert alert-warning alert-dismissable">
            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
            <strong>Alerte!</strong> vos champs sont vides.(C-10)
        </div>
        <?php
    }
}

function save_user_for_the_first_time($connexion,$type_user,$type_principale,$id_employe,$id_succursale,$type_transcation){

        $nom_client = strip_tags(utf8_encode(htmlspecialchars(strtoupper($_POST["nom_client"]))));
        $prenom_client = strip_tags(utf8_encode(htmlspecialchars($_POST["prenom_client"])));
        $cin_client = strip_tags(utf8_encode(htmlspecialchars($_POST["cin_client"])));
        $nif_client = strip_tags(utf8_encode(htmlspecialchars($_POST["nif_client"])));
        $sexe_client = strip_tags(utf8_encode(htmlspecialchars($_POST["sexe_client"])));
        $civilite_client = strip_tags(utf8_encode(htmlspecialchars($_POST["civilite_client"])));
        $date_naissance_client = strip_tags(utf8_encode(htmlspecialchars($_POST["date_naissance_client"])));
        $phone_prin_client = strip_tags(utf8_encode(htmlspecialchars($_POST["phone_prin_client"])));
        $mail_prin_client = strip_tags(utf8_encode(htmlspecialchars($_POST["mail_prin_client"])));
        $adresse_prin_client = strip_tags(utf8_encode(htmlspecialchars($_POST["adresse_prin_client"])));
        $type_compte = strip_tags(utf8_encode(htmlspecialchars($_POST["type_compte"])));
        $type_carte = strip_tags(utf8_encode(htmlspecialchars($_POST["type_carte"])));
        $montant_depot_compte = strip_tags(utf8_encode(htmlspecialchars($_POST["montant_depot_compte"])));
        $user_client = strip_tags(utf8_encode(htmlspecialchars($_POST["user_client"])));
        $password_client = strip_tags(utf8_encode(htmlspecialchars($_POST["password_client"])));
//ALTER TABLE tbl_Country DROP COLUMN IsDeleted;
//ALTER TABLE personal_info DROP FOREIGN KEY `personal_info_ibfk_1`
//ALTER TABLE client DROP FOREIGN KEY `id_user_client_UNIQUE` 
//ALTER TABLE client DROP FOREIGN KEY `id_user_client` 


        

                $save_user = "INSERT INTO `user` (`iduser`, `id_type_user`, `pseudo`, `password`, `actif_user`, `date_creation`, `date_mise_a_jour`) VALUES ('', '$type_user', '$user_client', '$password_client', '1', now(), now())";
                if(mysqli_query($connexion, $save_user)){

                    $user_id = mysqli_insert_id($connexion);
                    $save_client = "INSERT INTO `client` (`idclient`, `nom_client`, `prenom_client`, `naissance_client`, `nif_client`, `cin_client`, `sexe_client`, `civilite_client`, `userClientID`, `date_creation`, `date_mise_a_jour`, `id_succursale`) VALUES ('', '$nom_client', '$prenom_client', '$date_naissance_client', '$nif_client', '$cin_client', '$sexe_client', '$civilite_client', '$user_id', now(), now(), '$id_succursale')";
                    if(mysqli_query($connexion, $save_client)){

                        $client_id = mysqli_insert_id($connexion);
                        $save_phone = "INSERT INTO `telephone` (`idtelephone`, `id_type_telephone`, `id_proprietaire`, `numero_telephone`, `date_creation`, `date_mise_a_jour`) VALUES ('', '$type_principale', '$user_id', '$phone_prin_client', now(), now())"; 
                        $save_adresse = "INSERT INTO `adresse` (`idadresse`, `id_type_adresse`, `description_adresse`, `nom_proprietaire_id`, `date_creation`, `date_mise_a_jour`) VALUES ('', '$type_principale', '$adresse_prin_client', '$user_id', now(), now())";
                        $save_email = "INSERT INTO `email` (`idemail`, `id_type_mail`, `nom_proprietaire_id`, `email_emp`, `date_creation`, `date_mise_a_jour`) VALUES ('', '$type_principale', '$user_id', '$mail_prin_client', now(), now())";
                        if(mysqli_query($connexion, $save_phone) && mysqli_query($connexion, $save_adresse) && mysqli_query($connexion, $save_email)){

                            save_new_account_info($connexion,$type_user,$type_principale,$id_employe,$id_succursale,$type_transcation,$user_id,$client_id);

                        }else{
                             
                             //erreur d'insertion
                             ?>
                             <div class="alert alert-warning alert-dismissable">
                                 <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                     <strong>Alerte!</strong> Erreur insertion, essayer à nouveau.(C-001)
                             </div>
                             <?php
                        }
                        
                    }else{
                       //erreur d'insertion
                       
                       ?>
                       <div class="alert alert-warning alert-dismissable">
                           <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                               <strong>Alerte!</strong> Erreur insertion, essayer à nouveau.(C-102)
                       </div>
                       <?php 
                    }
                }else{
                    //erreur d'insertion
                    ?>
                    <div class="alert alert-warning alert-dismissable">
                        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                            <strong>Alerte!</strong> Erreur insertion, essayer à nouveau.(U-010)
                    </div>
                    <?php
                }
}


function save_new_account_info($connexion,$type_user,$type_principale,$id_employe,$id_succursale,$type_transcation,$user_id,$client_id){
        
                            $requete_t="SELECT * FROM type_transcation WHERE description_type_transaction='DEPOT'";
                            $result_t=mysqli_query($connexion, $requete_t);
                            $count_t=mysqli_num_rows($result_t);
                            if($count_t==1){
                                while($data_get_t=mysqli_fetch_assoc($result_t)){
                                    $type_transcation = $data_get_t["idtype_transcation"];
                                }
                            }

        $nom_client = strip_tags(utf8_encode(htmlspecialchars(strtoupper($_POST["nom_client"]))));
        $prenom_client = strip_tags(utf8_encode(htmlspecialchars($_POST["prenom_client"])));
        $cin_client = strip_tags(utf8_encode(htmlspecialchars($_POST["cin_client"])));
        $nif_client = strip_tags(utf8_encode(htmlspecialchars($_POST["nif_client"])));
        $sexe_client = strip_tags(utf8_encode(htmlspecialchars($_POST["sexe_client"])));
        $civilite_client = strip_tags(utf8_encode(htmlspecialchars($_POST["civilite_client"])));
        $date_naissance_client = strip_tags(utf8_encode(htmlspecialchars($_POST["date_naissance_client"])));
        $phone_prin_client = strip_tags(utf8_encode(htmlspecialchars($_POST["phone_prin_client"])));
        $mail_prin_client = strip_tags(utf8_encode(htmlspecialchars($_POST["mail_prin_client"])));
        $adresse_prin_client = strip_tags(utf8_encode(htmlspecialchars($_POST["adresse_prin_client"])));
        $type_compte = strip_tags(utf8_encode(htmlspecialchars($_POST["type_compte"])));
        $type_carte = strip_tags(utf8_encode(htmlspecialchars($_POST["type_carte"])));
        $montant_depot_compte = strip_tags(utf8_encode(htmlspecialchars($_POST["montant_depot_compte"])));
        $user_client = strip_tags(utf8_encode(htmlspecialchars($_POST["user_client"])));
        $password_client = strip_tags(utf8_encode(htmlspecialchars($_POST["password_client"])));

        $iban = "HT-00-BIC".mt_rand(0,9);
        $r_bic = mt_rand(0,9).mt_rand(1,9).mt_rand(6,9);
        $bic = "BASH-HT-PP-".$user_id."-".$r_bic;
        $code_secret = mt_rand(0,9).mt_rand(1,9).mt_rand(3,9).mt_rand(0,9);

                $save_compte = "INSERT INTO `compte` (`idcompte`, `iban`, `bic`, `type_compte_id`, `id_proprietaire`, `solde_compte`, `date_creation_ct`, `id_employe`) VALUES ('', '$iban', '$bic', '$type_compte', '$client_id', '$montant_depot_compte', now(), '$id_employe')";
                if(mysqli_query($connexion, $save_compte)){
                    $mesage = "Transaction douverture du compte.";
                    $compte_id = mysqli_insert_id($connexion);
                    $save_carte = "INSERT INTO `carte` (`idcarte`, `id_compte`, `code_secret`, `type_carte`, `date_fabrication`, `date_mise_circulation`) VALUES ('', '$compte_id', '$code_secret', '$type_carte', CURDATE(), CURDATE() + INTERVAL 9 DAY)";
                
                    if(mysqli_query($connexion, $save_carte)){
                        $carte_id = mysqli_insert_id($connexion);
                        $save_first_transaction = "INSERT INTO `transaction` (`idtransaction`, `compte_donneur_id`, `compte_beneficiare_id`, `typeTransID`, `information_textuel`, `message_communication`, `date_creation`, `employer_id`, `montant_transaction`) VALUES ('', '$compte_id', '$compte_id', '$type_transcation', '$mesage', '$mesage', now(), '$id_employe', '$montant_depot_compte')";
                        if(mysqli_query($connexion, $save_first_transaction)){
                            //echo mysqli_error($connexion)." - ".mysqli_errno($connexion); 
                            if (!mysqli_commit($connexion)){
                                ?>
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                        <strong>Erreur! </strong>Echec enregistrement, essayer plus tard ou contacter administrateur. (Z-0102)
                                </div>
                                <?php

                            }else{
                                ?>
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                        <strong>Succès! Information du Compte :</strong> <br />
                                        No Compte : <?php echo $compte_id; ?><br />
                                        No Carte : <?php echo $carte_id; ?><br />
                                        Montant Disponible : <?php echo $montant_depot_compte; ?><br />
                                        Code Secret Carte: <?php echo $code_secret; ?><br />
                                        IBAN : <?php echo $iban.$compte_id; ?><br />
                                        BIC : <?php echo $bic; ?><br />
                                </div>
                                <?php
                            }
                            
                        }else{
                            ?>
                            <div class="alert alert-warning alert-dismissable">
                                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                    <strong>Erreur:</strong> Impossible d'enregistrer, essayer a nouveau ou contacter administrateur.(Z-002)
                            </div>
                            <?php
                        }
                    }else{
                        
                        //erreur d'insertion
                        ?>
                        <div class="alert alert-warning alert-dismissable">
                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                <strong>Alerte!</strong> Erreur insertion, essayer à nouveau.(C-002)
                        </div>
                        <?php
                    }

                }else{
                    //erreur d'insertion
                     echo mysqli_error($connexion)." - ".mysqli_errno($connexion); 
                    ?>
                    <div class="alert alert-warning alert-dismissable">
                        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                            <strong>Alerte!</strong> Erreur insertion, essayer à nouveau.(C-092)
                    </div>
                    <?php

                }                
}

/*
alter table client drop index type_transaction_id;  KEY `type_transaction_id` (`type_transaction_id`),
alter table client drop index fk_client_agence_idx;
alter table client drop index id_user_client;
ALTER TABLE client DROP FOREIGN KEY `client_ibfk_1` ;
ALTER TABLE client DROP FOREIGN KEY `transaction_ibfk_5` ;
ALTER TABLE client DROP FOREIGN KEY `fk_client_type_user` transaction_ibfk_1;*/
?>
