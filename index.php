<?php

$photos=array();
$mainPhotos=array();

function recoverFile($file)
{
	global $mainPhotos;
	
	$p="/(.*?)\_[0-9]{2}\_[0-9]{2}\_[0-9]{2}\_[0-9]{5}\.jpg/";
	preg_match($p,$file,$r);
	$name=$r[1];
	
	foreach($mainPhotos as $photo)
	{
		if(strpos($photo['name'],$name)!==false)
		{
			return $name.'.'.$photo['extension'];
		}
	}
	return false;
}

if(isset($_GET['file']))
{
	$file=$_GET['file'];
	$width=1080;
	$height=720;
	$file='file:///'.$_SERVER['DOCUMENT_ROOT'].$file;
?>
<center>
<object type="application/x-vlc-plugin" data="<?=$file;?>" width="<?=$width;?>" height="<?=$height;?>" id="video1">
     <param name="movie" value="<?=$file;?>"/>
     <embed type="application/x-vlc-plugin" name="video1" autoplay="yes" loop="no" volume="0" width="<?=$width;?>" height="<?=$height;?>" target="<?=$file;?>" />
     <a href="<?=$file;?>">If content doesn't get loaded: missing VLC plugin.</a>
</object>
</center>
<?php
	die();
}

if (!$gestor = opendir('thumbs')) {die('cant find thumbs directory');}

 
while (false !== ($photo = readdir($gestor))) 
{
	if($photo=='..' ||$photo=='.' ){continue;}
	
	//recover file extension
	if(substr($photo,-8)=='_TGP.jpg')
	{
		$r=explode('_TGP_',$photo);
		$mainPhotos[$photo]=array(
			'name'=>$photo,
			'extension'=>str_replace('_TGP.jpg','',$r[1]),
			);
	}else{
		$photos[]=$photo;
	}
    
}

shuffle($photos);

closedir($gestor);

?>
<html>
	<head>
		<title>simpleTGP</title>
		<style>
			body{
				font-family: verdana;
				font-size: 12px;
			}
			.video{
				border: 3px solid blue;
				width: 340px;
				margin: 10px;
				display: inline-block;
			}
			.video img{
				width: 340;
				height: 254;
			}
		</style>
	</head>
	<body>
		<center><h2>simpleTGP</h2> - <a href="<?='file:///'.$_SERVER['DOCUMENT_ROOT'];?>apache/ASTOP.BAT">Finish</a></center>
		<?php
		foreach($photos as $photo){			
		?>
		<div class="video">
			<a target="_blank" href="index.php?file=<?=recoverFile($photo);?>"><img src="thumbs/<?=$photo;?>"/></a>
		</div>
		<?php
		}
		?>
	</body>
</html>