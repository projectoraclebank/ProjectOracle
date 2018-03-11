
<?php
/*$serveur='astruitiercom.ipagemysql.com';
$utilisateur='astruitier_root';
$password='admin_db_ast';
$nom_db='astruitier_db';*/
$serveur='localhost';
$utilisateur='root';
$password='';
$nom_db='project_oracle_final';

/*$con=new mysqli($serveur,$utilisateur,$password,$nom_db);
if (mysqli_connect_errno()) {
    printf("Échec de la connexion : %s\n", $con->connect_error);
    exit();
}*/
$connexion=mysqli_connect($serveur,$utilisateur,$password,$nom_db);
if(!$connexion)
{
	die('Erreur de conexion ('. mysqli_connect_errno() . ')' . mysqli_connect_error());	
	exit();
}
?>
