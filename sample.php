<?php
///////////////////////////////////////////////////////////////////
//---- Reza Salehi
//---- zaalion@yahoo.com
//---- free for non-commercial use.
///////////////////////////////////////////////////////////////////

	//---- including class file.
	include("root_finder.class.php");
	//---- making new instance of object.
	$r=new root_finder($_POST["function_x"],$_POST["x_start"],$_POST["x_end"],$_POST["tolerance"],$_POST["step"]);	
	//---- call draw method of root_finder onject to get the result and digram.
	$r->draw();

///////////////////////////////////////////////////////////////////////
//---- if you are not interested in diagram and want to get an array of your f(x) roots,
//---- you can call class "find()" method of object. then by getting "roots" property you 
//---- have the roots .
//---- example :
//----  1: $r=new root_finder($_POST["function_x"],$_POST["x_start"],$_POST["x_end"],$_POST["tolerance"],$_POST["step"]);
//----  2: $r->find();
//----  3: for($i=0;$i<count($r->roots);$i++) print($r->roots[$i]."   ");
///////////////////////////////////////////////////////////////////////

?>