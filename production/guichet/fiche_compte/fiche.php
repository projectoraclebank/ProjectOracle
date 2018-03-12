<?php
session_start(); 
setcookie('ticket_ck', "", time()+ 3660);

include('../utils/connexion.php');
mysqli_autocommit($connexion, false);
$params = explode( "/", $_SERVER['REQUEST_URI'] );
if(!empty($params[6])){
   $selected_compte=$params[6];
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
                                                $requete_agence="SELECT * FROM transaction WHERE compte_donneur_id='$selected_compte'";
                                                $result_agence=mysqli_query($connexion, $requete_agence);
                                                echo $count_agence=mysqli_num_rows($result_agence);
                                            ?>
                                            <span></span></h4>
                                        <p class="description">
                                            Transaction OUT</p>
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
                                                $requete_agence="SELECT * FROM transaction WHERE compte_beneficiare_id='$selected_compte' ";
                                                $result_agence=mysqli_query($connexion, $requete_agence);
                                                echo $count_agence=mysqli_num_rows($result_agence);
                                            ?>
                                            </span><span></span></h4>
                                        <p class="description">
                                            Transaction IN</p>
                                        <div class="progress progress-sm mbn">
                                            <div role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                                style="width: 60%;" class="progress-bar progress-bar-info">
                                                <span class="sr-only">60% Complete (success)</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <div class="panel income mbm">
                                    <div class="panel-body">
                                    <?php
                                    $requete_c="SELECT * FROM compte INNER JOIN client ON compte.id_proprietaire = client.idclient INNER JOIN type_compte ON compte.type_compte_id = type_compte.idtype_compte WHERE idcompte='$selected_compte'";
                                    $result_c=mysqli_query($connexion, $requete_c);
                                    $count_c=mysqli_num_rows($result_c);
                                    if($count_c==1){
                                        while($data_get_c=mysqli_fetch_assoc($result_c)){
                                            $iban = $data_get_c["iban"];
                                            $bic = $data_get_c["bic"];
                                            $desc_type_compte = $data_get_c["desc_type_compte"];
                                            $plafond_semaine = $data_get_c["plafond_semaine"];
                                            $nom_client =  utf8_encode($data_get_c["civilite_client"]." ".$data_get_c["nom_client"]." ".$data_get_c["prenom_client"]);  
                                            $nif_client = $data_get_c["nif_client"];
                                            $idcompte = $data_get_c["idcompte"];
                                            $cin_client = $data_get_c["cin_client"];
                                            $naissance_client = $data_get_c["naissance_client"];
                                            //table client
                                            $id_proprietaire = $data_get_c["id_proprietaire"];
                                            //table user
                                            $userClientID = $data_get_c["userClientID"];
                                            $date_creation_ct = $data_get_c["date_creation_ct"];
                                            $date_mise_a_jour = $data_get_c["date_mise_a_jour"];
                                            $solde_compte = $data_get_c["solde_compte"];
                                        }
                                    }
                                    ?>
                                        <h3 class="description"><u><?php echo $nom_client; ?></u></h3>
                                        <hr />

                                        <p class="description">COMPTE &emsp; : &emsp;&emsp;<?php echo $idcompte." / ".$desc_type_compte; ?></p>
                                        <p class="description">Plafond Semaine &emsp; : &emsp;&emsp;<?php echo $plafond_semaine; ?></p>
                                        <p class="description">Solde &emsp; : &emsp;&emsp;<?php echo $solde_compte; ?></p>
                                        <p class="description">Créé le &emsp; : &emsp;&emsp;<?php echo $date_creation_ct; ?></p>
                                        
                                        <hr />
                                        <p class="description">NIF & CIN &emsp; : &emsp;&emsp;<?php echo $nif_client." / ".$cin_client; ?></p>
                                        <p class="description">IBAN & BIC &emsp; : &emsp;&emsp;<?php echo $iban." / ".$bic; ?></p>
                                        <hr />
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="generalTabContent" class="tab-content responsive">
                            <div id="alert-tab" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="panel panel-blue">
                                            <div class="panel-heading">Autres Compte</div>
                                                <div class="panel-body">
                                                    <?php
        //debut update information Succursale     
                                                    /*$ext= "php"; 
                                                    include("update_info_agence.".$ext); */         
        // fin update information Succursale                                                  
                                                    ?>
                                                    <table class="table table-hover table-bordered">
                                                        <thead>
                                                        <tr class="bg bg-green">
                                                            <th>No Compte</th>
                                                            <th>IBAN</th>
                                                            <th>BIC</th>
                                                            <th>SOLDE</th>
                                                            <th>TYPE</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        $requete_cc="SELECT * FROM compte INNER JOIN client ON compte.id_proprietaire = client.idclient INNER JOIN type_compte ON compte.type_compte_id = type_compte.idtype_compte WHERE id_proprietaire='$id_proprietaire'";
                                                        $result_cc=mysqli_query($connexion, $requete_cc);
                                                        $count_cc=mysqli_num_rows($result_cc);
                                                        if($count_cc>0){
                                                            while($data_get_c=mysqli_fetch_assoc($result_cc)){
                                                                ?>
                                                                <tr class="success">
                                                                    <td><?php echo utf8_encode($data_get_c['idcompte']);?></td>
                                                                    <td><?php echo utf8_encode($data_get_c['iban']);?></td>
                                                                    <td><?php echo $data_get_c['bic'];?></td>
                                                                    <td><?php echo utf8_encode(floatval($data_get_c['solde_compte']));?></td>
                                                                    <td><?php echo utf8_encode($data_get_c['desc_type_compte']);?></td>
                                                                    
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
                                        <div class="col-lg-12">
                                            <div class="panel panel-blue" style="background:#FFF;">
                                                <div class="panel-heading">Historique Transaction</div>
                                                    <div class="panel-body">
                                                        <table class="table table-hover table-bordered">
                                                            <thead>
                                                            <tr class="bg bg-green">
                                                                <th>DONNEUR</th>
                                                                <th>BENEFICIARE</th>
                                                                <th>MONTANT</th>
                                                                <th>CREATION</th>
                                                                <th>MESSAGE</th>
                                                                <th>INFORMATION</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            $requete_cc="SELECT * FROM transaction WHERE compte_donneur_id='$selected_compte' OR compte_beneficiare_id='$selected_compte'";
                                                            $result_cc=mysqli_query($connexion, $requete_cc);
                                                            $count_cc=mysqli_num_rows($result_cc);
                                                            if($count_cc>0){
                                                                while($data_get_c=mysqli_fetch_assoc($result_cc)){
                                                                    ?>
                                                                    <tr class="success">
                                                                        <td>
                                                                            <?php 
                                                                            if($selected_compte==$data_get_c['compte_donneur_id']){
                                                                                echo "<b>".utf8_encode($data_get_c['compte_donneur_id'])."</b>";
                                                                            }else{
                                                                                echo "<b>".utf8_encode($data_get_c['compte_donneur_id'])."</b>";
                                                                            }
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php 
                                                                            if($selected_compte==$data_get_c['compte_beneficiare_id']){
                                                                                echo "<b>".utf8_encode($data_get_c['compte_beneficiare_id'])."</b>";
                                                                            }else{
                                                                                echo "<b>".utf8_encode($data_get_c['compte_beneficiare_id'])."</b>";
                                                                            }
                                                                            ?>
                                                                        </td>
                                                                        <td><?php echo $data_get_c['montant_transaction'];?></td>
                                                                        <td><?php echo utf8_encode($data_get_c['date_creation']);?></td>
                                                                        <td><?php echo utf8_encode($data_get_c['information_textuel']);?></td>
                                                                        <td><?php echo utf8_encode($data_get_c['message_communication']);?></td>
                                                                        
                                                                        
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
                                                            <tr class="bg bg-green">
                                                                <th>NUMERO</th>
                                                                <th>AJOUTER LE</th>
                                                                <th>TYPE</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                                $requete_cc="SELECT * FROM telephone INNER JOIN types_informations ON telephone.id_type_telephone = types_informations.idtypes_informations WHERE id_proprietaire='$userClientID'";
                                                                $result_cc=mysqli_query($connexion, $requete_cc);
                                                                $count_cc=mysqli_num_rows($result_cc);
                                                                if($count_cc>0){
                                                                    while($data_get_c=mysqli_fetch_assoc($result_cc)){
                                                                        ?>
                                                                        <tr class="success">
                                                                            <td><?php echo $data_get_c['numero_telephone'];?></td>
                                                                            <td><?php echo utf8_encode($data_get_c['date_creation']);?></td>
                                                                            <td><?php echo utf8_encode($data_get_c['description_type_infos']);?></td>
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
                                                            <tr class="bg bg-green">
                                                                <th>ADRESSE</th>
                                                                <th>AJOUTER LE</th>
                                                                <th>TYPE</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                                $requete_cc="SELECT * FROM adresse INNER JOIN types_informations ON adresse.id_type_adresse = types_informations.idtypes_informations WHERE nom_proprietaire_id='$userClientID'";
                                                                $result_cc=mysqli_query($connexion, $requete_cc);
                                                                $count_cc=mysqli_num_rows($result_cc);
                                                                if($count_cc>0){
                                                                    while($data_get_c=mysqli_fetch_assoc($result_cc)){
                                                                        ?>
                                                                        <tr class="success">
                                                                            <td><?php echo $data_get_c['description_adresse'];?></td>
                                                                            <td><?php echo utf8_encode($data_get_c['date_creation']);?></td>
                                                                            <td><?php echo utf8_encode($data_get_c['description_type_infos']);?></td>
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
                                                <div class="panel-heading">E-mail</div>
                                                    <div class="panel-body">
                                                        <table class="table table-hover table-bordered">
                                                            <thead>
                                                            <tr class="bg bg-green">
                                                                <th>EMAIL</th>
                                                                <th>AJOUTER LE</th>
                                                                <th>TYPE</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                                $requete_cc="SELECT * FROM email INNER JOIN types_informations ON email.id_type_mail = types_informations.idtypes_informations WHERE nom_proprietaire_id='$userClientID'";
                                                                $result_cc=mysqli_query($connexion, $requete_cc);
                                                                $count_cc=mysqli_num_rows($result_cc);
                                                                if($count_cc>0){
                                                                    while($data_get_c=mysqli_fetch_assoc($result_cc)){
                                                                        ?>
                                                                        <tr class="success">
                                                                            <td><?php echo $data_get_c['email_emp'];?></td>
                                                                            <td><?php echo utf8_encode($data_get_c['date_creation']);?></td>
                                                                            <td><?php echo utf8_encode($data_get_c['description_type_infos']);?></td>
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
                                                <div class="panel-heading">Historique de connexion</div>
                                                    <div class="panel-body">
                                                        <table class="table table-hover table-bordered">
                                                            <thead>
                                                            <tr class="bg bg-green">
                                                                <th>IP</th>
                                                                <th>HEURE DE CONNEXION</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                                $requete_cc="SELECT * FROM login_hystoric WHERE user_login='$userClientID'";
                                                                $result_cc=mysqli_query($connexion, $requete_cc);
                                                                $count_cc=mysqli_num_rows($result_cc);
                                                                if($count_cc>0){
                                                                    while($data_get_c=mysqli_fetch_assoc($result_cc)){
                                                                        ?>
                                                                        <tr class="success">
                                                                            <td><?php echo $data_get_c['ip_login'];?></td>
                                                                            <td><?php echo utf8_encode($data_get_c['date_login']);?></td>
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