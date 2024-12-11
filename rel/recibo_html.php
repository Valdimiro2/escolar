<?php 
include('../conexao.php');

include('data_formatada.php');

$data_atual = date('Y-m-d');

$id = $_GET['id'];


//BUSCAR AS INFORMAÇÕES DO PEDIDO
$query = $pdo->query("SELECT * from pgto_matriculas where id = '$id' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

$matricula = $res[0]['matricula'];
                  $valor = $res[0]['valor_pago'];
                  $data_venc = $res[0]['data_venc'];
                  $pago = $res[0]['pago'];
                  $id = $res[0]['id'];
                  $data_pgto = $res[0]['data_pgto'];
                  
                  $query_r = $pdo->query("SELECT * FROM matriculas where id = '$matricula' ");
                  $res_r = $query_r->fetchAll(PDO::FETCH_ASSOC);
                  $id_turma =  $res_r[0]['turma'];
                  $id_aluno =  $res_r[0]['aluno'];

                   $query_2 = $pdo->query("SELECT * FROM turmas where id = '$id_turma' ");
                    $res_2 = $query_2->fetchAll(PDO::FETCH_ASSOC);
                    $disciplina = $res_2[0]['disciplina'];


                    $query_2 = $pdo->query("SELECT * FROM disciplinas where id = '$disciplina' ");
                    $res_2 = $query_2->fetchAll(PDO::FETCH_ASSOC);
                    $nome_disciplina = $res_2[0]['nome'];

                    $query_2 = $pdo->query("SELECT * FROM alunos where id = '$id_aluno' ");
                    $res_2 = $query_2->fetchAll(PDO::FETCH_ASSOC);
                    $nome_aluno = $res_2[0]['nome'];
                    $cpf_aluno = $res_2[0]['cpf'];
                                       

                    $valor = number_format($valor, 2, ',', '.');
                    $data_venc = implode('/', array_reverse(explode('-', $data_venc)));
                    $data_pgto = implode('/', array_reverse(explode('-', $data_pgto)));

?>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

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


	</style>



<div class="printer-ticket">

<div class="row" style="padding:10px; border:1px solid #000; margin:5px">
<div class="col-6">
<b>Nº Recibo</b> <?php echo $id ?>
</div>
<div class="col-6" align="right">
<b>Valor</b> <?php echo $valor ?>
</div>
</div>

	
<br><br>


<div align="center" class="th title" ><big><b>Recibo de Pagamento</b></big></div>



<div style="margin:0px 20px" align='center'>Eu, <?php echo $nome_escola ?> recebi de <?php echo $nome_aluno ?> a quantia de <b> R$ <?php echo $valor ?></b> na data <?php echo $data_pgto ?> correspondente ao pagamento da Mensalidade com vencimento para <?php echo $data_venc ?> do curso <?php echo $nome_disciplina ?>! </div>

<div align="center" style="padding:10px">
	<div style="position:relative; top:60px;"><img src="../img/assinatura.png" width="300px"></div>
__________________________________________<br>
ASSINATURA
<br><br>
<small><?php echo mb_strtoupper($data_hoje) ?></small>
</div>

<br><br>

	<div  class="th" align="center">
		<small><?php echo $endereco_escola ?></small> <br />
		<small>Contato: <?php echo $telefone_escola ?> 
		<?php if($cnpj_escola != ""){echo ' / CNPJ '. @$cnpj_escola; } ?>
	</small>  
</div>

</div>
