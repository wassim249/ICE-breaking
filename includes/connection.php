<?php
    function getConnection() {
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=ice-breaking;charset=utf8',
            'root', '');

            return $bdd ;
        } catch (Exception $e) {
           return null ;
        }
    }

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
?>