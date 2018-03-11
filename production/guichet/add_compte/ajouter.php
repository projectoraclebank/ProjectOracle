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
    <title>Ajouter Compte | <?php echo utf8_encode($_SESSION['pseudo']);?></title>
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
                    $requete_t="SELECT * FROM type_user WHERE description_type_user='CLIENT'";
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

                    $requete_e="SELECT * FROM employe WHERE sha1(user_emp_id)='$iduser'";
                    $result_e=mysqli_query($connexion, $requete_e);
                    $count_e=mysqli_num_rows($result_e);
                    if($count_e>0){
                        while($data_get_e=mysqli_fetch_assoc($result_e)){
                            $id_employe = $data_get_e["idemploye"];
                            $id_succursale = $data_get_e["id_succursale"];
                        }
                    }
                ?>
                <!--BEGIN CONTENT-->
                <div class="page-content">
                    <div id="tab-general">
                        <div id="generalTabContent" class="tab-content responsive">
                            <div id="alert-tab" class="tab-pane fade in active">
                                <div class="row">
                                    <!--<div class="col-md-12">
                                                <div class="box-placeholder">
                                                    <h4 class="box-heading">Entrer # Nif et CIN</h4>
                                                    <form method="post">
                                                        <div class="input-group">
                                                            <div class="col-md-6">
                                                            <input type="text" name="no_nif" placeholder="No NIF" class="form-control"/>
                                                            </div>
                                                            <div class="col-md-6">
                                                            <input type="text" name="no_cin" placeholder="No CIN" class="form-control"/>
                                                            </div>
                                                            <span class="input-group-btn">
                                                                <button type="submit" name="search_nif_cin" class="btn btn-default">Recherche!</button>
                                                            </span>
                                                        </div>
                                                    </form>  
                                                    <div class="mbxl"></div>
                                                </div>
                                            </div>  -->   
                                    <div class="col-lg-12">
                                        <div class="panel panel-blue">
                                            <div class="panel-heading">
                                                Formulaire
                                            </div>
                                            <div class="panel-body pan">
                                            <?php
                                                $ext = "php";
                                                include("function_add.".$ext);
                                            ?>
                                                <form method="post">
                                                    <div class="form-body pal">
                                                        <legend>Information personnel : </legend>
                                                        <div class="form-group">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-user"></i>
                                                                <input id="inputName" type="text"  name="nom_client" placeholder="Nom client" class="form-control" maxlenght="100" required/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-user"></i>
                                                                <input id="inputName" type="text"  name="prenom_client" placeholder="Prenom client" class="form-control" maxlenght="100" required/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-edit"></i>
                                                                <input id="inputName" type="text"  name="cin_client" placeholder="CIN client" class="form-control" maxlenght="100" required/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-edit"></i>
                                                                <input id="inputName" type="text"  name="nif_client" placeholder="NIF client" class="form-control" maxlenght="100" required/>
                                                            </div>
                                                        </div> 
                                                        <div class="form-group">
                                                            <select name="sexe_client" class="form-control">
                                                                <option disabled>SEXE</option>
                                                                <option value="Homme">Homme</option>
                                                                <option value="Femme">Femme</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <select name="civilite_client"class="form-control">
                                                                <option disabled>Civilité</option>
                                                                <option value="Mr.">Mr.</option>
                                                                <option value="Me.">Me.</option>
                                                                <option value="Mlle.">Mlle.</option>
                                                            </select>
                                                        </div>
                                                        <hr />
                                                        <div class="form-group">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-calendar"></i>
                                                                <input id="inputName" type="date"  name="date_naissance_client" placeholder="Date de Naissance (1990-01-01)" class="form-control" pattern="\d{4}[\-]\d{2}[\-]\d{2}" minlenght="10" maxlenght="10" max="2017-01-01" required/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-phone"></i>
                                                                <input id="inputName" type="phone"  name="phone_prin_client" placeholder="Telephone Principale client" class="form-control" pattern="\d{8}" maxlength="8"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-phone"></i>
                                                                <input id="inputName" type="phone"  name="phone_sec_client" placeholder="Telephone Secondaire client" class="form-control" pattern="\d{8}" maxlength="8"/>
                                                            </div>
                                                        </div>
                                                        <hr />
                                                        <div class="form-group">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-envelope"></i>
                                                                <input id="inputName" type="email"  name="mail_prin_client" placeholder="Email principale client" class="form-control" required/>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-envelope"></i>
                                                                <input id="inputName" type="email"  name="mail_sec_client" placeholder="Email Secondaire client" class="form-control"/>
                                                            </div>
                                                        </div>
                                                        <hr />
                                                        <div class="form-group">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-home"></i>
                                                                <input id="inputName" type="text" name="adresse_prin_client" placeholder="Adresse Principale client" class="form-control" maxlenght="100" required/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-home"></i>
                                                                <input id="inputName" type="text" name="adresse_sec_client" placeholder="Adresse PrincipaleSecondaire client" class="form-control" maxlenght="100" />
                                                            </div>
                                                        </div>
                                                        <hr />
                                                        <div class="form-group box-placeholder">
                                                        <h4 class="box-heading">Montant 1er Transaction :</h4>
                                                            <div class="input-icon right">
                                                                <i class="fa fa-money"></i>
                                                                <input id="inputName" type="text" name="montant_depot_compte" placeholder="125.00" class="form-control" min="125" />
                                                            </div>
                                                        </div>
                                                        <legend>Compte de Connexion</legend>
                                                        <div class="form-group">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-user"></i>
                                                                <input id="inputName" type="text"  name="user_client" placeholder="Nom utilisateur client" class="form-control" required/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-key"></i>
                                                                <input id="inputName" type="text"  name="password_client" placeholder="Mot de passe client" class="form-control" required/>
                                                            </div>
                                                        </div>
                                                        <hr />
                                                    </div>
                                                    <?php
                                                    if(isset($type_user) != null && isset($type_principale) != null && isset($type_secondaire) != null && isset($id_employe) != null && isset($id_succursale) != null ){
                                                    
                                                            ?>
                                                            <div class="form-actions text-center pal">
                                                                <button type="submit" name="save_employer" class="btn btn-primary">
                                                                    Enregistrer
                                                                </button>
                                                            </div>
                                                            <?php
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