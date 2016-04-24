<ul class='menu_left'>
    <?php
        $menu = \modelos\Menus::get_menuLeft();
        foreach ($menu as $key => $item) {
            if(!is_array($item)){
                $item = explode(",", $item);
                $href = \core\URL::generar("$item[0]/$item[1]");
                //$title = ucwords( iText($item[2], 'dicc') );
                $title = ucwords($item[2]);
                //$texto = \core\Idioma::text($key, 'dicc');
                $texto = $key;
                echo"
                    <li class='item' title='$title'>
                        <a href='$href'>$texto</a>
                    </li>
                    ";
            }else{
    ?>
                <li class='item has-sub'><a><?php echo \core\Idioma::text($key, 'dicc') ?></a>
                    <ul>
                        <?php
                        foreach ($item as $key => $subitem) {
                            $subitem = explode (",", $subitem);
                            $href = \core\URL::generar("$subitem[0]/$subitem[1]/$subitem[2]");
                            $title = ucwords( $subitem[3] );
                            $texto = $key;
                            //$texto = \core\Idioma::text($key, 'dicc');
                            echo "
                                <li class='subitem' title='$title'>
                                    <a href='$href'>$texto</a>
                                </li>
                                ";
                        }

                        ?>                                
                    </ul>
                </li>
<?php 
                }
            }
?>
</ul>

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

<?php
if( \core\Distribuidor::get_controlador_instanciado() == 'articulos' ){
?>
    <div id="propietarios" class="opcion_menu_left">
        <?php
            //$clausulas['where'] = " propietario not in ('Otro')";
            $clausulas['order_by'] = "propietario";
            $datos['propietarios'] = \modelos\articulos::getPropietarios($clausulas);
            //var_dump($datos['propietarios']);
        ?>
        <script type='text/javascript'>
            function getPropietarios(propietario){
                //alert(rows.length);

                var lista_props = new Array();

                <?php
                if(! isset($datos['propietarios']) ){
                    $datos['propietarios'] = array('Beto','Jergo','Mar');
                }
                foreach ($datos['propietarios'] as $key => $propietario) {
                ?>
                    var prop_seleccionado = "prop_<?php echo $propietario['propietario']; ?>";
                    if( document.getElementById(prop_seleccionado).checked ){
                        lista_props.unshift(prop_seleccionado);
                    }
                <?php
                }
                ?>
                //console.log(lista_props);
                return lista_props;
            }
        </script>
        Propietarios:
        <form name="form_prop">
            <?php
            foreach ($datos['propietarios'] as $key => $propietario) {
                echo "<input type='checkbox' 
                    id='prop_".$propietario['propietario']."'
                    name='".$propietario['propietario']."'
                    value='".$propietario['propietario']."'
                    onchange='setArticulos()' checked='checked'> ".$propietario['propietario']
                    ."<br/>";
            }
            ?>
        </form>
    </div>
<?php
}
?>
