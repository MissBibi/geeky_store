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
  $insertSQL = sprintf("INSERT INTO produto (nomep, precou, stock, descricao, imagem, status, tipo_codtipo, marca_codmarca) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['nomep'], "text"),
                       GetSQLValueString($_POST['precou'], "double"),
                       GetSQLValueString($_POST['stock'], "int"),
                       GetSQLValueString($_POST['descricao'], "text"),
                       GetSQLValueString($_POST['imagem'], "text"),
                       GetSQLValueString($_POST['status'], "text"),
                       GetSQLValueString($_POST['tipo'], "int"),
                       GetSQLValueString($_POST['codmarca'], "int"));

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
$query_Recordset1 = "SELECT * FROM produto";
$Recordset1 = mysql_query($query_Recordset1, $geeky_store) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_geeky_store, $geeky_store);
$query_tipo = "SELECT * FROM tipo";
$tipo = mysql_query($query_tipo, $geeky_store) or die(mysql_error());
$row_tipo = mysql_fetch_assoc($tipo);
$totalRows_tipo = mysql_num_rows($tipo);

mysql_select_db($database_geeky_store, $geeky_store);
$query_marca = "SELECT * FROM marca";
$marca = mysql_query($query_marca, $geeky_store) or die(mysql_error());
$row_marca = mysql_fetch_assoc($marca);
$totalRows_marca = mysql_num_rows($marca);

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
		<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="js/skel.min.js"></script>
	<script src="js/skel-panels.min.js"></script>
	<script src="js/init.js"></script>
	<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
	<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
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
				
			<li class='last'><a href='#'></a></li>
	      </ul>
		</div>

	<!-- Main -->
	<form action="<?php echo $editFormAction; ?>" name="form1" method="POST">
		<table class="darkTable2">
        		<thead>
          		<tr>
	      			<th colspan="2"><div align="center">Inserir Produtos</div></th>
          		</tr>
       			</thead>
        		<tbody>
	    		<tr>
	      			<td width="213">Nome</td>
	      			<td width="194"><span id="sprytextfield1">
	        			<label for="nomep"></label>
	        			<input type="text" name="nomep" id="nomep">
          			<span class="textfieldRequiredMsg">Um valor é necessário.</span></span></td>
        		</tr>
	    		<tr>
	      			<td>Preço Unitário</td>
	      			<td><span id="sprytextfield2">
          			<label for="precou"></label>
          			<input type="text" name="precou" id="precou">
          			<span class="textfieldRequiredMsg">Um valor é necessário.</span><span class="textfieldInvalidFormatMsg">Formato inválido</span></span></td>
        		</tr>
	    		<tr>
	      			<td>Stock</td>
	      			<td><span id="sprytextfield3">
          			<label for="stock"></label>
          			<input type="text" name="stock" id="stock">
          			<span class="textfieldRequiredMsg">Um valor é necessário.</span><span class="textfieldInvalidFormatMsg">Formato inválido.</span></span></td>
        		</tr>
	      		<tr>
	      			<td>Descrição</td>
	      			<td><span id="sprytextfield4">
	        			<label for="descricao"></label>
	        			<input type="text" name="descricao" id="descricao">
          			<span class="textfieldRequiredMsg">Um valor é necessário.</span></span></td>
        		</tr>
	    		<tr>
	      			<td>Imagem</td>
	      			<td><span id="sprytextfield5">
	        			<label for="imagem"></label>
	        			<input type="text" name="imagem" id="imagem" >
          			<span class="textfieldRequiredMsg">Um valor é necessário</span></span></td>
        		</tr>
        		<tr>
	      			<td>Tipo de Produto</td>
	      			<td><span id="spryselect1">
	        			<label for="tipo"></label>
	        			<select name="tipo" id="tipo">
	          <?php
do {  
?>
	          <option value="<?php echo $row_tipo['codtipo']?>"<?php if (!(strcmp($row_tipo['codtipo'], $row_tipo['codtipo']))) {echo "selected=\"selected\"";} ?>><?php echo $row_tipo['tipo']?></option>
	          <?php
} while ($row_tipo = mysql_fetch_assoc($tipo));
  $rows = mysql_num_rows($tipo);
  if($rows > 0) {
      mysql_data_seek($tipo, 0);
	  $row_tipo = mysql_fetch_assoc($tipo);
  }
?>
          </select>
          <span class="selectRequiredMsg">Selecione uma das opções.</span></span></td>
        	</tr>
           	<tr>
	      		<td>Tipo de marca</td>
	      		<td><span id="spryselect2">
	        		<label for="codmarca"></label>
	        		<select name="codmarca" id="codmarca">
	          <?php
do {  
?>
	          <option value="<?php echo $row_marca['codmarca']?>"<?php if (!(strcmp($row_marca['codmarca'], $row_marca['codmarca']))) {echo "selected=\"selected\"";} ?>><?php echo $row_marca['marca']?></option>
	          <?php
} while ($row_marca = mysql_fetch_assoc($marca));
  $rows = mysql_num_rows($marca);
  if($rows > 0) {
      mysql_data_seek($marca, 0);
	  $row_marca = mysql_fetch_assoc($marca);
  }
?>
          		</select>
          		<span class="selectRequiredMsg">Selecione uma das opções.</span></span></td>
        	</tr>
        	<tr>
	      		<td>Status</td>
	      		<td><span id="sprytextfield6">
	        		<label for="status"></label>
	        		<input type="text" name="status" id="status">
          		<span class="textfieldRequiredMsg">Um valor é necessário.</span></span></td>
        	</tr>
	    	<tr>
	      		<td colspan="2"><input name="inserir" type="submit" class="botao" id="inserir" value="Inserir"></td>
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
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "integer");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "integer");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
    </script>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($tipo);

mysql_free_result($marca);
?>
