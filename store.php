<html>
<body>
  <link rel="stylesheet" href="main.css">
  <h3   color: #263238;>Welcome<h3>

    <form method="get" action="my_playlist.php">
      <p align="right" padding-top: "12px"
        padding-bottom: "12px"><b>My Playlist</b>
      <button type="submit">Go To:</button>
      </p>
  </form>

  <?php
  $name = $_POST["username"];
  echo $name.'!';
  function add(){
    list($si,$ati,$abi) = explode(", " , $_POST["buy"]);
    $library = fopen("library.txt","a+") or die("Refresh browser");
    $input = $si." ".$ati." ".$abi;
    $library = fwrite($library,$input);
  }
  function createFile($file){
    $songs = fopen($file, "r") or die("Refresh browser");
    echo "<table>"."<tr>"
         ."<th>".'Song'."<th>"
         ."<th>".'Artist'."<th>"
         ."<th>".'Album'."<th>"
         ."<th>"."</th>"
         ."</tr>";
    do {
          list($s,$at,$ab) = explode(" ", fgets($songs));
          if(strlen($s) == 0)
            break;
          echo "<tr>"
          ."<td>".$s."<td>"
          ."<td>".$at."<td>"
          ."<td>".$ab."<td>"
          ."<td>"
          ."<form action = \"store.php\" method = \"post\">"."<button type = \"submit\" name = \"buy\" value = \"$s, $at, $ab\">purchase"."</button>\n"."</form>"
          ."</tr>";
    } while(!feof($songs));
      echo ".</table>";
  }
  if (isset($_POST["buy"])){
    add();
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

</body>
</html>
