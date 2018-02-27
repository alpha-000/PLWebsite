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
  if(!file_exists($name."library.txt"))
    fopen($name."library.txt", "w");
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
          ."<td>"."<button type = \"submit\" name=\"button\" value=$s,$at,$ab onclick = \"myFunction()\"> purchase"."</button>"
          ."</tr>";
    } while(!feof($songs));
      echo ".</table>";
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
    <form action = "my_playlist.php" method= "post"><input type="hidden" name="username2" value= $_POST["username"]>
      <input type = "submit"></form>
      <script>
      function myFunction() {
            <?php
              $myfiles = fopen($_POST["username"]."library.txt", "a+") or die("Unable to open file!");
              fwrite($myfiles,$button[0]." ".$button[1]." ".$button[2]."Test");
              ?>
      }
      </script>

</body>
</html>
