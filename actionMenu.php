<html>
<head>
    <title>Menu de ação</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<form method = 'post'>
            <h4>Selecione a opção de ação</h4>
             
            <select name = 'acao[]' multiple size = 5> 
                <option value = 'resp'>Responder Perguntas</option>
                <option value = 'add'>Adicionar Pergunta</option>
                <option value = 'del'>Excluir pergunta</option>
                <option value = 'edit'>Editar pergunta</option>
                <option value = 'read'>Mostrar Perguntas</option>
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
                  header("location: operations\answer.php");
                break;
                case "del":
                  header("location: operations\Remove.php");
                break;
                case "edit":
                  header("location: operations\Editing.php");
                break;
                case "read":
                  header("location: operations\Reading.php");
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