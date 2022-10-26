<html>
    <head>
    <title>Menu de materias</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
        <!--name.php to be called on form submission-->
        <form method = 'post' >
            <h4>Selecione a materia desejada</h4>
            <select name = 'materia[]' multiple size =4> 
                <option value = 'aoc'>Arquitetura e Organização</option>
                <option value = 'est'>Estatistica</option>
                <option value = 'otm'>Otimizacao de BD</option>
                <option value = 'fund'>Fundamentos de rede</option>
            </select>
            <input type = 'submit' name = 'submit1' value = Continuar>
        </form>
        
    </body>
</html>
<?php
session_start();
    // Check if form is submitted successfully
    if(isset($_POST["submit1"]))
    {
        // Check if any option is selected
        if(isset($_POST["materia"]))
        {
            header("location:  actionMenu.php");
            // Retrieving each selected option
            foreach ($_POST['materia'] as $materia)
                print "You selected $materia<br/>";
            $_SESSION['materia'] = $materia;
           
        }
        
    else
        echo "Selecione uma matéria!";
    }
    
?>