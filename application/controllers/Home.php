<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		date_default_timezone_set('America/La_Paz');
		$today = date('Y-m-d 00:00:00');   
		$d = new DateTime('first day of this month');
    	$mes_actual = $d->format('Y-m-d 00:00:00');
    	$mes_actual_primer_dia = $d->format('Y-m-d 00:00:00');
    	$d = new DateTime('last day of this month');
    	$mes_actual_ultimo_dia = $d->format('Y-m-d 00:00:00');
    	$d = new DateTime('first day of last month');
    	$mes_anterior_primer_dia = $d->format('Y-m-d 00:00:00');
    	$d = new DateTime('last day of last month');
    	$mes_anterior_ultimo_dia = $d->format('Y-m-d 00:00:00');
    	$ano_actual = date('Y-m-d 00:00:00',strtotime(date('Y-01-01')));
    	$ano_actual_primer_dia = date('Y-m-d 00:00:00',strtotime(date('Y-01-01')));
    	$ano_actual_ultimo_dia = date('Y-m-d 00:00:00',strtotime(date('Y-12-31')));
    	$ano_anterior_primer_dia = strtotime('-1 year',strtotime($ano_actual_primer_dia));
		$ano_anterior_primer_dia = date('Y-m-d H:i:s' ,$ano_anterior_primer_dia);
		$ano_anterior_ultimo_dia = strtotime('-1 year',strtotime($ano_actual_ultimo_dia));
		$ano_anterior_ultimo_dia = date('Y-m-d H:i:s' ,$ano_anterior_ultimo_dia);
		$data=$this->Database->cargar_preferencias();
		switch ($data[0]['actividad']){
			case '1': //dia actual
				$today = '2016-09-15 00:00:00'; //datos de prueba;
				$actividad = $this->_actividadDelDia($today);
				break;
			case '2': //dia anterior
				$today = '2016-09-15 00:00:00'; //datos de prueba;
				$yesterday = $this->_diaAnterior($today);
				$actividad = $this->_actividadDelDia($yesterday);
				break;
			case '3': //dia
				$dia = '2016-09-15 00:00:00'; //datos de prueba;
				$actividad = $this->_actividadDelDia($dia);
				break;
			case '4': //dia comparativo
				$dia1 = '2016-09-15 00:00:00'; //datos de prueba;
				$dia2 = '2016-09-14 00:00:00'; //datos de prueba;
				$actividad = $this->_actividadComparacionDias($dia1,$dia2);
				break;
			case '5': //Mes Actual
				$actividad = $this->_actividadDelMes($mes_actual);
				break;
			case '6': //Mes
				$mes = '2016-09-01 00:00:00'; //datos de prueba
				$actividad = $this->_actividadDelMes($mes);
				break;
			case '7': //Mes comparativo
				$mes1 = '2016-09-01 00:00:00';
				$mes2 = '2016-08-01 00:00:00';
				$actividad = $this->_actividadComparacionMeses($mes1,$mes2);
				break;
			case '8': //Ano Actual
				$actividad = $this->_actividadDelAno($ano_actual);
				break;
			case '9': //Ano
				$ano = '2016-01-01 00:00:00'; //datos de prueba
				$actividad = $this->_actividadDelAno($ano);
				break;
			case '10': //Ano Comparativo
				$ano1 = '2016-01-01 00:00:00';
				$ano2 = '2016-01-01 00:00:00';
				$actividad = $this->_actividadComparacionAnos($ano1,$ano2);
				break;
		}
		switch ($data[0]['categoria']){
			case '1': //dia actual
				$today = '2016-09-02 00:00:00'; //datos de prueba;
				$categorias = $this->_categoriasDelDia($today);
				break;
			case '2': //dia anterior
				$today = '2016-09-04 00:00:00'; //datos de prueba;
				$yesterday = $this->_diaAnterior($today);
				$categorias = $this->_categoriasDelDia($yesterday);
				break;
			case '3': //dia
				$dia = '2016-09-03 00:00:00'; //datos de prueba;
				$categorias = $this->_categoriasDelDia($dia);
				break;
			case '4': //mes actual				
				$categorias = $this->_categoriasDelMes($mes_actual);
				break;
			case '5': //mes
				$mes = '2016-09-01 00:00:00'; //datos de prueba
				$categorias = $this->_categoriasDelMes($mes);
				break;
			case '6': //ano actual
				$categorias = $this->_categoriasDelAno($ano_actual);
				break;
			case '7': //ano
				$ano = '2015-01-01 00:00:00'; //datos de prueba
				$categorias = $this->_categoriasDelAno($ano);
				break;
			case '8': //periodo
				$fecha1 = '2016-09-02 00:00:00';
				$fecha2 = '2016-09-03 00:00:00';
				$categorias = $this->_categoriasDelPeriodo($fecha1,$fecha2);
				break;
		}
		switch ($data[0]['indicadores']){
			case '1': //dia actual
				$today = '2016-09-15 00:00:00'; //datos de prueba;
				$indicadores = $this->_indicadoresDelDia($today,$today);
				break;
			case '2': //dia anterior
				$today = '2016-09-15 00:00:00'; //datos de prueba;
				$yesterday = $this->_diaAnterior($today);
				$indicadores = $this->_indicadoresDelDia($yesterday,$yesterday);
				break;
			case '3': //dia
				$dia = '2016-09-15 00:00:00'; //datos de prueba;
				$indicadores = $this->_indicadoresDelDia($dia,$dia);
				break;
			case '4': //mes actual
				$indicadores = $this->_indicadoresDelMes($mes_actual);
				break;
			case '5': //mes
				$mes = '2016-09-01 00:00:00'; //datos de prueba
				$indicadores = $this->_indicadoresDelMes($mes);
				break;
			case '6': //ano actual
				$indicadores = $this->_indicadoresDelAno($ano_actual);
				break; 
			case '7': // ano
				$ano = '2016-01-01 00:00:00'; //datos de prueba
				$indicadores = $this->_indicadoresDelAno($ano);
				break; 
			case '8': // Periodo
				$fecha1 = '2016-09-02 00:00:00';
				$fecha2 = '2016-09-21 00:00:00';
				$indicadores = $this->_indicadoresDelPeriodo($fecha1,$fecha2);
				break; 
		}
		switch ($data[0]['crecimiento']){
			case '11': //instancias dia actual con respecto al dia anterior
				$today = '2016-09-03 00:00:00'; //datos de prueba;
				$yesterday = '2016-09-02 00:00:00'; //datos de prueba;
				$crecimiento = $this->_crecimientoDelDia(1,$yesterday,$today); //primero el mes base y luego el que se quiere calcular
				break;
			case '12': //instancias mes actual con respecto al mes anterior				
				$crecimiento = $this->_crecimientoDelMes(1,$mes_anterior_primer_dia,$mes_anterior_ultimo_dia,$mes_actual_primer_dia,$mes_actual_ultimo_dia);
				break;
			case '13': //instancias ano actual con respecto al ano anterior
				$crecimiento = $this->_crecimientoDelAno(1,$ano_anterior_primer_dia,$ano_anterior_ultimo_dia,$ano_actual_primer_dia,$ano_actual_ultimo_dia);
				break;
			case '14': //instancias 2 periodos de tiempo
				$fecha1 = '2016-08-12 00:00:00';
				$fecha2 = '2016-08-15 00:00:00';
				$fecha3 = '2016-09-12 00:00:00';
				$fecha4 = '2016-09-15 00:00:00';
				$crecimiento = $this->_crecimientoDelPeriodo(1,$fecha1,$fecha2,$fecha3,$fecha4);
				break;
			case '21': //instancias dia actual con respecto al dia anterior
				$today = '2016-09-15 00:00:00'; //datos de prueba;
				$yesterday = '2016-09-16 00:00:00'; //datos de prueba;
				$crecimiento = $this->_crecimientoDelDia(2,$yesterday,$today); //primero el mes base y luego el que se quiere calcular
				break;
			case '22': //instancias mes actual con respecto al mes anterior				
				$crecimiento = $this->_crecimientoDelMes(2,$mes_anterior_primer_dia,$mes_anterior_ultimo_dia,$mes_actual_primer_dia,$mes_actual_ultimo_dia);
				break;
			case '23': //instancias ano actual con respecto al ano anterior
				$crecimiento = $this->_crecimientoDelAno(2,$ano_anterior_primer_dia,$ano_anterior_ultimo_dia,$ano_actual_primer_dia,$ano_actual_ultimo_dia);
				break;
			case '24': //instancias 2 periodos de tiempo
				$fecha1 = '2016-08-12 00:00:00';
				$fecha2 = '2016-08-15 00:00:00';
				$fecha3 = '2016-09-12 00:00:00';
				$fecha4 = '2016-09-15 00:00:00';
				$crecimiento = $this->_crecimientoDelPeriodo(2,$fecha1,$fecha2,$fecha3,$fecha4);
				break;
		}

		$this->load->view('header','', FALSE);	
		$this->load->view('home','', FALSE);	
		$this->load->view('footerbegin','', FALSE);	
		$this->load->view('actividad',$actividad, FALSE);	
		$this->load->view('categoria',$categorias, FALSE);	
		$this->load->view('indicadores',$indicadores, FALSE);	
		$this->load->view('crecimiento',$crecimiento, FALSE);	
		$this->load->view('tiempo_respuesta','', FALSE);	
		$this->load->view('footerend','', FALSE);	
	}

	//calcula la actividad realizada en el dia especifico
	private function _actividadDelDia($dia){
		$actividad = $this->_actividadDia($dia);		
		$arr = explode(",", $actividad);
		$cant = $arr[0];
		unset($arr[0]);
		$actividad = rtrim(implode(',', $arr), ',');
		$dia = explode(" ",$dia);
		$dia = date_create($dia[0]);
		$dia = date_format($dia,"d-m-Y");
		$titulo = "Actividad del Día";
		$subtitulo = "Actividades del día ".$dia;
		$intervalo = 1 * 3600 * 1000;
		$fecha_inicio = preg_split("/[\s:-]+/",$dia);
		$fecha_inicio[1]=$fecha_inicio[1]-1;
		$fecha_inicio = rtrim(implode(',', $fecha_inicio), ','); //convierte arreglo a string separado por comas		
		$serie = $dia." (".$cant.")";
		$actividad = array(
			'titulo' 					=> $titulo,
			'subtitulo' 				=> $subtitulo,
			'datos_principal_nombre' 	=> $serie,
			'datos_principal' 			=> $actividad,
			'datos_secundario_nombre' 	=> '',
			'datos_secundario' 			=> null,
			'type' 						=> null,
			'intervalo' 				=> $intervalo,
			'fecha_inicio' 				=> $fecha_inicio );
		return $actividad;
	}

	//comparativa de dias en el grafico de actividades
	private function _actividadComparacionDias($dia1,$dia2){
		$actividadDia1 = $this->_actividadDia($dia1);
		$actividadDia2 = $this->_actividadDia($dia2);
		$arr = explode(",", $actividadDia1);
		$cant1 = $arr[0];
		unset($arr[0]);
		$actividadDia1 = rtrim(implode(',', $arr), ',');
		$arr = explode(",", $actividadDia2);
		$cant2 = $arr[0];
		unset($arr[0]);
		$actividadDia2 = rtrim(implode(',', $arr), ',');
		$dia1 = explode(" ",$dia1);
		$dia2 = explode(" ",$dia2);
		$dia1 = date_create($dia1[0]);
		$dia2 = date_create($dia2[0]);
		$dia1 = date_format($dia1,"d-m-Y");
		$dia2 = date_format($dia2,"d-m-Y");
		$titulo = "Comparativa de Actividades";
		$subtitulo = "Actividades del día ".$dia1." y del día ".$dia2;
		$intervalo = 1 * 3600 * 1000;
		$serie1 = $dia1." (".$cant1.")";
		$serie2 = $dia2." (".$cant2.")";
		$actividad = array(
			'titulo' 					=> $titulo,
			'subtitulo' 				=> $subtitulo,
			'datos_principal_nombre' 	=> $serie1,
			'datos_principal' 			=> $actividadDia1,
			'datos_secundario_nombre' 	=> $serie2,
			'datos_secundario' 			=> $actividadDia2,
			'type'						=> 'horas',
			'intervalo' 					=> $intervalo,
			'fecha_inicio' 				=> null );
		return $actividad;
	}

	//calcula la actividad en el dia dado
	private function _actividadDia($dia){		
		$data = $this->Database->actividadDia($dia);
		$datos = rtrim(implode(',', $data), ',');
		return $datos;
	}

	//calcula el dia anterior al pasado
	private function _diaAnterior($dia){
		strtotime($dia);
		$fecha_nueva = strtotime('-24 hour',strtotime($dia));
		$fecha_nueva = date('Y-m-d H:i:s' ,$fecha_nueva);
		return $fecha_nueva;
	}

	//calcula la actividad realizada en el mes especifico
	private function _actividadDelMes($mes){
		$actividad = $this->_actividadMes($mes);
		$nombreMes = $this->_nombreMes($mes);
		$arr = explode(",", $actividad);
		$cant = $arr[0];
		unset($arr[0]);
		$actividad = rtrim(implode(',', $arr), ',');
		$titulo = "Comparativa de Actividades";
		$subtitulo = "Actividades del mes: ".$nombreMes;
		$intervalo = 24 * 3600 * 1000; //24 hrs de intervalo
		$fecha_inicio = preg_split("/[\s:-]+/",$mes);
		$fecha_inicio[1]=$fecha_inicio[1]-1;
		$fecha_inicio = rtrim(implode(',', $fecha_inicio), ','); //convierte arreglo a string separado por comas		
		$serie = $nombreMes." (".$cant.")";
		$actividad = array(
			'titulo' 					=> $titulo,
			'subtitulo' 				=> $subtitulo,
			'datos_principal_nombre' 	=> $serie,
			'datos_principal' 			=> $actividad,
			'datos_secundario_nombre' 	=> '',
			'datos_secundario' 			=> null,
			'type'						=> null,
			'intervalo' 				=> $intervalo,
			'fecha_inicio' 				=> $fecha_inicio );
		return $actividad;

	}

	//compara la actividad realizada en los meses dados
	private function _actividadComparacionMeses($mes1,$mes2){
		$actividadMes1 = $this->_actividadMes($mes1);
		$actividadMes2 = $this->_actividadMes($mes2);
		$arr = explode(",", $actividadMes1);
		$cant1 = $arr[0];
		unset($arr[0]);
		$actividadMes1 = rtrim(implode(',', $arr), ',');
		$arr = explode(",", $actividadMes2);
		$cant2 = $arr[0];
		unset($arr[0]);
		$actividadMes2 = rtrim(implode(',', $arr), ',');
		$nombreMes1 = $this->_nombreMes($mes1);
		$nombreMes2 = $this->_nombreMes($mes2);
		$titulo = "Comparativa de Actividades";
		$subtitulo = "Actividades del mes: ".$nombreMes1." y del mes: ".$nombreMes2;
		$serie1 = $nombreMes1." (".$cant1.")";
		$serie2 = $nombreMes2." (".$cant2.")";
		$actividad = array(
			'titulo' 					=> $titulo,
			'subtitulo' 				=> $subtitulo,
			'datos_principal_nombre' 	=> $serie1,
			'datos_principal' 			=> $actividadMes1,
			'datos_secundario_nombre' 	=> $serie2,
			'datos_secundario' 			=> $actividadMes2,
			'type'						=> 'dias',
			'intervalo' 				=> '',
			'fecha_inicio' 				=> null );
		return $actividad;

	}

	private function _actividadMes($mes){
		$data = $this->Database->actividadMes($mes);
		$datos = rtrim(implode(',', $data), ',');
		return $datos;
	}

	private function _actividadDelAno($ano){
		$nombreAno = explode("-",$ano);
		$nombreAno = $nombreAno[0];		
		$actividad = $this->_actividadAno($ano);		
		$arr = explode(",", $actividad);
		$cant = $arr[0];
		unset($arr[0]);
		$actividad = rtrim(implode(',', $arr), ',');
		$titulo = "Comparativa de Actividades";
		$subtitulo = "Actividades del año: ".$nombreAno;
		$serie = $nombreAno." (".$cant.")";
		$actividad = array(
			'titulo' 					=> $titulo,
			'subtitulo' 				=> $subtitulo,
			'datos_principal_nombre' 	=> $serie,
			'datos_principal' 			=> $actividad,
			'datos_secundario_nombre' 	=> '',
			'datos_secundario' 			=> null,
			'type'						=> 'meses',
			'intervalo' 				=> '',
			'fecha_inicio' 				=> null );
		return $actividad;
	}

	private function _actividadComparacionAnos($ano1,$ano2){
		
		$nombreAno1 = explode("-",$ano1);
		$nombreAno1 = $nombreAno1[0];		
		$nombreAno2 = explode("-",$ano2);
		$nombreAno2 = $nombreAno2[0];		
		$actividad1 = $this->_actividadAno($ano1);		
		$actividad2 = $this->_actividadAno($ano2);	
		$arr = explode(",", $actividad1);
		$cant1 = $arr[0];
		unset($arr[0]);
		$actividad1 = rtrim(implode(',', $arr), ',');
		$arr = explode(",", $actividad2);
		$cant2 = $arr[0];
		unset($arr[0]);
		$actividad2 = rtrim(implode(',', $arr), ',');	
		$titulo = "Comparativa de Actividades";
		$subtitulo = "Actividades del año: ".$nombreAno1." y del año: ".$nombreAno2;
		$serie1 = $nombreAno1." (".$cant1.")";
		$serie2 = $nombreAno2." (".$cant2.")";
		$actividad = array(
			'titulo' 					=> $titulo,
			'subtitulo' 				=> $subtitulo,
			'datos_principal_nombre' 	=> $serie1,
			'datos_principal' 			=> $actividad1,
			'datos_secundario_nombre' 	=> $serie2,
			'datos_secundario' 			=> $actividad2,
			'type'						=> 'meses',
			'intervalo' 				=> '',
			'fecha_inicio' 				=> null );
		return $actividad;
	}

	private function _actividadAno($ano){
		$data = $this->Database->actividadAno($ano);
		$datos = rtrim(implode(',', $data), ',');
		return $datos;
	}

	private function _nombreMes($fecha){
		$fecha = explode(" ",$fecha);
		$fecha = explode("-",$fecha[0]);
		$mes = $fecha[1];
		switch ($mes){
			case '01':
				$nombreMes = 'Enero';
			break;
			case '02':
				$nombreMes = 'Febrero';
			break;
			case '03':
				$nombreMes = 'Marzo';
			break;
			case '04':
				$nombreMes = 'Abril';
			break;
			case '05':
				$nombreMes = 'Mayo';
			break;
			case '06':
				$nombreMes = 'Junio';
			break;
			case '07':
				$nombreMes = 'Julio';
			break;
			case '08':
				$nombreMes = 'Agosto';
			break;
			case '09':
				$nombreMes = 'Septiembre';
			break;
			case '10':
				$nombreMes = 'Octubre';
			break;
			case '11':
				$nombreMes = 'Noviembre';
			break;
			case '12':
				$nombreMes = 'Diciembre';
			break;
		}
		return $nombreMes;
	}

	//metodo para llamar al calculo de las categorias relizadas en un dia 
	private function _categoriasDelDia($dia){
		$categorias = $this->_categoriasDia($dia);
		$dia = explode(' ',$dia);
		$dia = date_create($dia[0]);
		$dia = date_format($dia,"d-m-Y");
		$titulo = "Flujos de Trabajo por categoría";
		$subtitulo = "Día: ".$dia;		
		$data = array(
			'titulo' 					=> $titulo,
			'subtitulo' 				=> $subtitulo,
			'categorias' 				=> $categorias);
		return $data;
	}

	//metodo para llamar al calculo de las categorias relizadas el dia anterior 
	private function _categoriasDelDiaAnterior(){
		$today = '2016-09-02 00:00:00';
		$yesterday = $this->_diaAnterior($today);								
		$categorias = $this->_categoriasDia($yesterday);
		$dia = explode(' ',$dia);
		$dia = date_create($dia[0]);
		$dia = date_format($dia,"d-m-Y");
		$titulo = "Flujos de Trabajo por categoría";
		$subtitulo = "Día: ".$dia;		
		$data = array(
			'titulo' 					=> $titulo,
			'subtitulo' 				=> $subtitulo,
			'categorias' 				=> $categorias);
		return $data;
	}
	//calcula el porcentaje de las categorias realizadas en un dia
	private function _categoriasDia($dia){
		$datos = array();
		$data = $this->Database->categoriasDia($dia);
		for($i=0;$i<count($data);$i++){
			$datos[$i] = "{ name: '".$data[$i]['nombre']." (".$data[$i]['cant'].")', y:".$data[$i]['porcentaje']."}";
			if (($i+1)!=count($data)){
				$datos[$i] = $datos[0].',';
			}			
		}
		return $datos;
	}

	//metodo para llamar al calculo de las categorias relizadas en un mes
	private function _categoriasDelMes($mes){
		$categorias = $this->_categoriasMes($mes);
		$titulo = "Flujos de Trabajo por categoría";
		$subtitulo = "Mes: ".$this->_nombreMes($mes);
		$data = array(
			'titulo' 					=> $titulo,
			'subtitulo' 				=> $subtitulo,
			'categorias' 				=> $categorias);
		return $data;
	}

	//calcula el porcentaje de las categorias realizadas en un mes
	private function _categoriasMes($mes){
		$datos = array();
		$data = $this->Database->categoriasMes($mes);
		for($i=0;$i<count($data);$i++){
			$datos[$i] = "{ name: '".$data[$i]['nombre']." (".$data[$i]['cant'].")', y:".$data[$i]['porcentaje']."}";
			if (($i+1)!=count($data)){
				$datos[$i] = $datos[0].',';
			}			
		}
		return $datos;
	}

	//metodo para llamar al calculo de las categorias relizadas en un año
	private function _categoriasDelAno($ano){
		$categorias = $this->_categoriasAno($ano);
		$ano = explode("-", $ano);
		$titulo = "Flujos de Trabajo por categoría";
		$subtitulo = "Año: ".$ano[0];
		$data = array(
			'titulo' 					=> $titulo,
			'subtitulo' 				=> $subtitulo,
			'categorias' 				=> $categorias);
		return $data;
	}
	//calcula el porcentaje de las categorias realizadas en un año
	private function _categoriasAno($ano){
		$datos = array();
		$data = $this->Database->categoriasAno($ano);
		for($i=0;$i<count($data);$i++){
			$datos[$i] = "{ name: '".$data[$i]['nombre']." (".$data[$i]['cant'].")', y:".$data[$i]['porcentaje']."}";
			if (($i+1)!=count($data)){
				$datos[$i] = $datos[0].',';
			}			
		}
		return $datos;
	}

	//metodo para llamar al calculo de las categorias relizadas en un periodo
	private function _categoriasDelPeriodo($fecha1,$fecha2){
		$categorias = $this->_categoriasPeriodo($fecha1,$fecha2);
		$fecha1 = explode(" ",$fecha1);
		$fecha2 = explode(" ",$fecha2);
		$fecha1 = date_create($fecha1[0]);
		$fecha2 = date_create($fecha2[0]);
		$fecha1 = date_format($fecha1,"d-m-Y");
		$fecha2 = date_format($fecha2,"d-m-Y");
		//$ano = explode("-", $ano);
		$titulo = "Flujos de Trabajo por categoría";
		$subtitulo = "Para el periodo del ".$fecha1." Al ".$fecha2;
		$data = array(
			'titulo' 					=> $titulo,
			'subtitulo' 				=> $subtitulo,
			'categorias' 				=> $categorias);
		return $data;
	}
	//calcula el porcentaje de las categorias realizadas en un periodo
	private function _categoriasPeriodo($fecha1,$fecha2){
		$datos = array();
		$data = $this->Database->categoriasPeriodo($fecha1,$fecha2);
		for($i=0;$i<count($data);$i++){
			$datos[$i] = "{ name: '".$data[$i]['nombre']." (".$data[$i]['cant'].")', y:".$data[$i]['porcentaje']."}";
			if (($i+1)!=count($data)){
				$datos[$i] = $datos[0].',';
			}			
		}
		return $datos;
	}

	//metodo para llamar al calculo de los indicadores en un dia 
	private function _indicadoresDelDia($fecha1,$fecha2){
		$rendimiento = $this->_rendimiento($fecha1,$fecha2);	
		$eficacia = $this->_eficacia($fecha1,$fecha2);	
		$respuesta = $this->_respuesta($fecha1,$fecha2);	
		$fecha1 = explode(" ",$fecha1);
		$fecha1 = date_create($fecha1[0]);
		$fecha1 = date_format($fecha1,"d-m-Y");
		$fecha2 = explode(" ",$fecha2);
		$fecha2 = date_create($fecha2[0]);
		$fecha2 = date_format($fecha2,"d-m-Y");
		$titulo = "Indicadores";
		$subtitulo = "Del día ".$fecha1;		
		$data = array(
			'titulo' 					=> $titulo,
			'subtitulo' 				=> $subtitulo,
			'rendimiento' 				=> $rendimiento,
			'eficacia' 					=> $eficacia,
			'respuesta' 				=> $respuesta);
		return $data;
	}

	//metodo para llamar al calculo de los indicadores en un mes
	private function _indicadoresDelMes($fecha_inicial){
		$fecha_final = strtotime ('+1 month',strtotime($fecha_inicial));	
		$fecha_final = date('Y-m-d H:i:s' ,$fecha_final);
		$rendimiento = $this->_rendimiento($fecha_inicial,$fecha_final);	
		$eficacia = $this->_eficacia($fecha_inicial,$fecha_final);	
		$respuesta = $this->_respuesta($fecha_inicial,$fecha_final);	
		$nombreMes = $this->_nombreMes($fecha_inicial);
		$titulo = "Indicadores";
		$subtitulo = "Del mes ".$nombreMes;		
		$data = array(
			'titulo' 					=> $titulo,
			'subtitulo' 				=> $subtitulo,
			'rendimiento' 				=> $rendimiento,
			'eficacia' 					=> $eficacia,
			'respuesta' 				=> $respuesta);
		return $data;
	}

	//metodo para llamar al calculo de los indicadores en un ano
	private function _indicadoresDelAno($fecha_inicial){
		$fecha_final = strtotime ('+12 month',strtotime($fecha_inicial));	
		$fecha_final = date('Y-m-d H:i:s' ,$fecha_final);
		$rendimiento = $this->_rendimiento($fecha_inicial,$fecha_final);	
		$eficacia = $this->_eficacia($fecha_inicial,$fecha_final);	
		$respuesta = $this->_respuesta($fecha_inicial,$fecha_final);	
		$nombreAno = explode("-",$fecha_inicial);
		$nombreAno = $nombreAno[0];		
		$titulo = "Indicadores";
		$subtitulo = "Del año ".$nombreAno;		
		$data = array(
			'titulo' 					=> $titulo,
			'subtitulo' 				=> $subtitulo,
			'rendimiento' 				=> $rendimiento,
			'eficacia' 					=> $eficacia,
			'respuesta' 				=> $respuesta);
		return $data;
	}

	//metodo para llamar al calculo de los indicadores en un periodo
	private function _indicadoresDelPeriodo($fecha_inicial,$fecha_final){
		$rendimiento = $this->_rendimiento($fecha_inicial,$fecha_final);	
		$eficacia = $this->_eficacia($fecha_inicial,$fecha_final);	
		$respuesta = $this->_respuesta($fecha_inicial,$fecha_final);	
		$fecha_inicial = explode(" ",$fecha_inicial);
		$fecha_final = explode(" ",$fecha_final);
		$fecha_inicial = date_create($fecha_inicial[0]);
		$fecha_final = date_create($fecha_final[0]);
		$fecha_inicial = date_format($fecha_inicial,"d-m-Y");
		$fecha_final = date_format($fecha_final,"d-m-Y");
		$titulo = "Indicadores";
		$subtitulo = "Para el periodo del ".$fecha_inicial." Al ".$fecha_final;
		$data = array(
			'titulo' 					=> $titulo,
			'subtitulo' 				=> $subtitulo,
			'rendimiento' 				=> $rendimiento,
			'eficacia' 					=> $eficacia,
			'respuesta' 				=> $respuesta);
		return $data;
	}

	//calcula el porcentaje del rendimiento en un periodo
	private function _rendimiento($fecha1,$fecha2){
		$datos = array();
		$data = $this->Database->rendimiento($fecha1,$fecha2);
		if ($data['cant_total_procesos']!=0)
			$datos = round((($data['cant_total_realizados']+$data['cant_total_instancias'])*100)/$data['cant_total_procesos']);
		else
			$datos = 0;
		return $datos;
	}

	//calcula el porcentaje de la eficacia en un periodo
	private function _eficacia($fecha1,$fecha2){
		$datos = array();
		$data = $this->Database->eficacia($fecha1,$fecha2);	
		if ($data['cant_total_procesos']!=0)	
			$datos = round(($data['cant_total_sinproblemas']*100)/$data['cant_total_procesos']);
		else
			$datos = 0;
		return $datos;
	}

	//calcula el porcentaje de la respuesta en un periodo
	private function _respuesta($fecha1,$fecha2){
		$datos = array();
		$data = $this->Database->respuesta($fecha1,$fecha2);				
		if ($data['cant_total_instancias']!=0)	
			$datos = round(($data['cant_total_finalizas']*100)/$data['cant_total_instancias']);
		else
			$datos = 0;
		return $datos;
	}

	//calcula el crecimiento comparando los dias
	private function _crecimientoDelDia($tipo,$dia1,$dia2){
		$tipo_msj='';
		$crecimiento = $this->_crecimiento($tipo,$dia1,$dia1,$dia2,$dia2);	
		$dia1 = explode(' ',$dia1);
		$dia1 = date_create($dia1[0]);
		$dia1 = date_format($dia1,"d-m-Y");
		$dia2 = explode(' ',$dia2);
		$dia2 = date_create($dia2[0]);
		$dia2 = date_format($dia2,"d-m-Y");
		if ($tipo==1){
			$tipo_msj = 'De instancias';
		}
		else{
			$tipo_msj = 'De procesos';	
		}
		$titulo = "Crecimiento";
		$subtitulo = $tipo_msj." del ".$dia2." respecto al ".$dia1;
		$data = array(
			'titulo' 					=> $titulo,
			'subtitulo' 				=> $subtitulo,
			'crecimiento' 				=> $crecimiento);
		return $data;
	}

	//calcula el crecimiento comparando los meses
	private function _crecimientoDelMes($tipo,$fecha1,$fecha2,$fecha3,$fecha4){
		$tipo_msj='';
		$crecimiento = $this->_crecimiento($tipo,$fecha1,$fecha2,$fecha3,$fecha4);	
		$mes1 = $this->_nombreMes($fecha1);
		$mes2 = $this->_nombreMes($fecha3);
		if ($tipo==1){
			$tipo_msj = 'De instancias';
		}
		else{
			$tipo_msj = 'De procesos';	
		}
		$titulo = "Crecimiento";
		$subtitulo = $tipo_msj." del mes ".$mes2." respecto al mes ".$mes1;
		$data = array(
			'titulo' 					=> $titulo,
			'subtitulo' 				=> $subtitulo,
			'crecimiento' 				=> $crecimiento);
		return $data;
	}

	//calcula el crecimiento comparando los años
	private function _crecimientoDelAno($tipo,$fecha1,$fecha2,$fecha3,$fecha4){
		$tipo_msj='';
		$crecimiento = $this->_crecimiento($tipo,$fecha1,$fecha2,$fecha3,$fecha4);	
		$ano1 = explode('-', $fecha1);
		$ano2 = explode('-', $fecha3);
		if ($tipo==1){
			$tipo_msj = 'De instancias';
		}
		else{
			$tipo_msj = 'De procesos';	
		}
		$titulo = "Crecimiento";
		$subtitulo = $tipo_msj." del año ".$ano2[0]." respecto al año ".$ano1[0];
		$data = array(
			'titulo' 					=> $titulo,
			'subtitulo' 				=> $subtitulo,
			'crecimiento' 				=> $crecimiento);
		return $data;
	}

	//calcula el crecimiento comparando los periodos
	private function _crecimientoDelPeriodo($tipo,$fecha1,$fecha2,$fecha3,$fecha4){
		$tipo_msj='';
		$crecimiento = $this->_crecimiento($tipo,$fecha1,$fecha2,$fecha3,$fecha4);	
		$fecha1 = explode(" ",$fecha1);
		$fecha2 = explode(" ",$fecha2);
		$fecha1 = date_create($fecha1[0]);
		$fecha2 = date_create($fecha2[0]);
		$fecha1 = date_format($fecha1,"d/m/Y");
		$fecha2 = date_format($fecha2,"d/m/Y");
		$fecha3 = explode(" ",$fecha3);
		$fecha4 = explode(" ",$fecha4);
		$fecha3 = date_create($fecha3[0]);
		$fecha4 = date_create($fecha4[0]);
		$fecha3 = date_format($fecha3,"d/m/Y");
		$fecha4 = date_format($fecha4,"d/m/Y");
		if ($tipo==1){
			$tipo_msj = 'De instancias';
		}
		else{
			$tipo_msj = 'De procesos';
		}
		$titulo = "Crecimiento";
		$subtitulo = $tipo_msj." del periodo ".$fecha3." - ".$fecha4." respecto al periodo ".$fecha1." - ".$fecha2;
		$data = array(
			'titulo' 					=> $titulo,
			'subtitulo' 				=> $subtitulo,
			'crecimiento' 				=> $crecimiento);
		return $data;
	}

	//calcula el porcentaje del crecimiento en un periodo
	private function _crecimiento($tipo,$fecha1,$fecha2,$fecha3,$fecha4){
		$datos = 0;
		$data = $this->Database->crecimiento($tipo,$fecha1,$fecha2,$fecha3,$fecha4);				
		if ($data['cant_total_1']>0){
			$porcentaje = round(($data['cant_total_2']*100)/$data['cant_total_1']);
			if ($data['cant_total_1']>$data['cant_total_2']){
				$datos = 100-$porcentaje;
				$datos = $datos*(-1); 				
			}else{
				$datos = $porcentaje-100;
			}
		}
		return $datos;
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */



