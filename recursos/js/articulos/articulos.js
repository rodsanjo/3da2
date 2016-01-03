alert(rows);
setArticulos(rows);
function setArticulos(rows){
    $.each(rows,function(index, row){
        //alert(row['nombre']);
//        alert(row['num_max_jug']);
//        if( row['num_max_jug'].length < 0 || row['num_max_jug'] == null || row['num_max_jug'] == row['num_min_jug']){
//            num_max_jug ='';
//        }else{
//            num_max_jug =' - '+row['num_max_jug'];
//        }
//        rangoJug = row['num_min_jug']+num_max_jug;
//        alert(rangoJug);
        
        html = "<div class='juego_index col-md-4'>";
        html += "<a href='"+href+"' title='"+title+
            "'><h3 class='"+titulo_art+"'>"+row['nombre']+"</h3></a><a href='"+href+
            "' class='media_articulo'>"+img+"</a><div class='datos_articulo'>";
        html += "<p>Precio:<br/><b class='precio'>"+row['precio']+"€</b></p>";
        html += "<p>Jugadores:<br/>"+rangoJu+"</p>";
        html += "</div><div class='masDetalles'><a class='masDetalles' title='Leer reseña'>Más detalles</a>";
        html += "<p class='resenha'>{$fila['resenha']}</b></p></div>"

        //$('#articulos').appendTo(html)
    });
}

function ordenarPor(campo){
    alert(campo);
    $('#articulos').html( '' );
    document.getElementById('articulos').innerHTML = rows[1].propietario;
    if( rows[1].propietario == '')

    html = '<div>';
    html += '<span>'+'hola'+'</span>';
    html += '</div>';
    alert(html);
    //$('#articulos').appendTo(html)

//        alert(tipo_ordenacion);
//        return url += tipo_ordenacion;
}

for(i=0; i<ordenacion.length ;i++){
    var tipoOrden = document.createElement("option"); //Creo la etiqueta
    tipoOrden.setAttribute("value",ordenacion[i].order_by[0]); //creo los atributos. value indicará el "orderby"
    var texto = document.createTextNode(ordenacion[i].name[0]); //Creo el texto
    tipoOrden.appendChild(texto);  //añado el texto a la etiqueta creada
    //alert(tipoOrden);
    document.getElementById("ordenar_por").appendChild(tipoOrden);
}

