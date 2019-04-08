<?php
if(!$_SESSION['userId']){
	header("Location: ".$pathWeb);
}else{
	$_SESSION ['fechaMov'] = date("Y-m-d H:i:s");
}
?>