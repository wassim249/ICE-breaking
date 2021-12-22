<?php
include '../includes/modals/user.php';

session_start();
if (isset($_SESSION['currentUser']))
  $currentUser = unserialize($_SESSION['currentUser']);
else
  header('Location: ../login.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="./css/main.css?v=<?php echo time(); ?>" />
  <link rel="stylesheet" href="./css/index.css?v=<?php echo time(); ?>" />
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
  <script src="./js/main.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</head>

<body>
  <header>
    <nav>
      <div class="logo">ICE BREAKING</div>
      <div class="search-bar">
        <input type="search" name="" id="" placeholder="Rechercher un(e) ..." />
        <select name="" id="cmb-sujet-discussion">
          <option value="s">Sujet</option>
          <option value="d">Discussion</option>
        </select>
      </div>
      <div class="profile">
        <i class="far fa-bell"></i>
        <img src="<?php echo "./../images/" . $currentUser->image; ?>" alt="profile" />
        <span><?php echo $currentUser->firstName . ' ' . $currentUser->lastName;  ?></span>
      </div>
    </nav>
  </header>

  <section class="home">
    <div class="navigation">
      <span>MENU</span>
      <div class="menu-item active" id="menu-new">
        <i class="fas fa-chart-network" style="color : var(--primary)"></i>
        <h4>Nouveau</h4>
      </div>
      <div class="menu-item" id="menu-mySubjects">
        <i class="fas fa-bullseye-pointer" style="color: var(--secondary)"></i>
        <h4>Mes sujets</h4>
      </div>

      <div class="menu-item" id="menu-discussions">
        <i class="far fa-comments-alt" style="color: rgb(19, 202, 19)"></i>
        <h4>Les discussions</h4>
      </div>

      <div class="menu-item" id="menu-myDiscussions">
        <i class="far fa-comments-alt" style="color: rgb(19, 202, 19)"></i>
        <h4>Mes discussions</h4>
      </div>

      <div class="menu-item" id="add-discussion">
        + ajouter une discussion
      </div>

      <div class="menu-item" id="add-subject">+ ajouter un sujet</div>
    </div>
    <div class="topics">
      <div class="topic">
        <h1>Title title title</h1>
        <p>description description description description description</p>

        <hr />
        <div class="info">
          <div class="poster">
            <img src="././assets/images/profile-picture.jpg" alt="" />
            <span>Posté par : </span>
            <a href="#" id="poster">Wassim </a>
            <span> 12Hr ago</span>
          </div>
          <span id="comments"><i class="far fa-comments-alt"></i>50</span>
        </div>
      </div>

      <div class="topic">
        <h1>Title title title</h1>
        <p>description description description description description</p>
        <hr />
        <div class="info">
          <div class="poster">
            <img src="././assets/images/profile-picture.jpg" alt="" />
            <span>Posté par : </span>
            <a href="#" id="poster">Wassim </a>
            <span> 12Hr ago</span>
          </div>
          <span id="comments"><i class="far fa-comments-alt"></i>50</span>
        </div>
      </div>
    </div>
  </section>
  <script>
    $(document).ready(() => {
      $(window).on("scroll", function() {
        if ($(window).scrollTop() > 50) {
          $("header").addClass("active");
        } else {
          $("header").removeClass("active");
        }
      });

      const fillSubjects = (s) => {
        !s ? console.log('clicked ' + s) : console.log('nop');
        $('.topics').empty()
        $('.topics').load(
          'includes/get-subjects.php', {
            allsubjects: s ? 'y' : 'n'
          },
          (response) => {
            if (response == 'no-subjects') {
              console.trace('add image later')
            }
          }
        )
      }
      fillSubjects(true)

      const fillDiscussions = (d) => {
        $('.topics').empty()
        $('.topics').load(
          'includes/get-discussions.php', {
            alldiscussions: d ? 'y' : 'n'
          },
          (response) => {
            if (response == 'no-subjects') {
              console.trace('add image later')
            }
          }
        )
      }

      $('#menu-new').click(() => {
        $('#menu-mySubjects').removeClass('active')
        $('#menu-discussions').removeClass('active')
        $('#menu-myDiscussions').removeClass('active')
        $('#menu-new').addClass('active')
        fillSubjects(true)
      })
      $('#menu-mySubjects').click(() => {
        $('#menu-new').removeClass('active')
        $('#menu-discussions').removeClass('active')
        $('#menu-myDiscussions').removeClass('active')
        $('#menu-mySubjects').addClass('active')
        fillSubjects(false)
      } )
      $('#menu-discussions').click(() => {
        $('#menu-new').removeClass('active')
        $('#menu-mySubjects').removeClass('active')
        $('#menu-myDiscussions').removeClass('active')
        $('#menu-discussions').addClass('active')
        fillDiscussions(true)
      } )
      $('#menu-myDiscussions').click(() => {
        $('#menu-mySubjects').removeClass('active')
        $('#menu-discussions').removeClass('active')
        $('#menu-new').removeClass('active')
        $('#menu-myDiscussions').addClass('active')
        fillDiscussions(false)
      } )

    })
  </script>
</body>

</html>