<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 
// Include config file
require_once "DataBase.php";
 
// Define variables and initialize with empty values
$nome = $email = $senha = "";
$nome_err = $senha_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if nome is empty
    if(empty(trim($_POST["nome"]))){
        $nome_err = "Entre com seu nome.";
    } else{
        $nome = trim($_POST["nome"]);
    }
    
    // Check if senha is empty
    if(empty(trim($_POST["senha"]))){
        $senha_err = "Entre com sua senha:";
    } else{
        $senha = trim($_POST["senha"]);
    }
    
    // Validate credentials
    if(empty($nome_err) && empty($senha_err)){
        // Prepare a select statement
        $sql = "SELECT id_aluno, nome, senha FROM tb_usuarios WHERE nome = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_nome);
            
            // Set parameters
            $param_nome = $nome;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Store result
                $stmt->store_result();
                
                // Check if nome exists, if yes then verify senha
                if($stmt->num_rows == 1){                    
                    // Bind result variables
                    $stmt->bind_result($id, $nome, $hashed_senha);
                    if($stmt->fetch()){
                        if(password_verify($senha, $hashed_senha)){
                            // senha is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["nome"] = $nome;                            
                            
                            // Redirect user to welcome page
                            header("location: menu.php");
                        } else{
                            // senha is not valid, display a generic error message
                            $login_err = "Invalid nome or senha.";
                        }
                    }
                } else{
                    // nome doesn't exist, display a generic error message
                    $login_err = "Invalid nome or senha.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Close connection
    $mysqli->close();
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>nome</label>
                <input type="text" name="nome" class="form-control <?php echo (!empty($nome_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nome; ?>">
                <span class="invalid-feedback"><?php echo $nome_err; ?></span>
            </div>    
            <div class="form-group">
                <label>senha</label>
                <input type="senha" name="senha" class="form-control <?php echo (!empty($senha_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $senha_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>
</body>
</html>