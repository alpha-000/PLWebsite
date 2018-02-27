<html>
<body>
  Welcome
  <?php
  $name = $_POST["username"];
  echo $name.'!';
  ?>

  <?php
  $songs = fopen("songs.txt", "r") or die("Refresh browser");
  echo "<table>"."<tr>"
       ."<th>".'song'."<th>"
       ."<th>".'artist'."<th>"
       ."<th>".'album'."<th>"
       ."<th>"."</th>"
       ."</tr>";
  while(!feof($songs)){
       list($s,$at,$ab) = explode(" ", fgets($songs));
        echo "<tr>"
        ."<td>".$s."<td>"
        ."<td>".$at."<td>"
        ."<td>".$ab."<td>"
        ."<td>"."<input type = \"submit\">"
        ."</tr>";
  }
    ".</table>"
  ?>

</body>
</html>
