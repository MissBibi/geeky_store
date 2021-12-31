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
						var step=1
						function slideit(){
						document.images.slide.src=eval("image"+step+".src")
						if(step<8)
						step++
						else
						step=1
						setTimeout("slideit()",3000)
						}
						slideit()	
					</script>
					</div>
					<img id="imglogo" src="images/game.png">
				</div>
			</div>
		</div>
		<div id='cssmenu'>
			<img id="menulogo" src="images/logo4.png">
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
				<form name="form1" method="post" action="">
              		<a href="<?php echo $logoutAction ?>">sair</a>             
				</form>                                 
            </ul>
			</li>
		  </ul>
		  <a href="car.php"> <img src="images/car.png" width="50px" height="50px" margin="0px"></a>
		</div>
		
	<!-- Featured -->
		<div id="featured">
			<div class="container">
				<header>               
					<h2 id="hg">Bem-vindo à loja!</h2>
				</header>
			</div>
		</div>

	<!-- Main -->
	<div>
     <?php 
	  if(isset(  $_SESSION['MM_Username'] ) && $_SESSION['MM_Username'] == 'adm@gmail.com')
	  {
       echo '<li><a href="listarprodutos.php">Administrador</a> </li>';
	  }
	  else
            //login 
			if(isset($_SESSION['MM_Username']))
			{echo "<p> Utilizador(a): ".$_SESSION['MM_Username'];
			}
	 ?>

	</div>	
		
		<div id="main">
			<div id="content" class="container">
				<div class="row">
					<section class="6u">                    
						<a href="assassins.php" class="image full"><img class="ifoto" src="images/assassins.jpg" alt="Assassins Creed"></a>     
						<div class="hidde">Assassin's Creed-Descrição
						<p class="texto" id="texto1" >Assassin's Creed é uma série de videojogos. A premissa central envolve-se a partir da rivalidade entre duas sociedades secretas ancestrais: os assassinos que desejam a paz através do livre arbítrio e os templários, que têm o objetivo de dominar o mundo.</p>
						</div>
					</section>				
					<section class="6u">
						<a href="dc.php" class="image full"><img class="ifoto" src="images/dc.jpg" alt="Dc"></a>     
						<div class="hidde">Dc Comics-Descrição
						<p class="texto" id="texto2" >A Dc Comics é uma editora norte-americana subsidiária da companhia WarnerMedia situada em Burbank, Califórnia, especializada em histórias em quadradinhos e mídias relacionadas, sendo considerada uma das maiores companhia ligada a este ramo no mundo.</p>
						</div>
					</section>				
				</div>
				<div class="row">
					<section class="6u">
						<a href="marvel.php" class="image full"><img class="ifoto" src="images/marvel.jpg" alt="Marvel"></a>
						<div class="hidde">Marvel Comics-Descrição					
						<p class="texto" id="texto3" >A Marvel Comics é uma editora norte-americana e mídias relacionadas. Hoje, a Marvel Comics é considerada a maior editora de histórias em quadrinhos do mundo. Em 2009, a The Walt Disney Company, adquiriu a Marvel Entertainment, a empresa chefe da Marvel.</p>
						</div>
					</section>				
					<section class="6u">
						<a href="hp.php" class="image full"><img class="ifoto" src="images/hp.jpg" alt="Harry Potter"></a>
						<div class="hidde">Harry Potter-Descrição
						<p class="texto" id="texto4">Harry Potter é uma série de sete romances de fantasia escrita pela autora britânica J. K. Rowling. A série narra as aventuras de um jovem chamado Harry James Potter, que descobre aos 11 anos de idade que é um bruxo ao ser convidado para estudar na Escola de Magia e Bruxaria de Hogwarts.</p>
						</div>
					</section>				
				</div>
				<div class="row">
					<section class="6u">
						<a href="dragonb.php" class="image full"><img class="ifoto" src="images/dragonball.jpg" alt="Dragon Ball"></a>
						<div class="hidde">Dragon Ball-Descrição	
						<p class="texto" id="texto5">Dragon Ball é uma série de anime japonesa produzida pela Toei Animation. A história de Dragon Ball conta a vida de Son Goku, um jovem garoto com causa de macaco que vive na Montanha Paozu, baseado no clássico romance chinês Jornada ao Oeste. A série narra desde as suas aventuras desde criança até se tornar avô. </p>
					</div>
					</section>				
					<section class="6u">
						<a href="onep.php" class="image full"><img class="ifoto" src="images/onepiece.jpg" alt="One Piece"></a>
						<div class="hidde">One Piece-Descrição	
						<p class="texto" id="texto6">One Piece é uma série de mangá escrita e ilustrada por Eiichiro Oda. One Piece conta as aventuras de Monkey D. Luffy, um jovem cujo corpo ganhou as propriedades de borracha após ter comido uma Fruta do Demônio acidentalmente. Com sua tripulação, os Piratas do Chapéu de Palha, Luffy explora a Grand Line em busca do tesouro mais procurado do mundo, o One Piece, a fim de se tornar o próximo Rei dos Piratas.</p>
					</div>
					</section>				
				</div>
				
				<div class="row">
					<section class="6u">
						<a href="starwars.php" class="image full"><img class="ifoto" src="images/starwars.jpg" alt="star Wars"></a>
						<div class="hidde">Star Wars-Descrição	
						<p class="texto" id="texto7" >Star Wars é uma franquia do tipo space opera estadunidense criada pelo cineasta George Lucas que conta com uma série de oito filmes de fantasia científica e dois spin-offs.</p>
					</div>
					</section>		
				</div>
			</div>
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