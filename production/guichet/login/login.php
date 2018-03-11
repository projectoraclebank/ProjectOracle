<?php session_start(); 
$noConnexion=sha1('NoConnexion');
//setcookie('ticket_connexion', $noConnexion, time()+360, null, null, false, true);
/* creation ticket de connexion */
	$ticket_connexion = $noConnexion.session_id().microtime().rand(2,9);
	$ticket_connexion = hash('sha512', $ticket_connexion);
/*fin */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,800italic,400,700,800">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">
    <?php
        include('../include/css_include.html');
    ?>
</head>
<body style="background: url('../images/bg/bg.png') center center fixed;">
    <div class="page-form">
        <div class="panel panel-blue">
            <div class="panel-body pan">
                <form method="post" class="form-horizontal">
                <div class="form-body pal">
                    <div class="col-md-12 text-center">
                        <h1 style="margin-top: -90px; font-size: 48px;">
                            KAdmin</h1>
                        <br />
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <img src="../images/avatar/profile-pic.png" class="img-responsive" style="margin-top: -35px;" />
                        </div>
                        <div class="col-md-9 text-center">
                            <h1>
                                Hold on, please.</h1>
                            <br />
                            <p>
                                Just sign in and we’ll send you on your way</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-md-3 control-label">
                            Nom utilisateur:</label>
                        <div class="col-md-9">
                            <div class="input-icon right">
                                <i class="fa fa-user"></i>
                                <input id="inputName" type="text" name="loginUsername" placeholder="" class="form-control" /></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-md-3 control-label">
                            Mot de passe:</label>
                        <div class="col-md-9">
                            <div class="input-icon right">
                                <i class="fa fa-lock"></i>
                                <input id="inputPassword" type="password" name="loginPassword" placeholder="******" class="form-control" /></div>
                        </div>
                    </div>
                    <div class="form-group mbn">
                        <div class="col-lg-12" align="right">
                            <div class="form-group mbn">
                                <div class="col-lg-3">
                                    &nbsp;
                                </div>
                                <div class="col-lg-9">
                                    <a href="./" class="btn btn-default">Go back</a>&nbsp;&nbsp;
                                    <button type="submit" name="login" class="btn btn-default">
                                        Sign In</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
                <?php
                  if(isset($_POST['login'])){
                    if(isset($_POST['loginUsername']) && isset($_POST['loginPassword'])){
                      $extension='.php';
                      $extension='.php';
                      $chemin="../utils/";
                      include($chemin.'connexion'.$extension);
                      mysqli_autocommit($connexion, false);
                      $nomUS=strip_tags(htmlspecialchars($_POST['loginUsername']));
                      $passUS=sha1(strip_tags(htmlspecialchars($_POST['loginPassword'])));
                      $requete="SELECT * FROM user INNER JOIN type_user ON type_user.idtype_user = user.id_type_user WHERE pseudo='$nomUS' AND password='$passUS'";
                      $result_connexion=mysqli_query($connexion, $requete);
                      $count=mysqli_num_rows($result_connexion);
                      $id_login=0;
                        
                      if($count>0 && $count==1){
                        while($data_con=mysqli_fetch_assoc($result_connexion)){
                            $iduser=sha1(strip_tags(htmlspecialchars($data_con['iduser'])));
                            $pseudo=strip_tags(htmlspecialchars($data_con['pseudo']));
                            $date_creation=strip_tags(htmlspecialchars($data_con['date_creation']));
                            $id_type_user=sha1(strip_tags(htmlspecialchars($data_con['id_type_user'])));
                            $description_type_user=strip_tags(htmlspecialchars($data_con['description_type_user']));
                            if($description_type_user != "EMPLOYER"){
                                session_destroy ();
                                $_SESSION[] = array();
                                ?>
                                <div class="alert alert-warning alert-dismissable">
                                    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                    <strong>Alerte!</strong> Ce Compte n'est pas autorisé.
                                </div>
                                <?php
                            }else{ 
                                $valeur_connexion=strip_tags(htmlspecialchars($iduser.$pseudo.$id_type_user));
                                $ticket_connexion = $valeur_connexion.session_id().microtime().rand(2,9);
                                $ticket_connexion = hash('sha512', $ticket_connexion);
                                $_SESSION['ticket_connexion']=$ticket_connexion;

                                $_SESSION['iduser'] = $iduser;
                                $_SESSION['pseudo'] = $pseudo;
                                $_SESSION['date_creation'] = $date_creation;
                                $_SESSION['id_type_user'] = $id_type_user;
                                $_SESSION['description_type_user'] = $description_type_user;
                                print("<script type=\"text/javascript\">setTimeout('location=(\"../dashboard/\")',0);</script>");
                            }
                        } 
                      }else{
                          //utilisateur n'existe pas 
                        session_destroy ();
                        $_SESSION[] = array();
                        ?>
                        <div class="alert alert-warning alert-dismissable">
                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                <strong>Alerte!</strong> Vérifier vos informations et essayer à nouveau.
                        </div>
                        <?php
                      }
                    }else{
                        //vos champs sont vides
                        ?>
                        <div class="alert alert-warning alert-dismissable">
                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                <strong>Alerte!</strong> vos champs sont vides.
                        </div>
                        <?php
                    }
                  }  
                      ?>
            </div>
        </div>
        <div class="col-lg-12 text-center">
            <p>
                Forgot Something ?
            </p>
        </div>
    </div>
</body>
</html>
