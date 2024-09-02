<?php
//if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('script_tag'))
{
    function script_tag($script_file = '')
    {
            if ($script_file )
              $script = '<script type="text/javascript" type="screen" src="'.base_url().$script_file.'"></script>';

            return $script;
    }
}

function pre($array = '',$msg="" )
{
    echo "<pre> $msg "; print_r($array); echo "</pre>";
}


function app_file_extension($filename=""){
    return strtolower(substr(strrchr($filename, '.'), 1));
}

function app_galeria_imagen($path="",$img="",$param=""){
    $extension = strtolower(app_file_extension($img));
    $imginfo = getimagesize($path.$img);
    $width = ( (int)$imginfo[0] > 70)? 70 : (int)$imginfo[0]; 
    $border = (isset($param['style']['border']))? $param['style']['border'] :'border:solid 1px #d0d0d0;'; 
    $str_imagen = '';
    if(in_array($extension, array('jpg','jpeg','jpe','png','gif'))){
        $str_imagen ='<div style="float:left; width:73px; padding:3px; '.$border.' margin-top: 3px; margin-right: 3px; text-align: center; overflow: hidden"><a href="###" rel="'.$path.$img.'" onclick="img_selected(this.rel)" title="'.$img.'"><img src="'.$path.$img.'" width="'.$width.'" ></a><div style="font-size: 10px; height:25px; border-top:solid 0px #d0d0d0; overflow: hidden;">'.$img.'</div></div>';
    }

    return $str_imagen;
}

function app_format_size($size) {
    $mod = 1024;
    $units = explode(' ','B KB MB GB TB PB');
    for ($i = 0; $size > $mod; $i++) {
        $size /= $mod;
    }
    return round($size, 2) . ' ' . $units[$i];
}

function cbo_rango_numerico($inicio=0,$fin=0,$salto=1, $txtSingular="",$txtPlural=""){
    $inicio = (int)$inicio;
    $fin = (int)$fin;
    $salto= (int)$salto; if($salto==0)$salto=1;
    
    for($i=$inicio; $i<=$fin; $i=$i+$salto){
        $op = $i;
        if($i==1 and $txtSingular){
            $op .=" ".$txtSingular;
        }elseif($i > 1 and $txtPlural){
            $op .=" ".$txtPlural;
        }
        $cbo[$i] = $op;
    }
    return $cbo;
}

function cbo_anio($opIni="", $inicio="", $fin=""){
    $anio_inicio = (strlen($inicio) ==4 and (int)$inicio > 0 )? $inicio : 1900;
    $anio_final = (strlen($fin) ==4 and (int)$fin > 0 )? $fin : date("Y");

    if($opIni)$arr['0000'] = $opIni;
    for($i = $anio_final; $i >= $anio_inicio; $i-- ){
        $arr[$i] = $i;
    }

    return $arr;
}

function cbo_mes($opIni=""){

    if($opIni) $arr[] = $opIni;
    $arr[1] = 'Enero';
    $arr[2] = 'Febrero';
    $arr[3] = 'Marzo';
    $arr[4] = 'Abril';
    $arr[5] = 'Mayo';
    $arr[6] = 'Junio';
    $arr[7] = 'Julio';
    $arr[8] = 'Agosto';
    $arr[9] = 'Septiembre';
    $arr[10] = 'Octubre';
    $arr[11] = 'Noviembre';
    $arr[12] = 'Diciembre';          

    return $arr;
}

function cbo_mes_abreviado($opIni=""){

    if($opIni) $arr[] = $opIni;
    $arr[1] = 'Ene';
    $arr[2] = 'Feb';
    $arr[3] = 'Mar';
    $arr[4] = 'Abr';
    $arr[5] = 'May';
    $arr[6] = 'Jun';
    $arr[7] = 'Jul';
    $arr[8] = 'Ago';
    $arr[9] = 'Sep';
    $arr[10] = 'Oct';
    $arr[11] = 'Nov';
    $arr[12] = 'Dic';          

    return $arr;
}

function cbo_mes_grande($fecha) {
    
    if ($fecha == "01") {
        $mes = "ENERO";
    } else if ($fecha == "02") {
        $mes = "FEBRERO";
    } else if ($fecha == "03") {
        $mes = "MARZO";
    } else if ($fecha == "04") {
        $mes = "ABRIL";
    } else if ($fecha == "05") {
        $mes = "MAYO";
    } else if ($fecha == "06") {
        $mes = "JUNIO";
    } else if ($fecha == "07") {
        $mes = "JULIO";
    } else if ($fecha == "08") {
        $mes = "AGOSTO";
    } else if ($fecha == "09") {
        $mes = "SEPTIEMBRE";
    } else if ($fecha == "10") {
        $mes = "OCTUBRE";
    } else if ($fecha == "11") {
        $mes = "NOVIEMBRE";
    } else if ($fecha == "12") {
        $mes = "DICIEMBRE";
    }
    
    return $mes;
}

function cbo_dia($opIni="", $anio=0, $mes =0 )
{
    $dia_inicial = 1;
    $dia_final = 31;
    if($mes > 0 and strlen($anio) ==4) $dia_final = ultimo_dia($anio,$mes);

    $arr[] = $opIni;
    for($dia= $dia_inicial; $dia <= $dia_final; $dia++)
    {
        $arr[$dia] = $dia;        
    }

    return $arr;
}


function ultimo_dia($anio,$mes){

   if($anio)
       if (((fmod($anio,4)==0) and (fmod($anio,100)!=0)) or (fmod($anio,400)==0)) {
           $dias_febrero = 29;
       } else {
           $dias_febrero = 28;
       }

   switch($mes) {
       case 1: return 31; break;
       case 2: return $dias_febrero; break;
       case 3: return 31; break;
       case 4: return 30; break;
       case 5: return 31; break;
       case 6: return 30; break;
       case 7: return 31; break;
       case 8: return 31; break;
       case 9: return 30; break;
       case 10: return 31; break;
       case 11: return 30; break;
       case 12: return 31; break;
   }
}

function getFechaInicioContrato($fecha_firma_contrato=""){
    if($fecha_firma_contrato=="0000-00-00") $fecha_firma_contrato ="";        
    if($fecha_firma_contrato){            
        $sFecha=separar_fecha($fecha_firma_contrato);            
        $anio = (int)$sFecha['anio'];
        $mes = (int)$sFecha['mes'];
        $dia = (int)$sFecha['dia'];
        if($dia <=15 ){
            $fecha =$anio."-".str_pad($mes, 2,"0",STR_PAD_LEFT)."-".str_pad(ultimo_dia($anio,$mes), 2,"0",STR_PAD_LEFT);                
        }else{
            if($mes < 12){ 
                $mes++;
            }else if($mes ==12){
                $anio++;
                $mes=1;
            }
            $fecha =$anio."-".str_pad($mes, 2,"0",STR_PAD_LEFT)."-15";
        }
        return $fecha;
    }
    return null;
}

function app_js_acento(){
    $str ="
        var acento_a = '\u00e1';\n
        var acento_e = '\u00e9';\n
        var acento_i = '\u00ed';\n
        var acento_o = '\u00f3';\n
        var acento_u = '\u00fa';\n
        var acento_A = '\u00c1';\n
        var acento_E = '\u00c9';\n
        var acento_I = '\u00cd';\n
        var acento_O = '\u00d3';\n
        var acento_U = '\u00da';\n
        var acento_n = '\u00f1';\n
        var acento_N = '\u00d1';\n
        var interroga ='\u00BF';\n  
        var admira ='\u00A1';\n
    ";
    return $str;
}

function agrupar_fecha($fnac){
    $anio = (strlen($fnac['anio'])==4)? (int)$fnac['anio']: 0;
    $mes =  (int)$fnac['mes'];
    $dia = (int)$fnac['dia'];
    $fecha = null;
    if($anio > 0 and $mes > 0 and $dia> 0){
        $fecha = $anio."-".$mes."-".$dia;
    }
    return $fecha;
}

function separar_fecha($strFecha=""){
    $tmp = explode("-", $strFecha);
    $fecha['anio'] = $tmp[0];
    $fecha['mes'] = $tmp[1];
    $fecha['dia'] = $tmp[2];
    return $fecha;
}



function factor_periodo($periodo=0){
    $factor = $periodo;
    if($factor > 2 )$factor = 0;                        
    if($factor == 110) $factor = 4;
    if($factor == 111) $factor = 2;
    if($factor == 112) $factor = 1;
    if($factor == 118) $factor = 4;
    
    return $factor;
}

function sanear_string($string) { 
    $string = trim($string); 
    $string = str_replace( array('�', '�', '�', '�', '�', '�', '�', '�', '�'), 
                           array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'), $string ); 
    $string = str_replace( array('�', '�', '�', '�', '�', '�', '�', '�'), 
                           array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'), $string ); 
    $string = str_replace( array('�', '�', '�', '�', '�', '�', '�', '�'), 
                           array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'), $string ); 
    $string = str_replace( array('�', '�', '�', '�', '�', '�', '�', '�'), 
                           array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'), $string ); 
    $string = str_replace( array('�', '�', '�', '�', '�', '�', '�', '�'), 
                           array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'), $string ); 
    $string = str_replace( array('�', '�', '�', '�'), array('n', 'N', 'c', 'C',), $string ); 
//Esta parte se encarga de eliminar cualquier caracter extra�o 
    $string = str_replace( array("\\", "�", "�", "-", "~", "#", "@", "|", "!", "\"", "�", 
                                 "$", "%", "&", "/", "(", ")", "?", "'", "�", "�", "[", "^", 
                                 "`", "]", "+", "}", "{", "�", "�", ">?, ?< ", ";", ",", ":", "."), '', $string ); //, " "
    return $string; 
}


function fecha_agregar_dias($fecha="", $dias=0){
    $diff1Day = new DateInterval('P'.$dias.'D');        
    $d1 = new DateTime($fecha.' 00:00:00');
    // Add 1 day - expect time to remain at 08:00
    $d1->add($diff1Day);
    $info = (Array)$d1;
    //pre($d1,"--d1--");
    
    //echo "DATE: ".$d1->date;
    return $info['date']; //$d1->date;
}

function ultimo_dia_del_mes($elAnio,$elMes) {
  return date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
}


function cbo_quincena($anio=0,$opIni=""){
    if($opIni) $cbo[] = $opIni;
    $quincenas = mapa_quincenas($anio);
    foreach(mapa_quincenas($anio) as $pos => $quincena){
        $cbo[$pos] = "[Quin $pos] $quincena";
    }
    
    return $cbo;
}
//------------------------------------------------------------------------------
// FUNCIONES PARA EL MODELO DE RESERVA
//------------------------------------------------------------------------------
function mapa_quincenas($anio=0){      
    
    $arr[1] = $anio."-01-15";
    $arr[2] = $anio."-01-31";
    $arr[3] = $anio."-02-15";
    $arr[4] = $anio."-02-".ultimo_dia_del_mes($anio,2);
    $arr[5] = $anio."-03-15";
    $arr[6] = $anio."-03-31";
    $arr[7] = $anio."-04-15";
    $arr[8] = $anio."-04-30";
    $arr[9] = $anio."-05-15";
    $arr[10] = $anio."-05-31";
    $arr[11] = $anio."-06-15";
    $arr[12] = $anio."-06-30";
    $arr[13] = $anio."-07-15";
    $arr[14] = $anio."-07-31";
    $arr[15] = $anio."-08-15";
    $arr[16] = $anio."-08-31";
    $arr[17] = $anio."-09-15";
    $arr[18] = $anio."-09-30";
    $arr[19] = $anio."-10-15";
    $arr[20] = $anio."-10-31";
    $arr[21] = $anio."-11-15";
    $arr[22] = $anio."-11-30";
    $arr[23] = $anio."-12-15";
    $arr[24] = $anio."-12-31";    
    return $arr;
}

function mapa_buscar_inicio($mapa=array(),$fecha_ini=""){  
    $mes = (int)substr($fecha_ini, 5 , 2);
    $qi = ($mes *2) -1;
    if($mapa){
        for($q=$qi; $q<=24; $q++){
            $quincena = $mapa[$q];
            if($quincena >= $fecha_ini){
                return array('pos'=>$q, 'fecha'=>$quincena);
            }
        }
        /*foreach($mapa as $i => $quincena){
            if($quincena >= $fecha_ini){
                return array('pos'=>$i, 'fecha'=>$quincena);
            }
        }*/
    }
}

function mapa_calcular_fecha_instalacion($fecha_inicial,$max_quincenas){    
    $anioInicial = (int)substr($fecha_inicial, 0 , 4);    
    $anioFinal = $anioInicial;
    $mapa = mapa_quincenas($anioInicial);
    $inicio = mapa_buscar_inicio($mapa,$fecha_inicial);
    //pre($inicio,"--inicio--" );
    $posInicial = (int)$inicio['pos'];    
    $posFinal = $posInicial;
    
    if($posInicial >0){
       $mp = $posInicial +$max_quincenas;       
       //echo "FechaInicial: $fecha_inicial; A�oInicial:$anioInicial; PosInicial: $posInicial; MaxQuincenas: $max_quincenas; MP: $mp <br>";        
       //echo " i=".($posInicial+1)."; i<=$mp <br>";
       
       for($i=$posInicial+1; $i<=$mp; $i++){
           //echo $i."-";
           $posFinal++;
           if($posFinal == 24 and $i<$mp){
               $posFinal=0; $anioFinal++;
           }
           if($posFinal > 24 ){
               $posFinal=1; $anioFinal++;
           }
       }
       //echo "<br>anioInicial: $anioInicial; anioFinal: $anioFinal; posFinal: $posFinal <br>";
       
       if($anioFinal > $anioInicial) $mapa = mapa_quincenas($anioFinal);       
       $fechaInstalacion = $mapa[$posFinal];       
       //echo "fechaInstalacion: $fechaInstalacion ";       
       return $fechaInstalacion;
    }
}

function mapa_calcular_diff_quincena($fechaInicial="", $fechaFinal=""){
    if(strlen($fechaInicial)==10 and strlen($fechaFinal)==10){ //ES FECHA        
        $anioInicial = (int)substr($fechaInicial, 0 , 4);         
        $anioFinal   = (int)substr($fechaFinal, 0 , 4);         
        
        $mapaInicial = mapa_quincenas($anioInicial);//MAPA DE QUINCENAS DEL A�O INICIAL        
        $INICIO = mapa_buscar_inicio($mapaInicial,$fechaInicial);//BUSCA POSICION INICIAL
                
        $mapaFinal = $mapaInicial;
        if($anioFinal > $anioInicial ) $mapaFinal = mapa_quincenas($anioFinal);        
        $FIN = mapa_buscar_inicio($mapaFinal,$fechaFinal); 
        
        $difAnio = $anioFinal- $anioInicial;
        if($difAnio==0){
            $mq = (int)$FIN['pos'] - (int)$INICIO['pos'];
        }else if($anioFinal > $anioInicial ){
            $mq = 24 - (int)$INICIO['pos'];            
            if($difAnio>=2) $mq += (($difAnio-1) * 24);
            $mq += (int)$FIN['pos'];  
        }
        return $mq;
    }
    
}

function estado_abreviacion(){
    $edo[strtoupper('Aguascalientes')] ="AGS";
    $edo[strtoupper('Baja California Norte')] ="BCN";
    $edo[strtoupper('Baja California Sur')] ="BCS";
    $edo[strtoupper('Campeche')] ="CAM";
    $edo[strtoupper('Chiapas')] ="CHS";
    $edo[strtoupper('Chihuahua')] ="CHI";
    $edo[strtoupper('Coahuila')] ="COA";
    $edo[strtoupper('Colima')] ="COL";
    $edo[strtoupper('Ciudad de Mexico')] ="CDMX";
    $edo[strtoupper('Durango')] ="DGO";
    $edo[strtoupper('Estado de Mexico')] ="EM";
    $edo[strtoupper('Guanajuato')] ="GTO";
    $edo[strtoupper('Guerrero')] ="GRO";
    $edo[strtoupper('Hidalgo')] ="HGO";
    $edo[strtoupper('Jalisco')] ="JAL";
    $edo[strtoupper('Michoacan')] ="MICH";
    $edo[strtoupper('Morelos')] ="MOR";
    $edo[strtoupper('Nayarit')] ="NAY";
    $edo[strtoupper('Nuevo Leon')] ="NL";
    $edo[strtoupper('Oaxaca')] ="OAX";
    $edo[strtoupper('Puebla')] ="PUE";
    $edo[strtoupper('Queretaro')] ="QRO";
    $edo[strtoupper('Quintana Roo')] ="QR";
    $edo[strtoupper('San Luis Potosi')] ="SLP";
    $edo[strtoupper('Sinaloa')] ="SIN";
    $edo[strtoupper('Sonora')] ="SON";
    $edo[strtoupper('Tabasco')] ="TAB";
    $edo[strtoupper('Tamaulipas')] ="TAM";
    $edo[strtoupper('Tlaxcala')] ="TLAX";
    $edo[strtoupper('Veracruz')] ="VER";
    $edo[strtoupper('Yucat�n')] ="YUC";
    $edo[strtoupper('Zacatecas')] ="ZAC";
    return $edo;
}


function comprimir($ruta, $zip_salida, $handle = false, $recursivo = false){

    /* Declara el handle del objeto */
    if(!$handle){
        $handle = new ZipArchive;
        if ($handle->open($zip_salida, ZipArchive::CREATE) === false){
            return false; /* Imposible crear el archivo ZIP */
        }
    }

    /* Procesa directorio */
    if(is_dir($ruta)){
     /* Aseguramos que sea un directorio sin car�cteres corruptos */
        $ruta = dirname($ruta.'/arch.ext');         
        $handle->addEmptyDir($ruta); /* Agrega el directorio comprimido */
        foreach(glob($ruta.'/*') as $url){ /* Procesa cada directorio o archivo dentro de el */            
            comprimir($url, $zip_salida, $handle, true); /* Comprime el subdirectorio o archivo */            
        }
        /* Procesa archivo */
    }else{
        $archivoNombre =  basename($ruta);
        $handle->addFile($ruta,$archivoNombre);
    }
    /* Finaliza el ZIP si no se est� ejecutando una acci�n recursiva en progreso */
    if(!$recursivo){      
        $handle->close();
    }

    return true; /* Retorno satisfactorio */
}


function eliminarDir($carpeta){
    foreach(glob($carpeta . "/*") as $archivos_carpeta){
        //echo $archivos_carpeta;
 
        if (is_dir($archivos_carpeta)){
            eliminarDir($archivos_carpeta);
        }else{
            unlink($archivos_carpeta);
        }
    } 
    rmdir($carpeta);
}

//------------------------------------------------------------------------------
//  FUNCIONES PARA BURO DE CREDITO
//------------------------------------------------------------------------------

function app_separar_nombres($nombre=""){
    $nombre = trim($nombre);
    $info=null;
    if($nombre <> ""){
        $arrNombre = explode(" ", $nombre);
        $info['primer_nombre'] = $arrNombre[0];
        unset($arrNombre[0]);
        $info['segundo_nombre'] = implode(" ", $arrNombre);
    }    
    return $info;
}

function app_estado_civil($edo_civil=""){
    $edo_civil = strtolower($edo_civil);
    $charEdoCivil ="";
    if(in_array( $edo_civil, array('divorciado','divorciada'))){
        $charEdoCivil='D';
    }else if($edo_civil=="union libre"){
        $charEdoCivil='F';
    }else if(in_array( $edo_civil, array('casado','casada'))){
        $charEdoCivil='M';
    }else if(in_array( $edo_civil, array('soltero','soltera'))){
        $charEdoCivil='S';
    }else if(in_array( $edo_civil, array('viudo','viuda'))){
        $charEdoCivil='W';
    }    
    return $charEdoCivil;
}

function app_sexo($sexo=""){
    $charSexo="";
    if($sexo=="H") $charSexo="M"; 
    if($sexo=="M") $charSexo="F";
    return $charSexo;
}


function isMobileDevice() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

function documentoVigente($doc){
    $vigente=0;
    if(isset($doc)) $doc_ok=1; else $doc_ok=0;
    //echo "<br>Id: ".$doc['Id']." revision: ".$doc['revision']." fecha_vigencia: ".$doc['fecha_vigencia'];
    if($doc_ok==1 and (!trim($doc['fecha_vigencia']) or($doc['fecha_vigencia']=='0000-00-00')) ){
            $vigente = 1; //echo " Entra: 1";
    }elseif( $doc_ok==1 and $doc['fecha_vigencia'] >= date("Y-m-d") and $doc['revision']==1 ){
        $vigente = 1; //echo " Entra: 2";
    }
    
    $fecha_vigencia = $doc['fecha_vigencia'];
    if($doc['fecha_vigencia']=='0000-00-00')$fecha_vigencia ="";    
    
    return array('docOk'=>$doc_ok,'vigente'=>$vigente,'fecha_vigencia'=>$fecha_vigencia,'revision'=>$doc['revision']) ;    
}

function solicitud_revisar_avances($solicitud=""){
    $totCampos = 0; $maxCampos= 0;
    //I.- Datos del cr�dito
    $datosDelCredito = 0; $maxDatosCredito = 3;
    //$datosDelCredito +=3; // DATOS INICIALES
    //if($solicitud['num_vendedor'])  $datosDelCredito++; //echo "[I-1]OK";}else{echo "[I-1]Vacio";}
    //if($solicitud['sucursal_id'] >0)  $datosDelCredito++; //echo "[I-2]OK";}else{echo "[I-2]Vacio";}
    if($solicitud['monto_autorizado'] >0)  $datosDelCredito++; //echo "[I-3]OK";}else{echo "[I-3]Vacio";}
    if($solicitud['clabe_valida']==1)  $datosDelCredito++; //echo "[I-4]OK";}else{echo "[I-4]Vacio";}
    if($solicitud['disposicion_credito']!="0")  $datosDelCredito++; //echo "[I-5]OK";}else{echo "[I-5]Vacio";}
    $totCampos +=$datosDelCredito; $maxCampos+=$maxDatosCredito;
    $porcentaje = round((($datosDelCredito/$maxDatosCredito)*100),2);
    $avance['SECCION_I']= array('maxCampos'=>$maxDatosCredito,'camposLlenos'=>$datosDelCredito,"porcentaje"=>$porcentaje);
  
    //II.- Datos del Solicitante
    $datosDelSolicitante=0; $maxDatosSolicitantes=28;
    if($solicitud['cliente']['apellido_paterno'])  $datosDelSolicitante++; //echo "[II-1.1]OK";}else{echo "[II-1.1]Vacio";}
    if($solicitud['cliente']['apellido_materno'])  $datosDelSolicitante++; //echo "[II-1.2]OK";}else{echo "[II-1.2]Vacio";}
    if($solicitud['cliente']['nombre'])  $datosDelSolicitante++; //echo "[II-1.3]OK";}else{echo "[II-1.3]Vacio";}
    if($solicitud['cliente']['curp'])  $datosDelSolicitante++; //echo "[II-1.4]OK";}else{echo "[II-1.4]Vacio";}
    if($solicitud['cliente']['nacimiento_fecha'])  $datosDelSolicitante++; //echo "[II-2.1]OK";}else{echo "[II-2.1]Vacio";}
    if($solicitud['cliente']['genero'])  $datosDelSolicitante++; //echo "[II-2.2]OK";}else{echo "[II-2.2]Vacio";}
    if($solicitud['cliente']['rfc'])  $datosDelSolicitante++; //echo "[II-2.3]OK";}else{echo "[II-2.3]Vacio";}
    if($solicitud['cliente']['ciudad_nacimiento'])  $datosDelSolicitante++; //echo "[II-2.4]OK";}else{echo "[II-2.4]Vacio";}
    if($solicitud['cliente']['nacimiento_estado'])  $datosDelSolicitante++; //echo "[II-2.5]OK";}else{echo "[II-2.5]Vacio";}
    if($solicitud['cliente']['nacimiento_pais'])  $datosDelSolicitante++; //echo "[II-3.1]OK";}else{echo "[II-3.1]Vacio";}
    if($solicitud['cliente']['email'])  $datosDelSolicitante++; //echo "[II-3.2]OK";}else{echo "[II-3.2]Vacio";}
    //if($solicitud['cliente']['telefono_fijo'])  $datosDelSolicitante++; //echo "[II-3.3]OK";}else{echo "[II-3.3]Vacio";}
    //if($solicitud['cliente']['telefono_fijo_dos'])  $datosDelSolicitante++; //echo "[II-3.4]OK";}else{echo "[II-3.4]Vacio";}
    if($solicitud['cliente']['telefono_movil'])  $datosDelSolicitante++; //echo "[II-3.5]OK";}else{echo "[II-3.5]Vacio";}
    if($solicitud['cliente']['domicilio_calle'])  $datosDelSolicitante++; //echo "[II-4.1]OK";}else{echo "[II-4.1]Vacio";}
    if($solicitud['cliente']['domicilio_calle_numext'])  $datosDelSolicitante++; //echo "[II-4.2]OK";}else{echo "[II-4.2]Vacio";}
    if($solicitud['cliente']['domicilio_cp'])  $datosDelSolicitante++; //echo "[II-4.4]OK";}else{echo "[II-4.4]Vacio";}
    if($solicitud['cliente']['domicilio_estado_id']>0)  $datosDelSolicitante++; //echo "[II-5.1]OK";}else{echo "[II-5.1]Vacio";}
    if($solicitud['cliente']['domicilio_municipio_id']>0)  $datosDelSolicitante++; //echo "[II-5.2]OK";}else{echo "[II-5.2]Vacio";}
    if($solicitud['cliente']['domicilio_ciudad_id']<> "")  $datosDelSolicitante++; //echo "[II-5.3]OK";}else{echo "[II-5.3]Vacio";}
    if($solicitud['cliente']['domicilio_colonia_id']>0)  $datosDelSolicitante++; //echo "[II-5.4]OK";}else{echo "[II-5.4]Vacio";}
    if($solicitud['cliente']['domicilio_tipo']>0)  $datosDelSolicitante++; //echo "[II-6.1]OK";}else{echo "[II-6.1]Vacio";}
    if($solicitud['cliente']['domicilio_antiguedadanios']>0)  $datosDelSolicitante++; //echo "[II-6.2]OK";}else{echo "[II-6.2]Vacio";}
    if($solicitud['cliente']['estado_civil'])  $datosDelSolicitante++; //echo "[II-6.3]OK";}else{echo "[II-6.3]Vacio";}
    //if($solicitud['cliente']['regimen_patrimonial'])  $datosDelSolicitante++; //echo "[II-6.4]OK";}else{echo "[II-6.4]Vacio";}
    if($solicitud['cliente']['dependientes_economicos']<>"")  $datosDelSolicitante++; //echo "[II-6.5]OK";}else{echo "[II-6.5]Vacio";}        
    if($solicitud['cliente']['grado_estudio_id'])  $datosDelSolicitante++; //echo "[II-7.1]OK";}else{echo "[II-7.1]Vacio";}
    if($solicitud['cliente']['ocupacion_profesion'])  $datosDelSolicitante++; //echo "[II-7.2]OK";}else{echo "[II-7.2]Vacio";}
    if($solicitud['cliente']['giro_negocio'])  $datosDelSolicitante++; //echo "[II-7.3]OK";}else{echo "[II-7.3]Vacio";}        
    if($solicitud['tipo_identificacion'])  $datosDelSolicitante++; //echo "[II-7.4]OK";}else{echo "[II-7.4]Vacio";}
    if($solicitud['numero_identificacion'])  $datosDelSolicitante++; //echo "[II-7.5]OK";}else{echo "[II-7.5]Vacio";}
    //if($solicitud['id_firma_electronica'])  $datosDelSolicitante++;  //echo "[II-8.1]OK";}else{echo "[II-8.1]Vacio";}
    //if($solicitud['id_tarjeta'])  $datosDelSolicitante++; //echo "[II-8.2]OK";}else{echo "[II-8.2]Vacio";}
    $totCampos +=$datosDelSolicitante; $maxCampos+=$maxDatosSolicitantes;
    $porcentaje=round((($datosDelSolicitante/$maxDatosSolicitantes)*100),2);
    //echo "<br>datosDelSolicitante: $datosDelSolicitante de $maxDatosSolicitantes (".round((($datosDelSolicitante/$maxDatosSolicitantes)*100),2)."%)";
    $avance['SECCION_II']= array('maxCampos'=>$maxDatosSolicitantes,'camposLlenos'=>$datosDelSolicitante,"porcentaje"=>$porcentaje);

    //III.- Informaci�n del empleo
    $datosDelEmpleo=0; $maxDatosEmpleado =13;
    //$datosDelEmpleo+=1;// DATOS INICIALES
    //if($solicitud['cliente']['empleo_num_empleado'])  $datosDelEmpleo++;
    if($solicitud['cliente']['empleo_departamento'])  $datosDelEmpleo++;        
    if($solicitud['cliente']['empleo_puesto'])  $datosDelEmpleo++;        
    //if($solicitud['cliente']['empleo_antiguedad'])  $datosDelEmpleo++;        
    if($solicitud['cliente']['empleo_domicilio'])  $datosDelEmpleo++;
    if($solicitud['cliente']['empleo_num_ext'])  $datosDelEmpleo++;
    //if($solicitud['cliente']['empleo_num_int'])  $datosDelEmpleo++;
    if($solicitud['cliente']['empleo_cp'])  $datosDelEmpleo++;
    if($solicitud['cliente']['empleo_estado_id'])  $datosDelEmpleo++;
    if($solicitud['cliente']['empleo_municipio_id'])  $datosDelEmpleo++;
    if($solicitud['cliente']['empleo_ciudad_id'])  $datosDelEmpleo++;
    if($solicitud['cliente']['empleo_colonia_id'])  $datosDelEmpleo++;        
    if($solicitud['cliente']['empleo_Ingreso_bruto_mensual'])  $datosDelEmpleo++;
    if($solicitud['cliente']['empleo_sueldo_variable'])  $datosDelEmpleo++;
    if($solicitud['cliente']['descuentos'])  $datosDelEmpleo++;
    if($solicitud['cliente']['empleo_Ingreso_neto_mensual'])  $datosDelEmpleo++;
    //if($solicitud['cliente']['empleo_tele_fijo_uno'])  $datosDelEmpleo++;
    //if($solicitud['cliente']['empleo_tele_fijo_dos'])  $datosDelEmpleo++;
    $totCampos +=$datosDelEmpleo; $maxCampos+=$maxDatosEmpleado;
    $porcentaje = round((($datosDelEmpleo/$maxDatosEmpleado)*100),2);
    $avance['SECCION_III']= array('maxCampos'=>$maxDatosEmpleado,'camposLlenos'=>$datosDelEmpleo,"porcentaje"=>$porcentaje);

    //IV.- Referencias Personales
    $referencia = (array)json_decode($solicitud['referencias_json'],true);
    $datosReferencia=0; $maxReferencia=9;
    for($i=1; $i<=3; $i++){
        if($referencia[$i]['nombre'])  $datosReferencia++;
        if($referencia[$i]['parentesco'])  $datosReferencia++;
        //if($referencia[$i]['telefono_casa'])  $datosReferencia++;
        if($referencia[$i]['telefono_movil'])  $datosReferencia++;
        //if($referencia[$i]['telefono_recados'])  $datosReferencia++;
    }
    $totCampos +=$datosReferencia; $maxCampos+=$maxReferencia;
    $porcentaje=round((($datosReferencia/$maxReferencia)*100),2);
    $avance['SECCION_IV']= array('maxCampos'=>$maxReferencia,'camposLlenos'=>$datosReferencia,"porcentaje"=>$porcentaje);

    //V.- Destino del credito
    $destinoDelCredito=0;  $maxDestino = 1;      
    if($solicitud['destino_credito'])$destinoDelCredito++;
    $totCampos +=$destinoDelCredito; $maxCampos+=$maxDestino;
    $porcentaje=round((($destinoDelCredito/$maxDestino)*100),2);
    $avance['SECCION_V']= array('maxCampos'=>$maxDestino,'camposLlenos'=>$destinoDelCredito,"porcentaje"=>$porcentaje);

    //VI.- Personas pol�ticamente expuestas
    $personasPolExp=0;$maxPolExp=1;
    if($solicitud['personas_pol_exp'])$personasPolExp++;
    $totCampos +=$personasPolExp; $maxCampos+=$maxPolExp;
    $porcentaje=round((($personasPolExp/$maxPolExp)*100),2);
    $avance['SECCION_VI']= array('maxCampos'=>$maxPolExp,'camposLlenos'=>$personasPolExp,"porcentaje"=>$porcentaje);

    //VII.- Declaracion de actuacion
    $declaracionActuacion=0; $maxDeclaracion=2;
    if($solicitud['cuenta_propia'])$declaracionActuacion++;
    if($solicitud['propietario_real'])$declaracionActuacion++;
    $totCampos +=$declaracionActuacion; $maxCampos+=$maxDeclaracion;
    $porcentaje=round((($declaracionActuacion/$maxDeclaracion)*100),2);
    $avance['SECCION_VII']= array('maxCampos'=>$maxDeclaracion,'camposLlenos'=>$declaracionActuacion,"porcentaje"=>$porcentaje);

    //OTROS
    $otros=0; $maxOtros=2;
    if($solicitud['ciudad_celebracion_contrato'])$otros++;
    if($solicitud['fecha_celebracion_contrato'])$otros++;  
    $totCampos +=$otros; $maxCampos+=$maxOtros;
    $porcentaje=round((($otros/$maxOtros)*100),2);
    $avance['SECCION_OTROS']= array('maxCampos'=>$maxOtros,'camposLlenos'=>$otros,"porcentaje"=>$porcentaje);


    $porcentaje=round((($totCampos/$maxCampos)*100),2);
    $avance['SOLICITUD'] = array('maxCampos'=>$maxCampos,'camposLlenos'=>$totCampos,"porcentaje"=>$porcentaje);

    //Reporte de buro
    $camposBuro=0; $maxBuro = 11;
    if($solicitud['cliente']['nombre']) $camposBuro++;
    if($solicitud['cliente']['apellido_materno']) $camposBuro++;
    if($solicitud['cliente']['apellido_materno']) $camposBuro++;
    if($solicitud['cliente']['rfc'])$camposBuro++;            
    if($solicitud['cliente']['domicilio_calle'])$camposBuro++;
    if($solicitud['cliente']['domicilio_calle_numext'])$camposBuro++;
    if($solicitud['cliente']['domicilio_colonia'])$camposBuro++;
    if($solicitud['cliente']['domicilio_municipio'])$camposBuro++;
    if($solicitud['cliente']['domicilio_estado'])$camposBuro++;    
    if($solicitud['cliente']['telefono_movil'])$camposBuro++;
    if($solicitud['ciudad_celebracion_contrato'])$camposBuro++;
    
    $porcentaje=round((($camposBuro/$maxBuro)*100),2);
    $avance['BURO'] = array('maxCampos'=>$maxBuro,'camposLlenos'=>$camposBuro,"porcentaje"=>$porcentaje);
    
    //Caratula de Credito
    $camposCaratula=0; $maxCaratula=5;
    if($solicitud['total_pagos']) $camposCaratula++;
    if($solicitud['monto_credito']) $camposCaratula++;
    if($solicitud['monto_total']) $camposCaratula++;
    //if($solicitud['costo_anual_total']) $camposCaratula++;
    //if($solicitud['fecha_limite']) $camposCaratula++;
    //if($solicitud['fecha_corte']) $camposCaratula++;
    //if($solicitud['seguro']) $camposCaratula++;
    //if($solicitud['aseguradora']) $camposCaratula++;
    //if($solicitud['clausula']) $camposCaratula++;
    //if($solicitud['consulta_estado_cuenta']) $camposCaratula++;
    if($solicitud['comisiones_contratacion']>=0) $camposCaratula++;
    if($solicitud['comisiones_fondo']>=0) $camposCaratula++;
    
    $porcentaje=round((($camposCaratula/$maxCaratula)*100),2);
    $avance['CARATULA'] = array('maxCampos'=>$maxCaratula,'camposLlenos'=>$camposCaratula,"porcentaje"=>$porcentaje);
    
    //Pagare
    $camposPagare=0; $maxPagare=2;
    if($solicitud['fecha_celebracion_contrato']) $camposPagare++;
    if($solicitud['periodicidad']) $camposPagare++;
    //if($solicitud['ciudad_celebracion_contrato']) $camposPagare++;
    
    $porcentaje=round((($camposPagare/$maxPagare)*100),2);
    $avance['PAGARE'] = array('maxCampos'=>$maxPagare,'camposLlenos'=>$camposPagare,"porcentaje"=>$porcentaje);
    
    //Aceptacion de Fideicomiso
    $camposFideicomiso=0; $maxFideicomiso=1;
    //if($solicitud['ciudad_celebracion_contrato']) $camposFideicomiso++;
    if($solicitud['porcentaje_credito']) $camposFideicomiso++;

    $porcentaje=round((($camposFideicomiso/$maxFideicomiso)*100),2);
    $avance['FIDEICOMISO'] = array('maxCampos'=>$maxFideicomiso,'camposLlenos'=>$camposFideicomiso,"porcentaje"=>$porcentaje);
    
    //Instruccion de Descuento
    $camposInstruccion=0; $maxInstruccion=1;
    //if($solicitud['ciudad_celebracion_contrato']) $camposInstruccion++;
    //if($solicitud['banco_nombre']) $camposInstruccion++;
    //if($solicitud['monto_pago']) $camposInstruccion++;
    //if($solicitud['monto_autorizado']) $camposInstruccion++;
    if($solicitud['periodicidad']) $camposInstruccion++;
    //if($solicitud['total_pagos']) $camposInstruccion++;
    if($solicitud['amortizaciones_adicionales']>=0 || $solicitud['descuento_puntual']>=0){
        $maxInstruccion=2;
        $camposInstruccion++;
    }
    $porcentaje=round((($camposInstruccion/$maxInstruccion)*100),2);
    $avance['INSTRUCCION'] = array('maxCampos'=>$maxInstruccion,'camposLlenos'=>$camposInstruccion,"porcentaje"=>$porcentaje);
    
    //Autorizacion de Domiciliacion
    $camposDomiciliacion=0; $maxDomiciliacion=2;
    if($solicitud['institucion']['razon_social']) $camposDomiciliacion++;
    if($solicitud['clabe'] || $solicitud['id_tarjeta']){
      $camposDomiciliacion++; 
    }
    
    $porcentaje=round((($camposDomiciliacion/$maxDomiciliacion)*100),2);
    $avance['DOMICILIACION'] = array('maxCampos'=>$maxDomiciliacion,'camposLlenos'=>$camposDomiciliacion,"porcentaje"=>$porcentaje);
    
    //Contrato de Credito
    $camposContrato=0; $maxContrato=5;
    if($solicitud['cliente']['nombre']) $camposContrato++;
    if($solicitud['cliente']['apellido_materno']) $camposContrato++;
    if($solicitud['cliente']['apellido_materno']) $camposContrato++;
    if($solicitud['ciudad_celebracion_contrato'])$camposContrato++;
    if($solicitud['fecha_celebracion_contrato'])$camposContrato++; 
    
    $porcentaje=round((($camposContrato/$maxContrato)*100),2);
    $avance['CONTRATO'] = array('maxCampos'=>$maxContrato,'camposLlenos'=>$camposContrato,"porcentaje"=>$porcentaje);
    
    //Pagare Verde
    $camposPagareVerde=0; $maxPagareVerde=1;
    if($solicitud['fecha_celebracion_contrato']) $camposPagareVerde++;
    
    $porcentaje=round((($camposPagareVerde/$maxPagareVerde)*100),2);
    $avance['PAGAREVERDE'] = array('maxCampos'=>$maxPagareVerde,'camposLlenos'=>$camposPagareVerde,"porcentaje"=>$porcentaje);
    
    //Mejora Vivienda
    $camposMejoraVivienda=0; $maxMejoraVivienda=2;
    if($solicitud['descripcion_vivienda']) $camposMejoraVivienda++;
    if($solicitud['porcentaje_vivienda']) $camposMejoraVivienda++;
    
    $porcentaje=round((($camposMejoraVivienda/$maxMejoraVivienda)*100),2);
    $avance['MEJORAVIVIENDA'] = array('maxCampos'=>$maxMejoraVivienda,'camposLlenos'=>$camposMejoraVivienda,"porcentaje"=>$porcentaje);

    $porcentaje=100;
    $avance['autorizacionFirma'] = array('maxCampos'=>"0",'camposLlenos'=>"0","porcentaje"=>$porcentaje);
    
    //Carta Bajo Protesta
    $camposCartaBajoProtesta=0; $maxCartaBajoProtesta=5;
    if($solicitud['nombre_negocio']) $camposCartaBajoProtesta++;
    if($solicitud['tiempo_negocio']) $camposCartaBajoProtesta++;
    if($solicitud['direccion_negocio']) $camposCartaBajoProtesta++;
    if($solicitud['descr_cred_sol']) $camposCartaBajoProtesta++;
    if($solicitud['cargo_negocio']) $camposCartaBajoProtesta++;
    
    
    $porcentaje=round((($camposCartaBajoProtesta/$maxCartaBajoProtesta)*100),2);
    $avance['CARTABAJOPROTESTA'] = array('maxCampos'=>$maxCartaBajoProtesta,'camposLlenos'=>$camposCartaBajoProtesta,"porcentaje"=>$porcentaje);
    
    //Mandato
    $camposMandato=0; $maxMandato=2;
    if($solicitud['monto_credito']) $camposMandato++;
    if($solicitud['monto_pago']) $camposMandato++;
    
    $porcentaje=round((($camposMandato/$maxMandato)*100),2);
    $avance['MANDATO'] = array('maxCampos'=>$maxMandato,'camposLlenos'=>$camposMandato,"porcentaje"=>$porcentaje);
    
    //$camposLlenos=0; $maxCampos = 11;
    //if($solicitud['cliente']['nombre']) $camposLlenos++;
    
    //$porcentaje=round((($camposBuro/$maxBuro)*100),2);
    //$avance['DOMICILIACION'] = array('maxCampos'=>$maxCampos,'camposLlenos'=>$camposLlenos,"porcentaje"=>$porcentaje);

    $camposLlenos=1; $maxCampos = 1;
    
    $porcentaje=round((($camposBuro/$maxBuro)*100),2);
    $avance['TABLA_AMORTIZACION'] = array('maxCampos'=>$maxCampos,'camposLlenos'=>$camposLlenos,"porcentaje"=>$porcentaje);

    $avance['AutorizacionFirma'] = array('maxCampos'=>$maxCampos,'camposLlenos'=>$camposLlenos,"porcentaje"=>$porcentaje);
    
    return $avance;
}
function traduce($val){
    switch($val){
        case "personal_identity": return "Identidad";break;
        case "criminal_record": return "Penal y Criminal";break;
        case "legal_background": return "Legal";break;
        case "international_background": return "Antecedentes internacionales";break;
        case "professional_background": return "Historial profesional";break;
        case "alert_in_media": return "Medios";break;
        case "taxes_and_finances": return "Impuestos y Finanzas";break;
        case "MX": return "México";break;
        case "male": return "Masculino";break;
        case "female": return "Femenino";break;
        case "affiliations_and_insurances": return "Afiliaciones y Seguros";break;
        case "business_background": return "Estatus Empresarial";break;
        case "vehicle_permits": return "Permisos Vehiculares";break;
        case "traffic_fines": return "Multas de tránsito";break;
        case "politically_exposed_person": return "Personas políticamente expuestas";break;
        case "vehicle_information": return "Información vehicular";break;
        case "driving_licenses": return "Licencias de Conducir";break;
        case "document_validation": return "Validación Documental";break;
        case "name": return "Nombre";break;
        case "last_name": return "Apellido Paterno";break;
        case "mothers_last_name": return "Apellido Materno";break;
        case "birth_date": return "Fecha Nacimiento";break;
        case "gender": return "Genero";break;
        case "elector_key": return "Clave de Elector";break;
        case "expiration_date": return "Fecha de Expiración";break;
        case "street": return "Calle";break;
        case "neighborhood": return "Colonia";break;
        case "zip_code": return "Código Postal";break;
        case "city": return "Ciudad";break;
        case "province": return "Estado";break;
        case "emission_number": return "Número de Emisión";break;
        case "type": return "Tipo";break;
        case "ine_type": return "Tipo INE";break;
        case "state_id": return "Id Estado";break;
        case "city_id": return "Id Ciudad";break;
        case "section_id": return "Sección";break;
        case "locality_id": return "Id Localidad";break;
        case "control": return "Control";break;
        case "register_year": return "Año de Registro";break;
        case "emission_year": return "Año de Emisión";break;
        case "last_names": return "Apellidos";break;
        case "ocr_number": return "Numero OCR";break;
        case "lines": return "Linea";break;
        case "cic": return "CIC";break;
        case "cic_digit_check": return "Digito Verificador CIC";break;
        case "is_cic_digit_check_consistent": return "Concistencia del digito verificador CIC";break;
        case "date": return "Fecha";break;
        case "section_and_consecutive": return "Sección y Consecutivo";break;
        case "date_check_digit": return "Digito Verificador de Fecha";break;
        case "expiration_date_digit": return "Digito de Fecha de Expiración";break;
        case "nationality": return "Nacionalidad";break;
        case "model_type": return "Modelo Tipo";break;
        case "model_id": return "ID Modelo";break;
        case "validation_id": return "ID Validación";break;
        case "status": return "Estatus";break;
        case "content": return "Contenido";break;
        case "result": return "Resultado";break;
        case "first_last_name": return "Apellido Paterno";break;
        case "second_last_name": return "Apellido Materno";break;
        case "provatory_document": return "Documento Probatorio";break;
        case "birth_federal_entity": return "Entidad Federativa de Nacimiento";break;
        case "success": return "Exitoso";break;
        case "retries": return "Reintentos";break;
        case "executed_at": return "Ejecutado a las";break;
        case "created_at": return "Creado el";break;
        case "updated_at": return "Actualizado el";break;
        case "validation": return "Validación";break;
        case "valid": return "Válido";break;
        case "expired": return "Vencido";break;
        case "messages": return "Mensajes";break;
        case "court_order": return "Orden Judicial";break;
        case "emission_at": return "Emitido el";break;
        case "registered_at": return "Registrado el";break;
        case "incorrect_data": return "Datos Incorrectos";break;
        case "local_district": return "Distrito local";break;
        case "federal_district": return "Distrito federal";break;
        case "ocr_front": return "OCR Frontal";break;
        case "ocr_back": return "OCR Trasero";break;
       

        default:return $val;
    }
}

function encriptarUrl($url) {
     // Encriptar la URL en Base64 y codificar caracteres especiales
     $url_encriptada = str_replace(['+', '/', '='], ['-', '_', ','], base64_encode($url));

     return $url_encriptada;
}

function desencriptarUrl($url_encriptada) {
   // Decodificar caracteres especiales y desencriptar la URL
   $url_original = base64_decode(str_replace(['-', '_', ','], ['+', '/', '='], $url_encriptada));

   return $url_original;
}

function validarUrl($url) {
    // Validar la URL
    $url_valida = filter_var($url, FILTER_VALIDATE_URL);

    return $url_valida !== false;
}


function cifrar_AES($mensaje) {
    $clave = LLAVE_SECRETA_URL;
    // Cifrar los datos con AES
    $cifrado = openssl_encrypt($mensaje, 'AES-256-CBC', $clave, 0, $clave);
    // Codificar el texto cifrado en base64 para enviarlo en la URL
    $cifrado_base64 = base64_encode($cifrado);
    return $cifrado_base64;
}

function descifrar_AES($cifrado_base64) {
    $clave = LLAVE_SECRETA_URL;
    // Decodificar la cadena base64
    $cifrado = base64_decode($cifrado_base64);
    // Descifrar los datos con AES
    $mensaje = openssl_decrypt($cifrado, 'AES-256-CBC', $clave, 0, $clave);
    return $mensaje;
}

// Función recursiva para buscar una variable específica en un JSON
function buscar_variable_en_json($json, $variable) {
    // Decodificar el JSON en un array asociativo de PHP
    $array = json_decode($json, true);

    // Buscar la variable en el array
    $value = null;
    foreach ($array as $key => $val) {
        if ($key === $variable) {
            $value = $val;
            break;
        } elseif (is_array($val)) {
            // Si el valor es un array, llamar recursivamente a la función para buscar en ese array
            $value = buscar_variable_en_json(json_encode($val), $variable);
            if ($value !== null) {
                break;
            }
        }
    }

    return $value;
}

function create_image_from_url($path,$url){
    // Obtenemos los datos de la imagen desde la URL
    $image_data = file_get_contents($url);
    // Guardamos los datos de la imagen en un archivo en el servidor
    file_put_contents($path, $image_data);
}

    function crearArchivo($url, $directory, $expectedMimeType = null, $customFilename = null) {
        // Obtenemos los datos del archivo desde la URL
        $file_data = file_get_contents($url);
        
        // Verificamos que la URL sea válida y los datos se hayan obtenido correctamente
        if ($file_data === FALSE) {
            throw new Exception("No se pudo obtener el archivo desde la URL proporcionada.");
        }
    
        // Crear el directorio si no existe
        if (!is_dir($directory)) {
            if (!mkdir($directory, 0777, true)) {
                throw new Exception("No se pudo crear el directorio especificado: $directory");
            }
        }
    
        // Extraer el nombre del archivo de la URL sin parámetros de consulta si no se proporciona un nombre personalizado
        $urlPath = parse_url($url, PHP_URL_PATH);
        $basename = basename($urlPath);
        $extension = pathinfo($basename, PATHINFO_EXTENSION);
    
        if ($customFilename) {
            // Usar el nombre personalizado proporcionado
            //$filename = date('Ymd_His') . "_" . $customFilename;
            $filename = $customFilename;
        } else {
            // Usar el nombre derivado de la URL
            //$filename = date('Ymd_His') . "_" . pathinfo($basename, PATHINFO_FILENAME);
            $filename = date('Ymd_His') . "_" . pathinfo($basename, PATHINFO_FILENAME);
        }
    
        $fullFilename = $filename . '.' . $extension;
        $path = rtrim($directory, '\\/') . DIRECTORY_SEPARATOR . $fullFilename;
    
        // Guardamos los datos del archivo en el servidor
        if (file_put_contents($path, $file_data) === FALSE) {
            throw new Exception("No se pudo guardar el archivo en el path proporcionado: $path");
        }
    
        // Validar el MIME type del archivo descargado si se proporciona $expectedMimeType
        $detectedMimeType = null;
        if ($expectedMimeType !== null) {
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $detectedMimeType = $finfo->file($path);
    
            if ($detectedMimeType !== $expectedMimeType) {
                // Si el MIME type no coincide, eliminamos el archivo y lanzamos una excepción
                unlink($path); // Eliminar el archivo si no es del tipo esperado
                throw new Exception("El MIME type detectado ($detectedMimeType) no coincide con el MIME type esperado ($expectedMimeType).");
            }
        }
    
        // Devolver información sobre el archivo guardado
        return [
            'path' => $path,
            'filename' => $fullFilename,
            'extension' => $extension,
            'mime_type' => $detectedMimeType ? $detectedMimeType : 'No se validó el MIME type'
        ];
    }


    function formatWithHyphens($input) {
        // Convert the input to a string in case it's a number
        $inputString = (string) $input;
    
        // Split the string into an array of individual characters
        $characters = str_split($inputString);
    
        // Join the characters with hyphens
        $formattedString = implode('-', $characters);
    
        return $formattedString;
    }

    // Función para verificar si una cadena es JSON válido
    function is_json($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    // Función principal para verificar el tipo de variable
    function check_type($variable) {
        // Verificar si es un array
        if (is_array($variable)) {
            return "array";
        }
        // Verificar si es un JSON válido
        elseif (is_string($variable) && is_json($variable)) {
            return "json";
        }
        // Si no es ni array ni JSON, es un dato escalar
        else {
            return "dato";
        }
    }

    
        function print_array_html($array, $indent = 0) {
            // Espacios para indentación
            $spaces = str_repeat(' ', $indent);
        
            foreach ($array as $key => $value) {
                echo $spaces . '<tr>';
                echo '<td style="vertical-align: middle; text-orientation: mixed;"><b>' . strtoupper(traduce(htmlspecialchars($key))) . "</b></td>";
                echo '<td>';
        
                if (is_array($value)) {
                    // Llamada recursiva para arrays anidados
                    echo '<table style="border-collapse: collapse; margin: 0; padding: 0;">';
                    print_array_html($value, $indent + 4);
                    echo '</table>';
                } else {
                    // Manejo de valores escalares
                    if (is_numeric($value)) {
                        // Convertir el valor a entero
                        $intValue = (int)$value;
        
                        // Verificar si el valor es un entero
                        if ((string)$intValue === (string)$value) {
                            // Asignar ícono según el valor
                            if ($intValue == 1 || $intValue == 2) {
                                echo '<i class="text-success fa fa-check-circle" style="font-size:115%"></i>';
                            } else {
                                echo '<i class="text-danger fa-solid fa-circle-xmark" style="font-size:115%"></i>';
                            }
                        } else {
                            // Si no es un entero, imprimir el valor como está
                            if($value == "1"){
                                echo "es un  unos";
                            }else{
                                echo nl2br(htmlspecialchars($value));
                            }
                        }
                    } else {
                        // Si no es numérico, imprimir el valor como está
                        echo nl2br(htmlspecialchars($value));
                    }
                }
        
                echo '</td>';
                echo '</tr>';
            }
        }
    
        function firmaElectronicaREM($id_Solicitud){
            $ArrayPeriodoEtiqueta = array( 
                'mensual'=>array('singular'=>'Mes', 'plural'=>'Meses','pagos'=>'mensuales'), 
                'quincenal'=>array('singular'=>'Quincena', 'plural'=>'Quincenas','pagos'=>'quincenales'),
                'catorcenal'=>array('singular'=>'Catorcena', 'plural'=>'Catorcenas','pagos'=>'catorcenales'),
                'decenal'=>array('singular'=>'Decena', 'plural'=>'Decenas','pagos'=>'decenales'),
                'semanal'=>array('singular'=>'Semana', 'plural'=>'Semanas'),'pagos'=>'semanales');

            $CI =& get_instance();
            $CI->load->model('solicitud_model');
            $CI->load->model('catalogo_model');

            $solicitud =  $CI->solicitud_model->get_data($id_Solicitud);
            $cliente =  $solicitud["cliente"];
           
            //Mensaje de lectura para la prueba de VIDA
            $nombre_cliente = $cliente["nombre"]." ". $cliente["apellido_paterno"]." ". $cliente["apellido_materno"];

            if(empty($solicitud["monto_autorizado"])){
                $monto_solicitado = $solicitud["monto_autorizado"];
            }else{
                $monto_solicitado = $solicitud["monto_credito"];
            }
            $lectura_cliente =  "Yo, $nombre_cliente, confirmo haber solicitado un crédito a SupplyCredit por un monto de ".number_format($monto_solicitado,2,".",",").". ";
            $lectura_cliente .= " Acepto las condiciones autorizadas del préstamo, el cual será pagado en ".$solicitud["total_pagos"]." pagos ".$ArrayPeriodoEtiqueta[$solicitud["periodicidad"]]["pagos"]." de ".number_format($solicitud["monto_pago"],2,".",",")." cada uno. ";
            $lectura_cliente .= "Declaro que esta aceptación se realiza de forma libre y voluntaria, y confirmo mi identidad y consentimiento en este momento";
            
            $pathPdf =  generarDocumentosExpediente($id_Solicitud,'F',"tmpZapZing/"); //Generar Documentod PDF del contrato
            $confREM = $CI->catalogo_model->get_RemConf();

            if($confREM["activo"] == 1){// Verifica si esta activado REM en la condiguracion
                $rem_object =  new remtoolsapi_helper($confREM["apikey"],$confREM["url"]); //Crear el objeto de REM
                
                /*Firma Electronica */
                $ApiCreateDocument = $rem_object->create_from_file($id_Solicitud,$pathPdf); //Carga el DOCUMENTO en SIgn de REM
                $idDocumente = buscar_variable_en_json($ApiCreateDocument,"id"); //Busca el ID del DOCUMENTO generado por SIng de REM
                
                //Firmas
                $ArrayFirmas = generarArrayFirma($id_Solicitud,"firmas_rem");
                $meta_signs =  $rem_object->createmeta_signs($ArrayFirmas);
                //pre($meta_signs,"meta_signs");die;

                /*Agregrar Firmante */
                $ApiAddSign = $rem_object->add_sign_fields($idDocumente,$id_Solicitud,$meta_signs); //AL documentos de SING(ID), le agrega lso datos del FIRMANtW (pendiente agreggar las firmas autogrfas)
                $tokenSign = buscar_variable_en_json($ApiAddSign,"token");//Busca el TOKEN del DOCUMENTO generado por SIng de REM


                /* Agreggar imagen base 64 al metadata*/
                $id_front_file_match = $rem_object->create_temp_file($id_Solicitud, get_Documentos($id_Solicitud),true);
                
                
                //$id_front_file_match=null;
                /*Crear El workflow  */
                //$step = array("enroll_full","document_sign");
                //$step = array("document_sign");
                //$step = array("document_preview","enroll_full","biometric_sign","document_sign");
                //$step = array("enroll_selfie","biometric_sign","document_sign");
                //$step = array("enroll_basic","biometric_sign","document_sign");
                //$step = array("biometric_sign","document_sign");
                //$step = array("biometric_sign","document_sign"); 
                $step = array("face_enrollment_3d","biometric_sign","document_sign");  
                $urlredirect = site_url("/app/ver/".cifrar_AES($id_Solicitud));
    
                $ApiCreateWorkflow = $rem_object->setWorkFlow($step,$id_Solicitud, $cliente['id'], $tokenSign,0,1,0,$urlredirect,$lectura_cliente,$id_front_file_match);
                
                $return =  $ApiCreateWorkflow;
                $data["id"] = $id_Solicitud;
                $data["url_Rem"] = $return;
                $CI->solicitud_model->update($data); 

                $idCifrado = cifrar_AES($id_Solicitud);
                $url = getURLExterno().$idCifrado;
                
                enviarsmsFirma($id_Solicitud,$url);
                //ENVIAR CORREO nOTIFICACION
                enviarCorreo_firmaREM($id_Solicitud,$cliente["email"]);
                return  $url;
            }
        }   

        function getURLExterno(){
            return "https://credinu.mx/t/?k=";
        }


        function enviarsmsFirma($id_Solicitud,$url = ""){
            $CI =& get_instance();
            $CI->load->model('solicitud_model');

            $solicitud = $CI->solicitud_model->get_data($id_Solicitud);
            $cliente =  $solicitud["cliente"];
            
            //$url = "https://credinu.mx/s/?k=".cifrar_AES($id_Solicitud);
            $preMensaje = "Para firmar tu contrato accede a ";
            enviarSms($cliente["telefono_movil"], trim($preMensaje.$url));
        }
        
        
        function enviarSms($destino,$mensaje=""){
            $CI =& get_instance();
            $CI->load->library('twilio');
            $CI->load->model('logsms_model');
        
            $sms_sender = '+19294703305';
            $sms_reciever = '+52'.$destino;
            $sms_message = $mensaje;
            $from = '+'.$sms_sender; //trial account twilio number
            $to = '+'.$sms_reciever; //sms recipient number
            $response = $CI->twilio->sms($from, $to,$sms_message);
            $data["telefono"]= $sms_reciever;
            $data["mensaje"]=  $sms_message; 
            $data["response"]= json_encode($response); 
            $CI->logsms_model->insert($data);
        }

        //Enviar la notificacl al cliente con REM
        function enviarCorreo_firmaREM($solicitud_id,$correo ="") {
            $CI =& get_instance();
            $CI->load->model('solicitud_model');
            $CI->load->model('catalogo_model');
    
            
            $plantillapath = "correos/NotificacionSolicitudFirmaContrato_REM"; // replace with the actual path to the email template file
            $conf = json_decode($CI->catalogo_model->get_data_list(2)[0]["descripcion"], true);  
            $config = array(
                'protocol' => $conf['protocol'],
                'smtp_host' => $conf['smtp_host'],
                'smtp_port' => $conf['smtp_port'],
                'smtp_user' => $conf['smtp_user'],
                'smtp_pass' => $conf['smtp_pass'],
                'mailtype' => $conf['mailtype'],
                'charset' => $conf['charset'],
                'newline' => "\r\n"
            );
            
            $subject = "Notificación de Solicitud Crédito No.".$solicitud_id;
            $CI->load->library('email'); 
            $CI->email->initialize($config);
            $data = $CI->solicitud_model->get_data($solicitud_id);
            $to = $correo;
            $data["solicitud"]["estatus"] = $estatus;
            $data["solicitud"]["motivo_rechazo"] = $motivo_rechazo;
            $data["solicitud"]["cliente"] = $data["cliente"];
            $data["solicitud"]["id"] = $solicitud_id;
            //pre($data);
                
            $plantilla = $CI->load->view($plantillapath, $data, true);
            //echo $plantilla;die;
            $CI->email->from('no-replay@supplycredit.com', 'CrediNu - Solicitud No.'.$solicitud_id);
            $CI->email->to($to); 
            $CI->email->cc('soporte@supplycredit.com');
            date_default_timezone_set('America/Mexico_City'); 
            $CI->email->subject($subject); 
            $CI->email->message($plantilla);
            
            if ($CI->email->send()) {
                return "Envio Correcto"; // fixed typo
            } else {
                return $CI->email->print_debugger();
            }
        }


        function get_Documentos($solicitud_id){
            $CI =& get_instance();
            $CI->load->model('Documento_model');
            $documentos = $CI->documento_model->getfiles(2,$solicitud_id);
            
            $path_ine = "";
            foreach($documentos as $doc){
                if($doc["posicion"] == 21){//21 => identificacion ofician front
                    $path_ine = $doc["path"];
                }
            }
    
            return REALPATH_SUPPLYNET_DOCTOS.$path_ine;
        }

        function convert_nulls_to_empty_strings($array) {
            foreach ($array as $key => $value) {
                if (is_array($value)) {
                    $array[$key] = convert_nulls_to_empty_strings($value);
                } elseif (is_null($value)) {
                    $array[$key] = '';
                }
            }
            return $array;
        }


        function crearValidacionSTP($id_Solicitud,$reenvio = ""){
            $CI =& get_instance();
            $CI->load->model('solicitud_model');
            $CI->load->model('catalogo_model');
            $CI->load->library("consultaSTP");
            $CI->load->model("CuentasClabe_model");
        
            $solicitud = $CI->solicitud_model->get_data($id_Solicitud);
            $cliente = $solicitud["cliente"];
        
            $STP_conf = $CI->catalogo_model->get_StpConf();
            $urlServer = "https://credinu.mx/stp/";
            $consultaSTP_obj = new consultaSTP($STP_conf["usuario"], $STP_conf["password"], $intetos, $urlServer); // Asegúrate de definir $intetos adecuadamente
        
            $bancos = $CI->catalogo_model->get_banco();
            $nombre_banco = $bancos[$solicitud["banco_id"]]["nombre"];
            $clave_stp_banco = $consultaSTP_obj->getClaveBanco($nombre_banco);
        
            $tipoTransaccion = "V";
            $monto = "0.01"; 
            $referenciaNumerica = (int)date("dmy");
            $conceptoPago = "Validacion cuenta Clabe";
        
            $institucionContraparte = $clave_stp_banco;
            $cuentaBeneficiario = $solicitud["clabe"];
            $tipoCuentaBeneficiario = "40";
            $claveRastreo = $tipoTransaccion.$STP_conf["prefijo_claveRastreo"].$solicitud["clabe"].date('dmy').$reenvio;
            $nombreCompletoCliente = trim($cliente["nombre"])." ".trim($cliente["apellido_paterno"])." ".trim($cliente["apellido_materno"]);
            $nombreBeneficiario = preg_replace('/\s+/', ' ', $nombreCompletoCliente);
            $rfcCurpBeneficiario = $cliente["rfc"];
            $folioOrigen = $STP_conf["prefijo_orden"].str_pad($id_Solicitud, 9 - strlen($STP_conf["prefijo_orden"]), "0", STR_PAD_LEFT).$reenvio;
        
            if (!$CI->CuentasClabe_model->existeClaveRastreo($claveRastreo)) {
                $respuesta = $consultaSTP_obj->ordenPago($monto, $referenciaNumerica, $conceptoPago, $institucionContraparte, $cuentaBeneficiario, $tipoCuentaBeneficiario, $claveRastreo, $nombreBeneficiario, $rfcCurpBeneficiario, $folioOrigen);
        
                $data = [
                    "id_solicitud" => $id_Solicitud,
                    "clabe" => $cuentaBeneficiario,
                    "folioOrigen" => $folioOrigen,
                    "id_stp" => $respuesta["resultado"]["id"],
                    "claveRastreo" => $claveRastreo,
                    "json_validacion" => json_encode($respuesta["resultado"])
                ];
                $CI->CuentasClabe_model->insert($data);
            } else {
                $mensajeError = "La clave de rastreo ya existe";
                // Manejar el error adecuadamente
            }
        }
