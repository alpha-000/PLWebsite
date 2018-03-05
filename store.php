<html>
<body>
  <link rel="stylesheet" href="main.css">
  <h3   color: #263238;>Welcome<h3>
  <?php
  $name = $_POST["username"];
  echo $name.'!';
  function add(){     //Adds song to specified playlist/file
    list($si,$ati,$abi) = explode(", " , $_POST["buy"]);
    $location = $_POST['addition'];
    $library = fopen($location.".txt","a+") or die("Refresh browser");
    $input = $si." ".$ati." ".$abi; //Specifies format for file
    $library = fwrite($library,$input);
  }
  function createFile($file){ //Creates table for available songs according to file specified
    $songs = fopen($file, "r") or die("Refresh browser");
    echo "<table>"."<tr>"     //Creates base for table
         ."<th>".'Song'."<th>"
         ."<th>".'Artist'."<th>"
         ."<th>".'Album'."<th>"
         ."<th>"."</th>"
         ."</tr>";
    do {                    //Populates table with file
          list($s,$at,$ab) = explode(" ", fgets($songs));
          if(strlen($s) == 0)
            break;
          echo "<tr>"
          ."<td>".$s."<td>"
          ."<td>".$at."<td>"
          ."<td>".$ab."<td>"
          ."<td>"             //adds button to help add purchased songs into specified playlist and refresh page
          ."<form action = \"store.php\" method = \"post\">"."<input type = \"text\" name =\"addition\">"."<button type = \"submit\" name = \"buy\" value = \"$s, $at, $ab\">purchase"."</button>\n"."</form>"
          ."</tr>";
    } while(!feof($songs));
      echo ".</table>";
  }
  function playlists($file){//Creates table for available playlists
    $songs = fopen($file, "r") or die("Refresh browser");
    $s = "library";
    echo "<table>"."<tr>"//Creates base for table
         ."<th>".'Playlists'."<th>"
         ."<th>"."<th>"
         ."<th>"."<th>"
         ."<th>"."<th>"
         ."</tr>"
         ."<tr>"
         ."<td>".$s."<td>"
         ."<td>"
         ."<form action = \"my_playlist.php\" method = \"post\">"."<button type = \"submit\" name = \"openplay\" value = \"$s\">open"."</button>\n"."</form>"
         ."<td>"
         ."<td>"
         ."<form action = \"store.php\" method = \"post\">"."<button type = \"submit\" name = \"deleteplay\" value = \"$s\">delete"."</button>\n"."</form>"
         ."<td>"
         ."</tr>";
    do {              //Populates table with playlists
          $s = fgets($songs);
          if((preg_match("/[a-z]/i",$s))){
              fopen(substr($s,0,-1).".txt","a");
          echo "<tr>"
          ."<td>".$s."<td>"
          ."<td>"//Creates button to open playlist and access my_playlist
          ."<form action = \"my_playlist.php\" method = \"post\">"."<button type = \"submit\" name = \"openplay\" value = \"$s\">open"."</button>\n"."</form>"
          ."<td>"
          ."<td>"//Creates button to delete playlist and refresh page
          ."<form action = \"store.php\" method = \"post\">"."<button type = \"submit\" name = \"deleteplay\" value = \"$s\">delete"."</button>\n"."</form>"
          ."<td>"
          ."<td>"//Creates button to rename file and pass information from previous file to new file
          ."<form action = \"store.php\" method = \"post\">"."<input type = \"text\" name = \"rname\">"."<button type = \"submit\" name = \"rename\" value = \"$s\">rename"."</button>\n"."</form>"
          ."<td>"
          ."</tr>";
        }
    } while(!feof($songs));
      echo ".</table>";
  }
  if (isset($_POST["buy"])){//Creates logic for purchase button
    add();
		}
    if (isset($_POST["deleteplay"])){//Creates logic for delete button for playlist
      $deletion = $_POST["deleteplay"];
      $deletion2 = substr($_POST["deleteplay"],0,-2);
      $list = fopen("playlists.txt","r");
      $listcontents;
        while(!feof($list)){  //populates listcontents with current file content
          $curr = fgets($list);
            $listcontents = $listcontents.";".$curr;
        }
        $list = fopen("playlists.txt","w+");//Overwrites file
        $listcontents = substr($listcontents,0,-1);
        $listcontents = str_replace(";"."$deletion2","",$listcontents);//Gets rid of specified playlist in file
        $contents = explode(";", $listcontents);
        for($x = 1; $x < count($contents); $x++){
          if(preg_match("/[a-z]/i",$contents[$x])){//Repopulates file
          fwrite($list,$contents[$x]);
          }
        }
  		}
  if (isset($_POST["createplay"]) && isset($_POST["playname"])){//Creates new playlist
      $playlistname = $_POST["playname"];
      $list = fopen("playlists.txt", "a+");
      fwrite($list, $playlistname."\n");//Adds playlist to the playlist file
      fclose($list);
  	}
  if(isset($_POST["rename"]) && isset($_POST["rname"])){//Creates logic for renaming playlist
    $deletion = $_POST["rename"];
    $deletion2 = substr($_POST["rename"],0,-2);
    $list = fopen("playlists.txt","r");
    $listcontents;
      while(!feof($list)){          //populates listcontents with current file content
        $curr = fgets($list);
          $listcontents = $listcontents.";".$curr;
      }
      $list = fopen("playlists.txt","w+");
      $listcontents = substr($listcontents,0,-1);
      $listcontents = str_replace(";"."$deletion2",";".$_POST['rname'],$listcontents);//Replaces current name with new name
      echo $listcontents;
      $contents = explode(";", $listcontents);
      for($x = 1; $x < count($contents); $x++){//Repopulates file with the new name
        if(preg_match("/[a-z]/i",$contents[$x])){
        fwrite($list,$contents[$x]);
      }
      $list2 = fopen(trim($deletion).".txt","r");
      $list3 = fopen(trim($_POST['rname']).".txt","w+");//Transfers file contents from previous file to the new playlists file
      while(!feof($list2)){
        $line = fgets($list2);
        fwrite($list3, $line);
      }
      }
  }
  ?>
<h2>Lollipop Tunes</h2>
  <?php
    createFile("lollipop.txt");
  ?>

<p>
<h2>Oreo Tunes</h2>
</p>
  <?php
  createFile("oreo.txt");
  ?>
  <p>
<h2>Playlists</h2>
</p>
  <?php
  playlists("playlists.txt");
  echo
  "<form action = \"store.php\" method = \"post\">"
  ."<input type = \"text\" name = \"playname\">"
  ."<button type = \"submit\" name = \"createplay\" value = \"$s\">create"."</button>\n"."</form>";
  ?>
</body>
</html>
