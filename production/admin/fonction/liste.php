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
    <title>Liste Fonction | <?php echo utf8_encode($_SESSION['pseudo']);?></title>
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
                            <div class="col-sm-12 col-md-12">
                                <div class="panel profit db mbm">
                                    <div class="panel-body">
                                        <p class="icon">
                                            <i class="icon fa fa-home"></i>
                                        </p>
                                        <h4 class="value">
                                            <span data-counter="" data-start="10" data-end="50" data-step="1" data-duration="0">
                                            </span>
                                            <?php 
                                                $requete_f="SELECT * FROM fonction";
                                                $result_f=mysqli_query($connexion, $requete_f);
                                                echo $count_f=mysqli_num_rows($result_f);
                                            ?>
                                            <span></span></h4>
                                        <p class="description">
                                            Fonctions</p>
                                        <div class="progress progress-sm mbn">
                                            <div role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"
                                                style="width: 80%;" class="progress-bar progress-bar-success">
                                                <span class="sr-only">80% Complete (success)</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="generalTabContent" class="tab-content responsive">
                            <div id="alert-tab" class="tab-pane fade in active">
                                <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <!-- add new function -->
                                    <?php
                                    $ext = "php";
                                    include("add_fonction.".$ext);
                                    ?>
                                    <!-- end add-->
                                    <div class="panel panel-grey">
                                            <div class="panel-heading">
                                                Fiche Nouveau Poste</div>
                                            <div class="panel-body pan">
                                                <form method="post" class="form-horizontal">
                                                <div class="form-body pal">
                                                    <div class="form-group">
                                                        <label for="inputName" class="col-md-3 control-label">
                                                            Titre</label>
                                                        <div class="col-md-9">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-user"></i>
                                                                <input id="inputName" type="text" name="edt_titre" placeholder="Secretaire Adjoint" class="form-control" /></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputSalaire" class="col-md-3 control-label">
                                                            Salaire de base</label>
                                                        <div class="col-md-9">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-money"></i>
                                                                <input id="inputSalaire" type="numeric" name="edt_salaire" placeholder="15075.25" class="form-control" /></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputSalaire" class="col-md-3 control-label">
                                                            Description Poste</label>
                                                        <div class="col-md-9">
                                                            <div class="input-icon right">
                                                                <textarea id="inputSalaire" name="edt_description" type="numeric" placeholder="15000" maxlength="100" class="form-control"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-actions pal">
                                                    <div class="form-group mbn">
                                                        <div class="col-md-6">
                                                            <button type="submit" name="save_fonction" class="btn btn-primary">
                                                                Enregistrer</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                    <?php
                                        $ext = "php";
                                        include("update_fonction.".$ext);
                                    ?>
                                        <div class="panel panel-blue">
                                            <div class="panel-heading">Nos Fonctions</div>
                                            <div class="panel-body">
                                                <table class="table table-hover table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Titre</th>
                                                        <th>Salaire</th>
                                                        <th>Decription</th>
                                                        <th>Modifier</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                        $requete_liste_f="SELECT * FROM fonction";
                                                        $result_liste_f=mysqli_query($connexion, $requete_liste_f);
                                                        $count_l_f=mysqli_num_rows($result_liste_f);
                                                        if($count_l_f>0){
                                                            while($data_liste_f=mysqli_fetch_assoc($result_liste_f)){
                                                                ?>
                                                                <form method="post">
                                                                    <tr class="warning">
                                                                        <td><input type="text" name="update_titre" placeholder="<?php echo utf8_encode($data_liste_f['titre_fonction']);?>"/></td>
                                                                        <td><input type="text" name="update_salaire" placeholder="<?php echo utf8_encode($data_liste_f['salaire_fonction']." Gdes.");?>"/></td>
                                                                        <td><textarea type="text" name="update_desc" placeholder="<?php echo utf8_encode($data_liste_f['desc_fonction']);?>"/></textarea></td>
                                                                        <td><button type="submit" name="btn_update_fonction" value="<?php echo sha1($data_liste_f['idfonction']);?>"><i class="icon fa fa-edit"></button></td> 
                                                                    </tr>
                                                                </form>
                                                                <?php
                                                            }
                                                        }   
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <hr />
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