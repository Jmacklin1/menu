<!Doctype html>
<html>

<head>

   <title></title>

</head>

<body>
   <?php

   $matrix= [];







print_r($_GET);
echo " <br><br>";
print_r($_GET["allergies"]);
echo " <br><br>";
print_r($_GET["diet"]);
echo " <br><br>";
$d=file_get_contents("file.json");
$d=json_decode($d,true);
print_r($d);
echo " <br><br>";
 $rest=[];
   // loop through rest
   foreach($d as $k => $o){
       $ar= false;
        $m=[];
       // loop through menu
        foreach($o["menu"] as $km => $om){

            $ga=true;
            $gd=false;
            // loop though allergies in each plate
            if(!empty($om["allergies"])){
                foreach($om["allergies"] as $ka => $oa){
                //if plate allergie matches user allergies return true
                if (in_array($oa, $_GET["allergies"]) ) {
                        $ga=false;
//
//                     echo $ga;
//                      echo $oa;
//                      echo $om["item"];
//                     echo "<br>";

               };
            };
            } else{
//                 echo $ga; echo "<br>";
            };

          if ($ga==true){
              foreach($om["diet"] as $kd => $od){
                  if (in_array($od, $_GET["diet"]) ) {
                      $gd=true;
                      echo $om["item"];
                      echo $gd;
                      echo " <br><br>";

                       if ($ga && $gd){
                           array_push($m,$km);
                       };

                  };


              };

          };

        };

        print_r($m);
       echo " <br><br>";
       echo count($m);
       echo " <br><br>";

       if ( count($m) > 0 ){
         // array_push($rest,$m);
              $rest[$k]=$m;
       };

   };

     print_r($rest);
           echo " <br><br>";

























        //loop through the data to create dynamic html
        foreach($rest as $kr => $or){
            //for each object in our data, create a table row with table cells. in each table cell, concatenate values from the object we are looping through
            //echo '<tr>
                    //<td>'.++$k.'</td>
                    //<td>'.$o['name'].'</td>
                    //<td>'.$o['genre'].'</td>
                //</tr>';
           echo '
   <div>
       <h2>'.$d[$kr]['name'].'</h2>
       <p>' .$d[$kr]['add'].'</p>
       <p>'.$d[$kr]['phone'].'</p>

       <p>
       <b>menu</b>
       </p>
       <ul>';

           foreach($or as $kp => $op){

                       echo'<li>
                       '.$d[$kr]["menu"][$op]['item'].' <br>
               '.$d[$kr]["menu"][$op]['price'].' <br>
                '.$d[$kr]["menu"][$op]['description'].'</li>
               ';






           };

       echo '</ul>


   </div>';
        }





?>






</body>







</html>