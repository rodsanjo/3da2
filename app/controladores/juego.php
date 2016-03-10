<?php
namespace controladores;

class juego extends \core\Controlador{
    
    private static $tabla = 'articulos';
    private static $tabla2 = 'comentarios_articulo';
    private static $controlador = 'juego';
    public static $num_arts_por_pag = 5;
        
    /**
     * Presenta un solo los juegos de tablero
     * @param array $datos
     */
    public function index(array $datos=array()) {
        
        if(isset($_GET['p3'])){
            $articulo_nombre = str_replace("-", " ", $_GET['p4']);
            //$articulo_nombre = mysql_escape_string($articulo_nombre);
            //printf("Escaped string: %s\n", $articulo_nombre);
            print $articulo_nombre;
            $clausulas['where'] = " nombre like '%$articulo_nombre%' ";
            //$clausulas['where'] = " id = {$_GET['p3']} ";
        }
        if ( ! $filas = \modelos\Datos_SQL::select( $clausulas, self::$tabla)) {
            $datos['mensaje'] = 'El articulo seleccionado no se encuentra en nuestro catálogo de productos';
            \core\Distribuidor::cargar_controlador('mensajes', 'mensaje', $datos);
            return;
        }else{   
            $datos['articulo'] = $filas[0];
            
            //Usando articulo_id como FK
            $articulo_id = $filas[0]['id'];
            $clausulas['where'] = " articulo_id = $articulo_id ";
            $clausulas['order_by'] = 'fecha_comentario desc';
            $datos["comentarios"] = \modelos\Modelo_SQL::table(self::$tabla2)->select($clausulas);
            
            //Usando articulo_nombre como FK
//            $clausulas['where'] = " articulo_nombre like '%$articulo_nombre%' ";
//            $clausulas['order_by'] = 'fecha_comentario desc';
//            $datos["comentarios"] = \modelos\Modelo_SQL::table(self::$tabla2)->select($clausulas);
        }
        
        //Mostramos los datos a modificar en formato europeo. Convertimos el formato de MySQL a europeo para su visualización
        self::convertir_formato_mysql_a_ususario($datos['articulo']);
        self::convertir_formato_mysql_a_ususario($datos['comentarios']);

        $datos['view_content'] = \core\Vista::generar(__FUNCTION__, $datos);
        $http_body = \core\Vista_Plantilla::generar('DEFAULT', $datos);
        \core\HTTP_Respuesta::enviar($http_body);

    }
        
    public function validar_form_comentario(array $datos=array()) {
        
        self::request_come_by_post();   //Si viene por POST sigue adelante
        
        $validaciones = array(
            "articulo_id" =>"errores_requerido && errores_texto && errores_numero_entero_positivo && errores_referencia:id/".self::$tabla."/id"
            //"articulo_nombre" =>"errores_requerido && errores_texto && errores_unicidad_modificar:id,articulo_nombre/articulos/id,articulo_nombre"
            ,"usuario_login" => "errores_requerido && errores_texto"
            ,"comentario" => "errores_requerido && errores_texto"
        );                                

        if ( ! $validacion = ! \core\Validaciones::errores_validacion_request($validaciones, $datos)){  //validaciones en PHP
            $datos["errores"]["errores_validacion"]="Corrija los errores, por favor.";
        }else{

            if ( ! $validacion = \modelos\Modelo_SQL::insert($datos["values"], self::$tabla2)) // Devuelve true o false
                $datos["errores"]["errores_validacion"]="No se han podido grabar los datos en la bd.";
        }
        if ( ! $validacion){ //Devolvemos el formulario para que lo intente corregir de nuevo
            \core\Distribuidor::cargar_controlador(self::$controlador, 'form_comentario', $datos);
        }else{
            // Se ha grabado la modificación. Devolvemos el control al la situacion anterior a la petición del form_modificar
            //$datos = array("alerta" => "Se han grabado correctamente los detalles");
            // Definir el controlador que responderá después de la inserción
            //\core\Distribuidor::cargar_controlador(self::$tabla, 'index', $datos);
            $_SESSION["alerta"] = "Su comentario ha sido enviado";
            //header("Location: ".\core\URL::generar("self::$controlador/index"));
            $articulo_nombre = str_replace(" ", "-",$datos['values']['articulo_nombre']);
     
            $articulo_id = $datos['values']['articulo_id'];
            $clausulas['where'] = " id = $articulo_id ";
            $filas = \modelos\Datos_SQL::select( $clausulas, self::$tabla);
            $articulo_nombre = $filas[0]['nombre'];
            $articulo_nombre = str_replace(" ", "-",$articulo_nombre);
            
            \core\HTTP_Respuesta::set_header_line("location", \core\URL::generar(self::$controlador."/juego/".$articulo_id."/".$articulo_nombre));
            \core\HTTP_Respuesta::enviar();
        }
    }
    
    /**
     * Muestra el formulario para editar un comentario
     * @author Jorge Rodriguez <jergo23@gmail.com>
     * @param array $datos
     */
    public function form_editar_comentario(array $datos=array()) {
        
        $datos["form_name"] = __FUNCTION__;

        self::request_come_by_post();   //Si viene por POST sigue adelante
        
        if ( ! isset($datos["errores"])) { // Si no es un reenvío desde una validación fallida
            $validaciones=array(
                "id" => "errores_requerido && errores_numero_entero_positivo && errores_referencia:id/".self::$tabla2."/id"
            );
            if ( ! $validacion = ! \core\Validaciones::errores_validacion_request($validaciones, $datos)) {
                $datos['mensaje'] = 'Datos erróneos para identificar el elemento a editar';
                \core\Distribuidor::cargar_controlador('mensajes', 'mensaje', $datos);
                return;
            }else{
                $clausulas['where'] = " id = {$datos['values']['id']} ";
                if ( ! $filas = \modelos\Datos_SQL::select( $clausulas, self::$tabla2)) {
                    $datos['mensaje'] = 'Error al recuperar la fila de la base de datos';
                    \core\Distribuidor::cargar_controlador('mensajes', 'mensaje', $datos);
                    return;
                }else{   
                    $datos['values'] = $filas[0];

                }
            }
        }
                        
        $datos['view_content'] = \core\Vista::generar(__FUNCTION__, $datos);
        $http_body = \core\Vista_Plantilla::generar('plantilla_principal', $datos);
        \core\HTTP_Respuesta::enviar($http_body);
    }
    /**
     * Edita un comentario enviado mediante un formulario
     * @author Jorge Rodriguez "Jergo" <jergo23@gmail.com>
     * @param array $datos
     */
    public function validar_form_editar_comentario(array $datos=array()) {
        
        self::request_come_by_post();   //Si viene por POST sigue adelante
        
        $validaciones = array(
            "id" =>"errores_requerido && errores_texto && errores_numero_entero_positivo && errores_referencia:id/".self::$tabla2."/id"
            //"articulo_nombre" =>"errores_requerido && errores_texto && errores_unicidad_modificar:id,articulo_nombre/articulos/id,articulo_nombre"
            ,"usuario_login" => "errores_requerido && errores_texto"
            ,"comentario" => "errores_requerido && errores_texto"
        );                                

        if ( ! $validacion = ! \core\Validaciones::errores_validacion_request($validaciones, $datos)){  //validaciones en PHP
            $datos["errores"]["errores_validacion"]="Corrija los errores, por favor.";
        }else{

            if ( ! $validacion = \modelos\Modelo_SQL::update($datos["values"], self::$tabla2)) // Devuelve true o false
                $datos["errores"]["errores_validacion"]="No se han podido grabar los datos en la bd.";
        }
        if ( ! $validacion){ //Devolvemos el formulario para que lo intente corregir de nuevo
            \core\Distribuidor::cargar_controlador(self::$controlador, 'editar_comentario', $datos);
        }else{
            // Se ha grabado la modificación. Devolvemos el control al la situacion anterior a la petición del form_modificar
            //$datos = array("alerta" => "Se han grabado correctamente los detalles");
            // Definir el controlador que responderá después de la inserción
            //\core\Distribuidor::cargar_controlador(self::$tabla, 'index', $datos);
            $_SESSION["alerta"] = "Su comentario ha sido editado";
            //header("Location: ".\core\URL::generar("self::$controlador/index"));
            $articulo_nombre = str_replace(" ", "-",$datos['values']['articulo_nombre']);
            
            //Cogemos el nombre del articulo antes de borrarlo, para luego poder mostrar la misma página
            $where = ' id = '.$datos['values']['id'];
            $sql = 'select * from '.\core\Modelo_SQL::get_prefix_tabla(self::$tabla2).' where '.$where;
            $fila = \core\Modelo_SQL::execute($sql);
            
            $articulo_id = $fila[0]['articulo_id'];
            $clausulas['where'] = " id = $articulo_id ";
            $filas = \modelos\Datos_SQL::select( $clausulas, self::$tabla);
            $articulo_nombre = $filas[0]['nombre'];
            $articulo_nombre = str_replace(" ", "-",$articulo_nombre);
            
            \core\HTTP_Respuesta::set_header_line("location", \core\URL::generar(self::$controlador."/juego/".$articulo_id."/".$articulo_nombre));
            \core\HTTP_Respuesta::enviar();
        }
    }

    /**
     * Muestra el formulario para eliminar un comentario
     * @author Jorge Rodriguez <jergo23@gmail.com>
     * @param array $datos
     * @return type
     */
    public function form_eliminar_comentario(array $datos=array()) {
        
        $datos["form_name"] = __FUNCTION__;

        self::request_come_by_post();   //Si viene por POST sigue adelante
        
        if ( ! isset($datos["errores"])) { // Si no es un reenvío desde una validación fallida
            $validaciones=array(
                "id" => "errores_requerido && errores_numero_entero_positivo && errores_referencia:id/".self::$tabla2."/id"
            );
            if ( ! $validacion = ! \core\Validaciones::errores_validacion_request($validaciones, $datos)) {
                $datos['mensaje'] = 'Datos erróneos para identificar el elemento a eliminar';
                \core\Distribuidor::cargar_controlador('mensajes', 'mensaje', $datos);
                return;
            }else{
                $clausulas['where'] = " id = {$datos['values']['id']} ";
                if ( ! $filas = \modelos\Datos_SQL::select( $clausulas, self::$tabla2)) {
                    $datos['mensaje'] = 'Error al recuperar la fila de la base de datos';
                    \core\Distribuidor::cargar_controlador('mensajes', 'mensaje', $datos);
                    return;
                }else{   
                    $datos['values'] = $filas[0];

                }
            }
        }
                        
        $datos['view_content'] = \core\Vista::generar(__FUNCTION__, $datos);
        $http_body = \core\Vista_Plantilla::generar('plantilla_principal', $datos);
        \core\HTTP_Respuesta::enviar($http_body);
    }
    /**
     * Elimina un comentario enviado mediante un formulario
     * @author Jorge Rodriguez "Jergo" <jergo23@gmail.com>
     * @param array $datos
     */
    public function validar_form_eliminar_comentario(array $datos=array()) {
        
        self::request_come_by_post();   //Si viene por POST sigue adelante
        
        $validaciones = array(
            "id" =>"errores_requerido && errores_texto && errores_numero_entero_positivo && errores_referencia:id/".self::$tabla2."/id"
            //"articulo_nombre" =>"errores_requerido && errores_texto && errores_unicidad_modificar:id,articulo_nombre/articulos/id,articulo_nombre"
            ,"usuario_login" => "errores_requerido && errores_texto"
            ,"comentario" => "errores_requerido && errores_texto"
        );                                

        if ( ! $validacion = ! \core\Validaciones::errores_validacion_request($validaciones, $datos)){  //validaciones en PHP
            $datos["errores"]["errores_validacion"]="Corrija los errores, por favor.";
        }else{
            //Cogemos el nombre del articulo antes de borrarlo, para luego poder mostrar la misma página
            $where = ' id = '.$datos['values']['id'];
            $sql = 'select * from '.\core\Modelo_SQL::get_prefix_tabla(self::$tabla2).' where '.$where;
            $fila = \core\Modelo_SQL::execute($sql);          
            $articulo_id = $fila[0]['articulo_id'];

            if ( ! $validacion = \modelos\Modelo_SQL::delete($datos["values"], self::$tabla2)) // Devuelve true o false
                $datos["errores"]["errores_validacion"]="No se han podido grabar los datos en la bd.";
        }
        if ( ! $validacion){ //Devolvemos el formulario para que lo intente corregir de nuevo
            \core\Distribuidor::cargar_controlador(self::$controlador, 'editar_comentario', $datos);
        }else{
            // Se ha grabado la modificación. Devolvemos el control al la situacion anterior a la petición del form_modificar
            //$datos = array("alerta" => "Se han grabado correctamente los detalles");
            // Definir el controlador que responderá después de la inserción
            //\core\Distribuidor::cargar_controlador(self::$tabla, 'index', $datos);
            $_SESSION["alerta"] = "El comentario ha sido eliminado";
            //header("Location: ".\core\URL::generar("self::$controlador/index"));
            $articulo_nombre = str_replace(" ", "-",$datos['values']['articulo_nombre']);
            
            $clausulas['where'] = " id = $articulo_id ";
            $filas = \modelos\Datos_SQL::select( $clausulas, self::$tabla);
            $articulo_nombre = $filas[0]['nombre'];
            $articulo_nombre = str_replace(" ", "-",$articulo_nombre);
            
            \core\HTTP_Respuesta::set_header_line("location", \core\URL::generar(self::$controlador."/juego/".$articulo_id."/".$articulo_nombre));
            \core\HTTP_Respuesta::enviar();
        }
    }
	
} // Fin de la clase
?>
