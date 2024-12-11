<?php 

require_once("../conexao.php"); 
@session_start();


$periodo = @$_GET['periodo'];
$aula = @$_GET['aula'];
$modulo = @$_GET['modulo'];

$html = file_get_contents($url."rel/rel_chamada_periodos_html.php?periodo=$periodo&aula=$aula&modulo=$modulo");
echo $html;



?>