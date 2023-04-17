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
            height: 80vh;

            background-color: var(--corPrimaria);

            border-radius: 20px;
        }
        .displayHeader{
            width: 85vw;
            height: 10vh;

            display: flex;
            align-items: center;
            justify-content: center;

            border-bottom: 1px solid var(--textColor);
        }
        .displayContent{
            width: 85vw;
            display: flex;
            align-items: center;
        }
        .sidebar{
            width: 15vw;
            height: 70vh;
            display: flex;
            flex-direction: column;

            border-right: 1px solid var(--textColor);
        }
        .nav{
            width: 70vw;
            height: 60vh;
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
                        <div class="item"><a href="">Visão geral</a></div>
                        <div class="item"><a href="">Funcionário</a></div>
                        <div class="item"><a href="">Cliente</a></div>
                        <div class="item" style="border: none;"><a href="">Carro</a></div>
                    </div>
                    <div class="nav">
                        <table>
                            <caption>Visão Geral</caption>
                            <thead>
                                <tr>
                                    <th scope="col">Cliente</th>
                                    <th scope="col">Tipo de vaga</th>
                                    <th scope="col">Carro</th>
                                    <th scope="col">Cor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    include('functions.php');
                                    $pp = 5;
                                    $sql = 'SELECT * FROM cliente';
                                    $res = $conn->query($sql);
                                    $total = $res->num_rows;
                                    $pgs = ceil($total/$pp);

                                    $atual = isset($_GET['pag']) ? $_GET['pag'] : 1;
                                    $atual = ($pp*$atual) - $pp;

                                    $sql = "SELECT * FROM cliente LIMIT $atual, $pp";
                                    $res = $conn->query($sql);

                                    while($c = $res->fetch_object()){
                                        echo '<tr>
                                                <td>'.
                                                    $c->idCliente.
                                                '</td>
                                                <td>'
                                                    .$c->nome.
                                                '</td>
                                             </tr>';
                                    }
                                    echo '<hr>';

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
                    </div>
            </div>
        </div>
    </div>
</body>
</html>