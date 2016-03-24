<?php

namespace modelos;

class articulos extends \core\sgbd\bd {
    
    private static $juegos = array();
    private static $expansiones = array();
    private static $tabla_j = 'articulos';
    private static $tabla_c = 'comentarios_articulo';
    private static $tabla_cat = 'categorias';
    private static $tabla_req = 'requerimientos';
    private static $tabla_p = 'propietarios';
    private static $juegos_por_pagina = 9;
    
    public function __construct(){
        self::setJuegos();
    }
    
    private static function setJuegos($what = 'all'){
        $table = \modelos\Modelo_SQL::get_prefix_tabla( self::$tabla_j );
        $sql = "select * from $table where requerimiento_id != 0 order by nombre";//Solo los juegos basicos, no expansiones
        //$sql = "select * from $table order by nombre"; //all games

        $basic_games = \modelos\Modelo_SQL::execute($sql);
        //$razas = \modelos\Modelo_SQL::table(self::$tabla)->select($clausulas);
        
        //var_dump($razas);
        self::$juegos = $basic_games;
    }
    
    public function getJuegos(){
        return self::$juegos;
    }
    
    public static function getJuegos_by_clausulas($clausulas){
        return \modelos\Modelo_SQL::table(self::$tabla_j)->select($clausulas);       
    }
    
    public static function getPropietarios($clausulas){
        return \modelos\Modelo_SQL::table(self::$tabla_p)->select($clausulas);       
    }
    
    public static function soloJuegosBasicos(&$clausulas){
        //$clausulas['where'] = ' basic_game = true '; //Expansiones
        $clausulas['where'] = ' requerimiento_id != 0 '; //Expansiones
        return $clausulas['where'];
        //return \modelos\Modelo_SQL::table(self::$tabla_j)->select($clausulas);
    }
    
    public static function getExpansiones(){
        $clausulas['where'] = ' requerimiento_id = 0 '; //Expansiones
        return \modelos\Modelo_SQL::table(self::$tabla_j)->select($clausulas);       
    }
    
    public static function getJuegos_by_categoria($categoria){
        $clausulas['where'] = self::soloJuegosBasicos($clausulas);
        //sacamos el id de la categoria
        $table = \modelos\Modelo_SQL::get_prefix_tabla( self::$tabla_cat );
        $sql = "select id from $table where categoria like '%$categoria%'";
        $categorias = \modelos\Modelo_SQL::execute($sql);

        if(!count($categorias)){
            $table = \modelos\Modelo_SQL::get_prefix_tabla( self::$tabla_req );
            $sql = "select id from $table where tipo like '%$categoria%'";
            $categorias = \modelos\Modelo_SQL::execute($sql);
            if(!count($categorias)){
                return;
            }
            
            //Por número
            $num = (int)substr($categoria,0,1);
            if( $num == 0 ){
                $num = 1;
            }
            
            $clausulas['where'] .= " and ( requerimiento_id = {$categorias[0]['id']} or (num_min_jug <= $num and num_max_jug >= $num) )"; //categoria extraida
            
            $juegos = \modelos\Modelo_SQL::table(self::$tabla_j)->select($clausulas);
            
            return $juegos;
        }else{
            $clausulas['where'] .= " and categoria_id = {$categorias[0]['id']} "; //categoria extraida
            return \modelos\Modelo_SQL::table(self::$tabla_j)->select($clausulas);
        }
    }
    
    /* Rescritura de propiedades de validación */
    public static $validaciones_insert = array(
        "nombre" =>"errores_requerido && errores_texto && errores_unicidad_insertar:nombre/articulos/nombre"
        //, "referencia" =>""
        , "propietario" =>"errores_texto"
        , "autor" =>"errores_texto"
        , "editorial" =>"errores_texto"
        , "anho" =>"errores_numero_entero_positivo"
        , "fecha_compra" =>"errores_fecha"
        , "num_min_jug" => "errores_numero_entero_positivo"
        , "num_max_jug" => "errores_numero_entero_positivo"
        , "duracion" => "errores_texto"
        , "edad_min" => "errores_numero_entero_positivo"                        
        , "categoria_id" => "errores_numero_entero_positivo && errores_referencia:categoria_id/categorias/id"
        , "requerimiento_id" => "errores_numero_entero_positivo && errores_referencia:requerimiento_id/requerimientos/id"
        , "tematica" => "errores_texto"
        , "precio" => "errores_decimal"
        , "resenha" => "errores_texto"
        , "descripcion" => "errores_texto"
    );


    public static $validaciones_update = array(
        "id" => "errores_requerido && errores_numero_entero_positivo && errores_referencia:id/articulos/id"
        , "nombre" =>"errores_requerido && errores_texto && errores_unicidad_modificar:id,nombre/articulos/id,nombre"
        //, "referencia" =>""
        , "propietario" =>"errores_texto"
        , "autor" =>"errores_texto"
        , "editorial" =>"errores_texto"
        , "anho" =>"errores_numero_entero_positivo"
        , "fecha_compra" =>"errores_fecha"
        , "num_min_jug" => "errores_numero_entero_positivo"
        , "num_max_jug" => "errores_numero_entero_positivo"
        , "duracion" => "errores_texto"
        , "edad_min" => "errores_numero_entero_positivo"                        
        , "categoria_id" => "errores_numero_entero_positivo && errores_referencia:categoria_id/categorias/id"
        , "requerimiento_id" => "errores_numero_entero_positivo && errores_referencia:requerimiento_id/requerimientos/id"
        , "tematica" => "errores_texto"
        , "precio" => "errores_decimal"
        , "resenha" => "errores_texto"
        , "descripcion" => "errores_texto"
    );


    public static $validaciones_delete = array(
        "id" => "errores_requerido && errores_numero_entero_positivo && errores_referencia:id/articulos/id"
    );

}
