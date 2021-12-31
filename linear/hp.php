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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_hp = 3;
$pageNum_hp = 0;
if (isset($_GET['pageNum_hp'])) {
  $pageNum_hp = $_GET['pageNum_hp'];
}
$startRow_hp = $pageNum_hp * $maxRows_hp;

mysql_select_db($database_geeky_store, $geeky_store);
$query_hp = "SELECT * FROM produto WHERE marca_codmarca = 4 AND produto.status='Disponivel'";
$query_limit_hp = sprintf("%s LIMIT %d, %d", $query_hp, $startRow_hp, $maxRows_hp);
$hp = mysql_query($query_limit_hp, $geeky_store) or die(mysql_error());
$row_hp = mysql_fetch_assoc($hp);

if (isset($_GET['totalRows_hp'])) {
  $totalRows_hp = $_GET['totalRows_hp'];
} else {
  $all_hp = mysql_query($query_hp);
  $totalRows_hp = mysql_num_rows($all_hp);
}
$totalPages_hp = ceil($totalRows_hp/$maxRows_hp)-1;

$queryString_hp = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_hp") == false && 
        stristr($param, "totalRows_hp") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_hp = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_hp = sprintf("&totalRows_hp=%d%s", $totalRows_hp, $queryString_hp);

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
			var image1=new Image()
			image1.src="images/hp0.gif"
			var image2=new Image()
			image2.src="images/hp1.gif"
			var image3=new Image()
			image3.src="images/hp2.gif"
			var image4=new Image()
			image4.src="images/hp3.gif"
			var image5=new Image()
			image5.src="images/hp4.gif"
			var image6=new Image()
			image6.src="images/hp5.gif"
			var image7=new Image()
			image7.src="images/hp6.gif"
			var image8=new Image()
			image8.src="images/hp7.gif"
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
					<img class="slide" id="imgslide2" src="images/hp0.gif"  name="slide">
					<script type="text/javascript">
					<!--
					var step=1
					function slideit(){
					document.images.slide.src=eval("image"+step+".src")
					if(step<8)
					step++
					else
					step=1
					setTimeout("slideit()",2000)
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
      <audio id="music" controls>
                <source src="music/hp.mp3" type="audio/mpeg">
              O teu browser não suporta a musica.
          </audio>
          <script>
        var mus = document.getElementById("music");
          mus.autoplay = true;
          mus.load();
      </script>
		    <table class="darkTable">
        <thead>
          <tr>
            <th>codproduto</th>
            <th>Nome do produto</th>
            <th>Preço do produto</th>
            <th>Stock</th>
            <th>Descricao</th>
            <th>Imagem</th>
            <th>Comprar</th>
          </tr>
        </thead>
        <tbody>
          <?php do { ?>
          <tr>
            <td><?php echo $row_hp['codproduto']; ?></td>
            <td><?php echo $row_hp['nomep']; ?></td>
            <td><?php echo $row_hp['precou']; ?></td>
            <td><?php echo $row_hp['stock']; ?></td>
            <td><?php echo $row_hp['descricao']; ?></td>
            <td><input type="image" name="imageField" id="imageField" src="../imagens/<?php echo $row_hp['imagem']; ?>" width="200" height="160" ></td>
            <td><a href="compras.php?codigo=<?php echo $row_hp['codproduto']; ?>"><img src="images/kart.png" width="200" height="160"></a></td>
          </tr>
          <?php } while ($row_hp = mysql_fetch_assoc($hp)); ?>
          </table>          
			<p>&nbsp;
            <table>
              <tr>
                <td><?php if ($pageNum_hp > 0) { // Aparece quaso não seja a primeira pagina ?>
                    <a href="<?php printf("%s?pageNum_hp=%d%s", $currentPage, 0, $queryString_hp); ?>"><img src="../imagens/First.gif"></a>
                    <?php } // Aparece quaso não seja a primeira pagina ?></td>
                <td><?php if ($pageNum_hp > 0) { // Aparece quaso não seja a primeira pagina?>
                    <a href="<?php printf("%s?pageNum_hp=%d%s", $currentPage, max(0, $pageNum_hp - 1), $queryString_hp); ?>"><img src="../imagens/Previous.gif"></a>
                    <?php } // Aparece quaso não seja a primeira pagina ?></td>
                <td><?php if ($pageNum_hp < $totalPages_hp) { // Aparece quaso não seja a ultima pagina ?>
                    <a href="<?php printf("%s?pageNum_hp=%d%s", $currentPage, min($totalPages_hp, $pageNum_hp + 1), $queryString_hp); ?>"><img src="../imagens/Next.gif"></a>
                    <?php } // Aparece quaso não seja a ultima pagina ?></td>
                <td><?php if ($pageNum_hp < $totalPages_hp) { // Aparece quaso não seja a ultima pagina ?>
                    <a href="<?php printf("%s?pageNum_hp=%d%s", $currentPage, $totalPages_hp, $queryString_hp); ?>"><img src="../imagens/Last.gif"></a>
                    <?php } // Aparece quaso não seja a ultima pagina ?></td>
              </tr>
            </table>
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
mysql_free_result($hp);
?>
