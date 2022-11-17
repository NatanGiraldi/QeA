<html>
<body>
<div id="wrapper">
<?php
    $question = $alt1 = $alt2 = $alt3 = $alt4 = $altCorreta = $id_Discipline = "";
    $question_error = $alt1_error = $alt2_error = $alt3_error = $alt4_error = $altCorreta_error = "";
    $conn = new mysqli("localhost", "root", "", "QeA_Lab3_Teste_1");

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        for($i=0;$i<count($_POST['no']);$i++){
            $row_no=$_POST['no'][$i];
        }
        $sqlGetQuestion = "SELECT * FROM tb_perguntas WHERE id_pg = $row_no";
        if($stmt = $conn->prepare($sqlGetQuestion)){
            if($stmt->execute()){
                $stmt->store_result();
                $questionDisplay = $_POST["questao"];
            }
        }

    }
?>
<form method="post">
<table cellpadding="10" border="1"> 
<?php
    while($row=mysqli_fetch_array($questionDisplay)){
        echo"<tr>";
            echo"<td>". $row['questao']."</td>";
        echo"</tr>";
    }
?>  
   </table></br>
        
        </form>
        </div>
    </body>
    </html>