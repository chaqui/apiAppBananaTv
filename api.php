<?php
	include_once('globals.php');
	include_once('dbmanager.php');
	/**
	*/
	class api 
	{

		
		 private function getCanales($idCanal){
		 	$consulta="SELECT * FROM canal WHERE idcanal =".$idCanal.";";
			$db = new dbmanager();
			return $db->executeQuery($consulta);	 	
		 }
		 private function getHorariosyCanales($idCanal){
		 	$canales= $this->getCanales($idCanal);
		 	$consulta="SELECT * FROM programa WHERE canal_idcanal =".$idCanal.";";
		 	$db = new dbmanager();
			$programas= $db->executeQuery($consulta);	
		 	$json = "";
		 	$json .="{\"canal:\":";
		 	while($canal = mysql_fetch_array($canales))
		 		{
		 			$json.="{\"nombre\":\"".$canal['nombre']."\",\"programas\":[";
		 			while($programa = mysql_fetch_array($programas)){
		 				$json.="{\"programa\":{\"nombre\":\"".$programa['nombre']."\",\"horario\":\"".$programa['horaDeInicio']."\",\"id\":".$programa["idprograma"]."}},";
		 			}
		 			$json = substr($json, 0, -1);
		 			$json.="]}";
		 		}
		 	$json.="}";
		 	return $json;	
		 }
		 public function getApi($canal)
		 {
		 	return $this->getHorariosyCanales($canal);
		 }
	}