<div>
    <?php
        $clausulas['where'] = " propietario not in ('Otro')";
        $clausulas['order_by'] = "propietario";
        $datos['propietarios'] = \modelos\articulos::getPropietarios($clausulas);
        //var_dump($datos['propietarios']);
    ?>
    <script type='text/javascript'>
        function haveChanged(propietario){
            alert('it has changed');
            //alert(rows.length);
            for( i=0; i<rows.length; i++){
                if( rows[i].propietario == propietario){
                    alert(rows[i].propietario);
                }
            }

            var lista_props = new Array();
            <?php
            foreach ($datos['propietarios'] as $key => $propietario) {
            ?>
                var prop_seleccionado = "prop_<?php echo $propietario['propietario']; ?>";
                if( document.getElementById(prop_seleccionado).checked ){
                    lista_props.unshift(prop_seleccionado);
                    //alert(lista_props);
                }
            <?php
            }
            ?>
            var cadena = "'"+lista_props.join("','")+"'";
            //alert(cadena);
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
                onchange="haveChanged(this.value)" > '.$propietario['propietario']
                ."<br/>";
        }
        ?>
    </form>
</div>