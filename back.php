<?php
			header('Access-Control-Allow-Origin: *');
			header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
			header('Access-Control-Max-Age: 1000');
			header('Access-Control-Allow-Headers: Content-Type');
			
			ini_set('display_errors', 1);
			ini_set('display_startup_errors', 1);
			error_reporting(E_ALL);
			$data = json_encode(array("your_request_was" => $_POST['code']));
			
			//$random = rand(1,100);
			//exec("mkdir $random");
			//$random = "root";
			//$file = "/var/www/html/ace/root/userProgram.c";
			//exec("chmod 777 $random");
			//exec("chmod 777 $file");
			
			
			
			$file = "userProgram.c";
			file_put_contents("./root/$file", $_POST['code'] , LOCK_EX);
	       	//	$bitch = fopen($file, "w") or die("can not open file");
		//	$text = "jeremy sucks";
		//	fwrite($bitch, $_POST['code']);
		//	fclose($bitch);
			$command = $_POST['command'];
			exec("gcc -o ./root/a.out ./root/userProgram.c $command 2>&1", $errLines);
		//	exec($command." $file 2>&1", $errLines);
		//	sleep(1);
		//	exec("chmod 777 a.out");
			$error = implode("\n",$errLines);
			
			if(strpos($error, ": error:") == false){
				//sleep(1);
				exec("./root/a.out 2>&1", $lines);
				$output = implode("\n", $lines);
			}
			else
				$output = "Compilation Error";
			$json = json_encode(array('Compiler Error:' => $error, 'Output:' => $output));
			file_put_contents("./error.txt", $error, LOCK_EX);
			
			echo $json;
?> 
