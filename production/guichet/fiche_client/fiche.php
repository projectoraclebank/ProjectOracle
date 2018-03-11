<?php
session_start(); 
setcookie('ticket_ck', "", time()+ 3660);

include('../utils/connexion.php');
mysqli_autocommit($connexion, false);
$params = explode( "/", $_SERVER['REQUEST_URI'] );
if(!empty($params[6])){
    $selected_client=$params[6];
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
    <title>Fiche Client | <?php echo utf8_encode($_SESSION['pseudo']);?></title>
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
                <!--BEGIN CONTENT-->
                <div class="page-content">
                    <div id="tab-general">
                        <div id="generalTabContent" class="tab-content responsive">
                            <div id="alert-tab" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="panel panel-blue">
                                            <div class="panel-heading">Fiche</div>
                                                <div class="panel-body">
                                                    <?php
        //debut update information Succursale     
                                                    $ext= "php"; 
                                                    include("update_info_agence.".$ext);          
        // fin update information Succursale                                                  
                                                    ?>
                                                    <table class="table table-hover table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th>Code</th>
                                                            <th>Nom</th>
                                                            <th>Fonction</th>
                                                            <th>Agence</th>
                                                            <th>Modifier</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                            $requete_liste_agence="SELECT * FROM client WHERE sha1(idclient)='$selected_client'";
                                                            $result_liste_agence=mysqli_query($connexion, $requete_liste_agence);
                                                            $count_l_agence=mysqli_num_rows($result_liste_agence);
                                                            if($count_l_agence>0){
                                                                while($data_liste_agence=mysqli_fetch_assoc($result_liste_agence)){
                                                                    $id_user_client=$data_liste_agence['id_user_client']
                                                                    ?>
                                                                        <tr class="success">
                                                                            <td><?php echo utf8_encode($data_liste_agence['civilite_client']);?></td>
                                                                            <td><?php echo utf8_encode($data_liste_agence['nom_client']." ".$data_liste_agence['prenom_client']);?></td>
                                                                            <td><?php echo $data_liste_agence['naissance_client'];?></td>
                                                                            <td><?php echo utf8_encode($data_liste_agence['nif_client']." / ".$data_liste_agence['cin_client']);?></td>
                                                                            <td>
                                                                                <div class="tools">
                                                                                    <i class="fa fa-chevron-up"></i>
                                                                                    <i data-toggle="modal" data-target="#modal-config-client" class="fa fa-cog"></i>
                                                                                    <i class="fa fa-refresh"></i><i class="fa fa-times"></i>
                                                                                </div>
                                                                            </td> 
                                                                        </tr>
                                                                    <?php
                                                                }
                                                            } 
                                                        ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!--- modal edit client-->
                                        <!--BEGIN MODAL CONFIG PORTLET-->
                                        <div id="modal-config-client" class="modal fade">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">
                                                            &times;</button>
                                                        <h4 class="modal-title">
                                                            Modal title</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>
                                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eleifend et nisl eget
                                                            porta. Curabitur elementum sem molestie nisl varius, eget tempus odio molestie.
                                                            Nunc vehicula sem arcu, eu pulvinar neque cursus ac. Aliquam ultricies lobortis
                                                            magna et aliquam. Vestibulum egestas eu urna sed ultricies. Nullam pulvinar dolor
                                                            vitae quam dictum condimentum. Integer a sodales elit, eu pulvinar leo. Nunc nec
                                                            aliquam nisi, a mollis neque. Ut vel felis quis tellus hendrerit placerat. Vivamus
                                                            vel nisl non magna feugiat dignissim sed ut nibh. Nulla elementum, est a pretium
                                                            hendrerit, arcu risus luctus augue, mattis aliquet orci ligula eget massa. Sed ut
                                                            ultricies felis.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" data-dismiss="modal" class="btn btn-default">
                                                            Close</button>
                                                        <button type="button" class="btn btn-primary">
                                                            Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--END MODAL CONFIG PORTLET-->
                                        <div class="col-lg-12">
                                            <div class="panel panel-blue" style="background:#FFF;">
                                                <div class="panel-heading">Fonction</div>
                                                    <div class="panel-body">
                                                    <table class="table table-hover table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th>TYPE</th>
                                                            <th>IBAN</th>
                                                            <th>BIC</th>
                                                            <th>SOLDE COMPTE</th>
                                                            <th>CRÉATION</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                            $requete_liste_agence="SELECT * FROM compte INNER JOIN type_compte ON type_compte_id.compte = type_compte.idtype_compte WHERE sha1(id_proprietaire)='$selected_client'";
                                                            $result_liste_agence=mysqli_query($connexion, $requete_liste_agence);
                                                            $count_l_agence=mysqli_num_rows($result_liste_agence);
                                                            if($count_l_agence>0){
                                                                while($data_liste_agence=mysqli_fetch_assoc($result_liste_agence)){
                                                                    ?>
                                                                        <tr class="success">
                                                                            <td><?php echo utf8_encode($data_liste_agence['desc_type_compte']);?></td>
                                                                            <td><?php echo utf8_encode($data_liste_agence['iban']);?></td>
                                                                            <td><?php echo $data_liste_agence['bic'];?></td>
                                                                            <td><?php echo utf8_encode($data_liste_agence['solde_compte']);?></td>
                                                                            <td><?php echo utf8_encode($data_liste_agence['date_creation']);?></td>
                                                                            <td>
                                                                                <div class="tools">
                                                                                    <i class="fa fa-chevron-up"></i>
                                                                                    <i data-toggle="modal" data-target="#modal-config-client" class="fa fa-cog"></i>
                                                                                    <i class="fa fa-refresh"></i><i class="fa fa-times"></i>
                                                                                </div>
                                                                            </td> 
                                                                        </tr>
                                                                    <?php
                                                                }
                                                            } 
                                                        ?>
                                                        </tbody>
                                                    </table>
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- -->
                                        <div class="col-lg-12">
                                            <div class="panel panel-blue" style="background:#FFF;">
                                                <div class="panel-heading">Téléphone</div>
                                                    <div class="panel-body">
                                                        <table class="table table-hover table-bordered">
                                                            <thead>
                                                            <tr>
                                                                <th>TYPE</th>
                                                                <th>Telephone</th>
                                                                <th>Ajouter le</th>
                                                                <th>Modifier</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                                $requete_liste_agence="SELECT * FROM telephone INNER JOIN types_informations ON telephone.id_type_telephone = types_informations.idtypes_informations WHERE sha1(id_proprietaire)='$id_user_client'";
                                                                $result_liste_agence=mysqli_query($connexion, $requete_liste_agence);
                                                                $count_l_agence=mysqli_num_rows($result_liste_agence);
                                                                if($count_l_agence>0){
                                                                    while($data_liste_agence=mysqli_fetch_assoc($result_liste_agence)){
                                                                        ?>
                                                                            <tr class="success">
                                                                                <td><?php echo utf8_encode($data_liste_agence['description_type_infos']);?></td>
                                                                                <td><?php echo utf8_encode($data_liste_agence['numero_telephone']);?></td>
                                                                                <td><?php echo utf8_encode($data_liste_agence['date_creation']);?></td>
                                                                                <td>
                                                                                    <div class="tools">
                                                                                        <i class="fa fa-chevron-up"></i>
                                                                                        <i data-toggle="modal" data-target="#modal-config-client" class="fa fa-cog"></i>
                                                                                        <i class="fa fa-refresh"></i><i class="fa fa-times"></i>
                                                                                    </div>
                                                                                </td> 
                                                                            </tr>
                                                                        <?php
                                                                    }
                                                                } 
                                                            ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- -->
                                        <div class="col-lg-12">
                                            <div class="panel panel-blue" style="background:#FFF;">
                                                <div class="panel-heading">Adresse</div>
                                                    <div class="panel-body">
                                                        <table class="table table-hover table-bordered">
                                                            <thead>
                                                            <tr>
                                                                <th>TYPE</th>
                                                                <th>Adresse</th>
                                                                <th>Ajouter le</th>
                                                                <th>Modifier</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                                $requete_liste_agence="SELECT * FROM adresse INNER JOIN types_informations ON telephone.id_type_adresse = types_informations.idtypes_informations WHERE sha1(nom_proprietaire_id)='$id_user_client'";
                                                                $result_liste_agence=mysqli_query($connexion, $requete_liste_agence);
                                                                $count_l_agence=mysqli_num_rows($result_liste_agence);
                                                                if($count_l_agence>0){
                                                                    while($data_liste_agence=mysqli_fetch_assoc($result_liste_agence)){
                                                                        ?>
                                                                            <tr class="success">
                                                                                <td><?php echo utf8_encode($data_liste_agence['description_type_infos']);?></td>
                                                                                <td><?php echo utf8_encode($data_liste_agence['description_adresse']);?></td>
                                                                                <td><?php echo utf8_encode($data_liste_agence['date_creation']);?></td>
                                                                                <td>
                                                                                    <div class="tools">
                                                                                        <i class="fa fa-chevron-up"></i>
                                                                                        <i data-toggle="modal" data-target="#modal-config-client" class="fa fa-cog"></i>
                                                                                        <i class="fa fa-refresh"></i><i class="fa fa-times"></i>
                                                                                    </div>
                                                                                </td> 
                                                                            </tr>
                                                                        <?php
                                                                    }
                                                                } 
                                                            ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>  
                                            <!-- -->
                                            <div class="col-lg-12">
                                            <div class="panel panel-blue" style="background:#FFF;">
                                                <div class="panel-heading">E-mail Table</div>
                                                    <div class="panel-body">
                                                        <table class="table table-hover table-bordered">
                                                            <thead>
                                                            <tr>
                                                                <th>TYPE</th>
                                                                <th>Email</th>
                                                                <th>Ajouter le</th>
                                                                <th>Modifier</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                                $requete_liste_agence="SELECT * FROM email INNER JOIN types_informations ON email.id_type_mail = types_informations.idtypes_informations WHERE sha1(nom_proprietaire_id)='$id_user_client'";
                                                                $result_liste_agence=mysqli_query($connexion, $requete_liste_agence);
                                                                $count_l_agence=mysqli_num_rows($result_liste_agence);
                                                                if($count_l_agence>0){
                                                                    while($data_liste_agence=mysqli_fetch_assoc($result_liste_agence)){
                                                                        ?>
                                                                            <tr class="success">
                                                                                <td><?php echo utf8_encode($data_liste_agence['description_type_infos']);?></td>
                                                                                <td><?php echo utf8_encode($data_liste_agence['email_emp']);?></td>
                                                                                <td><?php echo utf8_encode($data_liste_agence['date_creation']);?></td>
                                                                                <td>
                                                                                    <div class="tools">
                                                                                        <i class="fa fa-chevron-up"></i>
                                                                                        <i data-toggle="modal" data-target="#modal-config-client" class="fa fa-cog"></i>
                                                                                        <i class="fa fa-refresh"></i><i class="fa fa-times"></i>
                                                                                    </div>
                                                                                </td> 
                                                                            </tr>
                                                                        <?php
                                                                    }
                                                                } 
                                                            ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>  
                                    </div>                                
                                </div>
                                    
                                    <hr />
                                    
                                    
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
}else{
    echo '<meta http-equiv="refresh" content="0;url=../liste_agence/">';
}
?>