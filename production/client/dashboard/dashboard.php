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
    <title>Dashboard | <?php echo utf8_encode($_SESSION['pseudo']);?></title>
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
                include('../include/sidebar_include.html');
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
                            <div class="col-sm-6 col-md-3">
                                <div class="panel profit db mbm">
                                    <div class="panel-body">
                                        <p class="icon">
                                            <i class="icon fa fa-shopping-cart"></i>
                                        </p>
                                        <h4 class="value">
                                            <span data-counter="" data-start="10" data-end="50" data-step="1" data-duration="0">
                                            </span><span>$</span></h4>
                                        <p class="description">
                                            Profit description</p>
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
                                            <i class="icon fa fa-money"></i>
                                        </p>
                                        <h4 class="value">
                                            <span>215</span><span>$</span></h4>
                                        <p class="description">
                                            Income detail</p>
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
                                            <i class="icon fa fa-signal"></i>
                                        </p>
                                        <h4 class="value">
                                            <span>215</span></h4>
                                        <p class="description">
                                            Task completed</p>
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
                                            <i class="icon fa fa-group"></i>
                                        </p>
                                        <h4 class="value">
                                            <span>128</span></h4>
                                        <p class="description">
                                            Visitor description</p>
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
                                        <div id="change-transitions" class="row">
                                            <div class="col-md-4">
                                                <div class="box-placeholder">
                                                    <a href="#"  class="btn btn-success btn-block">Ajouter Employer</a>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="box-placeholder">
                                                    <a href="#"  class="btn btn-success btn-block">Ajouter Agence</a>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="box-placeholder">
                                                    <a href="#"  class="btn btn-success btn-block">Ajouter Fonction</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div id="change-transitions" class="row">
                                            <div class="col-md-4">
                                                <div class="box-placeholder">
                                                    <a href="#"  class="btn btn-info btn-block">Liste Employer</a>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="box-placeholder">
                                                    <a href="#"  class="btn btn-info btn-block">Liste Agence</a>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="box-placeholder">
                                                    <a href="#"  class="btn btn-info btn-block">Liste Fonction</a>
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