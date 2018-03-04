<?php
                                            if(isset($_POST["btn_update_agence"])){
                                                    if(isset($_POST["nom_agence"]) && !empty($_POST["nom_agence"])){
                                                        $update_nom_agence = utf8_encode(strip_tags(htmlspecialchars(strtoupper($_POST["nom_agence"]))));
                                                        $saveupdate_nom_agence = "UPDATE `agence` SET `nom_agence` = '$update_nom_agence' WHERE sha1(`agence`.`idagence`) = '$selected_agence'";
                                                    }
                                                    if(isset($_POST["tel_agence"]) && !empty($_POST["tel_agence"])){
                                                        $update_tel_agence = utf8_encode(utf8encode(strip_tags(htmlspecialchars($_POST["tel_agence"]))));
                                                        $saveupdate_tel_agence = "UPDATE `agence` SET `tel_agence` = '$update_tel_agence' WHERE sha1(`agence`.`idagence`) = '$selected_agence'";
                                                    }
                                                    if(isset($_POST["adresse_agence"]) && !empty($_POST["adresse_agence"])){
                                                        $update_adresse_agence = utf8_encode(strip_tags(htmlspecialchars($_POST["adresse_agence"])));
                                                        $saveupdate_adresse_agence = "UPDATE `agence` SET `adresse_agence` = '$update_adresse_agence' WHERE sha1(`agence`.`idagence`) = '$selected_agence'";
                                                    }
                                                    //
                                                    if(isset($saveupdate_nom_agence)){
                                                        if(mysqli_query($connexion, $saveupdate_nom_agence)){
                                                            if (!mysqli_commit($connexion)){
                                                                ?>
                                                                <div class="alert alert-warning alert-dismissable">
                                                                    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                                                    <strong>Erreur!</strong> Echec mise à jour nom, essayer à nouveau (C-2).
                                                                </div>
                                                                <?php
                                                            }else{
                                                                ?>
                                                                <div class="alert alert-success alert-dismissable">
                                                                    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                                                    <strong>Success!</strong> Nom Agence mise à jour avec succès.
                                                                </div>
                                                                <?php
                                                            }
                                                        }else{
                                                            ?>
                                                            <div class="alert alert-warning alert-dismissable">
                                                                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                                                <strong>Erreur!</strong> Echec mise à jour nom, essayer à nouveau (C-1).
                                                            </div>
                                                            <?php
                                                        }
                                                    }
                                                    
                                                    //
                                                    if(isset($saveupdate_adresse_agence)){
                                                        if(mysqli_query($connexion, $saveupdate_adresse_agence)){
                                                            if (!mysqli_commit($connexion)){
                                                                ?>
                                                                <div class="alert alert-warning alert-dismissable">
                                                                    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                                                    <strong>Erreur!</strong> Echec mise à jour nom, essayer à nouveau (C-2).
                                                                </div>
                                                                <?php
                                                            }else{
                                                                ?>
                                                                <div class="alert alert-success alert-dismissable">
                                                                    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                                                    <strong>Success!</strong> Adresse Agence mise à jour avec succès.
                                                                </div>
                                                                <?php
                                                            }
                                                        }else{
                                                            ?>
                                                            <div class="alert alert-warning alert-dismissable">
                                                                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                                                <strong>Erreur!</strong> Echec mise à jour adresse, essayer à nouveau (C-1).
                                                            </div>
                                                            <?php
                                                        }
                                                    }
                                                    
                                                    //
                                                    if(isset($saveupdate_tel_agence)){
                                                        if(mysqli_query($connexion, $saveupdate_tel_agence)){
                                                            if (!mysqli_commit($connexion)){
                                                                ?>
                                                                <div class="alert alert-warning alert-dismissable">
                                                                    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                                                    <strong>Erreur!</strong> Echec mise à jour telephone, essayer à nouveau (C-2).
                                                                </div>
                                                                <?php
                                                            }else{
                                                                ?>
                                                                <div class="alert alert-success alert-dismissable">
                                                                    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                                                    <strong>Success!</strong> Telephone Agence mise à jour avec succès.
                                                                </div>
                                                                <?php
                                                            }
                                                        }else{
                                                            ?>
                                                            <div class="alert alert-warning alert-dismissable">
                                                                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                                                <strong>Erreur!</strong> Echec mise à jour telephone, essayer à nouveau (C-1).
                                                            </div>
                                                            <?php
                                                        }
                                                    }
                                                }
                                                    
?>