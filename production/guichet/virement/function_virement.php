<?php
if(isset($_POST["save_retrait"])){
    if(!empty($_POST["no_compte"]) && !empty($_POST["no_compte_beneficiare"]) && !empty($_POST["montant_retrait"]) && !empty($_POST["message_retrait"])){
        
        $no_compte = strip_tags(utf8_encode(htmlspecialchars($_POST["no_compte"])));
        $no_compte_beneficiare = strip_tags(utf8_encode(htmlspecialchars($_POST["no_compte_beneficiare"])));
        $montant_retrait = strip_tags(utf8_encode(htmlspecialchars($_POST["montant_retrait"])));
        $message_retrait = strip_tags(utf8_encode(htmlspecialchars($_POST["message_retrait"])));
        $message_communication = "Transaction ";
        
        $requete_verifselect="SELECT solde_compte FROM compte WHERE idcompte='$no_compte_beneficiare'";
        $result_verifselect=mysqli_query($connexion, $requete_verifselect);
        $count_verifselect=mysqli_num_rows($result_verifselect);
        while($data_get_verifselect=mysqli_fetch_assoc($result_verifselect)){
            $solde_compte_beneficiare = $data_get_verifselect["solde_compte"];
        }


        $requete_verif="SELECT solde_compte FROM compte WHERE idcompte='$no_compte'";
        $result_verif=mysqli_query($connexion, $requete_verif);
        $count_verif=mysqli_num_rows($result_verif);
        if($count_verif==1 && $solde_compte_beneficiare != null){
            while($data_get_verif=mysqli_fetch_assoc($result_verif)){
                $solde_compte = $data_get_verif["solde_compte"];
                $soustrac = $solde_compte - $montant_retrait;
                $add_benef = $solde_compte_beneficiare + $montant_retrait;
                $min_account = 125;
                $message_retrait = strip_tags(utf8_encode(htmlspecialchars($_POST["message_retrait"])));
                $message_communication = "Vous avez fait un virement de ".$montant_retrait." sur ".$solde_compte."vers".$no_compte_beneficiare." . Solde actuel: ".$soustrac;
                if($soustrac>= $min_account){
                    $save_retrait = "INSERT INTO `transaction` (`idtransaction`, `compte_donneur_id`, `compte_beneficiare_id`, `typeTransID`, `information_textuel`, `message_communication`, `date_creation`, `employer_id`, `montant_transaction`) VALUES ('', '$no_compte', '$no_compte_beneficiare', '$type_transcation', '$message_retrait', '$message_communication', now(), '$idemploye', '$montant_retrait')";
                    if(mysqli_query($connexion, $save_retrait)){
                        $req_up_compte = "UPDATE `compte` SET `solde_compte` = '$soustrac' WHERE `compte`.`idcompte` = '$no_compte'";
                        
                        if(mysqli_query($connexion,$req_up_compte)){
                            $req_up_compte_ben = "UPDATE `compte` SET `solde_compte` = '$add_benef' WHERE `compte`.`idcompte` = '$no_compte_beneficiare'";
                            if(mysqli_query($connexion,$req_up_compte_ben)){
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
                                            <strong>Success!</strong> Virement effectuer vers <?php echo $no_compte_beneficiare ?>.
                                            Solde Avant : &emsp;&emsp; <?php echo $solde_compte;?> <br />
                                            Solde Après : &emsp;&emsp; <?php echo $soustrac;?> <br />
                                            Montant demandé : &emsp;&emsp; <?php echo $montant_retrait;?> <br />
                                            <hr />
                                    </div>
                                    <?php
                                }
                            }else{
                            ?>
                            <div class="alert alert-warning alert-dismissable">
                                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                    <strong>Alerte!</strong> Erreur insertion, essayer à nouveau.(CC-1021)
                            </div>
                            <?php

                            }
                            
                        }else{
                            echo mysqli_error($connexion);
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

                }else{
                    ?>
                    <div class="alert alert-warning alert-dismissable">
                        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                            <strong>Erreur!</strong> Montant non disponible, verifier et essayer a nouveau.(CC-120)<br />
                            Solde Actuel : &emsp;&emsp; <?php echo $solde_compte;?> <br />
                            Montant demandé : &emsp;&emsp; <?php echo $montant_retrait;?> <br />
                            <hr />
                            Reste : &emsp;&emsp; <?php echo $soustrac;?> <br />
                            Le reste doit etre superieure a <?php echo $min_account;?>.
                    </div>
                    <?php
                }
            }
        }else{
            ?>
            <div class="alert alert-warning alert-dismissable">
            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                    <strong>Alerte!</strong> Impossible de faire une transaction, contacter administration.(CC-140)
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