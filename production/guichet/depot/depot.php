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
    <title>FICHE DEPOT | <?php echo utf8_encode($_SESSION['pseudo']);?></title>
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
                        <?php 
                            $requete_t="SELECT * FROM type_transcation WHERE description_type_transaction='DEPOT'";
                            $result_t=mysqli_query($connexion, $requete_t);
                            $count_t=mysqli_num_rows($result_t);
                            if($count_t==1){
                                while($data_get_t=mysqli_fetch_assoc($result_t)){
                                    $type_transcation = $data_get_t["idtype_transcation"];
                                }
                            }

                            $requete_e="SELECT * FROM employe WHERE sha1(user_emp_id)='$iduser'";
                            $result_e=mysqli_query($connexion, $requete_e);
                            $count_e=mysqli_num_rows($result_e);
                            if($count_e==1){
                                while($data_get_e=mysqli_fetch_assoc($result_e)){
                                    $idemploye = $data_get_e["idemploye"];
                                }
                            }
                        ?>
                        </div>
                        <div id="generalTabContent" class="tab-content responsive">
                            <div id="alert-tab" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="panel panel-blue">
                                            <div class="panel-heading">
                                                FICHE DEPOT
                                            </div>
                                            <div class="panel-body pan">
                                            <?php
                                                $ext = "php";
                                                include("function_depot.".$ext);
                                            ?>
                                                <form method="post">
                                                    <div class="form-body pal">
                                                        <div class="form-group">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-credit-card"></i>
                                                                <input id="inputName" type="text"  name="no_compte" placeholder="No Compte" class="form-control" maxlength="9" pattern="[0-9]{1,11}" required/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-money"></i>
                                                                <input id="inputName" type="phone"  name="montant_retrait" placeholder="montant depot" class="form-control" required/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-file-text"></i>
                                                                <textarea id="inputName"  name="message_retrait" placeholder="message depot" class="form-control" required></textarea>
                                                            </div>
                                                        </div>
                                                        <hr />
                                                    </div>
                                                    <?php
                                                    if(isset($type_transcation) && $type_transcation != null && isset($idemploye) && $idemploye != null){
                                                        ?>
                                                        <div class="form-actions text-center pal">
                                                            <button type="submit" name="save_retrait" class="btn btn-primary">
                                                                DEPOT
                                                            </button>
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