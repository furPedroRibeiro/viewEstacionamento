<?php
    $user = 'root';
    $pass = '';
    $banco = 'estacionamento';
    $server = 'localhost';
    $conn = new mysqli($server, $user, $pass, $banco);
    if(!$conn){
        echo 'Problema de conexão '.$conn->error;
    }

    //funções para efetuar usuário
    function messageLogin(){
        //declarando estilo e tag para mensagem de login efetuado
        echo '
            <style>
                #msgLogin{
                    background-color: green;
                    color: white;
                    width: 100%;
                    padding: 3rem;
                }
            </style>
            <p id="msgLogin">Login efetuado com sucesso, você será redirecionado em segundos!!!!</p>
        ';
    }

    function loginUsuario($email, $senha){
        $sql = 'SELECT * FROM funcionario WHERE email = "'.$email.'" AND senha = md5("'.$senha.'")';
        $res = $GLOBALS ['conn']->query($sql);

        if($res->num_rows > 0){
            messageLogin();
            echo '<meta http-equiv="refresh" content="5; URL= home.php"';
        }
    }
?>