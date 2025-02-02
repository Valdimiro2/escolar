<?php 
require_once("../conexao.php"); 
$saldoF = 0;

include('data_formatada.php');

$dataInicial = $_GET['dataInicial'];
$dataFinal = $_GET['dataFinal'];


$dataInicialF = implode('/', array_reverse(explode('-', $dataInicial)));
$dataFinalF = implode('/', array_reverse(explode('-', $dataFinal)));


if($dataInicial != $dataFinal){
	$apuracao = $dataInicialF. ' até '. $dataFinalF;
}else{
	$apuracao = $dataInicialF;
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Relatório de Inadimplência</title>
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
				<div class="col-sm-10 esquerda_float">	
					<h2 class="titulo"><b><?php echo strtoupper($nome_escola) ?></b></h2>
					<h6 class="subtitulo"><?php echo $endereco_escola . ' Tel: '.$telefone_escola  ?></h6>

				</div>
			</div>
		

	</div>

	<div class="container">

		<div class="row">
			<div class="col-sm-8 esquerda">	
				<span class="titulorel">Relatório Inadimplência </span>
			</div>
			<div class="col-sm-4 direita" align="right">	
				<big> <small> Data: <?php echo $data_hoje; ?></small> </big>
			</div>
		</div>


		<hr>


		<div class="row margem-superior">
			<div class="col-md-12">
				<div class="esquerda_float margem-direita50">	
					<span class=""> <b> Período da Apuração </b> </span>
				</div>
				<div class="esquerda_float margem-direita50">	
					<span class=""> <?php echo $apuracao ?> </span>
				</div>
				
			</div>
		</div>

		<hr>



<table class='table' width='100%'  cellspacing='0' cellpadding='3'>
			<tr bgcolor='#f9f9f9' >
				<th>Aluno</th>
				<th>Disciplina</th>
				<th>Valor</th>
				<th>Data Vencimento</th>
				

			</tr>
			<?php 
			$saldo = 0;
			
			$query = $pdo->query("SELECT * FROM pgto_matriculas where data_venc >= '$dataInicial' and data_venc <= '$dataFinal' and pago != 'Sim' order by data_venc asc, id asc");
					$res = $query->fetchAll(PDO::FETCH_ASSOC);
					
					for ($i=0; $i < @count($res); $i++) { 
						foreach ($res[$i] as $key => $value) {
						}
						$matricula = $res[$i]['matricula'];
						$valor = $res[$i]['valor'];
						
						$data_venc = $res[$i]['data_venc'];
						
						
						$saldo = $saldo + $valor;
						$saldoF = number_format($saldo, 2, ',', '.');
						
						$id = $res[$i]['id'];

						$query_usu = $pdo->query("SELECT * FROM matriculas where id = '$matricula'");
						$res_usu = $query_usu->fetchAll(PDO::FETCH_ASSOC);
						$turma = $res_usu[0]['turma'];
						$aluno = $res_usu[0]['aluno'];


						$query_usu = $pdo->query("SELECT * FROM alunos where id = '$aluno'");
						$res_usu = $query_usu->fetchAll(PDO::FETCH_ASSOC);
						$nome_aluno = $res_usu[0]['nome'];


						$query_usu = $pdo->query("SELECT * FROM turmas where id = '$turma'");
						$res_usu = $query_usu->fetchAll(PDO::FETCH_ASSOC);
						$disciplina = $res_usu[0]['disciplina'];

						$query_usu = $pdo->query("SELECT * FROM disciplinas where id = '$disciplina'");
						$res_usu = $query_usu->fetchAll(PDO::FETCH_ASSOC);
						$nome_disciplina = $res_usu[0]['nome'];
						



						$valorF = number_format($valor, 2, ',', '.');
						$data_venc = implode('/', array_reverse(explode('-', $data_venc)));
						
				?>

				<tr>
					
					<td><?php echo $nome_aluno ?> </td>
					
					<td><?php echo $nome_disciplina ?> </td>
					<td>R$ <?php echo $valorF ?> </td>
					<td><?php echo $data_venc ?> </td>
					


				</tr>
			<?php } ?>



		</table>

		<hr>


		<div class="row margem-superior">
			<div class="col-md-12">
				<div class="" align="right">
								
					<span class="areaTotal"> <b> Total : R$ <?php echo $saldoF ?> </b> </span>
				</div>

			</div>
		</div>

		<hr>


	</div>


				<div class="footer">
		<p style="font-size:14px" align="center"><?php echo $rodape_relatorios ?></p> 
	</div>




				</body>
				</html>
