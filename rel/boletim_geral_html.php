<?php 
require_once("../conexao.php"); 


$id_turma = $_GET['id_turma'];
$id_periodo = $_GET['id_periodo'];
$id_aluno = $_GET['id_aluno'];

$query = $pdo->query("SELECT * FROM alunos where id = '$id_aluno'  order by id asc ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_aluno = $res[0]['nome'];


$query = $pdo->query("SELECT * FROM periodos where id = '$id_periodo'  order by id asc ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

$nome_periodo = $res[0]['nome'];
$minimo_media = $res[0]['minimo_media'];
$total_pontos = $res[0]['total_pontos'];


$query_2 = $pdo->query("SELECT * FROM turmas where id = '$id_turma' ");
$res_2 = $query_2->fetchAll(PDO::FETCH_ASSOC);
$disciplina = $res_2[0]['disciplina'];
$horario = $res_2[0]['horario'];
$dia = $res_2[0]['dia'];
$ano = $res_2[0]['ano'];
$data_final = $res_2[0]['data_final'];
$data_inicio = $res_2[0]['data_inicio'];
$professor = $res_2[0]['professor'];

  

$query_resp = $pdo->query("SELECT * FROM disciplinas where id = '$disciplina' ");
$res_resp = $query_resp->fetchAll(PDO::FETCH_ASSOC);                    
$nome_disc = $res_resp[0]['nome'];


$query_resp = $pdo->query("SELECT * FROM professores where id = '$professor' ");
$res_resp = $query_resp->fetchAll(PDO::FETCH_ASSOC);                    
$nome_prof = $res_resp[0]['nome'];
$email_prof = $res_resp[0]['email'];
$imagem_prof = $res_resp[0]['foto'];


include('data_formatada.php');

//TOTALIZAR OS PERIODOS
$query = $pdo->query("SELECT * FROM periodos where turma = '$id_turma'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_periodos = @count($res);


//TOTALIZAR NOTA DO PERIODO
$total_notas = 0;
$query = $pdo->query("SELECT * FROM notas where periodo = '$id_periodo' and aluno = '$id_aluno' order by id asc ");
			$res = $query->fetchAll(PDO::FETCH_ASSOC);

			for ($i=0; $i < @count($res); $i++) { 
				foreach ($res[$i] as $key => $value) {
				}
				$descricao = $res[$i]['descricao'];
				$nota = $res[$i]['nota'];
				$nota_max = $res[$i]['nota_max'];
				
				
				$total_notas = $total_notas + $nota;

				
		
}


//CALCULAR A MÉDIA DE PONTOS NO TOTAL
$query = $pdo->query("SELECT * FROM modulos_turmas where turma = '$id_turma'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$tot_modulos = @count($res);
if($tot_modulos > 0){
	$total_notas = round($total_notas / $tot_modulos);
}


if($total_notas < $minimo_media){
					$classe_nota = 'corvermelha';
				}else{
					$classe_nota = 'corazul';
				}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Boletim por Período</title>
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

		hr{
			margin:8px;
			padding:1px;
		}

		.container{
			padding-left:50px;
			padding-right:50px;
		}

		.corazul{
			color:#4e81ed;
		}

		.corvermelha{
			color:#e3393e;
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
					<h2 class="titulo"><b><?php echo mb_strtoupper($nome_escola) ?></b></h2>
					<h6 class="subtitulo"><?php echo $endereco_escola . ' Tel: '.$telefone_escola  ?></h6>

				</div>
			</div>
		

	</div>

	<div class="container">

		<div class="row">
			<div class="col-sm-4 esquerda">	
				<big> Aluno <?php echo $nome_aluno ?>  </big>
			</div>
			<div class="col-sm-8 direita" align="right">	
				<big> <small><small> Data: <?php echo $data_hoje; ?></small></small> </big>
			</div>
		</div>


		<hr>


		<br><br>
		
		<p class="subtitulo" align="center"><b>BOLETIM <?php echo mb_strtoupper($nome_disc) ?> </b></p>
		</span>
		<br><br><br>


	<?php if($total_periodos == 1){ ?>


<table class='table' width='100%'  cellspacing='0' cellpadding='3'>
			<tr bgcolor='#f9f9f9' >
				<th><b>Curso / Módulo</b></th>
				<th><b> </b></th>
				<th><b>Nota</b></th>
				

			</tr>
			<?php 
			
			
			$query = $pdo->query("SELECT * FROM modulos_turmas where turma = '$id_turma'  order by id asc ");
			$res = $query->fetchAll(PDO::FETCH_ASSOC);

			
			for ($i=0; $i < @count($res); $i++) { 
				foreach ($res[$i] as $key => $value) {
				}
				$classe = 'text-dark';
				$notas_modulo = 0;
				$modulo = $res[$i]['modulo'];
				$query3 = $pdo->query("SELECT * FROM modulos where id = '$modulo'  order by id asc ");
				$res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
				$nome_modulo = $res3[0]['nome'];

				$query2 = $pdo->query("SELECT * FROM notas where periodo = '$id_periodo' and aluno = '$id_aluno' and modulo = '$modulo'  order by id asc ");
				$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
				if(@count($res2) > 0){
					for ($i2=0; $i2 < @count($res2); $i2++) { 
						foreach ($res2[$i2] as $key => $value) {}

							$notas_modulo += $res2[$i2]['nota'];
							if($notas_modulo >= $minimo_media){
								$classe = 'corazul';
							}else{
								$classe = 'corvermelha';
							}

				}
					
				}else{
					$notas_modulo = 0;
				}
				
								
				?>

				<tr>
					<td>
						<?php echo $nome_modulo ?>
					</td>
					<td> - - - - - - - - - - - - - - - - - - - - - - - </td>
					
					<td class="<?php echo $classe ?>"><?php echo @$notas_modulo ?> </td>


				</tr>
			<?php } ?>



		</table>

	<?php }else{ ?>


		<table class='table' width='100%'  cellspacing='0' cellpadding='3'>
			<tr bgcolor='#f9f9f9' >
				<th><b>Curso / Módulo</b></th>
				<?php 

				$querype = $pdo->query("SELECT * FROM periodos where turma = '$id_turma' order by id asc ");
				$respe = $querype->fetchAll(PDO::FETCH_ASSOC);
				
					for ($ipe=0; $ipe < @count($respe); $ipe++) { 
						foreach ($respe[$ipe] as $key => $value) {}
							$nome_per = $respe[$ipe]['nome'];

							 ?>
				<th><b><?php echo $nome_per ?> </b></th>
			<?php } ?>
				<th><b>Nota Final</b></th>
				

			</tr>
			<?php 
			
			
			$query = $pdo->query("SELECT * FROM modulos_turmas where turma = '$id_turma'  order by id asc ");
			$res = $query->fetchAll(PDO::FETCH_ASSOC);

			
			for ($i=0; $i < @count($res); $i++) { 
				foreach ($res[$i] as $key => $value) {
				}
				$classe = 'text-dark';
				$notas_modulo = 0;
				$modulo = $res[$i]['modulo'];
				$query3 = $pdo->query("SELECT * FROM modulos where id = '$modulo'  order by id asc ");
				$res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
				$nome_modulo = $res3[0]['nome'];

				?>

				<tr>
					<td>
						<?php echo $nome_modulo ?>
					</td>
					<?php 


				$queryp = $pdo->query("SELECT * FROM periodos where turma = '$id_turma' order by id asc ");
				$resp = $queryp->fetchAll(PDO::FETCH_ASSOC);
				$nota_final = 0;
				
					for ($ip=0; $ip < @count($resp); $ip++) { 
						foreach ($resp[$ip] as $key => $value) {}
							$id_per = $resp[$ip]['id'];

						
				$query2 = $pdo->query("SELECT * FROM notas where periodo = '$id_per' and aluno = '$id_aluno' and modulo = '$modulo'  order by id asc ");
				$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
				$notas_modulo = 0;
				if(@count($res2) > 0){
					for ($i2=0; $i2 < @count($res2); $i2++) { 
						foreach ($res2[$i2] as $key => $value) {}
							$nota = $res2[$i2]['nota'];
							$notas_modulo += $nota;
							
							if($notas_modulo >= $minimo_media){
								$classe = 'corazul';
							}else{
								$classe = 'corvermelha';
							}

				}
					
				}else{
					$notas_modulo = 0;
				}
				
				$nota_final += $notas_modulo;

				if($nota_final >= $minimo_media){
								$classe_final = 'corazul';
							}else{
								$classe_final = 'corvermelha';
							}

								
				?>

				
					
					
					<td class="<?php echo $classe ?>"><?php echo @$notas_modulo ?> </td>

<?php } ?>
		<td class="<?php echo $classe_final ?>"> <?php echo $nota_final ?> </td>
				</tr>
			<?php }  ?>



		</table>


	<?php } ?>

		<hr>

		<br><br>

		<?php if($total_periodos == 1){ ?>
		<small><p align="center">Você obteve <span class="<?php echo $classe_nota ?>"><?php echo $total_notas ?> pontos</span> de <?php echo $total_pontos ?> pontos possíveis, a média para aprovação é de <?php echo $minimo_media ?> Pontos.</p></small>
		<?php }else{ ?>
		
		<?php } ?>

<br><br><br>
		
</div>
				<div class="footer">
		<p style="font-size:14px" align="center"><?php echo $rodape_relatorios ?></p> 
	</div>




				</body>
				</html>
