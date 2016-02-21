<img width="15%" style="float: left;" src="<?php echo URL_ROOT; ?>recursos/imagenes/logo.jpg" title="logo: 3da2" alt="logo: 3da2"/>

<div id="conexion cuadro_login">
    <?php 
        include PATH_APPLICATION_APP."vistas/zonas/form_login.php";
    ?>  
</div>

<img width="10%" src="<?php echo URL_ROOT; ?>recursos/imagenes/logo_letras.jpg" title="3da2" alt="3da2"/>

<div id="central_head" style="float: left;">
    <div id="menu_up" >
        <?php 
            include PATH_APPLICATION."app/vistas/zonas/menu_up.php";
        ?>
    </div>
    <div id="sendero_migas_pan">
        <?php echo \controladores\sendero::ver(); ?>
    </div>
</div>

<div id="buscar">
    <?php 
        include PATH_APPLICATION_APP."vistas/zonas/buscar.php";
    ?>
</div>