<?php
if(isset($_POST['removing']) && count($_POST['no']) > 0 ){
    session_start();
    $conn = new mysqli("localhost", "root", "", "QeA_Lab3_Teste_1");
    
    for($i=0;$i<count($_POST['no']);$i++)
{
 $row_no=$_POST['no'][$i];
 mysqli_query($conn, "DELETE FROM tb_perguntas where id_pg='$row_no'");
}
}
?>
<!DOCTYPE html>
<html lang="pt">
<body>
    <h2>Remoção bem sucedida!</h2>
    <p>Clique aqui para voltar ao menu inicial: <a href="../disciplinesMenu.php">Voltar</a>.</p>
    <p>Clique aqui para realizar outra remoção: <a href="../remove.php">Remover</a>.</p>
</body>
</html>