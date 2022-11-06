<?php 
session_start();
    $idUser = $_SESSION['id'];
    $materia = $_SESSION['materia'];
    $conn = new mysqli("localhost", "root", "", "QeA_Lab3_Teste_1");
    $qStatement = $idQuestion = "";

    switch($materia){
        case "est":
            $dispMateria = "Estatistica";
            $id_Discipline = "2";
        break;
        case "aoc":
            $dispMateria = "Arquitetura e Organização de Computadores";
            $id_Discipline = "1";
        break;
        case "otm":
            $dispMateria = "Otimização de Banco de Dados";
            $id_Discipline = "4";
        break;
        case "fund":
            $dispMateria = "Fundamentos de Rede";
            $id_Discipline = "3";
        break;
        default:
            $dispMateria = "Erro: Nenhuma matéria selecionada!";
            $id_Discipline = "0";
        break;
    }

    $sqlQuestionID = "SELECT questao FROM tb_perguntas WHERE id_disciplina = $id_Discipline";
    
    $dados = mysqli_query($conn, $sqlQuestionID);
    $linha = mysqli_fetch_assoc($dados);
    $total = mysqli_num_rows($dados);
?>
<!-- https://www.devmedia.com.br/php-e-mysql-conectando-e-exibindo-dados-de-forma-rapida-dica/28526 -->
<!DOCTYPE html>
<html lang="pt">
<head><meta charset="UTF-8"> </head>
<body>
    <h1>Respondendo as questões</h1>

    <p>Teste - ID_ALuno: <?php print "$idUser"; ?> </p>
    <p>Teste - id_pg: <?php print "$idQuestion"; ?> </p>

    <h3>Teste de coleta de perguntas</h3>
    <?php

        if($total > 0){
            
            do{
    ?>  
            <p><?=$linha['questao']?> </p>
    <?php   
            }while($linha = mysqli_fetch_assoc($dados));
        }

    ?>
</body>
</html>
<?php mysqli_free_result($dados);
?>