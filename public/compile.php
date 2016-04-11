<?php
/*
*
* Compile LESS PHP v1.0.0
* Required: oyejorge/less.php: ~1.5
* vendor/oyejorge/less.php/lessc.inc.php
*
* Copyright 2014, JAMPstudio.pl
* Licensed only for trusted sites
*
* http://jampstudio.pl
*
*/

require_once('./vendor/oyejorge/less.php/lessc.inc.php');

$stylesFile = 'styles.ini';

if(file_exists($stylesFile))
{
	$style = null;
	$CssContent = null;
	$styles = file($stylesFile);

	$files = array();

	try {
	    $LessCompiler = new Less_Parser(array( 'compress'=>true ));
		foreach($styles as $line)
		{
			if (substr(trim($line), 0, 1) === '/')
				$line = substr(trim($line), 1);
			else
				$line = trim($line);

			if(file_exists($line))
	    		$LessCompiler->parse(implode('', file($line)));
		}
    	$CssContent = $LessCompiler->getCss();
	} catch(Exception $e) {
		$error_message = $e->getMessage();
	}

	if($CssContent){
		$CssContent = "/* Compiled: ". date('Y-m-d, H:i:s')." - Copyright 2014, JAMPstudio.pl - Licensed only for trusted clients */\n".$CssContent;
		if(!is_dir('compiled'))
			mkdir('compiled');
		$plik = fopen('compiled/base.css', 'w');
		fputs($plik, $CssContent);
		fclose($plik);
		echo ("Compiled: ". date('Y-m-d, H:i:s')."<br /><br />Copyright 2014, JAMPstudio.pl<br />Licensed only for trusted clients");
	} else
		echo("File not compiled. Something went wrong!");
}

?>