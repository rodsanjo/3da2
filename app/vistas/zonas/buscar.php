<!--<div>
    <form class="form_buscar" method='post' action='<?php echo \core\URL::generar("articulos/busqueda"); ?>' onsubmit='return(document.getElementById("buscar_nombre").value.length>0);'>
        <input type='text' style="float:left;width: 65%;" id='buscar_nombre' name='buscar_nombre' title='Introduzca el nombre o parte del nombre del artículo a buscar'/>        
        <input type='submit' value='<?php echo iText('Buscar', 'dicc'); ?>' title='<?php echo iText('Buscar', 'dicc'); ?>'/>
    </form>
</div>
<hr/>-->
<div>
    <?php
    //Formulario de bscar
    $lupa = '<span class="glyphicon glyphicon-search" aria-hidden="true"></span>';
    ?>
    <form class="form_buscar" method='post' action='<?php echo \core\URL::generar("search/index"); ?>' onsubmit='return(document.getElementById("buscar_nombre").value.length>0);'>
    <!--    <input type='submit' value='Buscar' title='Buscar'/>-->
        
        <select id='buscar_en' name="buscar_en" >
            <option value='nombre' >Nombre juego</option>
            <option value='num_min_jug' >Número minimo de jugadores</option>
            <option value='propietario' >Propietario</option>
            <option value='autor' >Autor</option>
            <option value='editorial' >Editorial</option>
        </select>
        
        <input type='text' id='buscar_nombre' name='nombre' title='Introduzca una palabra o parte de la palabra a buscar'/>
        
        <button type='submit' style="float: left;"><?php echo $lupa; ?></button>
    </form>
</div>
