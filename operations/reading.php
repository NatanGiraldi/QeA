<html>
<body>
<div id="wrapper">

<?php 
session_start();
    $idUser = $_SESSION['id'];
    $materia = $_SESSION['materia'];
    $conn = new mysqli("localhost", "root", "", "QeA_Lab3_Teste_1");

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

    $sqlQuestionID = "SELECT * FROM tb_perguntas WHERE id_disciplina = $id_Discipline";
    $selection = mysqli_query($conn, $sqlQuestionID);
    ?>

    <h2>Questões relacionadas a materia de: <?php print "$dispMateria"; ?></h2>
    <form method="post" action="Actions\removing.php">
    <table cellpadding="10" border="1" >    
    <tr>
            <th>ID</th>
            <th>Enunciado</th>
            <th>Alternativa 1</th>
            <th>Alternativa 2</th>
            <th>Alternativa 3</th>
            <th>Alternativa 4</th>
            <th>Correção</th>
        </tr> 
        <?php
            while($row=mysqli_fetch_array($selection)){
                echo"<tr>";
                    echo "<td>".$row['id_pg']."</td><td width=250px>".$row['questao']."</td><td> 1). " . $row['alternativa1'] ."</td> <td> 2). " . $row['alternativa2'] ."</td> <td> 3). " . $row['alternativa3'] ."</td><td> 4). " . $row['alternativa4'] ."</td>  <td>" .$row['alt_correta'];
                echo"</tr>";
            }
        ?>
        </table></br>
        
    </form>
    <p>Clique aqui para voltar ao menu de ações: <a href="../actionMenu.php">Voltar</a>.</p>

    </div>
</body>
</html>