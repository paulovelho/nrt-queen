<?php
 
	$magratheaSingle = true;

	$magrathea_path = "/home/paulo/Rincewind/Magrathea/MagratheaPHP/Magrathea";
	include($magrathea_path."/LOAD.php");

	$pluginPath = "/home/paulo/Rincewind/Magrathea/MagratheaPHP/Magrathea/plugins/MagratheaImages2/";
	include($pluginPath."Model/MagratheaImage.php");

	$magImage = new MagratheaImage();

	$imagePath = __DIR__."/media/";
	$genPath = __DIR__."/generated/";

	$dir = new DirectoryIterator($imagePath);
	foreach ($dir as $fileinfo) {
    if (!$fileinfo->isDot()) {
    	echo "\ngot image: ".$fileinfo->getFilename();
    	$image = new MagratheaImage();
    	$filename = explode(".", $fileinfo->getFilename());
    	$extension = $filename[1];


    	if($extension != "jpg" && $extension != "jpeg" && $extension != "png" ) continue;

    	$image->filename = $fileinfo->getFilename();
    	$image->name = $filename[0];
    	$image->extension = $extension;
    	$image->file_type = $extension;
    	$image->
				SetConfig($imagePath, $genPath)->
    		SetWidthAndHeight()->
				SilentLoad()->
				FixedSize(90,125)->
				SaveFile();
    	echo "\nfinshed image... ".$image->filename." (original size: ".$image->width."x".$image->height.") ";
    }
	}

	$dir = new DirectoryIterator($genPath);
	foreach ($dir as $fileinfo) {
    if (!$fileinfo->isDot()) {
    	$file = $fileinfo->getFilename();
    	echo "\nrenaming image: ".$file;
    	$image = new MagratheaImage();
    	$filename = explode(".", $file);
    	$original_name = $filename[0];
    	$name = explode("_", $original_name);
    	$newname = $name[0].".".$filename[1];
    	rename($genPath.$file, $genPath.$newname);
    }
	}


?>