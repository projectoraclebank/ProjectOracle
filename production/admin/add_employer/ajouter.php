<?php
session_start(); 
setcookie('ticket_ck', "", time()+ 3660);

include('../utils/connexion.php');
mysqli_autocommit($connexion, false);

if(isset($_SESSION['ticket_connexion']) && isset($_SESSION['iduser']) && isset($_SESSION['pseudo']) && isset($_SESSION['id_type_user'])){
    $iduser = $_SESSION['iduser'];
    /*
    $_SESSION['date_creation'] = $date_creation;
    $_SESSION['description_type_user'] = $description_type_user;
    */
      //cree un ticket de connexion
        $ticket = session_id().microtime().rand(2,9);
        $ticket =hash('sha512', $ticket.$_SESSION['iduser'].$_SESSION['id_type_user']);
      //create coockie  
        setcookie('ticket_ck', $ticket, time()+ 3660);
        $_SESSION['ticket_ck']=$ticket;
      //$_COOKIE['ticket_ck'];
        $_SESSION['ticket_connexion'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ajouter Employer | <?php echo utf8_encode($_SESSION['pseudo']);?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/icons/favicon.ico">
    <link rel="apple-touch-icon" href="../images/icons/favicon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../images/icons/favicon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../images/icons/favicon-114x114.png">
    <?php
        include('../include/css_include.html');
    ?>
</head>
<body>
    <div>
        
        <!--BEGIN BACK TO TOP-->
        <a id="totop" href="#"><i class="fa fa-angle-up"></i></a>
        <!--END BACK TO TOP-->
        <!--BEGIN TOPBAR-->
        <?php 
            include('../include/topbar_include.php');
        ?>
        <!--END TOPBAR-->
        <div id="wrapper">
            <!--BEGIN SIDEBAR MENU-->
            <?php
                include('../include/sidebar_include.php');
            ?>
            <!--END SIDEBAR MENU-->
            <!--BEGIN CHAT FORM-->
            <?php
                include('../include/chatform_include.html')
            ?>
            <!--END CHAT FORM-->
            <!--BEGIN PAGE WRAPPER-->
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">
                            Dashboard</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="dashboard.php">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Dashboard</li>
                    </ol>
                    <div class="clearfix">
                    </div>
                </div>
                <!--END TITLE & BREADCRUMB PAGE-->
                <?php 
                    $requete_t="SELECT * FROM type_user WHERE description_type_user='EMPLOYER'";
                    $result_t=mysqli_query($connexion, $requete_t);
                    $count_t=mysqli_num_rows($result_t);
                    if($count_t==1){
                        while($data_get_t=mysqli_fetch_assoc($result_t)){
                            $type_user = $data_get_t["idtype_user"];
                        }
                    }

                    $requete_i="SELECT * FROM types_informations";
                    $result_i=mysqli_query($connexion, $requete_i);
                    $count_i=mysqli_num_rows($result_i);
                    if($count_i>0){
                        while($data_get_i=mysqli_fetch_assoc($result_i)){
                            
                            if($data_get_i["description_type_infos"]=="PRINCIPALE"){
                               $type_principale = $data_get_i["idtypes_informations"];
                            }
                            if($data_get_i["description_type_infos"]=="SECONDAIRE"){
                                $type_secondaire = $data_get_i["idtypes_informations"];
                            } 
                        }
                    }
                ?>

                <!--BEGIN CONTENT-->
                <div class="page-content">
                    <div id="tab-general">
                        <div id="sum_box" class="row mbl">
                            <div class="col-sm-6 col-md-3">
                                <div class="panel profit db mbm">
                                    <div class="panel-body">
                                        <p class="icon">
                                            <i class="icon fa fa-home"></i>
                                        </p>
                                        <h4 class="value">
                                            <span data-counter="" data-start="10" data-end="50" data-step="1" data-duration="0">
                                            </span>
                                            <?php 
                                                $requete_agence="SELECT * FROM agence";
                                                $result_agence=mysqli_query($connexion, $requete_agence);
                                                echo $count_agence=mysqli_num_rows($result_agence);
                                            ?>
                                            <span></span></h4>
                                        <p class="description">
                                            Total Agence</p>
                                        <div class="progress progress-sm mbn">
                                            <div role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"
                                                style="width: 80%;" class="progress-bar progress-bar-success">
                                                <span class="sr-only">80% Complete (success)</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="panel income db mbm">
                                    <div class="panel-body">
                                        <p class="icon"> 
                                            <i class="icon fa fa-group"></i>
                                        </p>
                                        <h4 class="value">
                                            <span>
                                            <?php 
                                                $requete_employe="SELECT * FROM employe";
                                                $result_employe=mysqli_query($connexion, $requete_employe);
                                                echo $count_employe=mysqli_num_rows($result_employe);
                                            ?>
                                            </span><span></span></h4>
                                        <p class="description">
                                            Total Employer</p>
                                        <div class="progress progress-sm mbn">
                                            <div role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                                style="width: 60%;" class="progress-bar progress-bar-info">
                                                <span class="sr-only">60% Complete (success)</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="panel task db mbm">
                                    <div class="panel-body">
                                        <p class="icon">
                                            <i class="icon fa fa-user"></i>
                                        </p>
                                        <h4 class="value">
                                            <span>
                                            <?php 
                                                $requete_client="SELECT * FROM client";
                                                $result_client=mysqli_query($connexion, $requete_client);
                                                echo $count_client=mysqli_num_rows($result_client);
                                            ?>
                                            </span></h4> <!-- signal shopping-cart money-->
                                        <p class="description">
                                            Total Client</p>
                                        <div class="progress progress-sm mbn">
                                            <div role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"
                                                style="width: 50%;" class="progress-bar progress-bar-danger">
                                                <span class="sr-only">50% Complete (success)</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="panel visit db mbm">
                                    <div class="panel-body">
                                        <p class="icon">
                                            <i class="icon fa fa-credit-card"></i>
                                        </p>
                                        <h4 class="value">
                                            <span>
                                            <?php 
                                                $requete_carte="SELECT * FROM carte";
                                                $result_carte=mysqli_query($connexion, $requete_carte);
                                                echo $count_carte=mysqli_num_rows($result_carte);
                                            ?>
                                            </span></h4>
                                        <p class="description">
                                            Total Carte</p>
                                        <div class="progress progress-sm mbn">
                                            <div role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"
                                                style="width: 70%;" class="progress-bar progress-bar-warning">
                                                <span class="sr-only">70% Complete (success)</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="generalTabContent" class="tab-content responsive">
                            <div id="alert-tab" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="panel panel-blue">
                                            <div class="panel-heading">
                                                Formulaire Employer
                                            </div>
                                            <div class="panel-body pan">
                                            <?php
                                                $ext = "php";
                                                include("function_add.".$ext);
                                            ?>
                                                <form method="post">
                                                    <div class="form-body pal">
                                                        <legend>Agence et Fonction :</legend>
                                                        <div class="form-group">
                                                            <select name="agence_employer"class="form-control">
                                                                <option selected disabled>Agence Employer</option>
                                                            <?php
                                                                $requete_get_agence="SELECT * FROM agence";
                                                                $result_get_agence=mysqli_query($connexion, $requete_get_agence);
                                                                $count_get_agence=mysqli_num_rows($result_get_agence);
                                                                if($count_get_agence>0){
                                                                    while($data_get_agence=mysqli_fetch_assoc($result_get_agence)){
                                                                        ?>
                                                                    <option value="<?php  echo $data_get_agence['idagence']?>"> <?php  echo $data_get_agence["nom_agence"]?> </option>
                                                                        <?php
                                                                    }
                                                                }
                                                            ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <select name="fonction_employer"class="form-control">
                                                                <option selected disabled>Fonction Employer</option>
                                                            <?php
                                                                $requete_get_fonction="SELECT * FROM fonction";
                                                                $result_get_fonction=mysqli_query($connexion, $requete_get_fonction);
                                                                $count_get_fonction=mysqli_num_rows($result_get_fonction);
                                                                if($count_get_fonction>0){
                                                                    while($data_get_fonction=mysqli_fetch_assoc($result_get_fonction)){
                                                                        ?>
                                                                    <option value="<?php  echo $data_get_fonction['idfonction']?>"> <?php  echo $data_get_fonction["titre_fonction"]?> </option>
                                                                        <?php
                                                                    }
                                                                }
                                                            ?> 
                                                            </select>
                                                        </div>
                                                        <hr />
                                                        <legend>Information personnel : </legend>
                                                        <div class="form-group">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-user"></i>
                                                                <input id="inputName" type="text"  name="nom_employer" placeholder="Nom Employer" class="form-control" maxlenght="100" required/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-user"></i>
                                                                <input id="inputName" type="text"  name="prenom_employer" placeholder="Prenom Employer" class="form-control" maxlenght="100" required/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-edit"></i>
                                                                <input id="inputName" type="text"  name="cin_employer" placeholder="CIN Employer" class="form-control" maxlenght="100" required/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-edit"></i>
                                                                <input id="inputName" type="text"  name="nif_employer" placeholder="NIF Employer" class="form-control" maxlenght="100" required/>
                                                            </div>
                                                        </div> 
                                                        <div class="form-group">
                                                            <select name="sexe_employer" class="form-control">
                                                                <option disabled>SEXE</option>
                                                                <option value="Homme">Homme</option>
                                                                <option value="Femme">Femme</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <select name="civilite_employer"class="form-control">
                                                                <option disabled>Civilité</option>
                                                                <option value="Mr.">Mr.</option>
                                                                <option value="Me.">Me.</option>
                                                                <option value="Mlle.">Mlle.</option>
                                                            </select>
                                                        </div>
                                                        <hr />
                                                        <!--<div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="inputName" class="control-label">
                                                                        Jour</label>
                                                                    <div class="input-icon right">
                                                                        <i class="fa fa-calendar"></i>
                                                                        <input id="inputName" type="number" placeholder="" class="form-control" min="1" max="12" maxlength="2" required/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="inputEmail" class="control-label">
                                                                        Mois</label>
                                                                    <div class="input-icon right">
                                                                        <i class="fa fa-calendar"></i>
                                                                        <input id="inputEmail" type="number" placeholder="" class="form-control" min="1" max="31" maxlength="2"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="inputEmail" class="control-label">
                                                                        Année</label>
                                                                    <div class="input-icon right">
                                                                        <i class="fa fa-calendar"></i>
                                                                        <input id="inputEmail" type="text" placeholder="" class="form-control" pattern="\d{4}" maxlength="4"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>-->
                                                        <div class="form-group">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-calendar"></i>
                                                                <input id="inputName" type="date"  name="date_naissance_emp" placeholder="Date de Naissance (1990-01-01)" class="form-control" pattern="\d{4}[\-]\d{2}[\-]\d{2}" minlenght="10" maxlenght="10" max="2017-01-01" required/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-phone"></i>
                                                                <input id="inputName" type="phone"  name="phone_prin_emp" placeholder="Telephone Principale Employer" class="form-control" pattern="\d{8}" maxlength="8"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-phone"></i>
                                                                <input id="inputName" type="phone"  name="phone_sec_emp" placeholder="Telephone Secondaire Employer" class="form-control" pattern="\d{8}" maxlength="8"/>
                                                            </div>
                                                        </div>
                                                        <hr />
                                                        <div class="form-group">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-envelope"></i>
                                                                <input id="inputName" type="email"  name="mail_prin_emp" placeholder="Email principale Employer" class="form-control" required/>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-envelope"></i>
                                                                <input id="inputName" type="email"  name="mail_sec_emp" placeholder="Email Secondaire Employer" class="form-control"/>
                                                            </div>
                                                        </div>
                                                        <hr />
                                                        <div class="form-group">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-home"></i>
                                                                <input id="inputName" type="text" name="adresse_prin_emp" placeholder="Adresse Principale employer" class="form-control" maxlenght="100" required/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-home"></i>
                                                                <input id="inputName" type="text" name="adresse_sec_emp" placeholder="Adresse PrincipaleSecondaire employer" class="form-control" maxlenght="100" />
                                                            </div>
                                                        </div>
                                                        <hr />
                                                        <legend>Compte de Connexion</legend>
                                                        <div class="form-group">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-user"></i>
                                                                <input id="inputName" type="text"  name="user_emp" placeholder="Nom utilisateur employé" class="form-control" required/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-key"></i>
                                                                <input id="inputName" type="text"  name="password_emp" placeholder="Mot de passe utilisateur employé" class="form-control" required/>
                                                            </div>
                                                        </div>
                                                        <hr />
                                                    </div>
                                                    <?php
                                                    if(isset($type_user) != null && isset($type_principale) != null && isset($type_secondaire) != null){
                                                        if($count_get_agence>0 && $count_get_fonction>0){
                                                            ?>
                                                            <div class="form-actions text-center pal">
                                                                <button type="submit" name="save_employer" class="btn btn-primary">
                                                                    Enregistrer
                                                                </button>
                                                            </div>
                                                            <?php
                                                        }else{
                                                            ?>
                                                            <div class="alert alert-error alert-dismissable">
                                                                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                                                <strong>Alerte!</strong> Fonction ou Agence non disponible, Verifier et essayer à nouveau. 
                                                            </div>
                                                            <?php
                                                        }
                                                    }else{
                                                        ?>
                                                        <div class="alert alert-warning alert-dismissable">
                                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                                            <strong>Alerte!</strong> Impossible d'enregistrer un nouveau membre, enregistrer d'abord les  types d'informations et type d'utilisateur. 
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div id="change-transitions" class="row">
                                            <div class="col-md-4">
                                                <div class="box-placeholder">
                                                    <a href="../add_employer/"  class="btn btn-success btn-block">Ajouter Employer</a>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="box-placeholder">
                                                    <a href="../add_agence/"  class="btn btn-success btn-block">Ajouter Agence</a>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="box-placeholder">
                                                    <a href="../fonction/"  class="btn btn-success btn-block">Ajouter Fonction</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div id="change-transitions" class="row">
                                            <div class="col-md-4">
                                                <div class="box-placeholder">
                                                    <a href="../employer/"  class="btn btn-info btn-block">Liste Employer</a>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="box-placeholder">
                                                    <a href="../agence/"  class="btn btn-info btn-block">Liste Agence</a>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="box-placeholder">
                                                    <a href="../fonction/"  class="btn btn-info btn-block">Liste Fonction</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--END CONTENT-->
                <!--BEGIN FOOTER-->
                <?php
                    include('../include/footer_include.html');
                ?>
                <!--END FOOTER-->
            </div>
            <!--END PAGE WRAPPER-->
        </div>
    </div>
    <?php
        include('../include/js_include.html');
    ?>
</body>
</html>
<?php
}else{
session_unset();
session_destroy();
$_SESSION = array();
echo '<meta http-equiv="refresh" content="0;url=../login/">';
}
?>