<!DOCTYPE html>
<html lang='<?php echo \core\Idioma::get(); ?>'>
<head>
    <?php 
        include PATH_APPLICATION_APP."vistas/zonas/head.php";
    ?>
</head>
<body>
    <section id="encabezado" class="container-fluid">
        <div class="teu">
            <div id="titulo_cabecera">
                <?php 
                include PATH_APPLICATION_APP."vistas/zonas/titulo_cabecera.php";
                ?>
            </div>
        </div>
    </section>
    <section class="container-fluid">
        <div id="sidebar_left" class="col-md-2">
            
            <div id="menu_left_v">
                <?php 
                    include PATH_APPLICATION_APP."vistas/zonas/menu_left.php";
                ?>
            </div>
            <div style="clear:both:">
                    <?php echo \core\HTML_Tag::li_menu("menu_adm", array("usuarios"), "Usuarios"); ?>
                    <?php echo \core\HTML_Tag::li_menu("menu_adm", array("roles"), "Roles"); ?>
            </div>
            
<!--            <div id="cuadro_login">
                <?php 
//                    include PATH_APPLICATION_APP."vistas/zonas/cuadro_login.php";
                ?>  
            </div>-->
        </div>
        
        <div id="sidebar_right">
            
        </div>
        
        <div id="view_content" class="col-md-10">
            <div id="sendero_migas_pan">
                <?php echo \controladores\sendero::ver(); ?>
            </div>
            <?php
                echo $datos['view_content'];
            ?>
        </div>
        
        
    </section>
    <section id="pie" class="container-fluid">
<!--        <div id="enlaces_down">
            <a href="<?php echo URL_ROOT ?>" title="3da2">HOME</a>
            &nbsp;|&nbsp;
            <a href="<?php echo URL_ROOT ?>sitemap.html" title="Mapa Web">MAPA WEB</a>
        </div>-->
        <div>
            <?php 
                include PATH_HOME."app/vistas/zonas/pie.php";
            ?>
        </div>
        <div id="conexion cuadro_login">
            <?php 
                include PATH_APPLICATION_APP."vistas/zonas/form_login.php";
            ?>  
        </div>
    </section>
    
    <!--Para poder enviar los formularios con el id oculto-->
    <?php echo \core\HTML_Tag::post_request_form(); ?>
    
<?php
if (isset($_SESSION["alerta"])) {
    echo <<<heredoc
<script type="text/javascript" />
    alert("{$_SESSION["alerta"]}");
    var alerta = '{$_SESSION["alerta"]}';
</script>
heredoc;
    unset($_SESSION["alerta"]);
}
elseif (isset($datos["alerta"])) {
    echo <<<heredoc
<script type="text/javascript" />
    // alert("{$datos["alerta"]}");
    var alerta = '{$datos["alerta"]}';
</script>
heredoc;
}
?>	
	
    <div id='globals'>
        <?php
            //var_dump($datos);
//            print "<pre>";
//                print_r($GLOBALS);
//                print("\$_GET "); print_r($_GET);
//                print("\$_POST ");print_r($_POST);
//                print("\$_COOKIE ");print_r($_COOKIE);
//                print("\$_REQUEST ");print_r($_REQUEST);
//    		print("\$_SESSION ");print_r($_SESSION);
//                print("\$_SERVER ");print_r($_SERVER);
//            print "</pre>";
//            print("xdebug_get_code_coverage() ");
//            var_dump(xdebug_get_code_coverage());
        ?>
    </div>
</body>
</html>
