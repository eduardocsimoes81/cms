<?php 
	class Config extends model{
		
		public function getConfig(){

			$array = array();

			$sql = "SELECT * FROM config";
			$sql = $this->db->prepare($sql);
			$sql->execute();

			if($sql->rowCount() > 0){
				foreach($sql->fetchAll() as $c){
					$array[$c['nome']] = $c['valor'];
				}
			}

			return $array;
		}
	}
 ?>