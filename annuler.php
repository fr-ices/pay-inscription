<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Cancellation of the payment</title>
<link href="css/general.css" rel="stylesheet" type="text/css" />

</head>
<body>
<div class="pagelibre">
    <div class="blanc">
        <div class="logoices">
            
            <img height="85" align="top" width="200" border="0" alt="Logo de l'ICES" src="images/PA_Logo_ICES_200x85.gif">
            
        </div>
      </div>
    
     <div class="gradient">
     <?php 
	 if($_GET["erreur"]=="00009") echo "<p>Your payment in 4 times could not be set up. Please check that the validity date of your bank card is posterior at the date of the last payment</p>";
	 ?>
    <p>Your payment was cancelled.</p>
    <p>Your inscription was not taken into account.</p>
    </div>
 </div>
</body>
</html>
