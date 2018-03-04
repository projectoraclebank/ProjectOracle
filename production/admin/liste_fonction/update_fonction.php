<?php
                                    if(isset($_POST["btn_update_fonction"])){
                                        $id_update = $_POST["btn_update_fonction"];
                                        if(isset($_POST["update_titre"]) && !empty($_POST["update_titre"])){
                                            $update_titre_fonction = utf8_encode(strip_tags(htmlspecialchars(strtoupper($_POST["update_titre"]))));
                                            $before_update="SELECT * FROM fonction WHERE titre_fonction='$update_titre_fonction' AND idfonction != '$id_update'";
                                            $result_before=mysqli_query($connexion, $before_update);
                                            $count_before=mysqli_num_rows($result_before);
                                                    //update 
                                                if($count_before==0){
                                                    update_fonction("titre_fonction",$update_titre_fonction,$id_update);
                                                }else{
                                                    ?>
                                                    <div class="alert alert-warning alert-dismissable">
                                                        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                                        <strong>Alert!</strong> <?php echo $update_titre_fonction;?> est déjá un poste enregistrer dans le systèm.
                                                    </div>
                                                    <?php
                                                }
                                        }
                                        if(isset($_POST["update_desc"]) && !empty($_POST["update_desc"])){
                                            $update_desc_fonction = utf8_encode(strip_tags(htmlspecialchars($_POST["update_desc"])));
                                            update_fonction("desc_fonction",$update_desc_fonction,$id_update);
                                        }
                                        if(isset($_POST["update_salaire"]) && !empty($_POST["update_salaire"])){
                                            if(is_numeric($_POST["update_salaire"])){
                                                $update_salaire_fonction = doubleval(strip_tags(htmlspecialchars($_POST["update_salaire"])));
                                                update_fonction("salaire_fonction",$update_salaire_fonction,$id_update);
                                            }else{
                                                ?>
                                                <div class="alert alert-warning alert-dismissable">
                                                    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                                    <strong>Alert!</strong> <?php echo $_POST["update_salaire"];?> n'est pas numeric, verifier et essayer a nouveau.
                                                </div>
                                                <?php
                                            }
                                        }
                                    }
                                    
                                    function update_fonction($champ_update,$valeur_champ,$id_update){
                                        include('../utils/connexion.php');
mysqli_autocommit($connexion, false);
                                        $saveupdate = "UPDATE `fonction` SET `$champ_update` = '$valeur_champ' WHERE sha1(`fonction`.`idfonction`) = '$id_update'";
                                        if(mysqli_query($connexion, $saveupdate)){
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
                                                    <strong>Succès!</strong>  <?php echo $valeur_champ;?>, mise à jour avec succès.
                                                </div>
                                                <?php
                                            }
                                        }else{
                                            ?>
                                            <div class="alert alert-warning alert-dismissable">
                                                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                                <strong>Erreur!</strong> Echec mise à jour nom, essayer à nouveau (C-2).
                                            </div>
                                            <?php
                                        }   
                                    };
                                    ?>