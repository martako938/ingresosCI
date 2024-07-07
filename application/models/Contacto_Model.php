<?php
class Contacto_Model extends Index_Model{

    //--------------Métodos para App Contacto
    public function fechaCompleta($fecha){
        //$hoy=date('d-m-Y');    //$hoy = '30-01-2024'; 
        $hoy = $fecha;  //Fecha en que se actualizó por última vez a aplicación                                 
        $date=$hoy;
        $dia = date('l', strtotime($date));
        $mes = date( 'm', strtotime( $date) );
        $diasMesesArray= array(
            0 => array( 0 => "domingo", 1 => "Sunday",2 => "enero", 3 => "01"),
            1 => array( 0 => "lunes", 1 => "Monday",2 => "febrero", 3 => "02"),
            2 => array( 0 => "martes", 1 => "Tuesday",2 => "marzo", 3 => "03"),
            3 => array( 0 => "miércoles", 1 => "Wednesday",2 => "abril", 3 => "04"),
            4 => array( 0 => "jueves", 1 => "Thursday",2 => "mayo", 3 => "05"),
            5 => array( 0 => "viernes", 1 => "Friday",2 => "junio", 3 => "06"), 
            6 => array( 0 => "sábado", 1 => "Saturday",2 => "julio", 3 => "07"),
            7 => array( 0 => "", 1 => "",2 => "agosto", 3 => "08"),
            8 => array( 0 => "", 1 => "",2 => "septiembre", 3 => "09"),
            9 => array( 0 => "", 1 => "",2 => "octubre", 3 => "10"),
            10 => array( 0 => "", 1 => "",2 => "noviembre", 3 => "11"),
            11 => array( 0 => "", 1 => "",2 => "diciembre", 3 => "12"),
        );
        for($i=0;$i<=11;$i++ ){         //Obteniendo el nombre del día
            if($i<=6 && $dia== $diasMesesArray[$i][1]){     $dia= $diasMesesArray[$i][0];   }
            if($mes== $diasMesesArray[$i][3]){              $mes= $diasMesesArray[$i][2];   }     //Obteniendo el mes
        }
        $idia = substr($hoy,-10,-8); //Num de día
        $anio = substr($hoy,-4);    //Año

        $fechaComp[0]= $dia;
        $fechaComp[1]= $idia;
        $fechaComp[2]= $mes;
        $fechaComp[3]= $anio;
        return  $fechaComp;
    }

}