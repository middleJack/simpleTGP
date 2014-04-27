<?php

echo'<pre>';

$currentDir=$_SERVER['DOCUMENT_ROOT'];
$currentDir=substr_replace($currentDir ,"",-1);

if (!$gestor = opendir('./')) {die('Cant find video directory');}
 
while (false !== ($file = readdir($gestor))) 
{
	if($file=='..' ||$file=='.' || strpos($file,'.txt')==true  ||strpos($file,'.bat')==true  || strpos($file,'.php')==true || strpos($file,'.')!=true){continue;}
	
	$ext=substr(strrchr($file, '.'), 1);
	$file=trim($file);
	$command=escapeshellarg($currentDir.'/generator/mtn.exe').' '.escapeshellarg($currentDir.'/'.$file).' -O '.escapeshellarg($currentDir.'/thumbs/').' -P -W -i -I -o _TGP_'.$ext.'_TGP.jpg';
	//exec('cmd /c '.$command);
	
	echo $command.'<br>';
	$text.=$command."\n";
}
closedir($gestor);


$triki=fopen("generator.bat",'w');
fwrite($triki,$text);
fclose($triki);

//unlink('generator.bat');

echo'##end##';
?>