<?php
                                        if(isset($_POST["save_fonction"])){
                                            if(!empty($_POST["edt_titre"]) && !empty($_POST["edt_salaire"]) && !empty($_POST["edt_description"])){
                                                $edt_titre = utf8_encode(strip_tags(htmlspecialchars(strtoupper($_POST["edt_titre"]))));
                                                $edt_description = utf8_encode(strip_tags(htmlspecialchars($_POST["edt_description"])));
                                                if(is_numeric($_POST["edt_salaire"])){
                                                    $edt_salaire = doubleval(strip_tags(htmlspecialchars($_POST["edt_salaire"])));
                                                    $requete_verifier="SELECT * FROM fonction WHERE titre_fonction='$edt_titre'";
                                                    $result_verification=mysqli_query($connexion, $requete_verifier);
                                                    $count_verification=mysqli_num_rows($result_verification);
                                                    //insertion 
                                                    if($count_verification==0){
                                                        $insert_fonction = "INSERT INTO `fonction` (`idfonction`, `titre_fonction`, `desc_fonction`, `salaire_fonction`) VALUES ('', '$edt_titre', '$edt_description', '$edt_salaire')";
                                                        if(mysqli_query($connexion, $insert_fonction)){
                                                            if (!mysqli_commit($connexion)){
                                                                ?>
                                                                <div class="alert alert-warning alert-dismissable">
                                                                    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                                                    <strong>Erreur!</strong> Essayer à nouveau. (4-3)
                                                                </div>
                                                                <?php
                                                            }else{
                                                                ?>
                                                                <div class="alert alert-success alert-dismissable">
                                                                    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                                                    <strong>Succès!</strong> <?php echo $edt_titre;?> enregistrer avec succès.
                                                                </div>
                                                                <?php
                                                            }
                                                        }else{
                                                            ?>
                                                            <div class="alert alert-warning alert-dismissable">
                                                                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                                                <strong>Erreur!</strong> Essayer à nouveau.(4-2)
                                                            </div>
                                                            <?php
                                                        }
                                                    }else{
                                                        //fonction existe 
                                                        ?>
                                                        <div class="alert alert-warning alert-dismissable">
                                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                                            <strong>Alert!</strong> <?php echo $edt_titre;?> est déjá un poste enregistrer dans le systèm.
                                                        </div>
                                                        <?php
                                                    }
                                                }else{
                                                    //verifier salaire et essayer a nouveau  
                                                    ?>
                                                    <div class="alert alert-warning alert-dismissable">
                                                        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                                        <strong>Alert!</strong> <?php echo $_POST["edt_salaire"];?> n'est pas numeric, verifier et essayer a nouveau.
                                                    </div>
                                                    <?php
                                                }
                                            }else{
                                                //champs vides
                                                ?>
                                                <div class="alert alert-warning alert-dismissable">
                                                    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                                    <strong>Alert!</strong> Vous avez des champs vides.
                                                </div>
                                                <?php
                                            }
                                        }

                                    ?>