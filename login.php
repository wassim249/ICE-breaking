<!-- Page d'identification -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./css/login.css?v=<?php echo time(); ?>">
    <script src="//code.tidio.co/lf2zoxxvg8n9kzfqykb21xczwpmijivb.js" async></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <title>ICE BREAKING | Identification</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
</head>
<body>
    <header class="header">
        <nav>
            <div class="logo">ICE BREAKING</div>
            <div class="links">
                <ul class="link-list">
                    <li class="link-items"><a href="./index.php" id="">Acceuil</a></li>
                    <li class="link-items"><a href="./forum/index.php">Forum</a></li>
                    <li class="link-items"><a href="#">A propos</a></li>
                </ul>
            </div>
            <div class="btns">
                <button id="loginBtn" onclick="window.location.href = './login.php'">S'identifier</button>
                <button id="registerBtn" onclick="window.location.href = './register.php'">S'inscrire</button>
            </div>
        </nav>
    </header>
    <section class="main">
        <div class="section1">
            <form action="" class="login-form" id="loginForm">
                <h1>Identification</h1>
                <div class="message">
                </div>
                <input type="email" name="" id="email" class="email-value" placeholder="Adresse email...">
                <input type="password" name="" id="pwd" class="password-value" placeholder="Mot de passe">
                <input type="submit" value="S'identifier" class="login-submit">
                <a href="./register.php" class="already-registered">Deja inscrit ?</a>
            </form>
        </div>
    </section>
    <footer class="footer">
        <p>Developpé par: <a href="https://github.com/Wassim249">Wassim EL BAKKOURI</a></p>
    </footer>
    <script>
        $(document).ready(function() {

            $('#loginForm').submit((e) => {
                e.preventDefault()
                // appel a script d'identification
                $('.message').css('display', 'block')
                $('.message').load('includes/login.php', {
                    email: $('#email').val(),
                    pwd: $('#pwd').val()
                }, (response, status) => {
                    if (response == 'login-success') 
                        window.location.href = './forum/index.php'
                })
            })

            $('.logo').click(e=>window.location.href='./index.php')

            $(window).on("scroll", function() {
                if ($(window).scrollTop() > 50) 
                    $(".header").addClass("active-header");
                else 
                    $(".header").removeClass("active-header");
            })

            $(document).on("click", '#close-icon', e => {
                $('.message').css('display', 'none')
            })
        })
    </script>
</body>

</html>