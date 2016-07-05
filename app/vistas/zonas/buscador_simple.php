<?php
$lupa = '<span class="glyphicon glyphicon-search" aria-hidden="true"></span>';
?>
<div id="busqueda" class="opcion_menu_left">
    <form class="form_buscar" method='post' action='<?php echo \core\URL::generar("articulos/busqueda"); ?>' onsubmit='return(document.getElementById("buscar_nombre2").value.length>0);'>
        <input placeholder=" buscar" type='text' style="float:left;width: 75%;" id='buscar_nombre2' name='buscar_nombre' title='Introduzca el nombre o parte del nombre del artículo a buscar'/>
        <button type='submit' style="float: right;"><?php echo $lupa; ?></button>
        <!--<input type='submit' value='OK' title='Buscar'>'/>-->
    </form>
</div>
