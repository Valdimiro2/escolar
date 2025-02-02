<?php 
require_once("../conexao.php"); 


$id_turma = $_GET['id_turma'];
$id_aluno = $_GET['id_aluno'];
$id_modulo = $_GET['id_modulo'];


//TOTALIZAR OS PERIODOS
$query = $pdo->query("SELECT * FROM periodos where turma = '$id_turma'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_periodos = @count($res);

$query = $pdo->query("SELECT * FROM alunos where id = '$id_aluno'  order by id asc ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_aluno = $res[0]['nome'];

$query = $pdo->query("SELECT * FROM modulos where id = '$id_modulo'  order by id asc ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_modulo = $res[0]['nome'];



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




//RECUPERAR NOTA DOS PERIODOS


        $query = $pdo->query("SELECT * FROM periodos where turma = '$id_turma' order by id asc ");
        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        $total_notas_curso = 0;
        for ($i=0; $i < count($res); $i++) { 
          foreach ($res[$i] as $key => $value) {
          }

          $nome = $res[$i]['nome'];
          $id_periodo = $res[$i]['id'];
          $minimo_media = $res[$i]['minimo_media'];


          //RECUPERAR AS NOTAS POR PERIODO
          $query_n = $pdo->query("SELECT * FROM notas where periodo = '$id_periodo' and aluno = '$id_aluno' and modulo = '$id_modulo'");
          $res_n = $query_n->fetchAll(PDO::FETCH_ASSOC);
          $total_notas_periodo = 0;
          
          for ($in=0; $in < count($res_n); $in++) { 
              foreach ($res_n[$in] as $key => $value) {
              }

              $total_notas_periodo = $total_notas_periodo + $res_n[$in]['nota'];

              

              if($total_notas_periodo < $minimo_media){
              $classe_nota2 = 'corvermelha';
              }else{
                $classe_nota2 = 'corazul';
              }


            }

            $total_notas_curso = $total_notas_curso + $total_notas_periodo;

            if($total_notas_curso < $media_pontos_minimo_aprovacao){
              $classe_nota = 'corvermelha';
            }else{
              $classe_nota = 'corazul';
            }
            
 

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Boletim Por Curso</title>
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
		
		<p class="subtitulo" align="center"><b>BOLETIM <?php echo mb_strtoupper($nome_modulo) ?>  -	<span class="<?php echo $classe_nota ?>"> <?php echo $total_notas_curso ?> 
		PONTOS</b></p>
		</span>
		<br><br><br>


<?php if($total_periodos == 1){ ?>
<table class='table' width='100%'  cellspacing='0' cellpadding='3'>
			<tr bgcolor='#f9f9f9' >
				<th><b>Descrição</b></th>
				<th><b>Nota</b></th>
				<th><b>Nota Possível</b></th>
				

			</tr>
			<?php 
			
			
          $query_n = $pdo->query("SELECT * FROM notas where periodo = '$id_periodo' and aluno = '$id_aluno' and modulo = '$id_modulo'");
          $res_n = $query_n->fetchAll(PDO::FETCH_ASSOC);
          $total_notas_periodo = 0;
          
          for ($in=0; $in < count($res_n); $in++) { 
              foreach ($res_n[$in] as $key => $value) {
              }

              $descricao = $res_n[$in]['descricao'];
              $nota_max = $res_n[$in]['nota_max'];
              $nota = $res_n[$in]['nota'];

              $total_notas_periodo = $total_notas_periodo + $nota;

              $media_nota = $nota_max * 0.60; 
              
              if($nota < $media_nota){
              $classe_nota2 = 'corvermelha';
              }else{
                $classe_nota2 = 'corazul';
              }

           								
				?>

				<tr>
					<td>
						<?php echo $descricao ?>
					</td>
					<td><span class="<?php echo $classe_nota2 ?>"><?php echo $nota ?></span> </td>
					
					<td><?php echo $nota_max ?> </td>


				</tr>

			<?php } ?>
			



		</table>

	<?php }else{ ?>

		<?php 

		$queryper = $pdo->query("SELECT * FROM periodos where turma = '$id_turma'");
		$resper = $queryper->fetchAll(PDO::FETCH_ASSOC);
		for ($iper=0; $iper < count($resper); $iper++) { 
              foreach ($resper[$iper] as $key => $value) {
              }
              $nome_period = $resper[$iper]['nome'];
              $id_period = $resper[$iper]['id'];
		 ?>

		
		<table class='table' width='100%'  cellspacing='0' cellpadding='3'>
			<tr bgcolor='#f9f9f9' >
				<th><b><?php echo $nome_period ?></b></th>
				<th><b>Nota</b></th>
				<th><b>Nota Possível</b></th>
				

			</tr>
			<?php 
			
			
          $query_n = $pdo->query("SELECT * FROM notas where periodo = '$id_period' and aluno = '$id_aluno' and modulo = '$id_modulo'");
          $res_n = $query_n->fetchAll(PDO::FETCH_ASSOC);
          $total_notas_periodo = 0;
          
          for ($in=0; $in < count($res_n); $in++) { 
              foreach ($res_n[$in] as $key => $value) {
              }

              $descricao = $res_n[$in]['descricao'];
              $nota_max = $res_n[$in]['nota_max'];
              $nota = $res_n[$in]['nota'];

              $total_notas_periodo = $total_notas_periodo + $nota;

              $media_nota = $nota_max * 0.60; 
              
              if($nota < $media_nota){
              $classe_nota2 = 'corvermelha';
              }else{
                $classe_nota2 = 'corazul';
              }

           								
				?>

				<tr>
					<td>
						<?php echo $descricao ?>
					</td>
					<td><span class="<?php echo $classe_nota2 ?>"><?php echo $nota ?></span> </td>
					
					<td><?php echo $nota_max ?> </td>


				</tr>

			<?php } ?>
			



		</table>

	<?php } } ?>

		<hr>

		<br><br>

		<?php if($total_notas_curso < $media_pontos_minimo_aprovacao){ ?>
		<small><p align="center">Você obteve <span class="<?php echo $classe_nota ?>"><?php echo $total_notas_curso ?> pontos! </span> Por enquanto você está <span class="<?php echo $classe_nota ?>">Reprovado</span>, pois o minímo de pontos para ser Aprovado é de <?php echo $media_pontos_minimo_aprovacao ?> Pontos</span> </p></small>
		<?php }else{ ?>
		<small><p align="center">Você obteve <span class="<?php echo $classe_nota ?>"><?php echo $total_notas_curso ?> pontos! </span> você está <span class="<?php echo $classe_nota ?>">Aprovado</span>, pois o minímo de pontos para ser Aprovado é de <?php echo $media_pontos_minimo_aprovacao ?> Pontos</span> </p></small>
		<?php } ?>

<br><br><br>
		
</div>
				<div class="footer">
		<p style="font-size:14px" align="center"><?php echo $rodape_relatorios ?></p> 
	</div>




				</body>
				</html>
