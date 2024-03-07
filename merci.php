<?php
ini_set("display_errors","On");
$auto=$_GET["auto"];
$erreur=$_GET["erreur"];
$sign=$_GET["sign"];
$ref=$_GET["ref"];
$montant=$_GET["montant"];
$idTrans=$_GET["idTrans"];
$autoreload=true;
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
		$montant=$montant/100;
		$data=json_decode(file_get_contents("data/{$ref}.json"));
		if( @$data->payment->status == "ok") {
			$autoreload=false;
		}
	
	} elseif ($ok == 0) {
		exit();
	} else {
		exit();
	}
	
	
}else{
	//il y a une erreur de traitement.
	exit();
}


?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Registration ok</title>
<?php if($autoreload){  ?>
	<script>
	setTimeout(pagereload, 3000);
	function pagereload(){
		location.reload(); 	
	}
	</script>
<?php } ?>
</head>
<body>
	<h1>MERCI !</h1>
	<?php 
		
		var_dump($data);

	?>
</html>