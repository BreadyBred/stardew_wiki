<?php
	session_start();
	error_reporting(E_ALL);
	$filename = "../files/";
	$filename_better = "../files/gameInfos_better.xml";
	$savePath = "../files/saves/";
	$oldFile = "../files/saves/gameInfos_better.xml";
	$saveFile = "../files/saves/gameInfos_".date("d.m.y-H_i_s").".xml";
	$canCheck = false;

	if ($_FILES['file']['name'] == "gameInfos_better.xml") $newFile = "gameInfos.xml";
	else $newFile = $_FILES['file']['name'];

	// Check if file is xml
	$uploadfile = $filename . $newFile;

	if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)){
		$checkFile = file_get_contents($uploadfile);
		if (strpos($checkFile, "<?xml") || strpos($checkFile, "<?xml")===0){
			// Réecriture au cas où 2 <?xml puis delete
			if (file_exists($uploadfile)){
				$fileBugged = file_get_contents($uploadfile);
				if (substr_count($fileBugged, "<?xml") > 1) $fileBettered = substr($fileBugged, 0, strpos($fileBugged, "<?xml", 10_000));
				else $fileBettered = $fileBugged;
				// If exists -> Backup Save
				echo "1";
				if (file_exists($filename_better)){
					echo "2";
					if (copy($filename_better, $saveFile)) {
						echo "3";
						// rename($oldFile, $saveFile);
						unlink($filename_better);
					}
				}
				if (file_put_contents($filename_better, $fileBettered)){
					$_SESSION["result"] = "Success";
					unlink($uploadfile);
					header("Location: ../upload");
				}
			}
			else{
				$_SESSION["result"] = "File doesn't exist";
				header("Location: ../upload");
			}
		}
		else {
			$_SESSION["result"] = "The file isn't a XML file.";
			unlink($uploadfile);
			header("Location: ../upload");
		}
	}
	else{
		$_SESSION["result"] = "Problem during file uploading";
		header("Location: ../upload");
	}
?>