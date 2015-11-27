<?php 
			header('Access-Control-Allow-Origin: *');
			header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
			header('Access-Control-Max-Age: 1000');
			header('Access-Control-Allow-Headers: Content-Type');

			ini_set('display_errors', 1);
			ini_set('display_startup_errors', 1);
			error_reporting(E_ALL);

			$data = json_encode(array("your_request_was" => $_POST['code']));
			//echo $data;
			//$Code = $_Post['code'];
			//$data = "#include<stdio.h> \n int main(){printf(\"Hello World\"); return 0;}";

			//$codee = json_encode(array("code_so_far:" => $Code));
			//echo $codee;

			$file = "userProgram.c";
			file_put_contents($file, $_POST['code'] , LOCK_EX);
			$command = $_POST['command'];

				

			$error = implode("\n",$errLines);
			/*
			$process = proc_open($command,
			    array(
			        1 => array("pipe", "w"),  //stdout
			        2 => array("pipe", "w")   // stderr
			    ), $pipes);
			*/
			//sleep(2);
	
			//fclose($pipes[1]);
			//fclose($pipes[2]);

			if(strpos($error, ": error:") == false){
				sleep(1);
				exec("./a.out 2>&1", $lines);
				$output = implode("\n", $lines);
			//while(strpos($output, "not found") >= 0){
				
				//proc_open("./a.out 2>&1", $output);
				//}
			}
			else
				$output = "Compilation Error";
			
			// //echo $output;
			$json = json_encode(array('Compiler Error:' => $error, 'Output:' => $output));
			
			echo $json;

?> 	