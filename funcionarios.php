<?php
    include('functions.php');
    if(isset($_POST['submitFunc'])){
        cadastrarFuncionario($_POST['nome'], $_POST['dtNasc'], $_POST['funcao'], $_POST['email'], $_POST['senha']);
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;

            color: var(--textColor);
            font-family: Arial, Helvetica, sans-serif;
        }
        :root{
            --corPrimaria: rgb(91, 87, 87);
            --corSecundaria: rgb(68, 67, 67);
            --textColor: aliceblue;
        }
        body{
            background-color: var(--corSecundaria);
        }
        .container{
            width: 100vw;
            height: 100vh;
            padding: 4rem;
            display: flex;
            align-items: center;
            justify-content: center;

        }
        .display{
            width: 85vw;
            height: 90vh;

            background-color: var(--corPrimaria);

            border-radius: 20px;
        }
        .displayHeader{
            width: 85vw;
            height: 7vh;

            display: flex;
            align-items: center;
            justify-content: center;

            border-bottom: 1px solid var(--textColor);
        }
        .displayContent{
            width: 90vw;
            display: flex;
            align-items: center;
        }
        .sidebar{
            width: 15vw;
            height: 83vh;
            display: flex;
            flex-direction: column;

            border-right: 1px solid var(--textColor);
        }
        .nav{
            width: 70vw;
            height: 83vh;
            display: flex;
            flex-direction: column-reverse;

            align-items: center;
            justify-content: center;
        }
        .paginacao{
            display: flex;
            gap:0.3rem;
        }
        .item{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 25%;
            border-bottom: 1px solid var(--textColor);
        }
        caption{
            margin-block: 1rem;
        }
        table{
            width: 80%;
            border: 1px solid var(--textColor);
            margin-block: 2rem;
        }
        th,td{
            border: 1px solid var(--textColor);
            text-align: center;
            padding: 0.5rem;
        }
        .form{
            display: flex;
            flex-direction: column;

            gap: 0.5rem;
        }
        input{
            outline: none;
            color: var(--corSecundaria);
        }
        input::placeholder{
            color: var(--corSecundaria);
        }
        button{
            height: 3rem;
            background-color: var(--corPrimaria);
            border: 1px solid var(--corSecundaria);
            cursor: pointer;
            transition: 1s;

            font-size: 18px;
        }
        button:hover{
            background-color: var(--textColor);
            color: var(--corSecundaria);
            border: 1px solid var(--corPrimaria);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="display">
            <div class="displayHeader">
                <h1>Estacionamento</h1>
            </div>
            <div class="displayContent">
                    <div class="sidebar">
                        <div class="item"><a href="home.php">Visão geral</a></div>
                        <div class="item"><a href="">Funcionário</a></div>
                        <div class="item"><a href="">Cliente</a></div>
                        <div class="item" style="border: none;"><a href="">Carro</a></div>
                    </div>
                    <div class="nav">
                        <table>
                            <caption>Funcionários</caption>
                            <thead>
                                <tr>
                                    <th scope="col">Cd funcionários</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Dt_nasc</th>
                                    <th scope="col">Função</th>
                                    <th scope="col">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $pp = 3;
                                    $sql = 'SELECT idFuncionario, substring_index(nome, "", 1) AS PrimeiroNome, substring_index(nome, "", -1) AS UltimoNome, dtnasc, função, email
                                    FROM funcionario';
                                    $res = $GLOBALS['conn']->query($sql);
                                    $total = $res->num_rows;
                                    $pgs = ceil($total/$pp);

                                    $atual = isset($_GET['pag']) ? $_GET['pag'] : 1;
                                    $atual = ($pp*$atual) - $pp;

                                    $sql = 'SELECT idFuncionario, substring_index(nome, " ", 1) AS PrimeiroNome, substring_index(nome, " ", -1) AS UltimoNome, dtnasc, função, email FROM funcionario LIMIT '.$atual.', '.$pp;
                                    $res = $GLOBALS['conn']->query($sql);

                                    while($func = $res->fetch_object()){
                                        echo '<tr>
                                                <td>'.
                                                    $func->idFuncionario.
                                                '</td>
                                                <td>'
                                                    .$func->PrimeiroNome.' '.$func->UltimoNome.
                                                '</td>
                                                <td>'
                                                    .$func->dtnasc.
                                                '</td>   
                                                <td>'
                                                    .$func->função.
                                                '</td>
                                                <td>'
                                                    .$func->email.
                                                '</td>  
                                               </tr>';
                                    }

                                    $atual = isset($_GET['pag']) ? $_GET['pag'] : 1;
                                    $inicio = ($atual-5) >=1 ? $atual-5 : 1;
                                    $fim = ($atual+5) <= $pgs ? $atual+5 : $pgs;
                                    echo '<div class="paginacao">';
                                    for($i = $inicio ; $i <= $fim ; $i++){
                                        $class = ($i == $atual) ? "atual" : "";
                                        echo '<a href="?pag='.$i.'" class="'.$class.'">'.$i.'</a>';
                                    }
                                    echo '</div>';
                                ?>
                            </tbody>
                        </table>
                        <form action="" method="post" class="form">
                            <legend><h1>Cadastrar Funcionário</h1></legend>
                            <label for="nome">Digite o nome do funcionário:</label>
                            <input type="text" id="nome" name="nome">
                            <label for="dtNasc">Data de nascimento:</label>
                            <input type="date" id="dtNasc" name="dtNasc">
                            <label for="funcao">Função:</label>
                            <input type="text" name="funcao" id="funcao">
                            <label for="email">Digite o email:</label>
                            <input type="email" name="email" id="email">
                            <label for="senha">Digite a senha:</label>
                            <input type="password" name="senha" id="senha">
                            <button type="submit" name="submitFunc">Cadastrar</button>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</body>
</html>