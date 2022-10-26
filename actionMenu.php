<html>
<head>
    <title>Menu de ação</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<form method = 'post'>
            <h4>Selecione a opção de ação</h4>
             
            <select name = 'acao[]' multiple size = 4> 
                <option value = 'resp'>Responder Perguntas</option>
                <option value = 'add'>Adicionar Pergunta</option>
                <option value = 'del'>Excluir pergunta</option>
                <option value = 'edit'>Editar pergunta</option>
            </select>
            <input type = 'submit' name = 'submit2' value = Continuar>
       </form>
</body>
</html>
<?php
session_start();
    // Check if form is submitted successfully
    if(isset($_POST["submit2"]))
    {
        // Check if any option is selected
        if(isset($_POST["acao"]))
        {
            // Retrieving each selected option
            foreach ($_POST['acao'] as $acao)
            
            switch ($acao){
                case "add":
                  header("location: operations\insertion.php");
                break;
                case "resp":
                  header("location: answer.php");
                break;
                case "del":
                  header("location: remove.php");
                break;
                case "edit":
                  header("location: editing.php");
                break;
                default:
                    echo "ERROR SWITCH CASE MENU";
                break;
              }
        }
    else
        echo "Selecione uma ação!";
    }

?>