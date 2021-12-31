<?php require_once('../Connections/geeky_store.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}
?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO tipo (tipo) VALUES (%s)",
                       GetSQLValueString($_POST['tipo'], "text"));

  mysql_select_db($database_geeky_store, $geeky_store);
  $Result1 = mysql_query($insertSQL, $geeky_store) or die(mysql_error());

  $insertGoTo = "listarprodutos.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_geeky_store, $geeky_store);
$query_Recordset1 = "SELECT * FROM tipo";
$Recordset1 = mysql_query($query_Recordset1, $geeky_store) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname_clientes = "-1";
if (isset($_SESSION['MM_Usermane'])) {
  $colname_clientes = $_SESSION['MM_Usermane'];
}
mysql_select_db($database_geeky_store, $geeky_store);
$query_clientes = sprintf("SELECT * FROM cliente WHERE email = %s", GetSQLValueString($colname_clientes, "text"));
$clientes = mysql_query($query_clientes, $geeky_store) or die(mysql_error());
$row_clientes = mysql_fetch_assoc($clientes);
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
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="js/skel.min.js"></script>
	<script src="js/skel-panels.min.js"></script>
	<script src="js/init.js"></script>
	<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
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
			  <div id="logo">
					<div class="slider">
					<div class="load"> </div>
					<img class="slide" id="imgslide" src="images/slide0.jpg"  name="slide">
					<script type="text/javascript">
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
		<img id="menulogo" src="images/logo4.png">
			<ul>
				<li><a href='index.php'><span>Pagina Inicial</span></a></li>
                <li><a href='listarprodutos.php'><span>Listar Produtos</span></a></li>
				
			<li class='last'></li>
	      </ul>
		</div>
	<!-- Main -->
					
				
	<form action="<?php echo $editFormAction; ?>" name="form1" method="POST">
		<table class="darkTable2">
        		<thead>
          		<tr>
	      			<th colspan="2"><div align="center">Insere Tipo de Produto</div></th>
          		</tr>
       			</thead>
        		<tbody>
          		<tr>
	      			<td width="213">Tipo de Produto</td>
	      			<td width="194"><span id="sprytextfield1">
	        			<label for="tipo"></label>
	        			<input type="text" name="tipo" id="tipo">
          				<span class="textfieldRequiredMsg">Um valor é necessário.</span></span></td>
        		</tr>
	    		<tr>
	    			<td><button class="botao" onclick="document.location = 'listarprodutos.php'">Voltar</button></td>
	      			<td colspan="2" ><input name="inserir" type="submit" class="botao" id="inserir" value="Inserir"></td>
        		</tr>
          		</tbody>
        </table>
	  <input type="hidden" name="MM_insert" value="form1">
	</form>
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
    <script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
        </script>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
