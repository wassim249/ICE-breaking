<?php

include '../includes/modals/user.php';
include '../includes/connection.php';

$userImage = '';
session_start();
if (isset($_SESSION['currentUser']))
  $currentUser = unserialize($_SESSION['currentUser']);
else
  header('Location: ../login.php');


if (isset($_GET['id'])) {
  $req = getConnection()->prepare('SELECT * FROM users WHERE id= ?');
  $req->execute(array($_GET['id']));
  $user = $req->fetch();

  $userImage = $user['photo'];
} else {
  $userImage = $currentUser->image;
  echo $currentUser->firstName;
}

function profileImage($img)
{

  if (isset($_GET['id'])) {
    if ($img != '')
      echo "../images/" . $img;
    else
      echo "../images/" . 'default-profile-image.png';
  } else
    echo "./../images/" . $img;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./css/main.css?v=<?php echo time(); ?>" />
  <link rel="stylesheet" href="./css/profile.css?v=<?php echo time(); ?>" />
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

  <title>Document</title>
</head>

<body>
  <header>
    <nav>
      <div class="logo">ICE BREAKING</div>
      <div class="search-bar">
        <input type="search" name="" id="" placeholder="Rechercher un sujet..." />
      </div>
      <div class="profile">
        <i class="far fa-bell"></i>
      </div>
    </nav>
  </header>

  <section class="home">
    <div class="profile-details">

      <div class="image-container" style="background-image: url('<?php profileImage($userImage) ?>');">
        <?php
        if (!isset($_GET['id']))
          echo ' <div class="overlay">
         <form action="">
           <i class="fas fa-camera"></i>
         </form>
       </div>';

        ?>

      </div>

      <h4 class="full-name"><?php
                            if (isset($_GET['id']))
                              echo $user['nom'] . ' ' . $user['prenom'];
                            else
                              echo $currentUser->firstName . ' ' . $currentUser->lastName; ?>
      </h4>

      <div class="email">
        <i class="fas fa-envelope"></i>
        <span><?php
              if (isset($_GET['id']))
                echo $user['email'];
              else
                echo $currentUser->email; ?></span>
      </div>
      <?php if (!isset($_GET['id'])) {
        echo '  <button class="modify">Modifier le profil</button>
        <div class="logout">
          <i class="fas fa-sign-in-alt"></i>
          <span>Se déconnecter</span>
        </div>';
      }  ?>

    </div>

    <div id="myModal" class="modal">

      <!-- Modal content -->
      <div class="modal-content">
        <span class="close">&times;</span>
        <form action="" id="modify-profile-form">
          <h1>Modifier votre profile</h1>
          <div class="message"></div>
          <br>
          <input type="text" name="" id="firstName" placeholder="Modifier le nom" value="<?php

                                                                                          ?>">
          <input type="text" name="" id="lastName" placeholder="Modifier le prenom" value="<?php echo $currentUser->lastName; ?>">
          <input type="email" name="" id="email" placeholder="Modifier l'email" value="<?php echo $currentUser->email; ?>">
          <input type="password" name="" id="pwd" placeholder="Modifier le mot passe">
          <input type="password" name="" id="pwdConf" placeholder="Confirmation du mot passe">
          <input type="submit" class="modify" id="modify-profile" value="Modifier">
        </form>
      </div>

    </div>

    <div class="discussions-subjects">
      <div class="discussions">
        <h1>
          <?php
          if (isset($_GET['id']))
            echo 'Les discussions de ' . $user['nom'] . ' ' . $user['prenom'];
          else
            echo 'Votre discussion';
          ?>
        </h1>

        <div class="discussions-list">


        
        </div>
      </div>

      <div class="subjects">
        <h1>
        <?php
             if(isset($_GET['id'])) 
             echo 'Les sujets de ' . $user['nom'] . ' ' .$user['prenom'] ;
           else
            echo 'Votre sujets';
        ?>  
        
       </h1>
        <div class="topics">
        </div>
      </div>
    </div>
  </section>

  <script>
    $(document).ready(function() {
      $('#modify-profile-form').submit(e => {
        e.preventDefault();
        $('.message').load('includes/modify-profile.php', {
            firstName: $('#firstName').val(),
            lastName: $('#lastName').val(),
            email: $('#email').val(),
            pwd: $('#pwd').val(),
            pwdConf: $('#pwdConf').val()
          },
          (response) => {
            if (response == 'modification-success') modal.style.display = "none";
          })
      })

      $('.fa-camera').click(e => {
        var input = document.createElement('input');
        input.type = 'file';

        let file = null
        input.onchange = e => {
          file = e.target.files[0];

          let match = ['image/jpeg', 'image/jpg', 'image/png'];

          if (!(file.type == match[0] ||
              file.type == match[1] ||
              file.type == match[2])) {
            alert('Seulement JPEG , JPG & PNG')
            return false
          } else if (file.size > 5000000) {
            alert('le fichier est trés grand !')
            return false
          } else {
            console.log(file);
            var myFormData = new FormData();
            myFormData.append('pictureFile', file);
            $.ajax({
              url: 'includes/upload-image.php',
              type: 'POST',
              data: myFormData,
              cache: false,
              processData: false,
              contentType: false,
              success: response => {
                console.log('done');
              },
              complete: data => {
                window.location.href = './profile.php';
              }
            })
          }
        }
        input.click();
      })

      console.log(<?php echo $_GET['id']; ?>);

      $('.topics').load(
        'includes/get-subjects-for-user.php', {
          userId: <?php echo $_GET['id']; ?>
        },
        (response) => {
          if (response == 'no-subjects') {
            console.trace('add image later')
          }
        }
      )

      $('.discussions-list').load(
        'includes/get-discussion-for-user.php', {
          userId: <?php echo $_GET['id']; ?>
        },
        (response) => {
          if (response == 'no-subjects') {
            console.trace('add image later')
          }
        }
      )

      $('.logout').click(e => {
        $.ajax({
          url: 'includes/logout.php',
          type: 'POST',
          complete: data => {
            window.location.href = './../index.php';
          }
        })
      })


      // Get the modal
      var modal = document.getElementById("myModal");

      // Get the button that opens the modal
      var btn = document.querySelector(".modify");

      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("close")[0];

      // When the user clicks on the button, open the modal
      btn.onclick = function() {
        modal.style.display = "block";
      }

      // When the user clicks on <span> (x), close the modal
      span.onclick = function() {
        modal.style.display = "none";
      }

      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }
    });
  </script>

</body>

</html>