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
     $materia = $_SESSION['materia'];
    // Check if form is submitted successfully
    if(isset($_POST["submit2"]))
    {
        // Check if any option is selected
        if(isset($_POST["acao"]))
        {
            // Retrieving each selected option
            foreach ($_POST['acao'] as $acao)
                print "Você selecionou a materia: $materia<br/>";
                print "Você selecionou a ação:    $acao<br/>";
        }
    else
        echo "Selecione uma ação!";
    }

?>