<div>
    <?php
        $clausulas['where'] = " propietario not in ('Otro')";
        $clausulas['order_by'] = "propietario";
        $datos['propietarios'] = \modelos\articulos::getPropietarios($clausulas);
        //var_dump($datos['propietarios']);
    ?>
    <script type='text/javascript'>
        function getPropietarios(propietario){
            //alert(rows.length);
            
            var lista_props = new Array();
            <?php
            foreach ($datos['propietarios'] as $key => $propietario) {
            ?>
                var prop_seleccionado = "prop_<?php echo $propietario['propietario']; ?>";
                if( document.getElementById(prop_seleccionado).checked ){
                    lista_props.unshift(prop_seleccionado);
                }
            <?php
            }
            ?>
            console.log(lista_props);
            return lista_props;
        }
    </script>
    Propietarios:
    <form name="form_prop" method='post'
          action='<?php echo \core\URL::generar("articulos/busqueda"); ?>'
          onsubmit='return(document.getElementById("buscar_nombre").value.length>0);'>
        <?php
        foreach ($datos['propietarios'] as $key => $propietario) {
            echo "<input type='checkbox' 
                id='prop_".$propietario['propietario']."'
                name='".$propietario['propietario']."'
                value=".$propietario['propietario'].'
                onchange="setArticulos()" checked="checked"> '.$propietario['propietario']
                ."<br/>";
        }
        ?>
    </form>
</div>