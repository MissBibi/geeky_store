<?php require_once('../Connections/geeky_store.php'); ?>

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
  $updateSQL = sprintf("UPDATE produto SET nomep=%s, precou=%s, stock=%s, descricao=%s, imagem=%s, status=%s, tipo_codtipo=%s, marca_codmarca=%s WHERE codproduto=%s",
                       GetSQLValueString($_POST['nomep'], "text"),
                       GetSQLValueString($_POST['precou'], "double"),
                       GetSQLValueString($_POST['stock'], "int"),
                       GetSQLValueString($_POST['descricao'], "text"),
                       GetSQLValueString($_POST['imagem'], "text"),
                       GetSQLValueString($_POST['status'], "text"),
                       GetSQLValueString($_POST['codigo_tipo'], "int"),
                       GetSQLValueString($_POST['codigo_marca'], "int"),
                       GetSQLValueString($_POST['codigo'], "int"));

  mysql_select_db($database_geeky_store, $geeky_store);
  $Result1 = mysql_query($updateSQL, $geeky_store) or die(mysql_error());

  $updateGoTo = "listarprodutos.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_produtos = "-1";
if (isset($_GET['codigo'])) {
  $colname_produtos = $_GET['codigo'];
}
mysql_select_db($database_geeky_store, $geeky_store);
$query_produtos = sprintf("SELECT * FROM produto, marca, tipo WHERE codproduto = %s AND produto.tipo_codtipo=tipo.codtipo AND produto.marca_codmarca=marca.codmarca", GetSQLValueString($colname_produtos, "int"));
$produtos = mysql_query($query_produtos, $geeky_store) or die(mysql_error());
$row_produtos = mysql_fetch_assoc($produtos);

mysql_select_db($database_geeky_store, $geeky_store);
$query_marcas = "SELECT * FROM marca";
$marcas = mysql_query($query_marcas, $geeky_store) or die(mysql_error());
$row_marcas = mysql_fetch_assoc($marcas);
$totalRows_marcas = mysql_num_rows($marcas);

mysql_select_db($database_geeky_store, $geeky_store);
$query_tipos = "SELECT * FROM tipo";
$tipos = mysql_query($query_tipos, $geeky_store) or die(mysql_error());
$row_tipos = mysql_fetch_assoc($tipos);
$totalRows_tipos = mysql_num_rows($tipos);

$colname_Produto = "-1";
if (isset($_GET['codigo'])) {
  $colname_Produto = $_GET['codigo'];
}
mysql_select_db($database_geeky_store, $geeky_store);
$query_Produto = sprintf("SELECT * FROM produto, marca, tipo WHERE codproduto = %s AND produto.tipo_codtipo=tipo.codtipo AND produto.marca_codmarca=marca.codmarca", GetSQLValueString($colname_Produto, "int"));
$Produto = mysql_query($query_Produto, $geeky_store) or die(mysql_error());
$row_Produto = mysql_fetch_assoc($Produto);
$totalRows_Produto = mysql_num_rows($Produto);

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
					<script type_="text/javascript">
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
	


	<!-- Main -->
					
				
	<form action="<?php echo $editFormAction; ?>" name="form1" method="POST">
		<table class="darkTable2">
        		<thead>
          		<tr>
	      			<th colspan="2"><div align="center">Alterar Dados do Produto</div></th>
          		</tr>
       			</thead>
        		<tbody>
          		<tr>
	      			<td>Nome          
          			<input name="codigo" type="hidden" id="codigo" value="<?php echo $row_produtos['codproduto']; ?>"></td>
	      			<td width="194"><span id="sprytextfield1">
	        			<label for="nomep2"></label>
	        			<input name="nomep" type="text" id="nomep2" value="<?php echo $row_Produto['nomep']; ?>">
          			<span class="textfieldRequiredMsg">Um valor é necessário.</span></span></td>
        		</tr>
	    		<tr>
	      			<td>Preço Unitário</td>
	      			<td ><span id="sprytextfield2">
	        			<label for="precou2"></label>
	        			<input name="precou" type="text" id="precou2" value="<?php echo $row_Produto['precou']; ?>">
          			<span class="textfieldRequiredMsg">Um valor é necessário.</span></span></td>
        		</tr>
        		<tr>
	      			<td>Stock</td>
	      			<td><span id="sprytextfield3">
	        			<label for="stock"></label>
	        			<input name="stock" type="text" id="stock" value="<?php echo $row_Produto['stock']; ?>">
          			<span class="textfieldRequiredMsg">Um valor é necessário.</span></span></td>
        		</tr>
	    		<tr>
	      			<td>Descrição</td>
	      			<td><span id="sprytextfield4">
	        			<label for="descricao2"></label>
	        			<input name="descricao" type="text" id="descricao2" value="<?php echo $row_Produto['descricao']; ?>">
          			<span class="textfieldRequiredMsg">Um valor é necessário.</span></span></td>
        		</tr>
        		<tr>
	      			<td>Imagem</td>
	      			<td><span id="sprytextfield5">
	        			<label for="imagem2"></label>
	        			<input name="imagem" type="text" id="imagem2" value="<?php echo $row_Produto['imagem']; ?>">
          			<span class="textfieldRequiredMsg">Um valor é necessário.</span></span></td>
        		</tr>
        		<tr>
	      			<td>Tipo
          			<input name="codigo_tipo" type="hidden" id="codigo_tipo" value="<?php echo $row_Produto['tipo_codtipo']; ?>"></td>
	      			<td><span id="spryselect1">
	        			<label for="tipo2"></label>
	        			<select name="tipo" id="tipo2">
	          			<?php
						do {  
						?>
	          <option value="<?php echo $row_tipos['codtipo']?>"<?php if (!(strcmp($row_tipos['codtipo'], ucwords($row_Produto['tipo_codtipo'])))) {echo "selected=\"selected\"";} ?>><?php echo $row_tipos['tipo']?></option>
	          <?php
} while ($row_tipos = mysql_fetch_assoc($tipos));
  $rows = mysql_num_rows($tipos);
  if($rows > 0) {
      mysql_data_seek($tipos, 0);
	  $row_tipos = mysql_fetch_assoc($tipos);
  }
?>
          </select>
          <span class="selectRequiredMsg">Selecione uma das opções.</span></span></td>
        		</tr>
	    		<tr>
	      			<td>Marca
          			<input name="codigo_marca" type="hidden" id="codigo_marca" value="<?php echo $row_Produto['marca_codmarca']; ?>"></td>
	      			<td><span id="spryselect2">
	        			<label for="marca2"></label>
	        			<select name="marca" id="marca2">
	          			<?php
						do {  
						?>
	          <option value="<?php echo $row_marcas['codmarca']?>"<?php if (!(strcmp($row_marcas['codmarca'], $row_Produto['marca_codmarca']))) {echo "selected=\"selected\"";} ?>><?php echo $row_marcas['marca']?></option>
	          <?php
} while ($row_marcas = mysql_fetch_assoc($marcas));
  $rows = mysql_num_rows($marcas);
  if($rows > 0) {
      mysql_data_seek($marcas, 0);
	  $row_marcas = mysql_fetch_assoc($marcas);
  }
?>
          </select>
          <span class="selectRequiredMsg">Selecione uma das opções.</span></span></td>
        </tr>
        <tr>
	      <td>Status</td>
	      <td><span id="sprytextfield6">
	        <label for="status2"></label>
	        <input name="status" type="text" id="status2" value="<?php echo $row_Produto['status']; ?>">
          <span class="textfieldRequiredMsg">Um valor é necessário.</span></span></td>
        </tr>
	    <tr>
	      <td colspan="2"><input name="alterar" type="submit" class="botao" id="alterar" value="Alterar"></td>
        </tr>
         	</tbody>
        </table>
	  <input type="hidden" name="MM_update" value="form1">
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
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2");
    </script>
</body>
</html>
<?php
mysql_free_result($marcas);

mysql_free_result($tipos);

mysql_free_result($Produto);
?>
