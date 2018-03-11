<?php
session_start(); 
setcookie('ticket_ck', "", time()+ 3660);

include('../utils/connexion.php');
mysqli_autocommit($connexion, false);
$params = explode( "/", $_SERVER['REQUEST_URI'] );
if(!empty($params[6])){
    $selected_employer=$params[6];
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
    <title>Fiche Employer | <?php echo utf8_encode($_SESSION['pseudo']);?></title>
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
                        <div id="sum_box" class="row mbl">
                            <div class="col-sm-6 col-md-6">
                                <div class="panel profit db mbm">
                                    <div class="panel-body">
                                        <p class="icon">
                                            <i class="icon fa fa-home"></i>
                                        </p>
                                        <h4 class="value">
                                            <span data-counter="" data-start="10" data-end="50" data-step="1" data-duration="0">
                                            </span>
                                            <?php 
                                                $requete_agence="SELECT * FROM agence WHERE actif_agence=1";
                                                $result_agence=mysqli_query($connexion, $requete_agence);
                                                echo $count_agence=mysqli_num_rows($result_agence);
                                            ?>
                                            <span></span></h4>
                                        <p class="description">
                                            Agence Actif</p>
                                        <div class="progress progress-sm mbn">
                                            <div role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"
                                                style="width: 80%;" class="progress-bar progress-bar-success">
                                                <span class="sr-only">80% Complete (success)</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="panel income db mbm">
                                    <div class="panel-body">
                                        <p class="icon"> 
                                            <i class="icon fa fa-group"></i>
                                        </p>
                                        <h4 class="value">
                                            <span>
                                            <?php 
                                                $requete_agence="SELECT * FROM agence WHERE actif_agence=0";
                                                $result_agence=mysqli_query($connexion, $requete_agence);
                                                echo $count_agence=mysqli_num_rows($result_agence);
                                            ?>
                                            </span><span></span></h4>
                                        <p class="description">
                                            Agence Inactif</p>
                                        <div class="progress progress-sm mbn">
                                            <div role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                                style="width: 60%;" class="progress-bar progress-bar-info">
                                                <span class="sr-only">60% Complete (success)</span></div>
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
                                                        $requete_liste_agence="SELECT * FROM employe_fonction INNER JOIN employe ON employe_fonction.emp_fonc_id = employe.idemploye INNER JOIN fonction ON employe_fonction.fonction_id = fonction.idfonction INNER JOIN agence ON employe.id_succursale = agence.idagence WHERE sha1(employe.idemploye)= '$selected_employer' ORDER BY agence.idagence";
                                                        $result_liste_agence=mysqli_query($connexion, $requete_liste_agence);
                                                        $count_l_agence=mysqli_num_rows($result_liste_agence);
                                                        if($count_l_agence>0){
                                                            while($data_liste_agence=mysqli_fetch_assoc($result_liste_agence)){
                                                                if($data_liste_agence['actif_emp'] == 0){
                                                                    ?>
                                                                    <tr class="warning">
                                                                        <td><?php echo utf8_encode($data_liste_agence['code_emp']);?></td>
                                                                        <td><?php echo utf8_encode($data_liste_agence['nom_emp']." ".$data_liste_agence['prenom_emp']);?></td>
                                                                        <td><?php echo $data_liste_agence['titre_fonction'];?></td>
                                                                        <td><?php echo utf8_encode($data_liste_agence['nom_agence']);?></td>
                                                                        <td><a href="#../fiche_employer/<?php echo sha1($data_liste_agence['idemploye']);?>"><i class="icon fa fa-edit"></i><i class="fa fa-cog"></i></a></td> 
                                                                    </tr>
                                                                    <?php
                                                                }else{
                                                                    ?>
                                                                    <tr class="success">
                                                                        <td><?php echo utf8_encode($data_liste_agence['code_emp']);?></td>
                                                                        <td><?php echo utf8_encode($data_liste_agence['nom_emp']." ".$data_liste_agence['prenom_emp']);?></td>
                                                                        <td><?php echo $data_liste_agence['titre_fonction'];?></td>
                                                                        <td><?php echo utf8_encode($data_liste_agence['nom_agence']);?></td>
                                                                        <td><a href="#../fiche_employer/<?php echo sha1($data_liste_agence['idemploye']);?>"><i class="icon fa fa-edit"></i><i class="fa fa-cog"></i></a></td> 
                                                                    </tr>
                                                                    <?php
                                                                }
                                                            }
                                                        }   
                                                    ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="panel panel-blue" style="background:#FFF;">
                                                <div class="panel-heading">Fonction</div>
                                                    <div class="panel-body">
                                                        <table class="table table-hover table-bordered">
                                                            <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Username</th>
                                                                <th>Age</th>
                                                                <th>Status</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td>Henry</td>
                                                                <td>23</td>
                                                                <td><span class="label label-sm label-success">Approved</span></td>
                                                            </tr>
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
                                                                <th>#</th>
                                                                <th>Username</th>
                                                                <th>Age</th>
                                                                <th>Status</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td>Henry</td>
                                                                <td>23</td>
                                                                <td><span class="label label-sm label-success">Approved</span></td>
                                                            </tr>
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
                                                                <th>#</th>
                                                                <th>Username</th>
                                                                <th>Age</th>
                                                                <th>Status</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td>Henry</td>
                                                                <td>23</td>
                                                                <td><span class="label label-sm label-success">Approved</span></td>
                                                            </tr>
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
                                                                <th>#</th>
                                                                <th>Username</th>
                                                                <th>Age</th>
                                                                <th>Status</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td>Henry</td>
                                                                <td>23</td>
                                                                <td><span class="label label-sm label-success">Approved</span></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>  
                                            <!-- -->
                                            <div class="col-lg-12">
                                            <div class="panel panel-blue" style="background:#FFF;">
                                                <div class="panel-heading">Historique de connexion</div>
                                                    <div class="panel-body">
                                                        <table class="table table-hover table-bordered">
                                                            <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Username</th>
                                                                <th>Age</th>
                                                                <th>Status</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td>Henry</td>
                                                                <td>23</td>
                                                                <td><span class="label label-sm label-success">Approved</span></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- -->
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