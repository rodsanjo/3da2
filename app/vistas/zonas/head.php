<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<meta http-equiv="Content-Type" content="text/html" charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!--Mostrar sitios para móviles en escala correcta con viewport-->
<meta name="viewport" content="width=750, initial-scale=0.5">

<title><?php echo TITULO; ?></title>
<link href="<?php echo URL_ROOT ?>favicon.png" rel="shortcut icon" type="image/x-icon" />
<link href="<?php echo URL_ROOT ?>favicon.png" rel="icon" type="image/x-icon" /> 

<meta name="title" content="3da2"/>
<meta name="Description" content="Family's boardgames" />
<meta name="rating" content="General">
<meta name="generator" content="jequeto framework" />
<meta name="origen" content="Vallekas" />
<meta name="author" content="Jergo" />
<meta name="owner" content="3da2">
<meta name="locality" content="Madrid, España" />
<meta name="lang" content="<?php echo \core\Idioma::get(); ?>" />
<meta name="viewport" content="maximum-scale=10.0" />
<meta name="revisit-after" content="1 days" />
<meta name="robots" content="NOINDEX,NOFOLLOW,NOARCHIVE,NOSNIPPET, NOYDIR" />
<meta http-equiv="content-Language" content="<?php echo \core\Idioma::get(); ?>"/>
<meta http-equiv="content-Type" content="text/html;charset=utf-8" />

<!-- for Google -->
<meta name="description" content="juegos de mesa board games" />
<meta name="keywords" content="juegos,mesa,ocio,board,game,boardgame,dados,rol,frikis" />

<!-- for Facebook -->
<meta property="og:title" content="3da2" />
<meta property="og:type" content="library" />
<meta property="og:image" content="http://jergapps.zz.mu/3da2/recursos/imagenes/logo.png" />
<meta property="og:url" content="http://jergapps.zz.mu/3da2" />
<meta property="og:description" content="Juegos de mesa familiares" />

<!-- for Twitter -->
<meta name="twitter:card" content="3da2" />
<meta name="twitter:title" content="jergapps" />
<meta name="twitter:description" content="Family¡s boardgames" />
<meta name="twitter:image" content="http://jergapps.zz.mu/3da2/recursos/imagenes/logo.png" />

<?php 
    include PATH_HOME."app/vistas/zonas/head_bootstrap.php";
?>

<link rel="stylesheet" type="text/css" href="<?php echo URL_HOME_ROOT ?>recursos/css/main.css" />
<link rel="stylesheet" type="text/css" href="<?php echo URL_ROOT ?>recursos/css/main.css" />
<link rel="stylesheet" type="text/css" href="<?php echo URL_ROOT.'recursos/css/'.\core\Distribuidor::get_controlador_instanciado(); ?>.css" />
<!--<link rel="stylesheet" type="text/css" href="<?php echo URL_ROOT ?>recursos/css/print.css" media="print"/>--> 

<?php if (isset($_GET["administrator"])): ?>
<link rel="stylesheet" type="text/css" href="<?php echo URL_ROOT; ?>recursos/css/administrator.css" />
<?php endif; ?>

<!--[if lte IE 7]>
    <link rel="stylesheet" href="<?php echo URL_HOME_ROOT ?>recursos/css/ie7.css" />
<![endif]-->

<script type="text/javascript" src="<?php echo URL_HOME_ROOT ?>recursos/js/f_cookies.js"></script>
<script type="text/javascript" src="<?php echo URL_HOME_ROOT ?>recursos/js/idiomas.js"></script>

<script type="text/javascript" src=""></script>
<script type="text/javascript" src="<?php echo URL_HOME_ROOT ?>recursos/js/jquery/jquery-1.10.2.js"></script>

<script type="text/javascript" src="<?php echo URL_ROOT ?>recursos/js/config.js"></script>
<script type="text/javascript" src="<?php echo URL_HOME_ROOT ?>recursos/js/funciones.js"></script>
<script type="text/javascript" src="<?php echo URL_ROOT ?>recursos/js/funciones.js"></script>
<script type="text/javascript" src="<?php echo URL_HOME_ROOT ?>recursos/js/ajax.js"></script>
<!--<script type="text/javascript" src="<?php echo URL_ROOT ?>recursos/js/ajax.js"></script>-->

<!-- Custom -->
<!-- Menu -->
<link rel="stylesheet" type="text/css" href="<?php echo URL_ROOT ?>recursos/css/menu_up.css" />
<link rel="stylesheet" type="text/css" href="<?php echo URL_ROOT ?>recursos/css/menu_left_v.css" />
