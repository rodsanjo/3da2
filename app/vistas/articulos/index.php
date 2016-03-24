<?php
//Variables de configuración
//var_dump($datos);
$gamesByLine = 3;//juegos por fila. Games in each line
$datos["paginacion"]["num_total_juegos"] = count($datos['filas']);

$rows = json_encode($datos['filas']);

?>

<script type="text/javascript">
    var url_root = "<?php echo URL_ROOT ?>";
    var rows = <?php echo $rows ?>;
    //alert(rows);
</script>
<script type="text/javascript" src="<?php echo URL_ROOT ?>recursos/js/articulos/articulos.js"></script>

<div>
    <div>
        <h2 id="titulo_seccion" class="titulo_seccion">Juegos de mesa</h2>

        <?php
        if(isset($datos['campo'])){
            $selected = "selected = 'selected'";
        }
        $values = array('nombre','precio','num_min_jug','propietario','anho');
        ?>
        <form name="formOrdenar" method='post' action='<?php echo \core\URL::generar("articulos/ordenar"); ?>'>
            <p>Ordenar por:
                <!--<select id='ordenar_por' name="campo" onchange="ordenarPor(this.value);">-->
                <select id='ordenar_por' name="campo">
                    <option value='nombre' ><?php echo iText('Nombre', 'dicc'); ?></option>
                    <option value='precio' ><?php echo iText('Precio', 'dicc'); ?></option>
                    <option value='num_min_jug' ><?php echo iText('nº jugadores min', 'frases'); ?></option>
                    <option value='num_max_jug' ><?php echo iText('nº jugadores max', 'frases'); ?></option>
                    <option value='editorial'>Editorial</option>
                    <option value='propietario' >Propietario</option>
                    <option value='anho'>Antigüedad</option>
                </select>
                
                <input type="radio" name="orden" value="asc" checked> ascendente
                <input type="radio" name="orden" value="desc"> descendente
                
                <input type="hidden" name="filas" value='<?php echo serialize($datos['filas']) ?>'/>
                <input type="submit" value="<?php echo iText('Ordenar', 'dicc'); ?>" title="Ordenar juegos"/>
            </p>       
        </form>
    </div>
    
    <div class="align_right">
        <?php
        //echo \core\HTML_Tag::a_boton_onclick("boton", array("articulos", "form_insertar"), "Insertar un nuevo artículo");
        echo \core\HTML_Tag::a_boton("boton", array("articulos", "form_insertar"), "insertar un nuevo artículo");
        ?>
    </div>
    <div id="articulos">
    <?php
//    foreach ($datos['filas'] as $key => $fila){ //cada fila corresponde a un juego de mesa        
//        if($key !== 'otros'){
//            $img = ($fila["foto"]) ? "<img class='img_index' src='".URL_ROOT."recursos/imagenes/articulos/".$fila["foto"]."' alt='{$fila['nombre']}' title='{$fila['nombre']}' />" :"";
//            $num_max_jug = isset($fila['num_max_jug'])?$fila['num_max_jug']:null;
//            if(is_null($num_max_jug) || $num_max_jug == $fila['num_min_jug']){
//                $num_max_jug ='';
//            }else{
//                $num_max_jug =' - '.$num_max_jug;
//            }
//            $rangoJug = $fila['num_min_jug'].$num_max_jug;
//            $articulo_nombre = str_replace(" ", "-", $fila['nombre']);
//            $href = \core\URL::generar(array('articulos','juego',$fila['id'], $articulo_nombre));
//            $title = ((isset($fila['resenha']) and strlen($fila['resenha'])) ? $fila['resenha'] : $fila['nombre']); 
//            echo "<div class='juego_index col-md-4 col-sm-6 col-xs-12'>
//                    <a href='$href' title='$title'>
//                        <h3 class='titulo_art'>{$fila['nombre']}</h3>
//                    </a>
//                    <a href='$href' class='media_articulo'>$img</a>
//                    <div class='datos_articulo'>
//                        <p>".iText('Precio', 'dicc').":<br/> <b class='precio'>{$fila['precio']} €</b></p>                    
//                        <p>".iText('Jugadores', 'dicc').":<br/> $rangoJug</p>
//                    </div>
//                    <div class='masDetalles'>
//                        <a class='masDetalles' title='".iText('Leer reseña', 'frases')."'>".iText('Más detalles', 'frases')."</a>
//                        <p class='resenha'>{$fila['resenha']}</b></p>
//                    </div>
//                ";
//                echo "<div class='align_right'>"
//                    .\core\HTML_Tag::a_boton_onclick("boton", array("articulos", "form_modificar", $fila['id']), "Modificar")
//                    //.\core\HTML_Tag::a_boton("boton", array("articulos", "form_modificar", $fila['id']), "Modificar")
//                    //<a class='boton' href='?menu={$datos['controlador_clase']}&submenu=form_modificar&id={$fila['id']}' >modificar</a>
//                    .\core\HTML_Tag::a_boton_onclick("boton", array("articulos", "form_borrar", $fila['id']), "Borrar")
//                    //.\core\HTML_Tag::a_boton("boton", array("articulos", "form_borrar", $fila['id']), "Borrar")
//                    //<a class='boton' href='".\core\URL::generar("articulos/form_borrar/{$fila["id"]}")."' >borrar</a>
//                    ."</div>
//                </div>";
////            if($key%$gamesByLine == $gamesByLine-1){
////                echo "<div style='clear: left;'><hr/></div>";
////            }
//
//            //<p>Precio: <b class='precio'>".\core\Conversiones::decimal_punto_a_coma_y_miles($fila['precio'])." €</b></p>
//        }
//    }
    ?>
    </div>

