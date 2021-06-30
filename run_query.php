<?php
	#Esta funcion la comparto para ayudar a todos que desean simplicar la vida PHP con mysql
	#propiedad de "cristhianjdv"
	#Codigo elaborado en el 2011 y funcional hasta la actualidad.
	
			function run_query($sql,$op, $debug){
				include_once 'data_db.php';
				$db = new PDO('mysql:host='.$servidor.';dbname='.$bd, $usuario_db, $password_db
								, array(
										//  PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
										 PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
										, PDO::ATTR_PERSISTENT => false  //PDO::ATTR_PERSISTENT => true //al estar persistente genera daño
										//, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
										//, PDO::MYSQL_ATTR_INIT_COMMAND => "SET SESSION collation_connection = 'utf8_unicode_ci'"
										)
							 );
				
				if($debug == 1){
					echo "<pre>";
						print_r($sql);
					echo "<pre>";
				}
				
				switch($op){
					case 1: /*devuelve un JSON con datos o un JSON con error*/
					
						try{
							$statement  = $db->prepare($sql);
							$statement->execute();
							
							if($debug == 1){
								$statement->debugDumpParams();
							}
							
							$result     = $statement->fetchAll(PDO::FETCH_ASSOC);
							
							if($debug == 1){
								echo "<pre>";
									print_r($result);
								echo "<pre>";
							}
							
							if(count($result) >= 1){
								
								echo '{"data":'. json_encode($result) .'}' ;
								
							}else{
								$rw_error['error'] = 'error';
								$myArray[] = $rw_error;
								echo '{"data":['. implode(',',$myArray) .']}' ;
								
							}
							
							$statement = null;
							$db = null;
							
						}catch(PDOException  $e ){
							echo "Error: ".$e->getMessage();
						}
					
					break;
					
					case 2: /*devuelve el array con datos o devuelve un error*/
					
						try{
							$statement  = $db->prepare($sql);
							$statement->execute();
							
							if($debug == 1){
								$statement->debugDumpParams();
							}
							
							$result     = $statement->fetchAll(PDO::FETCH_ASSOC);
							
							if($debug == 1){
								echo "<pre>";
									print_r($result);
								echo "<pre>";
							}
							
							if(count($result) >= 1){
								
								$result_s = $result;
								
							}else{
								$rw_error['error'] = 'error';
								$myArray[] = $rw_error;
								$result_s = $myArray;
								
							}
							
							$statement = null;
							$db = null;
							
						}catch(PDOException  $e ){
							echo "Error: ".$e->getMessage();
						}
					
						return $result_s;
					
					break;
					
					case 3: /*devuelve la informacion y sin mensaje de error*/
					
						try{
							$statement  = $db->prepare($sql);
							$statement->execute();
							
							if($debug == 1){
								$statement->debugDumpParams();
							}
							
							$result     = $statement->fetchAll(PDO::FETCH_ASSOC);
							
							if($debug == 1){
								echo "<pre>";
									print_r($result);
								echo "<pre>";
							}
							
							if(count($result) >= 1){
								
								$result_s = $result;
								
							}else{
								
								$result_s = array();
								
							}
							
							$statement = null;
							$db = null;
							
						}catch(PDOException  $e ){
							echo "Error: ".$e->getMessage();
						}
					
						return $result_s;
					
					break;
					
					default:
					break;
				}
				
				
			}
			

?>