<?php
class Progra_Model extends Index_Model{

    public function seleccionar_salida(){
        $database= 'dbsisestadistico';
        // $database= 'default';
        $qna= 202401;
        $this-> $database = $this->load->database($database, TRUE);
        $sql = "EXEC sp_ReporteGastosGMM ?";
        // $sql=" SELECT ID, vcUsuario, iNumEmp, iNumEmpLargo, Dependencia, PR, SP, DEP, SD, PARTIDA 
        //         FROM usuarios;";
        $query = $this->dbsisestadistico->query($sql, array($qna));
        // $query = $this->$database->query($sql, array());
        $this->$database->close();
        $Out = array();
        foreach ( $query->result_array() as $row ){
            $Out[] = array( 
                // 'id' =>  $row['ID'],                                                                    //LA TABLA DE PRODUCCION NO TIENE ID
                // 'vcUsuario' => $row['vcUsuario'],
                'iNumEmp'  => $row['iNumEmp'],
                'iNumEmpLargo'  => $row['iNumEmpLargo'],
                'vcDependencia'  => utf8_encode($row['Dependencia']),
                'iPR' => $row['PR'],
                'iSP' => $row['SP'],
                'iDEP' => $row['DEP'],
                'iSD' => $row['SD'],
                'ipartida' => $row['PARTIDA']  
            );
        }
        return $Out;
    }
    
    public function ingresaNumeros($numerosletra,$numeros){
        $database= 'dbsisestadistico';
        $table = 'tRepGastosGMM';
        // $database= 'default';
        // $table = 'usuarios';
        $limit= count($numerosletra);
        $this-> $database = $this->load->database($database, TRUE);
        for ($i=0;$i<$limit;$i++){                                          //Ingresa datos de los dos arreglos
            $sql=" INSERT INTO ".$table."(iNumEmp, iNumEmpLargo) VALUES(?, ?); ";   
            $query2 = $this->$database->query($sql, array($numeros[$i], $numerosletra[$i]) ); 
        }
        if($query2 === true){                                               //Extrae datos ingresados verificando la insercion correcta
            $sql=" SELECT iNumEmp, iNumEmpLargo FROM ".$table.";";
            $query = $this->$database->query($sql, array());
            $this->$database->close();
            foreach ( $query->result_array() as $row ){
                $Out[] = array( 
                    'iNumEmp' =>  $row['iNumEmp'],
                    'iNumEmpLargo' => $row['iNumEmpLargo']
                );
            }
        }else{    $Out = "Error al guardar y recuperar";   }
        $this->$database->close();
        return $Out;
    }

    public function seleccionar_entrada(){
        $database= 'dbsisestadistico';
        $table = 'tRepGastosGMM';
        // $database= 'default';
        // $table = 'usuarios';
        $this-> $database = $this->load->database($database, TRUE);
        $sql="SELECT * FROM ".$table."; ";   
        $query = $this->$database->query($sql); 
        $Out = array();
        foreach ( $query->result_array() as $row ){
            $Out[] = array( 
                'iNumEmp'  => $row['iNumEmp'],
                'iNumEmpLargo'  => $row['iNumEmpLargo']
            );
        }
        if($Out==NULL || $Out== '' ){
            $Out=0;
        }
        $this->$database->close();
        return $Out;
    }

    public function borrar_entrada(){
        $database= 'dbsisestadistico';
        $table = 'tRepGastosGMM';
        // $database= 'default';
        // $table = 'usuarios';
        $this-> $database = $this->load->database($database, TRUE);
        $sql="TRUNCATE TABLE ".$table."; ";   
        $query = $this->$database->query($sql); 
        $Out=0;
        $this->$database->close();
        return $Out;
    }
}