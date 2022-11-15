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

    $sqlQuestionID = "SELECT id_pg, questao FROM tb_perguntas WHERE id_disciplina = $id_Discipline";
    $selection = mysqli_query($conn, $sqlQuestionID);
    ?>
    <form method="post" action="Actions\removing.php">
    <table cellpadding="10" border="1">    
    <tr>
            <th>ID</th>
            <th>Enunciado</th>
        </tr>
        <?php
            while($row=mysqli_fetch_array($selection)){
                echo"<tr>";
                    echo "<td><input type='checkbox' name='no[]' value='".$row['id_pg']."'></td><td>".$row['questao']."</td>";
                echo"</tr>";
            }
        ?>
        </table></br>
        
        <input type="submit" name="removing" value="Remover Questao">
    </form>
    

    </div>
</body>
</html>