<!-- Page d'inscription -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ICE-BREAKING | Inscription</title>
    <link rel="stylesheet" href="./css/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./css/register.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <script src="//code.tidio.co/lf2zoxxvg8n9kzfqykb21xczwpmijivb.js" async></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <script src="./js/main.js"></script>

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
            <form action="" id="register-form">
                <h1>Inscription</h1>
                <div class="message">

                </div>
                <input type="text" name="" id="firstName" class="first-name-value" placeholder="Nom">
                <input type="texts" name="" id="lastName" class="last-name-value" placeholder="Prenom">
                <input type="email" name="" id="email" class="email-value" placeholder="Adresse email...">
                <input type="password" name="" id="pwd" class="password-value" placeholder="Le mot de passe">
                <input type="password" name="" id="pwd-conf" class="password-confirmation-value" placeholder="confirmation du mot passe">
                <input type="submit" value="S'inscrire" class="register-submit">
                <a href="./login.php" class="new-user">Ancien utilisateur ?</a>
            </form>
        </div>

    </section>

    <footer class="footer">
        <p>Developpé par: <a href="https://github.com/Wassim249">Wassim EL BAKKOURI</a></p>
    </footer>

    <script>
        $(document).ready(function() {
            $('#register-form').submit((e) => {
                e.preventDefault()
                $('.message').css('display', 'block')
                // appel a le script d'inscription
                $('.message').load('includes/register.php', {
                    firstName: $('#firstName').val(),
                    lastName: $('#lastName').val(),
                    email: $('#email').val(),
                    pwd: $('#pwd').val(),
                    pwdConf: $('#pwd-conf').val()
                }, (response) => {
                    if (response == 'register-success') 
                        window.location.href = './forum/index.php'
                })
            })
            // click sur le logo
            $('.logo').click(e => window.location.href = './index.php')

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