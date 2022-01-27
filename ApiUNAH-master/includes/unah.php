<?php
include 'simple_html_dom.php';

function getDataAlumno($usuario, $clave)
{
    $EVENTVALIDATION = '/wEdAA29ABtgHzbDLDZ8i2IiL66qLhWkvKFYsOaCSvCAkdnA3SQuzYxkS4BZfgj9eFosIfs1B3wBeDBSuytLP7WXV1Wj+Acom66qoXdW8H8Sfu1pSjtzpTW31CVGZjUL8cEDHE6QgRsNye+5nJGG/r2nAU1DQtxIMJcI6+vKNwSodoSvppubsFfb0Q/444pjdjzlFB/uWt948gHaAca80ARUswcec1+BY+fffscDi0LTojZe0thmXI8lnGMQDgg7nfbST1P53d8HLcsMPPSWw23i74K4e+kOTxPLlE5Ebau9Ir/h8etd2j0XTw+F62k03bpdIt0=';
    $VIEWSTATE = '/wEPDwULLTEzMTA2NjU0ODQPZBYCZg9kFgICAw9kFgICAw9kFgICAQ8PZBYCHgpvbmtleXByZXNzBSVqYXZhc2NyaXB0OnJldHVybiBzb2xvbnVtZXJvcyhldmVudCk7ZGSGfHEiMMKqZ8fLhm5gdCRpF1d2pGQRxUR7l/uvEVbNyQ==';
    $PREGRA_ESTU_LOGIN = "https://registro.unah.edu.hn/pregra_estu_login.aspx";
    $PREGA_ESTU_MAIN = "https://registro.unah.edu.hn/prega_estu_main.aspx";
	$PREGA_FORM03_MATRICULA = "https://registro.unah.edu.hn/pregra_form03_matricula.aspx";
	$HISTORIAL_ACADEMICO = "https://registro.unah.edu.hn/historial_academico.aspx";

	$data = http_build_query(array(
		'action'=> $PREGRA_ESTU_LOGIN,
		'__VIEWSTATE'=>$VIEWSTATE,
		'__EVENTVALIDATION'=>$EVENTVALIDATION,
		'ctl00$MainContent$txt_cuenta'=>$usuario,
		'ctl00$MainContent$txt_clave'=>$clave,
		'ctl00$MainContent$Button1'=>"Ingresar"
	));

    $ch = curl_init();
	$ops = 	array(
		CURLOPT_URL=>$PREGRA_ESTU_LOGIN,
		CURLOPT_POST=>true,
		CURLOPT_COOKIEJAR=> '-',
		//CURLOPT_COOKIEFILE=> 'cookies/cookies.txt',
		//CURLOPT_COOKIEJAR=> 'cookies/cookies.txt',
		CURLOPT_FOLLOWLOCATION=>true,
		CURLOPT_POSTFIELDS=>$data,
		CURLOPT_RETURNTRANSFER=>true,
		CURLOPT_TIMEOUT=>120,
		CURLOPT_SSL_VERIFYPEER=>false,
		CURLOPT_USERAGENT=>$_SERVER['HTTP_USER_AGENT']
	);

	curl_setopt_array($ch, $ops);
	$result = curl_exec($ch);
	$html = str_get_html($result);

	$info = array();
	$info['correoInstitucional']=trim($html->getElementById("MainContent_Label1")->parent()->find('label > b', 0)->innertext);

	curl_setopt($ch, CURLOPT_URL, $PREGA_FORM03_MATRICULA);
    curl_setopt($ch, CURLOPT_TIMEOUT, 120);
    $result = curl_exec($ch);
    $html = str_get_html($result);


    $info["anio"] = trim($html->getElementById("MainContent_Label6")->innertext);

	$filas = $html->find('#MainContent_GridView1 tr');
    $clases = array();
    foreach ($filas as $fila) {
        $clases[] = array(
            "codigo" => trim($fila->find('td', 0)->innertext),
            "asignatura" => preg_replace_callback("/(&#[0-9]+;)/", function($m) { return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES"); }, trim($fila->find('td', 1)->innertext)),
            "seccion" =>trim($fila->find('td', 2)->innertext),
            "hi" => trim($fila->find('td', 3)->innertext),
            "hf" => trim($fila->find('td', 4)->innertext),
            "dias" => trim($fila->find('td', 5)->innertext),
            "edificio" => trim($fila->find('td', 6)->innertext),
            "aula" => trim($fila->find('td', 7)->innertext),
            "uv" => trim($fila->find('td', 8)->innertext),
            "obs" => str_replace("&nbsp;", '', trim($fila->find('td', 9)->innertext)),
            "periodo" => trim($fila->find('td', 10)->innertext),
            "semana" => str_replace("&nbsp;", '', trim($fila->find('td', 11)->innertext))

        );
    }

    $info["forma03"] = $clases;


	curl_setopt($ch, CURLOPT_URL, $HISTORIAL_ACADEMICO);
	curl_setopt($ch, CURLOPT_TIMEOUT, 120);
	$result = curl_exec($ch);
	$html = str_get_html($result);

	$paginas = count($html->find(".dxpPageNumber_Aqua"));

    if ((trim($html->getElementById("MainContent_ASPxRoundPanel2_ASPxLabel9")->innertext)) === 'INFORMATICA ADMINISTRATIVA'){
        $CAR = 'INFORMÁTICA ADMINISTRATIVA';
    }else if((trim($html->getElementById("MainContent_ASPxRoundPanel2_ASPxLabel9")->innertext)) === 'INGENIERIA AGROINDUSTRIAL(94)'){
        $CAR = 'INGENIERÍA AGROINDUSTRIAL';
    }else{
        $CAR = trim($html->getElementById("MainContent_ASPxRoundPanel2_ASPxLabel9")->innertext);
    }

	$info["cuenta"] = trim($html->getElementById("MainContent_ASPxRoundPanel2_ASPxLabel7")->innertext);
	$info["nombre"] = preg_replace_callback("/(&#[0-9]+;)/", function($m) { return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES"); }, trim($html->getElementById("MainContent_ASPxRoundPanel2_ASPxLabel8")->innertext));
	$info["carrera"] = $CAR;
	$info["centro"] = trim($html->getElementById("MainContent_ASPxRoundPanel2_ASPxLabel10")->innertext);
	$info["indiceGlobal"] = trim($html->getElementById("MainContent_ASPxRoundPanel2_ASPxLabel11")->innertext);
	$info["indicePeriodo"] = trim($html->getElementById("MainContent_ASPxRoundPanel2_ASPxLabel12")->innertext);

	//$sql='insert into alumnos(cuenta,nombre,correoInstitucional,carrera,indicePeriodo,indiceGlobal,centro,estadoAcade,genero) values(?,?,?,?,?,?,?,?,?)';
	//insert($sql,array($info["cuenta"],$info["nombre"],$info['correoInstitucional'],	$info["carrera"],$info["indicePeriodo"],$info["indiceGlobal"],$info["centro"],0,0));


	$filas = $html->find('#MainContent_ASPxPageControl1_ASPxGridView2_DXMainTable .dxgvDataRow_Aqua');
	$clases = array();
	foreach($filas as $fila) {
		$clases[] = array(
			"codigo" => trim($fila->find('td.dxgv', 0)->innertext),
			"asignatura" => preg_replace_callback("/(&#[0-9]+;)/", function($m) { return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES"); },trim($fila->find('td.dxgv', 1)->innertext)),
			"uv" => trim($fila->find('td.dxgv', 2)->innertext),
			"seccion" =>trim($fila->find('td.dxgv', 3)->innertext),
			"anio" => trim($fila->find('td.dxgv', 4)->innertext),
			"periodo" => trim($fila->find('td.dxgv', 5)->innertext),
			"calificacion" =>trim($fila->find('td.dxgv', 6)->innertext),
			"obs" => trim($fila->find('td.dxgv', 7)->innertext)
		);

	}

	$datos= array();
	for($i = 1; $i < $paginas; $i++ ){
		foreach($html->find('form input') as $element)
			$datos[$element->id] =  $element->value;
		$datos['__CALLBACKID']='ctl00$MainContent$ASPxPageControl1$ASPxGridView2';
		$datos['__CALLBACKPARAM']='c0:GB|20;12|PAGERONCLICK3|PN'.$i. ';';
		$data = http_build_query($datos);
		curl_setopt($ch, CURLOPT_URL, $HISTORIAL_ACADEMICO);
		curl_setopt($ch, CURLOPT_TIMEOUT, 120);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$result = curl_exec($ch);

		$html = str_get_html($result);
		$filas = $html->find('#MainContent_ASPxPageControl1_ASPxGridView2_DXMainTable .dxgvDataRow_Aqua');
		foreach($filas as $fila) {
			$clases[] = array(
				"codigo" => trim($fila->find('td.dxgv', 0)->innertext),
				"asignatura" => preg_replace_callback("/(&#[0-9]+;)/", function($m) { return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES"); }, trim($fila->find('td.dxgv', 1)->innertext)),
				"uv" => trim($fila->find('td.dxgv', 2)->innertext),
				"seccion" =>trim($fila->find('td.dxgv', 3)->innertext),
				"anio" => trim($fila->find('td.dxgv', 4)->innertext),
				"periodo" => trim($fila->find('td.dxgv', 5)->innertext),
				"calificacion" =>trim($fila->find('td.dxgv', 6)->innertext),
				"obs" => trim($fila->find('td.dxgv', 7)->innertext)
			);

		}
	}
	$info["historial"] = $clases;
	//foreach($info["historial"] as $his) {
	  //  $sql='insert into historial(asignatura,cuenta,codigo,uv,seccion,anio,periodo,calificacion,obs) values(?,?,?,?,?,?,?,?,?)';
        //insert($sql,array($his["asignatura"],$info["cuenta"],$his["codigo"],$his['uv'],$his["seccion"],$his["anio"],$his["periodo"],$his["calificacion"],$his["obs"]));
	//}
	curl_close($ch);
	return $info;
}

function accesoAlumno($usuario, $clave){

    $EVENTVALIDATION = '/wEdAA29ABtgHzbDLDZ8i2IiL66qLhWkvKFYsOaCSvCAkdnA3SQuzYxkS4BZfgj9eFosIfs1B3wBeDBSuytLP7WXV1Wj+Acom66qoXdW8H8Sfu1pSjtzpTW31CVGZjUL8cEDHE6QgRsNye+5nJGG/r2nAU1DQtxIMJcI6+vKNwSodoSvppubsFfb0Q/444pjdjzlFB/uWt948gHaAca80ARUswcec1+BY+fffscDi0LTojZe0thmXI8lnGMQDgg7nfbST1P53d8HLcsMPPSWw23i74K4e+kOTxPLlE5Ebau9Ir/h8etd2j0XTw+F62k03bpdIt0=';
    $VIEWSTATE = '/wEPDwULLTEzMTA2NjU0ODQPZBYCZg9kFgICAw9kFgICAw9kFgICAQ8PZBYCHgpvbmtleXByZXNzBSVqYXZhc2NyaXB0OnJldHVybiBzb2xvbnVtZXJvcyhldmVudCk7ZGSGfHEiMMKqZ8fLhm5gdCRpF1d2pGQRxUR7l/uvEVbNyQ==';
    $PREGRA_ESTU_LOGIN = "https://registro.unah.edu.hn/pregra_estu_login.aspx";
    $PREGA_ESTU_MAIN = "https://registro.unah.edu.hn/prega_estu_main.aspx";
	$HISTORIAL_ACADEMICO = "https://registro.unah.edu.hn/historial_academico.aspx";

	$data = http_build_query(array(
		'action'=> $PREGRA_ESTU_LOGIN,
		'__VIEWSTATE'=>$VIEWSTATE,
		'__EVENTVALIDATION'=>$EVENTVALIDATION,
		'ctl00$MainContent$txt_cuenta'=>$usuario,
		'ctl00$MainContent$txt_clave'=>$clave,
		'ctl00$MainContent$Button1'=>"Ingresar"
	));

    $ch = curl_init();
	$ops = 	array(
		CURLOPT_URL=>$PREGRA_ESTU_LOGIN,
		CURLOPT_POST=>true,
		CURLOPT_COOKIEJAR=> '-',
		//CURLOPT_COOKIEFILE=> 'cookies/cookies.txt',
		//CURLOPT_COOKIEJAR=> 'cookies/cookies.txt',
		CURLOPT_FOLLOWLOCATION=>true,
		CURLOPT_POSTFIELDS=>$data,
		CURLOPT_RETURNTRANSFER=>true,
		CURLOPT_TIMEOUT=>120,
		CURLOPT_SSL_VERIFYPEER=>false,
		CURLOPT_USERAGENT=>$_SERVER['HTTP_USER_AGENT']
	);

	curl_setopt_array($ch, $ops);
	$result = curl_exec($ch);
	$html = str_get_html($result);
	$info = array();

    //$html->getElementById("MainContent_Label1") != null
	if( $html->getElementById("MainContent_Label1") != null){
    	$info['correoInstitucional']= trim($html->getElementById("MainContent_Label1")->parent()->find('label > b', 0)->innertext);

	    curl_setopt($ch, CURLOPT_URL, $HISTORIAL_ACADEMICO);
	    curl_setopt($ch, CURLOPT_TIMEOUT, 120);
	    $result = curl_exec($ch);
	    $html = str_get_html($result);

        if ((trim($html->getElementById("MainContent_ASPxRoundPanel2_ASPxLabel9")->innertext)) === 'INFORMATICA ADMINISTRATIVA'){
            $CAR2 = 'INFORMÁTICA ADMINISTRATIVA';
        }else if((trim($html->getElementById("MainContent_ASPxRoundPanel2_ASPxLabel9")->innertext)) === 'INGENIERIA AGROINDUSTRIAL(94)'){
            $CAR2 = 'INGENIERÍA AGROINDUSTRIAL';
        }else{
            $CAR2 = trim($html->getElementById("MainContent_ASPxRoundPanel2_ASPxLabel9")->innertext);
        }

	    $info["cuenta"] = trim($html->getElementById("MainContent_ASPxRoundPanel2_ASPxLabel7")->innertext);
	    $info["nombre"] = preg_replace_callback("/(&#[0-9]+;)/", function($m) { return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES"); }, trim($html->getElementById("MainContent_ASPxRoundPanel2_ASPxLabel8")->innertext));
	    $info["carrera"] = $CAR2;
	    $info["centro"] = trim($html->getElementById("MainContent_ASPxRoundPanel2_ASPxLabel10")->innertext);
	    $info["indiceGlobal"] = trim($html->getElementById("MainContent_ASPxRoundPanel2_ASPxLabel11")->innertext);
	    $info["indicePeriodo"] = trim($html->getElementById("MainContent_ASPxRoundPanel2_ASPxLabel12")->innertext);
	    curl_close($ch);
	    return $info;
	} else {
	    curl_close($ch);

	    }

}

/*
function getDataForma03($usuario, $clave)
{
    $EVENTVALIDATION = '/wEdAA29ABtgHzbDLDZ8i2IiL66qLhWkvKFYsOaCSvCAkdnA3SQuzYxkS4BZfgj9eFosIfs1B3wBeDBSuytLP7WXV1Wj+Acom66qoXdW8H8Sfu1pSjtzpTW31CVGZjUL8cEDHE6QgRsNye+5nJGG/r2nAU1DQtxIMJcI6+vKNwSodoSvppubsFfb0Q/444pjdjzlFB/uWt948gHaAca80ARUswcec1+BY+fffscDi0LTojZe0thmXI8lnGMQDgg7nfbST1P53d8HLcsMPPSWw23i74K4e+kOTxPLlE5Ebau9Ir/h8etd2j0XTw+F62k03bpdIt0=';
    $VIEWSTATE = '/wEPDwULLTEzMTA2NjU0ODQPZBYCZg9kFgICAw9kFgICAw9kFgICAQ8PZBYCHgpvbmtleXByZXNzBSVqYXZhc2NyaXB0OnJldHVybiBzb2xvbnVtZXJvcyhldmVudCk7ZGSGfHEiMMKqZ8fLhm5gdCRpF1d2pGQRxUR7l/uvEVbNyQ==';
    $PREGRA_ESTU_LOGIN = "https://www.registro.unah.edu.hn/pregra_estu_login.aspx";
    $PREGA_ESTU_MAIN = "https://www.registro.unah.edu.hn/prega_estu_main.aspx";
	$PREGA_FORM03_MATRICULA = "https://www.registro.unah.edu.hn/pregra_form03_matricula.aspx";
	$HISTORIAL_ACADEMICO = "https://www.registro.unah.edu.hn/historial_academico.aspx";

	$data = http_build_query(array(
		'action'=> $PREGRA_ESTU_LOGIN,
		'__VIEWSTATE'=>$VIEWSTATE,
		'__EVENTVALIDATION'=>$EVENTVALIDATION,
		'ctl00$MainContent$txt_cuenta'=>$usuario,
		'ctl00$MainContent$txt_clave'=>$clave,
		'ctl00$MainContent$Button1'=>"Ingresar"
	));

    $ch = curl_init();
	$ops = 	array(
		CURLOPT_URL=>$PREGRA_ESTU_LOGIN,
		CURLOPT_POST=>true,
		CURLOPT_COOKIEJAR=> '-',
		//CURLOPT_COOKIEFILE=> 'cookies/cookies.txt',
		//CURLOPT_COOKIEJAR=> 'cookies/cookies.txt',
		CURLOPT_FOLLOWLOCATION=>true,
		CURLOPT_POSTFIELDS=>$data,
		CURLOPT_RETURNTRANSFER=>true,
		CURLOPT_TIMEOUT=>120,
		CURLOPT_SSL_VERIFYPEER=>false,
		CURLOPT_USERAGENT=>$_SERVER['HTTP_USER_AGENT']
	);

	curl_setopt_array($ch, $ops);
	$result = curl_exec($ch);
	$html = str_get_html($result);

	$info2 = array();
	//$info['correoInstitucional']=trim($html->getElementById("MainContent_Label1")->parent()->find('label > b', 0)->innertext);

	curl_setopt($ch, CURLOPT_URL, $PREGA_FORM03_MATRICULA);
    curl_setopt($ch, CURLOPT_TIMEOUT, 120);
    $result = curl_exec($ch);
    $html = str_get_html($result);


    //$info["anio"] = trim($html->getElementById("MainContent_Label6")->innertext);

	$filas = $html->find('#MainContent_GridView1 tr');
    $clases = array();
    foreach ($filas as $fila) {
        $clases[] = array(
            "codigo" => trim($fila->find('td', 0)->innertext),
            "asignatura" => preg_replace_callback("/(&#[0-9]+;)/", function($m) { return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES"); }, trim($fila->find('td', 1)->innertext)),
            "seccion" =>trim($fila->find('td', 2)->innertext),
            "hi" => trim($fila->find('td', 3)->innertext),
            "hf" => trim($fila->find('td', 4)->innertext),
            "dias" => trim($fila->find('td', 5)->innertext),
            "edificio" => trim($fila->find('td', 6)->innertext),
            "aula" => trim($fila->find('td', 7)->innertext),
            "uv" => trim($fila->find('td', 8)->innertext),
            "obs" => str_replace("&nbsp;", '', trim($fila->find('td', 9)->innertext)),
            "periodo" => trim($fila->find('td', 10)->innertext),
            "semana" => str_replace("&nbsp;", '', trim($fila->find('td', 11)->innertext))

        );
    }

    $info2["forma03"] = $clases;

    curl_close($ch);
	return $info;
}
*/
?>
