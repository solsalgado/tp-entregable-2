<?php
class Viaje{
    //atributos
    private $codigo;
    private $destino;
    private $maxPasajeros;
    private $CollPasajeros = array();
    private $objResponsableV;

    //constructor
    public function construct($codigo, $destino, $maxPasajeros, $CollPasajeros, $objResponsableV){
        $this->codigo = $codigo;
        $this->destino = $destino;
        $this->maxPasajeros = $maxPasajeros;
        $this->CollPasajeros = $CollPasajeros;
        $this->objResponsableV = $objResponsableV;
    }

    //metodos de acceso
    public function getCodigo(){
        return $this->codigo;
    }
    public function getDestino(){
        return $this->destino;
    }
    public function getMaxPasajeros(){
        return $this->maxPasajeros;
    }
    public function getCollPasajeros(){
        return $this->CollPasajeros;
    }
    public function getObjResponsableV(){
        return $this->objResponsableV;
    }

    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }
    public function setDestino($destino){
        $this->destino = $destino;
    }
    public function setMaxPasajeros($maxPasajeros){
        $this->maxPasajeros = $maxPasajeros;
    }
    public function setCollPasajeros($CollPasajeros){
        $this->CollPasajeros = $CollPasajeros;
    }
    public function setObjResponsableV($objResponsableV){
        $this->objResponsableV = $objResponsableV;
    }

    /**
     * agrega pasajeros y verifica que no esten repetidos
     * @param object $objPasajeros
     * @return boolean
     */
    public function agregarPasajeros($objPasajeros){
        $arrayPasaj = $this-> getCollPasajeros();
        $count = count($arrayPasaj);
        $existe = false;
        $boolean = true;
        $i = 0;
        $dni = $objPasajeros->getNroDoc();
        while ($i < $count && $existe == false){
            $pasaj = $arrayPasaj[$i];
            $dniP = $pasaj->getNroDoc();
            if($dniP == $dni){
                $existe = true;
            }
            $i++;
         } 

        if($existe == false){
            $boolean = true;           
            $arrayPasaj[] = $objPasajeros;
            $this->setCollPasajeros($arrayPasaj);
        } else{
            $boolean = false;
        }
        return $boolean;


             
    }



    /**
     * permite modificar a los pasajeros
     * @param float $dni
     * @return boolean
     */
    public function modificarPasajeros($dni){
        $arrayPasaj = $this->getCollPasajeros();
        $c = count($arrayPasaj);
        $encontrado = false;
        $i = 0;

        while($i < $c && $encontrado == false){
            $pasaj = $arrayPasaj[$i];
            $doc = $pasaj->getNroDoc();
            if ($doc == $dni) {
                $encontrado = true;
            }
            $i++;
        }       
        return $encontrado;
    }

    /**
     * crea el objeto responsable
     * @param int $numEmp
     * @param int $numLic
     * @param string $nom
     * @param string $apell
     */
    public function responsable($numEmp, $numLic, $nom, $apell){
        $objResponsableV = new ResponsableV($numEmp, $numLic, $nom, $apell);
        $this->setObjResponsableV($objResponsableV); 
    }

    /**
     * permite modificar al responsable del viaje
     * @param int $numEmp
     * @return boolean
     */
    public function modificarResponsable($numEmp){
        $resp = $this->getObjResponsableV();      
        $existe = false;
          if($resp-> getNumEmpleado() == $numEmp){
            $existe = true;
        }        
        return $existe;
    }

    public function __toString(){
        return "". $this->getCodigo(). "". $this->getDestino(). "". $this->getMaxPasajeros(). "". $this->getCollPasajeros(). "". $this->getObjResponsableV();
        
    }




}
