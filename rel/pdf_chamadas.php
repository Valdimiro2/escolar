<?php 
require_once("../conexao.php"); 

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));

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

<style>

@import url('https://fonts.cdnfonts.com/css/tw-cen-mt-condensed');
@page { margin: 145px 20px 25px 20px; }
#header { position: fixed; left: 0px; top: -110px; bottom: 100px; right: 0px; height: 35px; text-align: center; padding-bottom: 100px; }
#content {margin-top: 0px;}
#footer { position: fixed; left: 0px; bottom: -60px; right: 0px; height: 80px; }
#footer .page:after {content: counter(page, my-sec-counter);}
body {font-family: 'Tw Cen MT', sans-serif;}

.marca{
	position:fixed;
	left:50;
	top:130;
	width:80%;
	opacity:10%;
}

.text-danger{
	color:red;
}

.text-primary{
	color:blue;
}

</style>

</head>
<body>

<img class="marca" src="<?php echo $url ?>img/logo.jpg">	



<div id="header" >

	<div style="border-style: solid; font-size: 10px; height: 50px;">
		<table style="width: 100%; border: 0px solid #ccc;">
			<tr>
				<td style="border: 1px; solid #000; width: 20%; text-align: left;">
					<img style="margin-top: 0px; margin-left: 7px;" id="imag" src="<?php echo $url ?>img/logo.jpg" width="110px">
				</td>
				<td style="width: 20%; text-align: left; font-size: 13px;">
				
				</td>
				<td style="width: 5%; text-align: center; font-size: 13px;">
				
				</td>
				<td style="width: 55%; text-align: right; font-size: 9px;padding-right: 10px;">
						<b><big>DEMONSTRATIVO DE CHAMDAS <?php echo mb_strtoupper($nome_periodo) ?> </big></b><br>
						
						<br>
						 <?php echo mb_strtoupper($data_hoje) ?>
				</td>
			</tr>		
		</table>
	</div>

<br>


		
</div>

<div id="footer" class="row">
<hr style="margin-bottom: 0;">
	<table style="width:100%;">
		<tr style="width:100%;">
			<td style="width:60%; font-size: 10px; text-align: left;"><?php echo $nome_escola ?> / Telefone: <?php echo $telefone_escola ?> / Email: <?php echo $email_adm ?></td>
			<td style="width:40%; font-size: 10px; text-align: right;"><p class="page">Página  </p></td>
		</tr>
	</table>
</div>

<div id="content" style="margin-top: -30px;">



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
		echo '<span style="font-size:12px"><b><u>Aula '. ($i3+1) . ' - '. $nome.'</u></b></span>';
	}else{
		echo '<span style="font-size:12px"><b><u>Aula '. ($numero_aula+1) . ' - '.$nome.'</u></b> Data: '.$data_chamadaF.'</span>';
	}

		 ?>

	<table id="cabecalhotabela" style="border-bottom-style: solid; font-size: 9px; margin-bottom:10px; margin-top: 10px; width: 100%; table-layout: fixed; font-weight: bold">
			<thead>
				
				<tr id="cabeca" style="margin-left: 0px; background-color:#CCC">
					<td style="width:35%">ALUNO</td>
					<td style="width:35%">EMAIL</td>
					<td style="width:30%">PRESENÇA / FALTA</td>				
				</tr>
			</thead>
		</table>

		<table style="width: 100%; table-layout: fixed; font-size:8px; text-transform: uppercase;">
			<thead>
				<tbody>
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
<td style="width:35%;"><?php echo $nome ?></td>
<td style="width:35%"> <?php echo $email ?></td>
<td style="width:30%; color:<?php echo $classe_chamada ?>"><?php echo $presencaF ?></td>

    </tr>

<?php }  ?>
				</tbody>
	
			</thead>
		</table>

<hr style="border-top:1px solid #505252; margin-bottom: 20px">	
<?php }  ?>

</div>

		

</body>

</html>


