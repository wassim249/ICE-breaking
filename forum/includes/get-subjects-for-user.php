<?php
    include '../../includes/connection.php';
    include '../../includes/modals/user.php' ;
    session_start() ;
    $currentUser = unserialize($_SESSION['currentUser']);


    function get_time_difference($created_time)
    {
           $str = strtotime($created_time);
           $today = strtotime(date('Y-m-d H:i:s'));
   
           // It returns the time difference in Seconds...
           $time_differnce = $today-$str;
   
           // To Calculate the time difference in Years...
           $years = 60*60*24*365;
   
           // To Calculate the time difference in Months...
           $months = 60*60*24*30;
   
           // To Calculate the time difference in Days...
           $days = 60*60*24;
   
           // To Calculate the time difference in Hours...
           $hours = 60*60;
   
           // To Calculate the time difference in Minutes...
           $minutes = 60;
   
           if(intval($time_differnce/$years) > 1)
           {
               return 'il y a ' . intval($time_differnce/$years)." années";
           }else if(intval($time_differnce/$years) > 0)
           {
               return 'il y a ' . intval($time_differnce/$years)." an";
           }else if(intval($time_differnce/$months) > 1)
           {
               return 'il y a ' . intval($time_differnce/$months)." mois";
           }else if(intval(($time_differnce/$months)) > 0)
           {
               return 'il y a ' . intval(($time_differnce/$months))." mois";
           }else if(intval(($time_differnce/$days)) > 1)
           {
               return 'il y a ' . intval(($time_differnce/$days))." jours";
           }else if (intval(($time_differnce/$days)) > 0) 
           {
               return 'il y a ' . intval(($time_differnce/$days))." jour";
           }else if (intval(($time_differnce/$hours)) > 1) 
           {
               return 'il y a ' . intval(($time_differnce/$hours))." heures";
           }else if (intval(($time_differnce/$hours)) > 0) 
           {
               return 'il y a ' . intval(($time_differnce/$hours))." heure";
           }else if (intval(($time_differnce/$minutes)) > 1) 
           {
               return 'il y a ' . intval(($time_differnce/$minutes))." minutes";
           }else if (intval(($time_differnce/$minutes)) > 0) 
           {
               return 'il y a ' . intval(($time_differnce/$minutes))." minute";
           }else if (intval(($time_differnce)) > 1) 
           {
               return 'il y a ' . intval(($time_differnce))." secondes";
           }else
           {
               return "il y a quelques secondes";
           }
     }
   

    if(!isset($_POST['userId'])) $userId = $currentUser->id ;
    else $userId = $_POST['userId'] ;

    $req = getConnection()->prepare('SELECT u.id as userId , u.nom , u.prenom  ,u.email , u.photo , s.id as subjectID ,s.titre , s.description , s.dateCreation 
    FROM users u , sujet s WHERE u.id = s.idCreator AND u.id = ? ORDER BY s.dateCreation DESC');
    $req->execute(array($userId)) ;

    while($subject = $req->fetch()) {
        $postcount = getConnection()->prepare('SELECT COUNT(*) as postcount FROM poste WHERE idSujet = ?');
        $postcount->execute(array($subject['subjectID'])) ;
        $postcountResult = $postcount->fetch() ;


       if(isset($subject['photo'])) $image =$subject['photo'] ;
        else  $image =  'default-profile-image.png' ;

 
        echo ' <div class="topic">
        <h1>'. $subject['titre'] .'</h1>
        <p>'. $subject['description'] .'</p>
        <hr />
        <div class="info">
          <div class="poster">
            <img src="../images/'. $image .'" alt="" />
            <span>Posté par : </span>
            <a href="profile.php?id='. $subject['userId'] .'" id="poster">'. $subject['nom'] . ' ' . $subject['prenom'] .'</a>
            <span> '. get_time_difference($subject['dateCreation']) .'</span>
          </div>
          <span id="comments"><i class="far fa-comments-alt"></i>'. $postcountResult['postcount'] .'</span>
        </div>
      </div>' ;
    }
?>