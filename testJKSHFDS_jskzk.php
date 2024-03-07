<?php
$refpaiement="pay-1-1".date("ymd-his");
$codeetudiant="12345";
$montant=150;
$email="info@pro-display.fr";
$template=file_get_contents("/usr/local/apache/cgi-bin/requetePaybox/templateTestPay.txt");

$template=preg_replace("/##refpaiement##/",$refpaiement,$template);
$template=preg_replace("/##montant##/",$montant,$template);
$template=preg_replace("/##email##/",$email,$template);

$testFile="/usr/local/apache/cgi-bin/requetePaybox/{$refpaiement}.txt";
$transactionFile="data/{$refpaiement}.json";
$transctionObj=new stdClass();
$transctionObj->uptopay=$template;
$transctionObj->codeetudiant=$codeetudiant;
$transctionObj->email=$email;

file_put_contents($testFile,$template);
file_put_contents($transactionFile,json_encode($transctionObj,JSON_PRETTY_PRINT));

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <FORM id="payboxForm" ACTION ="/payform/index.php" METHOD = post>
    <INPUT TYPE = "hidden" NAME = "PBX_MODE" VALUE = "13">
    <INPUT id="payboxFile" TYPE = "text"  NAME = "PBX_OPT" VALUE = "<?php echo $testFile;?>"> <INPUT TYPE = 'submit' NAME = "bouton_paiement" VALUE = "paiement">
</FORM>
</body>
</html>