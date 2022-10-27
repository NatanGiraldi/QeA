<?php 

session_start();
    $question = $alt1 = $alt2 = $alt3 = $alt4 = $altCorreta = $id_Discipline = "";
    $question_error = $alt1_error = $alt2_error = $alt3_error = $alt4_error = $altCorreta_error = "";
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
//function inserirQuestao($conn, $question, $materia, $dispMateria, $insertQuestion, $alt1, $alt2, $alt3, $alt4, $altCorreta){
    
   /* $sqlGETDisciplineID = "SELECT id_disciplina FROM tb_disciplinas WHERE disciplina = ?";
    $stmt = $conn->prepare($sqlGETDisciplineID);
    $stmt->bind_param("s", $dispMateria);
    $stmt->execute();
    $id_Discipline = $stmt->fetch();
    $stmt->close();
    */

if($_SERVER["REQUEST_METHOD"] == "POST"){
    

    if(empty(trim($_POST["questao"]))){
        $question_error = "Informe o enunciado da questao.";
    }else{
        $sqlQError = "SELECT id_pg FROM tb_perguntas WHERE questao = ?";
        if($stmt = $conn->prepare($sqlQError)){
            $stmt->bind_param("s", $paramQuestion);
            $paramQuestion = trim($_POST["questao"]);

            if($stmt->execute()){
                $stmt->store_result();
                if($stmt->num_rows == 1){
                    $question_error = "Questão ja inserida.";
                }else{
                    $question = trim($_POST["questao"]);
                }
            }
            $conn->next_result();
            $stmt->close();
        }
    }

    if(empty(trim($_POST["alt1"]))){
        $alt1_error = "Informe a alternativa 1.";
    }else{
        $alt1 = trim($_POST["alt1"]);
    }

    if(empty(trim($_POST["alt2"]))){
        $alt2_error = "Informe a alternativa 2.";
    }else{
        $alt2 = trim($_POST["alt2"]);
    }

    if(empty(trim($_POST["alt3"]))){
        $alt3_error = "Informe a alternativa 3.";
    }else{
        $alt3 = trim($_POST["alt3"]);
    }

    if(empty(trim($_POST["alt4"]))){
        $alt4_error = "Informe a alternativa 4.";
    }else{
        $alt4 = trim($_POST["alt4"]);
    }

  if(isset($_POST["altCorreta"])){
    $altCorreta = trim($_POST["altCorreta"]);
  }else{
    echo "ERRO NA ALTCORRETA!!!";
  }
  //$_POST["altCorreta"] = ( isset($_POST["altCorreta"]) ) ? $_POST["altCorreta"] : null;  

    if(empty($question_error) && empty($alt1_error) && empty($alt2_error) && empty($alt3_error) && empty($alt4_error)){
        $sqlInsertQuestion = "INSERT INTO tb_perguntas (questao, alternativa1, alternativa2, alternativa3, alternativa4, alt_correta, id_disciplina) VALUES (?, ?, ?, ?, ?, ?, ?)";

        if($stmt = $conn->prepare($sqlInsertQuestion)){
            $stmt->bind_param("sssssii", $insertQuestion, $in_alt1, $in_alt2, $in_alt3, $in_alt4, $in_altCorreta, $id_Discipline);
            
            $insertQuestion = $question;
            $in_alt1 = $alt1;
            $in_alt2 = $alt2;
            $in_alt3 = $alt3;
            $in_alt4 = $alt4;
            $in_altCorreta = $altCorreta;
            
           
            if($stmt->execute()){
                header("location: success.HTML");
            }
            $stmt->close();
        }

    }

    //SELECIONAR ID DA DISCIPLINA!!

    //n sei se isso será necessario:
   
}
//}
?>
<!DOCTYPE html>
<html lang="pt">
<head><meta charset="UTF-8"> 
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
        .button {
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
            font-size: 16px;
            margin: 4px 2px;
           background-color: #4CAF50;
        }
    </style>
</head>
<body>
    <div>
        <h2>Adicionar pergunta</h2>
        <h4>Disciplina: <?php print "$dispMateria"; ?> </h4><br/>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);
        ?>" method="post">
            <div>
                <label>Digite o enunciado da questão:</label><br/>
                    <textarea autofocus style="width: 450px; height: 70px;" name="questao" maxlength="200" id="questionText" value="<?php echo $question; ?> "> </textarea>
            </div> <br/>
            <div>
                <h3>Digite as alternativas</h3>
                    <label>Alternativa 1:</label><br/>
                    <textarea name="alt1" id="alt1id" maxlength="100" value="<?php echo $alt1; ?> "></textarea><br/>
                    <label>Alternativa 2:</label><br/>
                    <textarea name="alt2" id="alt2id" maxlength="100" value="<?php echo $alt2; ?> "></textarea><br/>
                    <label>Alternativa 3:</label><br/>
                    <textarea name="alt3" id="alt3id" maxlength="100" value="<?php echo $alt3; ?> "></textarea><br/>
                    <label>Alternativa 4:</label><br/>
                    <textarea name="alt4" id="alt4id" maxlength="100" value="<?php echo $alt4; ?> "></textarea><br/>
            </div>
            <div>
                <h3>Selecione a alternativa correta para esta questão:</h3>
            <p>
                <input type="radio" name="altCorreta" value="1"/> 1
                <input type="radio" name="altCorreta" value="2"/> 2
                <input type="radio" name="altCorreta" value="3"/> 3
                <input type="radio" name="altCorreta" value="4"/> 4
            </p>

            <input type="submit" value="Inserir questao">
                
            </div>
        </form>
    </div>
</body>
</html>

