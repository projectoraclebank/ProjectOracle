<?php
if(isset($_POST["save_retrait"])){
    if(!empty($_POST["no_compte"]) && !empty($_POST["montant_retrait"]) && !empty($_POST["message_retrait"])){
        
        $no_compte = strip_tags(utf8_encode(htmlspecialchars($_POST["no_compte"])));
        $montant_retrait = strip_tags(utf8_encode(htmlspecialchars($_POST["montant_retrait"])));
        $message_retrait = strip_tags(utf8_encode(htmlspecialchars($_POST["message_retrait"])));
        $message_communication = "Transaction ";
        
        $requete_verif="SELECT solde_compte FROM compte WHERE idcompte='$no_compte'";
        $result_verif=mysqli_query($connexion, $requete_verif);
        $count_verif=mysqli_num_rows($result_verif);
        if($count_verif==1){
            while($data_get_verif=mysqli_fetch_assoc($result_verif)){
                $solde_compte = $data_get_verif["solde_compte"];
                $addvalue = $solde_compte + $montant_retrait;
                $message_retrait = strip_tags(utf8_encode(htmlspecialchars($_POST["message_retrait"])));
                $message_communication = "Un depot a été effectué sur votre compte. Montant :".$montant_retrait." . Solde Avant:".$solde_compte." . Solde apres: ".$addvalue;
                
                    $save_retrait = "INSERT INTO `transaction` (`idtransaction`, `compte_donneur_id`, `compte_beneficiare_id`, `typeTransID`, `information_textuel`, `message_communication`, `date_creation`, `employer_id`, `montant_transaction`) VALUES ('', '$no_compte', '$no_compte', '$type_transcation', '$message_retrait', '$message_communication', now(), '$idemploye', '$montant_retrait')";
                    if(mysqli_query($connexion, $save_retrait)){
                        $req_up_compte = "UPDATE `compte` SET `solde_compte` = '$addvalue' WHERE `compte`.`idcompte` = '$no_compte'";
                        if(mysqli_query($connexion, $req_up_compte)){
                            if (!mysqli_commit($connexion)){
                                //erreur commit 
                                ?>
                                <div class="alert alert-warning alert-dismissable">
                                    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                        <strong>Alerte!</strong> Vérifier vos informations et essayer à nouveau.(CC-090)
                                </div>
                                <?php
                            }else{
                                ?>
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                        <strong>Success!</strong>Montant transaction <?php echo $montant_retrait ?>.
                                        Solde Avant : &emsp;&emsp; <?php echo $solde_compte;?> <br />
                                        Solde Après : &emsp;&emsp; <?php echo $addvalue;?> <br />
                                        <hr />
                                </div>
                                <?php
                            }
                        }else{
                            //erreur d'insertion
                            ?>
                            <div class="alert alert-warning alert-dismissable">
                                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                    <strong>Alerte!</strong> Erreur insertion, essayer à nouveau.(CC-001)
                            </div>
                            <?php
                        }
                    }else{
                        //erreur d'insertion
                        ?>
                        <div class="alert alert-warning alert-dismissable">
                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                <strong>Alerte!</strong> Erreur insertion, essayer à nouveau.(CC-010)
                        </div>
                        <?php
                    }
            }
        }else{
            ?>
            <div class="alert alert-warning alert-dismissable">
            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                    <strong>Alerte!</strong> Impossible de faire cette transaction, contacter administration.(CC-140)
            </div>
            <?php
        }
        //echo mysqli_error($connexion);
    }else{
        //champs vides
        ?>
        <div class="alert alert-warning alert-dismissable">
            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
            <strong>Alerte!</strong> vos champs sont vides.(CC-E34)
        </div>
        <?php
    }
}


?>