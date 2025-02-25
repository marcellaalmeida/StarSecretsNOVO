<?php include("header.php"); ?>

<?php
    //Inclui o arquivo de conexão com o Banco de Dados
    include("conexaoBD.php");

    $listarNoticias = "SELECT * FROM Noticia ORDER BY data DESC"; //Seleciona todos os campos da tabela Noticias


    $res = mysqli_query($conn, $listarNoticias); //Executa o comando de listagem
    $totalNoticias = mysqli_num_rows($res); //Função para retornar a quantidade de registros da tabela

    if($totalNoticias > 0){
        $nomePagina = $_SERVER['SCRIPT_NAME']; // ou $_SERVER['PHP_SELF']
        $info_arquivo = pathinfo($nomePagina);
        $pagina = $info_arquivo['filename'];

        if($totalNoticias == 1){
            echo "<div class='alert alert-success text-center'><h4>Há <strong>$totalNoticias</strong> Noticias !</h4></div>";
        }
        else{
            echo "<div class='alert alert-success text-center'><h4>Há <strong>$totalNoticias</strong> Noticias !</h4></div>";
        }

        echo "
        <hr>";
            
        //Monta a tabela para exibir os registros encontrados
        echo "
        <div class='row'>";

            // Varre a tabela em busca de registros e armazena em um array
            //Enquanto houverem dados na linha da tabela, atribui o valor atual do array a uma variável
            while($registro = mysqli_fetch_assoc($res)){
                $fotoNoticia      = $registro["foto"];
                $tituloNoticia    = $registro["titulo"];
                $descricaoNoticia = $registro["conteudo"];
                $dataInicio     = $registro["data"];
                
                
                //Cria uma linha da tabela com os registros encontrados
                echo "
                <div class='col-4' style='margin-bottom:30px;'>
                    <div class='card' style='width:100%; height:100%;'>
                        <div class='card-body' style='height:100%'>
                            <img class='card-img-top' src='$fotoNoticia' alt='Foto de $tituloNoticia'>                         
                        </div>
                        <div class='card-body text-center'>
                            <h4 class='card-title'>$tituloNoticia</h4>
                            <h4 class='card-title'>Data: $dataInicio</h4>                         
                            <p class='card-text' style='white-space: normal;'>$descricaoNoticia</p>
                        </div>
                    </div>
                </div>
                ";
            }
        echo "</div>";
    }
    else{
        echo "<div class='alert alert-warning text-center'>Não há Noticias à registrados! <i class='bi bi-emoji-frown'></i></div>";
    }
      
?>

<?php include("footer.php"); ?>

?>