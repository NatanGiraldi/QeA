
<!DOCTYPE html> 
<html lang="pt">
    <head>
    <meta charset="UTF-8">
    <title>Menu de ação</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>    
    <div class="wrapper" >
    <h2>Opções</h2>
    <form>
        <div class="form-group">
            <h5><label>Escolha a materia da questao:</label></h5>
            <select class="form-control" nome = "materia" id="materia" multiple>
            <div>
                <option class="form-control" value="est">Estatistica</option></br>
            </div>
            <div>
                <option class="form-control" value="aoc">AOC</option></br>
            </div>
            <div>
                <option class="form-control" value="otim">Otimização de BD</option></br>
            </div>
            <div>
                <option class="form-control" value="nda">NAO LEMBRO</option></br>
            </div>
            </select>
        </div>
    </form>
    
    <form>
        <div class="form-group">
            <h5><label>Selecione a opção de ação:</label></h5>
            <select class="form-control" name = "acao" id="acao" multiple>
            <div>
                <option class="form-control" value="add">Adicionar Questao</option></br>
            </div>
            <div>
                <option class="form-control" value="resp">Responder Questao</option></br>
            </div>
            <div>
                <option class="form-control" value ="rem">Remover Questao</option></br>
            </div>
            <div>
                <option class="form-control" value="edit">Editar Qestao</option></br>
            </div>
            </select>
        </div>
    </form>
    </div>
    <form method="post">
        <input type="button" name="materia"
                value="Prosseguir"/>
    </form>
    <?php
       switch($_POST['materia']){
        case 'est':
            echo 'AAAAAAAAAAAAAAAA';
        break;
        case 'aoc':
            echo 'AAAAAAAAAAAAAAAA';
        break;
        case 'otim':
            echo 'AAAAAAAAAAAAAAAA';
        break;
        case 'nda':
            echo 'AAAAAAAAAAAAAAAA';
        break;
        default:
            echo 'deu merd';
        break;
       }
    ?>
    
</html>