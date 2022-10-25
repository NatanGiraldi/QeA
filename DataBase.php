<?php
  /*
  define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    //connexão com o conn
    $conn = conni_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or
        die('Erro ao conectar!');
    //Criação do banco 
    //conni_query($conn , "CREATE DATABASE IF NOT EXISTS QeA_Lab3");
    //conexão com o banco criado
    $sql = "CREATE DATABASE IF NOT EXISTS QeA_Lab3";
    if ($conn->query($sql) === TRUE) {
        echo "Database created successfully with the name newDB";
    } else {
        echo "Error creating database: " . $conn->error;
    }
    */
    $servername = "localhost";
    $username = "root";
    $password = "";

    // Create connection
    $conn = new mysqli($servername, $username, $password);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    // Create database
    $sqlcreate = "CREATE DATABASE IF NOT EXISTS QeA_Lab3_Teste_1";
    if ($conn->query($sqlcreate) === TRUE) { 
    $conn = new mysqli($servername, $username, $password, "QeA_Lab3_Teste_1");
     } else {
    echo "Error creating database";
    }
    require_once "TBcreation.php";
    //definir boolean para que: Se for falso, abrir login normal, se for verdadeiro,
    //significa que o usuario clicou em registrar-se, ou seja
    require_once "login.php";
?>