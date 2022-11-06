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
    
    $info = mysqli_query($conn, $sqlQuestionID);
    $lines = mysqli_fetch_assoc($info);
    /*if(isset($_POST["submit5"])){
        if(isset($_POST["id_pg"])){
            foreach ($_POST['id_pg'] as $IDquestionDel)
            do{
                echo "Você selecionou: $IDquestionDel";
            }while($lines = mysqli_fetch_assoc($info));
        }
    }else{
        echo "selecionaaaaaaa";
    }*/
   
?>
<!-- https://phppot.com/php/updatedelete-multiple-rows-using-php/ -->
<!DOCTYPE html>
<html lang="pt">
<head><meta charset="UTF-8"> <script language="javascript" src="function.js" type="text/javascript"></script>
</head>
<body>
    <h1>Removendo questões</h1>

    <p>Teste - ID_ALuno: <?php print "$idUser"; ?> </p>

    <h3>Teste de coleta de perguntas</h3>
    <form method='post'>
  
  <?php
    if(is_array($lines) || is_object($lines)) {
        foreach ($lines as $i => $value ){
            if ($i % 2 == 0)
                $classname = "evenRow";
            else
                $classname = "oddRow";
            ?>
    <tr class="<?php if(isset($classname)) echo $classname;?>" >
        <tb><input type="checkbox" name="questions[]" value="<?php echo $lines[$i]["id_pg"]; ?>"></tb>
        <tb><?php echo $lines[$i]["questao"]; ?></tb>
    </tr>
    <?php
        $i ++;
        }
    }
    /*
        if($total > 0){
            
            do{
    ?>      
            <label>Alternativa: </label>
            <input type="checkbox" value="id_pg[]"><?=$linha['id_pg']?> <?=$linha['questao']?><br/>
    <?php   
            }while($linha = mysqli_fetch_assoc($dados));
        }
    */
    ?>
    <!--<input  type="submit" name="submit5" value=Remover> -->
    <td colspan="4">
  <!--      <input type="button" name="update" value="Update" onClick="setUpdateAction();" /> -->
        <input type="button" name="delete" value="Delete" onClick="setDeleteAction();" />
    </td>
    </form>
</body>
</html>
<?php 
 
mysqli_free_result($info);
?>