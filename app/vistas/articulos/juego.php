<div>
    
    <h1 class="titulo_seccion" class='nombre_articulo' title='<?php echo $datos['articulo']['nombre'] ?>'><?php echo $datos['articulo']['nombre'] ?></h1>
    
    <?php
    echo \core\HTML_Tag::a_boton_onclick("boton", array("articulos", "form_modificar", $datos['articulo']['id']), "Modificar");
    $fila = $datos['articulo'];
    $img = ($fila["foto"]) ? "<img src='".URL_ROOT."recursos/imagenes/articulos/".$fila["foto"]."' width='200px' style='float:left' />" :"";  
    $num_max_jug = isset($fila['num_max_jug'])?$fila['num_max_jug']:null;
    if(is_null($num_max_jug) || $num_max_jug == $fila['num_min_jug']){
        $num_max_jug ='';
    }else{
        $num_max_jug ='-'.$num_max_jug;
    }
    $rangoJug = $fila['num_min_jug'].$num_max_jug;
    $duracion = (isset($fila['duracion'])?$fila['duracion'].' min.':"-");
    $edad = isset($fila['edad_min']) ? $fila['edad_min'].'+' : '-';
    
    $articulo_nombre = str_replace(" ", "-", $fila['nombre']);
    $resenha = ((isset($fila['resenha']) and strlen($fila['resenha'])) ? $fila['resenha'] : ''); 
    $descripcion = ((isset($fila['descripcion']) and strlen($fila['descripcion'])) ? $fila['descripcion'] : ''); 
    echo "
            <div id='resenha_articulo' class='text_justificado'>
                <p>$resenha</p>
            </div>
            <div id='media_articulo'>
                $img
                <div id='descarga_manual'>"; 
                //Descarga reglamento:
                if (\core\Usuario::$login != 'anonimo'){
                    $datos["carpeta"] = 'manuales';       
                    $metodo = ($datos["carpeta"] == "js") ? "js" : "file";
                    //No funciona en amigable:
                    //$manual = ($fila["manual"]) ? "<a href='".\core\URL::generar("download/$metodo/manuales/{$fila["manual"]}")."'>Descargar reglamento</a>" : ""; //No funciona en amigable           
                    $manual = ($fila["manual"]) ? "<a href='".URL_ROOT."?p1=download&p2=$metodo&p3=manuales&p4={$fila["manual"]}' >Descargar reglamento</a>" : iText('Reglamento no disponible', 'frases');            
                    echo $manual;
                }
                    echo "</div><br/>
        </div>
    ";

    echo "
            <div id='datos_articulo'>
                <div id='datos_tecnicos'>
                    <p><i>".iText('Precio', 'dicc').":</i> {$fila['precio']} €</p>
                    <p><i>".iText('Jugadores', 'dicc').":</i> $rangoJug</p>
                    <p><i>".iText('Duración', 'dicc').":</i> $duracion</p>
                    <p><i>".iText('Edad', 'dicc').":</i> $edad</p>
                </div>
                <div id='datos_edicion'>
                    <p><i>Año:</i> {$fila['anho']}</p>
                    <p><i>Autor:</i> {$fila['autor']}</p>
                    <p><i>Editorial:</i> \"{$fila['editorial']}\"</p>
                </div>
                <div id='datos_descripcion'><p>$descripcion</p></div>
            </div>
    ";

    //Introdución de comentarios
    if( \core\Usuario::tiene_permiso('articulos', 'form_comentario')){
        echo "<div id='cuadro_comentario' >".iText('opina', 'frases')."
            <form class='form_comentario' name='form_comentario' method='post' 
                action='".\core\URL::generar('articulos/validar_form_comentario')."' 
                onsubmit='return (form_comentario.comentario.value.length>0)'>
                ".
                
                //Dos opciones: usando articulo_id o articulo_nombre como FK
                "
                <input name='articulo_id' type='hidden' value='{$datos['articulo']['id']}'/>
                ".
                //<input name='articulo_nombre' type='hidden' value='{$datos['articulo']['nombre']}'/>
                
                "<input name='usuario_login' type='hidden' value='".\core\Usuario::$login."'/>
                <textarea type='text' id='comentario' name='comentario' maxlength='500' cols='92' rows='5'></textarea>      
                ".\core\HTML_Tag::span_error('errores_validacion', $datos)."
                <input type='submit' value='Enviar'/>
            </form></div>
        ";
    }
    echo "<div id='comentarios' >
            <h4>".iText('Comentarios', 'dicc').":</h4>";
            $array = $datos['comentarios'];
            if( ! count($array)){
                echo "<center>".iText('sinComentarios', 'frases')."</center>";
            }
            $ahora = date("Y-m-d H:i:s");   // 2001-03-10 17:16:18 (el formato DATETIME de MySQL)
            foreach ($array as $key => $comentario) {
                if($comentario['visible'] || \core\Usuario::tiene_permiso('articulos', 'hacer_visible_comentario') ){
                    //print_r(strtotime($ahora).'<br/>');   //strtotime() pasa la fecha a seg
                    if ( \core\Usuario::$login == $comentario['usuario_login'] && strtotime($comentario['fecha_ult_edicion']) > strtotime($ahora) - (60* \core\Configuracion::$minutos_edicion_comentario ) ){ //Permitimos editar el comentario si es del usuario y han transcurrido menos de x minutos desde la ultima edición
                        $editar_comentario = \core\HTML_Tag::a_boton_onclick("boton", array("articulos", "form_editar_comentario", $comentario['id']), 'Editar' );
                    }else{
                        $editar_comentario = "";
                    }
                    if( \core\Usuario::tiene_permiso('articulos', 'form_eliminar_comentario')){
                        $eliminar_comentario = \core\HTML_Tag::a_boton_onclick("boton", array("articulos", "form_eliminar_comentario", $comentario['id']), 'Eliminar' );
                    }else{
                        $eliminar_comentario = "";
                    }
                    
                    $hacer_visible_comentario = '';
                    $style_not_visible = '';
                    if( !$comentario['visible']){
                        $style_not_visible = "style='background-color: lightpink;'";
                        if( \core\Usuario::tiene_permiso('articulos', 'hacer_visible_comentario')){
                            $hacer_visible_comentario = \core\HTML_Tag::a_boton_onclick("boton", array("articulos", "hacer_visible_comentario", $comentario['id']), 'Hacer visible' );
                            //$hacer_visible_comentario = \core\HTML_Tag::a_boton("boton", array("articulos", "hacer_visible_comentario", $comentario['id']), 'Hacer visible' );
                        }
                    }
                    
                    $edicion = ($comentario['num_ediciones'] > 0 ) ? '<small>'.iText('Editado', 'dicc').' '.$comentario['num_ediciones'].' '.iText('veces', 'dicc').'.</small>' : "" ;
                    echo "<div>
                            <div class='acciones_comentario'>$editar_comentario $hacer_visible_comentario $eliminar_comentario</div>
                            ".iText('fecha', 'dicc').": ".$comentario['fecha_comentario'].'  '.$edicion."<br/>
                            <b>".$comentario['usuario_login']."</b> ".iText('escribió', 'dicc').":
                        </div>";
                    echo "<div id='texto_comentario' $style_not_visible>{$comentario['comentario']}</div><br/>";
                }
            }
    echo "</div>";
    ?>
    
</div>

<script type="text/javascript">       
    var unds_stock = <?php echo $fila['unds_stock']; ?>;   //Me guardo la cantidad de unidades en stock disponibles, que serán usadas en el siguiente javascript 
</script>