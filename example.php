<?php
include 'run_query.php';

$sql = " SELECT id, text, option FROM mytable ";
/* run_query (query_mysql, option (1,2,3), debug 0=false 1=true) */
/*=============== OPTION 1 =====================*/
$rw  = run_query($sql,1,0);
echo $rw;
/*
{"data":[{"text":"Gr"},{"text":"Kgrs"},{"text":"Mg"},{"text":"Tn"}]}
*/

/*=============== OPTION 2 ARRAY + ERROR SI ESTA VACIO EL ARRAY =====================*/
$rw  = run_query($sql,2,0);
echo "<pre>";
print_r($rw);
echo "</pre>";
/*
Array
(
    [0] => Array
        (
            [text] => Gr
        )

    [1] => Array
        (
            [text] => Kgrs
        )

    [2] => Array
        (
            [text] => Mg
        )

    [3] => Array
        (
            [text] => Tn
        )

)
*/

/*=============== OPTION 3 ARRAY CON O SIN CONTENIDO =====================*/
$rw  = run_query($sql,3,0);
echo "<pre>";
print_r($rw);
echo "</pre>";
/*
Array
(
    [0] => Array
        (
            [text] => Gr
        )

    [1] => Array
        (
            [text] => Kgrs
        )

    [2] => Array
        (
            [text] => Mg
        )

    [3] => Array
        (
            [text] => Tn
        )

)
*/

/*=============== TRABAJANDO CON EL ARRAY =====================*/

$rw  = run_query($sql,3,0);

/*si deseo puede consultar si hay registros*/
if(count($rw)>=1){
	/*puedo utilizar un foreach para recorrer los registros*/
	foreach($rw as $id => $datos){
		echo $datos['id'];
		echo $datos['text'];
		echo $datos['option'];
	}
	
	/* si no me interesa el foreach puedo ir a la fila y columna deseada  */
	echo $rw[2]['text'];
}



?>
