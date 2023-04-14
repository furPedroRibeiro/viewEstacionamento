    <?php 
        include('functions.php');
        session_start();
        if(isset($_POST['submit'])){
            loginUsuario($_POST['email'], $_POST['senha']);
        }
    ?>
    <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Login</title>
            <link rel="stylesheet" href="style.css">
        </head>
        <body>
            <main>
                <div class="boxLogin">
                    <form action="" method="post" id="form1">
                        <fieldset form="form1" name="login">
                            <p id="desc">Seja bem vindo á administração do nosso estacionamento, fique a vontade, esperamos que goste da experiência!!!!</p>
                            <legend>Login</legend>
                            <label for="email">Digite seu email:</label>
                            <input type="email" id="email"
                            name="email" placeholder="Ex.: usuario@gmail.com">
                            <label for="senha">Digite sua senha: </label>
                            <input type="password" id="senha" name="senha" placeholder="Ex.: 123Usuario-123">
                            <button type="submit" name="submit">Entrar</button>
                        </fieldset>
                    </form>
                </div>
            </main>
        </body>
    </html>