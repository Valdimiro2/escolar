<?php 

require_once("../conexao.php"); 
@session_start();

$cpf_usuario = $_SESSION['cpf_usuario'];
$query = $pdo->query("SELECT * FROM alunos where cpf = '$cpf_usuario'  order by id asc ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_aluno = $res[0]['id'];


$id_turma = $_GET['id_turma'];
$id_modulo = $_GET['id_modulo'];

$html = file_get_contents($url."rel/boletim_modulo_html.php?id_turma=$id_turma&id_aluno=$id_aluno&id_modulo=$id_modulo");
echo $html;


?>