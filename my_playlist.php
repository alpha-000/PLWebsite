<html>
<body>
  <link rel="stylesheet" href="main.css">
  <?php
  echo "<table>"."<tr>"//Creates table
       ."<th>".'Song'."<th>"
       ."<th>".'Artist'."<th>"
       ."<th>".'Album'."<th>"
       ."<th>"."</th>"
       ."<th>"."</th>"
       ."<th>"."</th>"
       ."</tr>";
       $file = $_POST["openplay"]; //Creates file based off name passed to file
       $library = fopen(trim($file).".txt", "r") or die("error");
  do { //Populates playlist with information from current file
        list($s,$at,$ab) = explode(" ", fgets($library));
        if(preg_match("/[a-z]/i",$s)){
        echo "<tr>"
        ."<td>".$s."<td>"
        ."<td>".$at."<td>"
        ."<td>".$ab."<td>"
        ."<td>"."<button type = \"submit\"> play"."</button>"
        ."<td>"//Passes file name to refreshed website using hidden button and removes song
        ."<form action = \"my_playlist.php\" method = \"post\">"."<input type = \"hidden\" name = \"openplay\" value = \"$file\">"
        ."<button type = \"submit\" name = \"delete\" value = \"$s,$at,$ab\">remove"."</button>\n"."</form>"
        ."<td>"
        ."<td>"//Annotates current song name
        ."<form action = \"my_playlist.php\" method = \"post\">"."<input type = \"hidden\" name = \"openplay\" value = \"$file\">"."<input type = \"text\" name = \"annotate\">"."<button type = \"submit\" name = \"anname\" value = \"$s\">rename"."</button>\n"."</form>"
        ."<td>"
        ."</tr>";
      }
  } while(!feof($library));
    echo ".</table>";
    if (isset($_POST["delete"])){//Creates logic for removal
      $library = fopen(trim($file).".txt", "r") or die("error");
      $deletion = $_POST["delete"];
      $deletion2 = substr($_POST["delete"],0,-2);
      $listcontents;
        while(!feof($library)){//Fills listcontents with current file contents
          $curr = fgets($library);
            $listcontents = $listcontents.";".$curr;
        }
         $library = fopen(trim($file).".txt", "w+") or die("error");//Clears file
        $listcontents = substr($listcontents,0,-1);
        list($s,$at,$ab) = explode(",",$deletion);
        $listcontents = str_replace(";".$s." ".$at." ".$ab,"",$listcontents);//Gets rid of specified song
        $contents = explode(";", $listcontents);
         for($x = 1; $x < count($contents); $x++){//Repopulates file without song
           if(preg_match("/[a-z]/i",$contents[$x])){
             fwrite($library,$contents[$x]);
           }
          //echo $contents[$x]." ".strcmp($deletion,$contents[$x])." ";
        }
  		}


      if(isset($_POST["annotate"]) && isset($_POST["anname"])){//Creates logic for annotate
        $library = fopen(trim($file).".txt", "r") or die("error");
        $deletion = $_POST["anname"];
        $deletion2 = substr($_POST["anname"],0,-2);
        $listcontents;
          while(!feof($library)){//Fills listcontents with current file contents
            $curr = fgets($library);
              $listcontents = $listcontents.";".$curr;
          }
           $library = fopen(trim($file).".txt", "w+") or die("error");//clears file
          $listcontents = substr($listcontents,0,-1);
          list($s,$at,$ab) = explode(",",$deletion);
          $listcontents = str_replace(";".$s,";".trim($_POST['annotate']),$listcontents);//Replaces song name with new name
          $contents = explode(";", $listcontents);
           for($x = 1; $x < count($contents); $x++){
             if(preg_match("/[a-z]/i",$contents[$x])){//Repopulates file
               fwrite($library,$contents[$x]);
             }
          }
      }
    ?>
    <form method="post" action="store.php">
  <p align="middle"><b>Buy More Songs!</b>
  <button type="submit">Go Back:</button>
  </p>
</form>
</body>
</html>
