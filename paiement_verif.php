<?php
ini_set("display_errors","On");
include("/var/www/Mailjet/mailjet.inc.php");
require_once('/var/www/composer/vendor/autoload.php');
$auto=$_GET["auto"];
$erreur=$_GET["erreur"];
$sign=$_GET["sign"];
$ref=$_GET["ref"];
$montant=$_GET["montant"];
$idTrans=$_GET["idTrans"];
#### AFFICHER CES LIGNES UNIQUEMENT EN MODE DEVELOPPEMENT####
//if($auto=="XXXXXX") $auto="123456";//en mode de test
##### FIN MODE DEVELOPPEMENT #####
if($erreur=="00000" && $auto!="XXXXXX" ){

	$sign=base64_decode($sign); //signature décodée


	//parametres
	$query= $_SERVER['QUERY_STRING'];
	$query=substr($query,0,strrpos($query,"&"));
	$ok = openssl_verify($query, $sign,file_get_contents("pubkey.pem"));
	if ($ok == 1) { //la signature est cohérente avec la clé publique
		//on regarde s'il y a un paiement en attente correspondant
		$montant=$montant/100;
		//echo $montant;
		$data=json_decode(file_get_contents("data/{$ref}.json"));
		$data->payment=new stdClass();
		$data->payment->date=date("Y-m-d H:i:s");
		$data->payment->status="ok";
		$data->payment->montant=$montant;
		$data->idtransaction=$idTrans;
		file_put_contents("data/{$ref}.json", json_encode($data,JSON_PRETTY_PRINT));

	} elseif ($ok == 0) {
		//echo "Signature erronée";
	} else {
		//echo "Erreur de vérification de la signature";
	}


}else{
	//il y a une erreur de traitement.

}


?>