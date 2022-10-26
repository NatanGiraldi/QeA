<?php 

session_start();
    $materia = $_SESSION['materia'];

?>

<!DOCTYPE html>
<html lang="pt">
<head><meta charset="UTF-8"></head>
<body>
    <div> 

        <h2>Adicionar pergunta</h2>
        <h4>Disciplina: <?php print "$materia"; ?> </h4><br/>
        <label>Titulo:</label>

    </div>
</body>
</html>