<?php
    if(isset($_POST["save_employer"])){
        /*
        nom_employer prenom_employer cin_employer nif_employer 
        sexe_employer civilite_employer phone_prin_emp mail_prin_emp user_emp password_emp 
        adresse_prin_emp */

        /*
         phone_sec_emp
         mail_sec_emp adresse_sec_emp
         fonction_employer
         agence_employer
        */

        //$type_user $type_principale."--".$type_secondaire;
        if($_POST["fonction_employer"] != null && $_POST["agence_employer"] != null && !empty($_POST["phone_prin_emp"]) && !empty($_POST["adresse_prin_emp"]) && !empty($_POST["mail_prin_emp"]) && !empty($_POST["user_emp"]) && !empty($_POST["password_emp"]) && !empty($_POST["nom_employer"]) && !empty($_POST["prenom_employer"]) && !empty($_POST["cin_employer"]) && !empty($_POST["nif_employer"]) && $_POST["sexe_employer"] != "SEXE" && $_POST["civilite_employer"] != "Civilité"){ 
            $nom_employer = utf8_encode(strip_tags(htmlspecialchars(strtoupper($_POST["nom_employer"]))));
            $prenom_employer = utf8_encode(strip_tags(htmlspecialchars($_POST["prenom_employer"])));
            $sexe_employer = utf8_encode(strip_tags(htmlspecialchars($_POST["sexe_employer"])));
            $date_naissance_emp = strip_tags(htmlspecialchars($_POST["date_naissance_emp"]));
            $cin_employer = utf8_encode(strip_tags(htmlspecialchars($_POST["cin_employer"])));
            $nif_employer = utf8_encode(strip_tags(htmlspecialchars($_POST["nif_employer"])));    
            $civilite_employer = utf8_encode(strip_tags(htmlspecialchars($_POST["civilite_employer"])));
            $fonction_employer = strip_tags(htmlspecialchars($_POST["fonction_employer"]));
            $agence_employer = strip_tags(htmlspecialchars($_POST["agence_employer"]));

            $phone_prin_emp = utf8_encode(strip_tags(htmlspecialchars($_POST["phone_prin_emp"])));
            $mail_prin_emp = utf8_encode(strip_tags(htmlspecialchars($_POST["mail_prin_emp"])));
            $user_emp = utf8_encode(strip_tags(htmlspecialchars($_POST["user_emp"])));
            $password_emp = sha1(utf8_encode(strip_tags(htmlspecialchars($_POST["password_emp"]))));                                                        
            $adresse_prin_emp = utf8_encode(strip_tags(htmlspecialchars($_POST["adresse_prin_emp"])));    
    //actif : 0 , Inactif
    //actif : 1 , Actif
    //if (!mysqli_commit($connexion)){}
        $requete_insert_user = "INSERT INTO `user` (`iduser`, `id_type_user`, `pseudo`, `password`, `actif_user`, `date_creation`, `date_mise_a_jour`) VALUES ('', $type_user, '$user_emp', '$password_emp', '1', now(), now())"; 
        if(mysqli_query($connexion, $requete_insert_user)){
                $id_user = mysqli_insert_id($connexion);
                $sub_nom = substr(strtoupper($nom_employer), 0, 3);
                $sub_prenom = substr(strtoupper($prenom_employer), 0, 3);
                $code_emp = strtoupper("EMP-".$sub_nom."-".$sub_prenom."-".$id_user);
                $requete_insert_employer = "INSERT INTO `employe` (`idemploye`, `code_emp`, `nom_emp`, `prenom_emp`, `sexe_emp`, `naissance_emp`, `civilite_emp`, `nif_emp`, `cin_emp`, `user_emp_id`, `type_user_id`, `date_creation`, `date_mise_a_jour`, `id_succursale`) VALUES ('', '$code_emp', '$nom_employer', '$prenom_employer', '$sexe_employer', '$date_naissance_emp', '$civilite_employer', '$nif_employer', '$cin_employer', $id_user, $type_user, now(),now(), $agence_employer)";                                                                                                                                               
                if(mysqli_query($connexion, $requete_insert_employer)){
                    $emp_id = mysqli_insert_id($connexion);
                    $requete_insert_emp_fonction = "INSERT INTO `employe_fonction` (`idemploye_fonction`, `emp_fonc_id`, `fonction_id`, `actif_emp`, `date_creation`) VALUES ('', $emp_id, $fonction_employer, '1', now())";                 
                    if(mysqli_query($connexion, $requete_insert_emp_fonction)){
                        $requete_insert_adress = "INSERT INTO `adresse` (`idadresse`, `id_type_adresse`, `description_adresse`, `nom_proprietaire_id`, `date_creation`, `date_mise_a_jour`) VALUES ('', $type_principale, '$adresse_prin_emp', $id_user, now(), now())";
                        $requete_insert_phone = "INSERT INTO `telephone` (`idtelephone`, `id_type_telephone`, `id_proprietaire`, `numero_telephone`, `date_creation`, `date_mise_a_jour`) VALUES ('', $type_principale, $id_user, '$phone_prin_emp', now(), now())";
                        $requete_insert_mail = "INSERT INTO `email` (`idemail`, `id_type_mail`, `nom_proprietaire_id`, `email_emp`, `date_creation`, `date_mise_a_jour`) VALUES ('', $id_user, '".$type_principale."', '$mail_prin_emp', now(), now())";
                        if(mysqli_query($connexion, $requete_insert_adress) && mysqli_query($connexion, $requete_insert_phone) && mysqli_query($connexion, $requete_insert_mail)){
                            if (!mysqli_commit($connexion)){
                                ?>
                                <div class="alert alert-error alert-dismissable">
                                    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                        <strong>Alerte!</strong> Vérifier vos informations et essayer à nouveau.
                                </div>
                                <?php
                            }else{
                                ?>
                                <div class="alert alert-warning alert-dismissable">
                                    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                        <strong>Success!</strong> Agence ajouter avec succès.
                                </div>
                                <?php
                            }
                        }else{
                            //erreur insertion
                            ?>
                            <div class="alert alert-warning alert-dismissable">
                                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                    <strong>Alerte!</strong> Erreur insertion, essayer à nouveau.(A.P.E-01)
                            </div>
                            <?php 
                        }
                    }else{
                        //erreur insertion
                        ?>
                        <div class="alert alert-warning alert-dismissable">
                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                <strong>Alerte!</strong> Erreur insertion, essayer à nouveau.(F-01)
                        </div>
                        <?php 
                    }
                }else{
                    //erreur insertion 
                    ?>
                    <div class="alert alert-warning alert-dismissable">
                        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                            <strong>Alerte!</strong> Erreur insertion , essayer à nouveau.(E-01)
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
            echo mysqli_error($connexion);
        }else{
            //champs vides
            ?>
            <div class="alert alert-error alert-dismissable">
                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                <strong>Alerte!</strong> vos champs sont vides.
            </div>
            <?php
        }
    }
?>