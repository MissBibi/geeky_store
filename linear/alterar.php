<?php require_once('../Connections/geeky_store.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}?>


<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE cliente SET nome=%s, morada=%s, codpostal=%s, cospostal2=%s, telefone=%s, sexo=%s, datanasc=%s, localidade=%s, password=%s, nif=%s WHERE email=%s",
                       GetSQLValueString($_POST['nome'], "text"),
                       GetSQLValueString($_POST['morada'], "text"),
                       GetSQLValueString($_POST['codpostal'], "int"),
                       GetSQLValueString($_POST['codpostal2'], "int"),
                       GetSQLValueString($_POST['telefone'], "int"),
                       GetSQLValueString($_POST['sexo'], "text"),
                       GetSQLValueString($_POST['datanasc'], "date"),
                       GetSQLValueString($_POST['localidade'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['nif'], "int"),
                       GetSQLValueString($_POST['hiddenField'], "text"));

  mysql_select_db($database_geeky_store, $geeky_store);
  $Result1 = mysql_query($updateSQL, $geeky_store) or die(mysql_error());

  $updateGoTo = "altsuc.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_alterar = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_alterar = $_SESSION['MM_Username'];
}
mysql_select_db($database_geeky_store, $geeky_store);
$query_alterar = sprintf("SELECT * FROM cliente WHERE email = %s", GetSQLValueString($colname_alterar, "text"));
$alterar = mysql_query($query_alterar, $geeky_store) or die(mysql_error());
$row_alterar = mysql_fetch_assoc($alterar);
$totalRows_alterar = mysql_num_rows($alterar);

//initialize the session
if (!isset($_SESSION)) {
  session_start();
}
?>

<!DOCTYPE HTML>

<html>
	<head>
		<title>Geeky Store</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,700,500,900' rel='stylesheet' type='text/css'>
		<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
		<link href="../SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css">
		<link href="../SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="js/skel.min.js"></script>
	<script src="js/skel-panels.min.js"></script>
	<script src="js/init.js"></script>
	<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
	<script src="../SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
	<script src="../SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
	<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
		</noscript>
		<script type="text/javascript">
			<!--
			var image1=new Image()
			image1.src="images/slide0.jpg"
			var image2=new Image()
			image2.src="images/slide.jpg"
			var image3=new Image()
			image3.src="images/slide2.jpg"
			var image4=new Image()
			image4.src="images/slide3.jpg"
			var image5=new Image()
			image5.src="images/slide4.jpg"
			var image6=new Image()
			image6.src="images/slide5.jpg"
			var image7=new Image()
			image7.src="images/slide6.jpg"
			var image8=new Image()
			image8.src="images/slide7.jpg"
			//-->
		</script>
	</head>
	<body class="homepage">

	<!-- Header -->	
	
		
		<div id="header">
			<div class="container"> 
				
			  <!-- Logo -->
			  <<div id="logo">
					<div class="slider">
					<div class="load"> </div>
					<img class="slide" id="imgslide" src="images/slide0.jpg"  name="slide">
					<script type"text/javascript">
					<!--
					var step=1
					function slideit(){
					document.images.slide.src=eval("image"+step+".src")
					if(step<8)
					step++
					else
					step=1
					setTimeout("slideit()",4000)
					}
					slideit()
					//-->
					</script>
					</div>
					<img id="imglogo" src="images/game.png">
				</div>			
		  </div>
		</div>

		<div id='cssmenu'>
			<img id="menulogo" src="images/logo4.png" >
			<ul>
				<li><a href='#'><span>Página Inicial</span></a></li>
				<li class='active has-sub'><a href='#'><span>Produtos</span></a>
			<ul>
				<li class='has-sub'><a href='#'><span>Categorias</span></a>
				<ul>
					<li><a href='pop.php'><span>Pop Figure</span></a></li>
					<li><a href='colar.php'><span>Colar</span></a></li>
					<li><a href='candeeiro.php'><span>Candeeiro</span></a></li>
					<li><a href='almofada.php'><span>Almofada</span></a></li>
					<li><a href='tapete.php'><span>Tapete</span></a></li>
					<li><a href='caneca.php'><span>Canecas</span></a></li>
					<li><a href='poster.php'><span>Poster</span></a></li>
					<li class='last'><a href='colecionavel.php'><span>Objetos Colecionáveis</span></a></li>
				</ul>
				</li>
			<li class='has-sub'><a href='#'><span>Marcas</span></a>
            <ul>
               <li><a href='assassins.php'><span>Assassin's Creed</span></a></li>
               <li><a href='dc.php'><span>Dc Comics</span></a></li>
			    <li><a href='marvel.php'><span>Marvel Comics</span></a></li>
               <li><a href='hp.php'><span>Harry Potter</span></a></li>
			    <li><a href='dragonb.php'><span>Dragon Ball</span></a></li>
               <li><a href='onep.php'><span>One Piece</span></a></li>
               <li class='last'><a href='starwars.php'><span>Star Wars</span></a></li>
            </ul>
			</li>
			</ul>
				</li>
			<li class='has-sub'><a href='#'><span>Cliente</span></a>
            <ul>
               <li><a href='registrar.php'><span>Registar</span></a></li>
                  <li><a href='alterar.php'><span>Alterar</span></a></li>
			   <li><a href='login.php'><span>Login</span></a></li>                                
            </ul>
			</li>
			
	      </ul>
		</div>

		<div id="featured">
			<div class="container">
				<header>               
					<h2 id="hg" >Altere os seus dados aqui!</h2>
				</header>
			</div>
		</div>
		<br>
		<br>	
	<!-- Main -->
					
				
	<form action="<?php echo $editFormAction; ?>" name="form1" method="POST">
		<table class="darkTable2">
        		<thead>
          		<tr>
	      			<th colspan="2"><div align="center">Alterar Dados</div></th>
          		</tr>
       			</thead>
        		<tbody>
          		<tr>
	      			<td width="213">Nome</td>
	      			<td width="194"><span id="sprytextfield1">
	        		<label for="nome2"></label>
	        		<input name="nome" type="text" id="nome2" value="<?php echo $row_alterar['nome']; ?>">
          			<span class="textfieldRequiredMsg">É necessário um valor.</span></span></td>
        		</tr>
        		<tr>
	      			<td>Data de nascimento</td>
	      			<td><span id="sprytextfield5">
          			<label for="datanasc"></label>
          			<input name="datanasc" type="text" id="datanasc" placeholder="AAAA/MM/DD" value="<?php echo $row_alterar['datanasc']; ?>">
          			<span class="textfieldRequiredMsg">É necessário um valor .</span><span class="textfieldInvalidFormatMsg">Formato inválido, formato aaaa/mm/dd.</span></span></td>
        		</tr>
        		<tr>
	      			<td>Morada</td>
	      			<td><span id="sprytextfield2">
	        		<label for="morada"></label>
	        		<input name="morada" type="text" id="morada" value="<?php echo $row_alterar['morada']; ?>">
          			<span class="textfieldRequiredMsg">É necessário um valor.</span></span></td>
        		</tr>
	    		<tr>
	      			<td>Localidade</td>
	      			<td><span id="sprytextfield3">
	        		<label for="localidade"></label>
	       		 	<input name="localidade" type="text" id="localidade" value="<?php echo $row_alterar['localidade']; ?>">
         		 	<span class="textfieldRequiredMsg">É necessário um valor.</span></span></td>
        		</tr>
        		<tr>
	      			<td>Codigo Postal</td>
	      			<td><span id="sprytextfield8">
          			<label for="codpostal"></label>
          			<input name="codpostal" type="text" id="codpostal" value="<?php echo $row_alterar['codpostal']; ?>" size="9" maxlength="4">
          			<span class="textfieldRequiredMsg">É necessário um valor.</span><span class="textfieldInvalidFormatMsg">Formato inválido.</span></span><span id="sprytextfield9">--
          			<label for="codpostal2"></label>
          			<input name="codpostal2" type="text" id="codpostal2" value="<?php echo $row_alterar['cospostal2']; ?>" size="9" maxlength="3">
          			<span class="textfieldRequiredMsg">É necessário um valor.</span><span class="textfieldInvalidFormatMsg">Formato inválido.</span></span></td>
        		</tr>
	    		<tr>
	      			<td>Telefone</td>
	      			<td><span id="sprytextfield6">
          			<label for="telefone"></label>
          			<input name="telefone" type="text" id="telefone" value="<?php echo $row_alterar['telefone']; ?>" maxlength="9">
          			<span class="textfieldRequiredMsg">É necessário um valor.</span><span class="textfieldInvalidFormatMsg">Formato inválido.</span></span></td>
        		</tr>
        		<tr>
	      			<td height="66">Sexo</td>
	      			<td><p>
	        		<label>
	          		<input type="radio" name="sexo" value="<?php echo $row_alterar['sexo']; ?>" id="sexo_0">Femenino</label><br>
	        		<label>
	          		<input type="radio" name="sexo" value="<?php echo $row_alterar['sexo']; ?>" id="sexo_1">Maculino</label><br>
          			</p></td>
        		</tr>
	    		<tr>
	      			<td>Email
          			<input name="hiddenField" type="hidden" id="hiddenField" value="<?php echo $row_alterar['email']; ?>"></td>
	      			<td><span id="sprytextfield4">
          			<label for="email"></label>
          			<input name="email" type="text" id="email" placeholder="*******@****.com" value="<?php echo $row_alterar['email']; ?>">
          			<span class="textfieldRequiredMsg">É necessário um valor.</span><span class="textfieldInvalidFormatMsg">Formato inválido.</span></span></td>
        		</tr>
        		<tr>
	      			<td >Palavra passe</td>
	      			<td ><span id="sprypassword1">
	        		<label for="password"></label>
	        		<input name="password" type="password" id="password" placeholder="***************" value="<?php echo $row_alterar['password']; ?>">
          			<span class="passwordRequiredMsg">É necessário um valor.</span></span></td>
        		</tr>
	    		<tr>
	      			<td>Confirmação palavra passe</td>
	      			<td><span id="spryconfirm1">
          			<label for="password"></label>
	        		<input name="password2" type="password" id="password" placeholder="**************" value="<?php echo $row_alterar['password']; ?>">
          			<span class="confirmRequiredMsg">É necessário um valor.</span><span class="confirmInvalidMsg">A palavra passe não é igual à anterior.</span></span></td>
        		</tr>
        		<tr>
	      			<td>Nif</td>
	      			<td><span id="sprytextfield7">
          			<label for="nif"></label>
          			<input name="nif" type="text" id="nif" value="<?php echo $row_alterar['nif']; ?>" maxlength="9">
          			<span class="textfieldRequiredMsg">É necessário um valor.</span><span class="textfieldInvalidFormatMsg">Formato inválido.</span></span></td>
        		</tr>
	    		<tr>
	    			 <td><button class="buttonback" onclick="document.location = 'index.php'">Voltar</button></td>
	      			<td colspan="2"><input type="submit" name="registar" class="botao" value="Alterar"></td>
        		</tr>
          		</tbody>
        </table>
	  <input type="hidden" name="MM_update" value="form1">
	</form>
	
    <script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1");
var spryconfirm1 = new Spry.Widget.ValidationConfirm("spryconfirm1", "password");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "email");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "date", {format:"yyyy/mm/dd"});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "integer");
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "integer");
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8", "integer");
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9", "integer");
    </script>
    
    <!-- Footer -->
		<div id="footer">
			<div class="container">
				<section>
					<header>
						<h2>Contacto</h2>
						<span class="byline">Qualquer duvida ou problema contacte-nos!</span>
						<span class="byline">E-mail:geeky.store@gmail.com</span>
            			<span class="byline">Contacto:213456789</span>
					</header>
				</section>
			</div>
		</div>
</body>
</html>
<?php
mysql_free_result($alterar);
?>
