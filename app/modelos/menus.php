<?php

namespace modelos;

class Menus{    //la clase se tiene que llamar igual que el archivo
    private static $menuUp = array(
        /*
            item => "controlador,metodo/clausula,title"
            item => array( subitem, subitem, ...)
                subitem => "controlador,metodo,title"

        */
        "inicio" => "inicio,index,inicio"
        ,"juegos de mesa" => 
            "articulos,index,juegos de mesa"
//            array(
//                "Juegos de tablero"=>"articulos,juegosTablero,Juegos de Tablero"
//                ,"Juegos de cartas"=>"articulos,juegosCartas,Juegos de Cartas"
//                ,"2 jugadores"=>"articulos,2juegadores,2 jugadores"
//        )
        ,"Expansiones" => "articulos,expansiones,Expansiones de juegos"
        ,"Galería" => "galeria,index,Galeria de imagenes"
        ,"Enlaces" => "enlaces,index,Enlaces de interés"
        ,"contacto" => "contacto,index,contacto"
    );
    
    public static function get_menuUp(){
        return self::$menuUp;
    }
    
    private static $menuLeft = array(
        /*
            item => "controlador,metodo/clausula,title"
            item => array( subitem, subitem, ...)
                subitem => "controlador,metodo,clausula,title"

        */
        "inicio" => "inicio,index,inicio"
        ,"juegos de mesa" => array(
            "todos" =>"articulos,index,juegos de mesa,juegos de mesa"
            ,"juegos de tablero"=>"articulos,categoria,tablero,juegos de tablero"
            ,"juegos de cartas"=>"articulos,categoria,cartas,juegos de cartas"
            ,"juegos de dados"=>"articulos,categoria,dados,juegos de dados"
            ,"solitarios"=>"articulos,categoria,solitario,solitarios" 
            ,"2 jugadores"=>"articulos,categoria,2jugadores,2 jugadores"
            ,"+3 jugadores"=>"articulos,categoria,3jugadores,Minimo 3 jugadores"
            ,"+4 jugadores"=>"articulos,categoria,4jugadores,Minimo 4 jugadores"
        )
        ,"Expansiones" => "articulos,expansiones,Expansiones de juegos"
        ,"Galería" => array(
            "Reglamentos"=>"galeria,carpeta,manuales,Reglamentos"
            ,"Enanos"=>"galeria,carpeta,krasnale,Enanos"
        )
        ,"Enlaces" => "enlaces,index,Enlaces de interés"
        ,"contacto" => "contacto,index,contacto"
    );
    
    public static function get_menuLeft(){
        return self::$menuLeft;
    }

}

?>
