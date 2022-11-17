<html>
<body>
<div id="wrapper">
<?php
$correctAlternative = "0";
     $question = $alt1 = $alt2 = $alt3 = $alt4 = $altCorreta = $id_Discipline = "";
    $question_error = $alt1_error = $alt2_error = $alt3_error = $alt4_error = $altCorreta_error = "";
    $conn = new mysqli("localhost", "root", "", "QeA_Lab3_Teste_1");

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])){
        for($i=0;$i<count($_POST['id_pg_edit']);$i++){
            $row_no=$_POST['id_pg_edit'][$i];
        }
        $sqlGetQuestion = "SELECT * FROM tb_perguntas WHERE id_pg = $row_no";
        $selection = mysqli_query($conn, $sqlGetQuestion);
        /* ==== Tentativa de usar o mesmo que o insert
        if($stmt = $conn->prepare($sqlGetQuestion)){
            if($stmt->execute()){
                $stmt->store_result();
                $questionDisplay = $_POST['questao'];
            }
        }*/

    }

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['questao'])){

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
      //Após intensa analise, foi acordado que é impossivel associar o ID da questão assinalada no arquivo anterior (editing.php), com o parametro WHERE do UPDATE .
        if(empty($question_error) && empty($alt1_error) && empty($alt2_error) && empty($alt3_error) && empty($alt4_error)){
            $sqlInsertQuestion = "UPDATE tb_perguntas SET questao = ?, alternativa1 = ?, alternativa2 = ?, alternativa3 = ?, alternativa4 = ?, alt_correta = ?, id_disciplina = ? WHERE id_pg =$id_question2";
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
    }

?>
<form method="post">
<table cellpadding="10" border="1"> 
<?php

    while($row=mysqli_fetch_array($selection)){
        $id_question = $row['id_pg'];
        echo"<tr>";
        echo"<label>Alternativa 1:</label><br/>";
        echo"<textarea autofocus style='width: 450px; height: 70px;' name='questao' maxlength='400' id='questionText' value='<?php echo $question; ?> '> " . $row['questao'] . " </textarea>";
        echo"</tr>";
        echo "</div> <br/>";
        echo "<div>";
        echo "<h3>Digite as alternativas</h3>";
        echo "<label>Alternativa 1:</label><br/>";
        echo "<textarea name='alt1' id='alt1id' maxlength='100' value='<?php echo $alt1; ?> '>".$row['alternativa1']."</textarea><br/>";
        echo "<label>Alternativa 2:</label><br/>";
        echo "<textarea name='alt2' id='alt2id' maxlength='100' value='<?php echo $alt2; ?> '>".$row['alternativa2']."</textarea><br/>";
        echo "<label>Alternativa 3:</label><br/>";
        echo "<textarea name='alt3' id='alt3id' maxlength='100' value='<?php echo $alt3; ?> '>".$row['alternativa3']."</textarea><br/>";
        echo "<label>Alternativa 4:</label><br/>";
        echo "<textarea name='alt4' id='alt4id' maxlength='100' value='<?php echo $alt4; ?> '>".$row['alternativa4']."</textarea><br/>";
        echo "</div>";
        echo "<div>";
        echo "<h3>Selecione a alternativa correta para esta questão: </h3>";
        ?>
         <p> Alternativa Correta atual: <?php print $row['alt_correta'] ?> </p>
         <p> ASASJLDHAJSD: <?php print $id_question ?> </p>
        <?php
        echo "<p>";
        echo "<input type='radio' name='altCorreta' value='1'/> 1";
        echo "<input type='radio' name='altCorreta' value='2'/> 2";
        echo "<input type='radio' name='altCorreta' value='3'/> 3";
        echo "<input type='radio' name='altCorreta' value='4'/> 4";
               echo "</p>";
    }
?>
   </table></br>
   <input type="submit" value="Atualizar questão">
        </form>
        </div>
    </body>
    </html>

    