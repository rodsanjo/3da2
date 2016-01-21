host = ''; //Host
host = '/web/jergapps'; //'http://localhost/web/jergapps';
name_app = '/3da2'

//alert(rows);
function setArticulos(){
    html = "";
    $('#articulos').html(html);
    var options = checkedOptions();
    //console.log(options);
    /*
    for( i=0; i<rows.length; i++){    
        if( rows[i].propietario == propietario){
            alert(rows[i].propietario);
        }
    }
    */
    $.each(rows,function(index, row){
        html = '';
        if( $.inArray('prop_'+row['propietario'], options) >= 0 ){ //inArray devuelve la posicion

            articulo_nombre = row['nombre'].replace(/\s/g, "-");
            //articulo_nombre = row['nombre'].replace(" ", "-"); //sustituye solo el primer encuentro
            //console.log(articulo_nombre+' -> prop_'+row['propietario']);

            if( row['foto'] == null ){
                img = '';
            }else{
                img = "<img class='img_index' src='"+url_root+"recursos/imagenes/articulos/"+row['foto']+"' alt='"+row['nombre']+"' title='"+row['nombre']+"' />";
            }
            //console.log( img);

            href = url_root+"articulos/juego/"+row['id']+"/"+articulo_nombre;
            if( row['resenha'] != null && row['resenha'].length > 0 ){
                resenha = row['resenha'];
            }else{
                resenha = row['nombre']; 
            }
            //console.log(title); 

            if( row['num_max_jug'] == null || row['num_max_jug'] == row['num_min_jug']){
                num_max_jug ='';
            }else{
                num_max_jug =' - '+row['num_max_jug'];
            }
            rangoJug = row['num_min_jug']+num_max_jug;

            html = "<div class='juego_index col-md-4'>";
            html += "<a href='"+href+"' title='"+row['nombre']+
                "'><h3 class='titulo_art'>"+row['nombre']+"</h3></a><a href='"+href+
                "' class='media_articulo'>"+img+"</a><div class='datos_articulo'>";
            html += "<p>Precio:<br/><b class='precio'>"+row['precio']+"€</b></p>";
            html += "<p>Jugadores:<br/>"+rangoJug+"</p>";
            html += "</div><div class='masDetalles'><a class='masDetalles' title='Leer reseña'>Más detalles</a>";
            html += "<p class='resenha'>"+resenha+"</b></p></div>";

            $(html).appendTo('#articulos');
            //$(html).appendTo(document.getElementById('articulos'));
        }
        //$('#articulos').html(html);
    });
}

function checkedOptions(){
    
    options = getPropietarios();
    
    //console.log(options);
    return options;
}

function ordenarPor_old(campo){
    alert(campo);
    $('#articulos').html( '' );
    //document.getElementById('articulos').innerHTML = rows[1].propietario;
    //alert(rows[1].propietario);
    if( rows[1].propietario == ''){}

    html = '<div>';
    html += '<span>'+'hola'+'</span>';
    html += '</div>';

    $(html).appendTo('#articulos');

//    alert(tipo_ordenacion);
//        return url += tipo_ordenacion;
}

function ordenarPor(campo){
    console.log(rows);
    for(i=0; i<formOrdenar.orden.length; i++){
        if(formOrdenar.orden[i].checked){
            ordenType = formOrdenar.orden[i].value;
        }
    }
    console.log(ordenType);
    
    jQuery.post(
        host+name_app+'/articulos/ordenarByAjax'
        ,{rows: rows, field: campo, ordenType: ordenType, is_ajax: "true"}
        ,function(data, textStatus, jqXHR) {
            //$('#articulos').html( data );
            //rows = json_encode(data);
            rows = data
            setArticulos(rows);
        }
    );
}

/*
for(i=0; i<ordenacion.length ;i++){
    var tipoOrden = document.createElement("option"); //Creo la etiqueta
    tipoOrden.setAttribute("value",ordenacion[i].order_by[0]); //creo los atributos. value indicará el "orderby"
    var texto = document.createTextNode(ordenacion[i].name[0]); //Creo el texto
    tipoOrden.appendChild(texto);  //añado el texto a la etiqueta creada
    //alert(tipoOrden);
    document.getElementById("ordenar_por").appendChild(tipoOrden);
}
*/
