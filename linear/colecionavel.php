<?php require_once('../Connections/geeky_store.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "sair.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
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

$maxRows_colecionavel = 3;
$pageNum_colecionavel = 0;
if (isset($_GET['pageNum_colecionavel'])) {
  $pageNum_colecionavel = $_GET['pageNum_colecionavel'];
}
$startRow_colecionavel = $pageNum_colecionavel * $maxRows_colecionavel;

mysql_select_db($database_geeky_store, $geeky_store);
$query_colecionavel = "SELECT * FROM produto WHERE produto.tipo_codtipo=8 AND produto.status='Disponivel'";
$query_limit_colecionavel = sprintf("%s LIMIT %d, %d", $query_colecionavel, $startRow_colecionavel, $maxRows_colecionavel);
$colecionavel = mysql_query($query_limit_colecionavel, $geeky_store) or die(mysql_error());
$row_colecionavel = mysql_fetch_assoc($colecionavel);

if (isset($_GET['totalRows_colecionavel'])) {
  $totalRows_colecionavel = $_GET['totalRows_colecionavel'];
} else {
  $all_colecionavel = mysql_query($query_colecionavel);
  $totalRows_colecionavel = mysql_num_rows($all_colecionavel);
}
$totalPages_colecionavel = ceil($totalRows_colecionavel/$maxRows_colecionavel)-1;

$queryString_colecionavel = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_colecionavel") == false && 
        stristr($param, "totalRows_colecionavel") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_colecionavel = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_colecionavel = sprintf("&totalRows_colecionavel=%d%s", $totalRows_colecionavel, $queryString_colecionavel);

$queryString_tapete = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_tapete") == false && 
        stristr($param, "totalRows_tapete") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_tapete = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_colar = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_colar") == false && 
        stristr($param, "totalRows_colar") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_colar = "&" . htmlentities(implode("&", $newParams));
  }
}

$queryString_pop = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_pop") == false && 
        stristr($param, "totalRows_pop") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_pop = "&" . htmlentities(implode("&", $newParams));
  }
}


$currentPage = $_SERVER["PHP_SELF"];

$queryString_assassins = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_assassins") == false && 
        stristr($param, "totalRows_assassins") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_assassins = "&" . htmlentities(implode("&", $newParams));
  }
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
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<script src="js/init.js"></script>
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
					<li class='last'><a href='colecionavel.php'><span>Objetos Colecion??veis</span></a></li>
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
			<form name="form1" method="post" action="">
              <a href="<?php echo $logoutAction ?>">sair</a>             
			</form>
	      </ul>
		</div>

      <!-- Main -->
     <?php
            //login 
      if(isset($_SESSION['MM_Username']))
      {echo "<p> Utilizador(a): ".$_SESSION['MM_Username'];
      }
      ?>

	<!-- Featured -->
		<div id="featured">
			<div class="container"></div>
			<form name="form2" method="post" action="">
          <table class="darkTable">
        <thead>
          <tr>
            <th>codproduto</th>
            <th>Nome do produto</th>
            <th>Pre??o do produto</th>
            <th>Stock</th>
            <th>Descricao</th>
            <th>Imagem</th>
            <th>Comprar</th>
          </tr>
        </thead>
        <tbody>
          <?php do { ?>
          <tr>
            <td><?php echo $row_colecionavel['codproduto']; ?></td>
              <td><?php echo $row_colecionavel['nomep']; ?></td>
              <td><?php echo $row_colecionavel['precou']; ?></td>
              <td><?php echo $row_colecionavel['stock']; ?></td>
              <td><?php echo $row_colecionavel['descricao']; ?></td>
              <td><input type="image" name="imageField" id="imageField" src="../imagens/<?php echo $row_colecionavel['imagem']; ?>" width="200" height="160"></td>
              <td><a href="compras.php?codigo=<?php echo $row_colecionavel['codproduto']; ?>"><img src="images/kart.png" width="200" height="160"></a></td>
          </tr>
          <?php } while ($row_colecionavel = mysql_fetch_assoc($colecionavel)); ?>         
        </table>
			<p>&nbsp;
            <table border="0">
              <tr>
                <td><?php if ($pageNum_colecionavel > 0) { // SAparece quaso n??o seja a primeira pagina ?>
                    <a href="<?php printf("%s?pageNum_colecionavel=%d%s", $currentPage, 0, $queryString_colecionavel); ?>"><img src="../imagens/First.gif"></a>
                    <?php } // Aparece quaso n??o seja a primeira pagina ?></td>
                <td><?php if ($pageNum_colecionavel > 0) { // Aparece quaso n??o seja a primeira pagina ?>
                    <a href="<?php printf("%s?pageNum_colecionavel=%d%s", $currentPage, max(0, $pageNum_colecionavel - 1), $queryString_colecionavel); ?>"><img src="../imagens/Previous.gif"></a>
                    <?php } // Aparece quaso n??o seja a primeira pagina ?></td
                <td><?php if ($pageNum_colecionavel < $totalPages_colecionavel) { // Aparece quaso n??o seja a ultima pagina ?>
                    <a href="<?php printf("%s?pageNum_colecionavel=%d%s", $currentPage, min($totalPages_colecionavel, $pageNum_colecionavel + 1), $queryString_colecionavel); ?>"><img src="../imagens/Next.gif"></a>
                    <?php } // Aparece quaso n??o seja a ultima pagina ?></td>
                <td><?php if ($pageNum_colecionavel < $totalPages_colecionavel) { // Aparece quaso n??o seja a ultima pagina?>
                    <a href="<?php printf("%s?pageNum_colecionavel=%d%s", $currentPage, $totalPages_colecionavel, $queryString_colecionavel); ?>"><img src="../imagens/Last.gif"></a>
                    <?php } // Aparece quaso n??o seja a ultima pagina ?></td>
              </tr>
            </table>
            </p>
          </form>
		</div>
	<!-- Tweet -->
		<div id="tweet">
			<div class="container">
				<section>
					<blockquote>Being a geek means never having to play it cool about how much you like something.- Simon Pegg</blockquote>
				</section>
			</div>
		</div>

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
mysql_free_result($colecionavel);
?>
