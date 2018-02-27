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
  ?>
<h2>Lollipop Tunes</h2>
  <?php


  $songs = fopen("lollipop.txt", "r") or die("Refresh browser");
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
        ."<td>"."<button type = \"submit\"> purchase"."</button>"
        ."</tr>";
  } while(!feof($songs));
    echo ".</table>";
  ?>

<p>
<h2>Oreo Tunes</h2>
</p>
  <?php

$oreo_songs = fopen("oreo.txt", "r") or die("Refresh browser");
echo "<table>"."<tr>"
     ."<th>".'Song'."<th>"
     ."<th>".'Artist'."<th>"
     ."<th>".'Album'."<th>"
     ."<th>"."</th>"
     ."</tr>";
do {
      list($sa,$ata,$aba) = explode(" ", fgets($oreo_songs));
      if(strlen($sa) == 0)
        break;
      echo "<tr>"
      ."<td>".$sa."<td>"
      ."<td>".$ata."<td>"
      ."<td>".$aba."<td>"
      ."<td>"."<button type = \"submit\"> purchase"."</button>"
      ."</tr>";
} while(!feof($oreo_songs));
  echo ".</table>";
  $library = $_POST["username"]."library.txt";
  if(!file_exists($library)){
    $file =fopen($library, "w");
  }
    echo "<form action = my_playlist.php method= \"post\">"."<input type=\"hidden\" name=\"username\" value= \".$_POST[."username"]".\">"."<input type = \"submit\">"."</form>";
  ?>

</body>
</html>
