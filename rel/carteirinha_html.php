<?php 
include('../conexao.php');

include('data_formatada.php');

$data_atual = date('Y-m-d');
$ano_atual = Date('Y');

$id = $_GET['id'];


//BUSCAR AS INFORMAÇÕES DO PEDIDO
$query = $pdo->query("SELECT * from alunos where id = '$id' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

    $nome = $res[0]['nome'];
                      $telefone = $res[0]['telefone'];
                      $email = $res[0]['email'];
                      $endereco = $res[0]['endereco'];
                      $cpf = $res[0]['cpf'];
                      $foto = $res[0]['foto'];
                     

                     $data_nasc = $res[0]['data_nascimento'];
                    $sexo = $res[0]['sexo'];
                    $responsavel = $res[0]['responsavel'];

                    $query_resp = $pdo->query("SELECT * FROM responsaveis where cpf = '$responsavel' ");
                    $res_resp = $query_resp->fetchAll(PDO::FETCH_ASSOC);
                    $nome_resp = @$res_resp[0]['nome'];
                    $telefone_resp = @$res_resp[0]['telefone'];
                    $email_resp = @$res_resp[0]['email'];

                    $data_F = implode('/', array_reverse(explode('-', $data_nasc)));
                    
                    //CALCULAR IDADE
                    $date1 = $data_nasc;
                    $date2 = date('Y-m-d');
                    $diff = abs(strtotime($date2) - strtotime($date1));
                    $idade = floor($diff / (365*60*60*24));


?>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

<style>

		@page {
			margin: 0px;
			padding:0px;
		}

		
		.aluno{
			position:absolute;
			top:133px;
			left:190px;
			color:#FFF;
			font-size: 15px;
		}

		.foto_aluno{
			position:absolute;
			top:130px;
			left:50px;
			width:130px;
			height:170px;
			object-fit: fill;			
		}

		.cod{
			position:absolute;
			top:315px;
			left:55px;
			color:#FFF;
			font-size: 22px;
		}

		.ano{
			position:absolute;
			top:280px;
			left:440px;
			color:#FFF;
			font-size: 55px;
		}

		.qr-code{
  opacity: 0.5;
  display: flex;
  padding: 3px 3px;
  border-radius: 5px;
  align-items: center;
  pointer-events: none;
  justify-content: center; 
  position:absolute;
 top:65px;
 left:505px;
 background: #FFF;
}
.wrapper.active .qr-code{
  opacity: 1;
  pointer-events: auto;
  transition: opacity 0.5s 0.05s ease;
 
}
.qr-code img{
  width: 65px;
}

	</style>



<div>




<div class="aluno">

	<span><b><big><?php echo mb_strtoupper($nome) ?></big></b></span><br><br>
	<span>CPF: <?php echo mb_strtoupper($cpf) ?></span><br>
	<span>DATA DE NASC: <?php echo mb_strtoupper($data_F) ?></span><br>
	<span>IDADE: <?php echo $idade ?></span><br>
	<span>SEXO: <?php echo $sexo ?></span><br>
	<?php if($responsavel != ""){ ?>
		<span>RESPONSÁVEL: <?php echo mb_strtoupper($nome_resp) ?></span><br>
	<?php } ?>

</div>

<div class="cod">COD. USO: <?php echo $id ?></div>
<div class="ano"><b><?php echo $ano_atual ?></b></div>

<div class="wrapper">
            <div class="qr-code">
        <img src="" alt="qr-code">
      </div>
    </div>

  <img class="foto_aluno" src="../img/alunos/<?php echo $foto ?>" width="100%">  

<img src="../img/a4.jpg" width="1200px">

</div>


<script type="text/javascript">
	$(document).ready( function () {
    var id = '<?=$id?>';
    const wrapper = document.querySelector(".wrapper"),
    qrImg = wrapper.querySelector(".qr-code img");    
    qrImg.src = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${id}`;
    qrImg.addEventListener("load", () => {
        wrapper.classList.add("active");        
    });
});


</script>