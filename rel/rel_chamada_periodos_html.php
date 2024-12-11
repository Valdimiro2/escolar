<?php 
require_once("../conexao.php"); 


include('data_formatada.php');

$periodo = @$_GET['periodo'];
$aula_get = @$_GET['aula'];
$modulo = @$_GET['modulo'];



$query2 = $pdo->query("SELECT * FROM periodos where id = '$periodo'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$nome_periodo = $res2[0]['nome'];
$turma = $res2[0]['turma'];


if($aula_get != ""){
$query2 = $pdo->query("SELECT * FROM chamadas where turma = '$turma' and aula = '$aula_get' ");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$data_chamada = @$res2[0]['data'];
$data_chamadaF = implode('/', array_reverse(explode('-', $data_chamada)));

$numero_aula = '';
$query3 = $pdo->query("SELECT * FROM aulas where turma = '$turma' and periodo = '$periodo' and modulo = '$modulo' order by id asc ");
$res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
for ($i3=0; $i3 < count($res3); $i3++) { 
	$id_aula = @$res3[$i3]['id'];	
	if($id_aula == $aula_get){
		$numero_aula = $i3;
	}
}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Demonstrativo de Chamada</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<style>

		@page {
			margin: 0px;

		}

		.footer {
			margin-top:20px;
			width:100%;
			background-color: #ebebeb;
			padding:10px;
			position:relative;
			bottom:0;
		}

		.cabecalho {    
			background-color: #ebebeb;
			padding:10px;
			margin-bottom:30px;
			width:100%;
			height:100px;
		}

		.titulo{
			margin:0;
			font-size:28px;
			font-family:Arial, Helvetica, sans-serif;
			color:#6e6d6d;

		}

		.subtitulo{
			margin:0;
			font-size:17px;
			font-family:Arial, Helvetica, sans-serif;
		}

		.areaTotais{
			border : 0.5px solid #bcbcbc;
			padding: 15px;
			border-radius: 5px;
			margin-right:25px;
			margin-left:25px;
			position:absolute;
			right:20;
		}

		.areaTotal{
			border : 0.5px solid #bcbcbc;
			padding: 15px;
			border-radius: 5px;
			margin-right:25px;
			margin-left:25px;
			background-color: #f9f9f9;
			margin-top:2px;
		}

		.pgto{
			margin:1px;
		}

		.fonte13{
			font-size:13px;
		}

		.esquerda{
			display:inline;
			width:50%;
			float:left;
		}

		.direita{
			display:inline;
			width:50%;
			float:right;
		}

		.table{
			padding:15px;
			font-family:Verdana, sans-serif;
			margin-top:20px;
		}

		.texto-tabela{
			font-size:12px;
		}


		.esquerda_float{

			margin-bottom:10px;
			float:left;
			display:inline;
		}


		.titulos{
			margin-top:10px;
		}

		.image{
			margin-top:-10px;
		}

		.margem-direita{
			margin-right: 80px;
		}

		.margem-direita50{
			margin-right: 50px;
		}

		hr{
			margin:8px;
			padding:1px;
		}


		.titulorel{
			margin:0;
			font-size:28px;
			font-family:Arial, Helvetica, sans-serif;
			color:#6e6d6d;

		}

		.margem-superior{
			margin-top:30px;
		}


	</style>


</head>
<body>


	<div class="cabecalho">
		
			<div class="row titulos">
				<div class="col-sm-2 esquerda_float image">	
					<img src="../img/logo.png" width="170px">
				</div>
				<div class="col-sm-8 esquerda_float">	
					<h2 class="titulo"><b><?php echo strtoupper($nome_escola) ?></b></h2>
					<h6 class="subtitulo"><?php echo $endereco_escola . ' Tel: '.$telefone_escola  ?></h6>

				</div>
				<div class="col-sm-2 image">	
					<a href="pdf_chamadas_class.php?periodo=<?php echo $periodo ?>&aula=<?php echo $aula_get ?>&modulo=<?php echo $modulo ?>" title="Gerar PDF"><img src="../img/pdf.png" width="80px"></a>
				</div>
			</div>
		

	</div>

	<div class="container">

		<div class="row">
			<div class="col-sm-8 esquerda">	
				<span class="titulorel"><small><small>Demonstrativo de Chamadas <?php echo $nome_periodo ?></small></small> </span>
			</div>
			<div class="col-sm-4 direita" align="right">	
				<big> <small> Data: <?php echo $data_hoje; ?></small> </big>
			</div>
		</div>


		<hr>

		<?php 
		if($aula_get != ""){
			$query3 = $pdo->query("SELECT * FROM aulas where id = '$aula_get' order by id asc ");
		}else{
			$query3 = $pdo->query("SELECT * FROM aulas where turma = '$turma' and periodo = '$periodo' and modulo = '$modulo' order by id asc ");
		}
		
$res3 = $query3->fetchAll(PDO::FETCH_ASSOC);

for ($i3=0; $i3 < count($res3); $i3++) { 
	
	$nome = $res3[$i3]['nome'];
	$descricao = $res3[$i3]['descricao'];	
	$id_aula = $res3[$i3]['id'];	

	if($aula_get == ""){
		echo '<b><u>Aula '. ($i3+1) . ' - '. $nome.'</u></b>';
	}else{
		echo '<b><u>Aula '. ($numero_aula+1) . ' - '.$nome.'</u></b> Data: '.$data_chamadaF;
	}

		 ?>
			
<small>
<table class='table' width='100%'  cellspacing='0' cellpadding='1'>
			<tr bgcolor='#f9f9f9' >
				<th>Aluno</th>
				<th>Email</th>
				<th>Presença / Falta</th>
				
			</tr>
			<?php 
			$query = $pdo->query("SELECT * FROM matriculas where turma = '$turma' order by id desc ");
                 $res = $query->fetchAll(PDO::FETCH_ASSOC);

                 for ($i=0; $i < count($res); $i++) { 
                  foreach ($res[$i] as $key => $value) {
                  }

                  $aluno = $res[$i]['aluno'];

                   $query_r = $pdo->query("SELECT * FROM alunos where id = '$aluno' order by nome asc");
                    $res_r = $query_r->fetchAll(PDO::FETCH_ASSOC);

                  $nome = $res_r[0]['nome'];
                  $telefone = $res_r[0]['telefone'];
                  $email = $res_r[0]['email'];
                  $endereco = $res_r[0]['endereco'];
                  $cpf = $res_r[0]['cpf'];
                  $foto = $res_r[0]['foto'];
                  $id_aluno = $res_r[0]['id'];


                   $query2 = $pdo->query("SELECT * FROM chamadas where turma = '$turma' and aluno = '$id_aluno' and aula = '$id_aula' ");
                  $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                  $presenca = $res2[0]['presenca'];

                  if($presenca == 'P'){
                    $classe_chamada = 'blue';
                    $presencaF = 'Presença';
                    
                  }else{
                    $classe_chamada = 'red';
                    $presencaF = 'falta';
                    
                  }

				?>

				<tr>
					
					<td><?php echo $nome ?> </td>
					<td><?php echo $email ?> </td>
					<td style="color:<?php echo $classe_chamada ?>"><?php echo $presencaF ?> </td>
					

				</tr>
			<?php } ?>



		</table>
		</small>
		<hr style="border-top:1px solid #505252; margin-bottom: 20px">


		<?php } ?>

		


	</div>


				<div class="footer">
		<p style="font-size:14px" align="center"><?php echo $rodape_relatorios ?></p> 
	</div>




				</body>
				</html>
