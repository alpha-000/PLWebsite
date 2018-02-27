<html>
<body>
  Welcome
</p>
  <?php
  $name = $_POST["username"];
  echo $name;
  $songs = fopen("songs.txt", "r") or die("Refresh browser");
  echo "<table>"."<tr>"
       ."<th>".'song'."<th>"
       ."<th>".'artist'."<th>"
       ."<th>".'album'."<th>"
       ."</tr>";
  while(!feof($songs)){
       list($s,$at,$ab) = explode(" ", fgets($songs));
        echo "<tr>"
        ."<td>".$s."<td>"
        ."<td>".$at."<td>"
        ."<td>".$ab."<td>"
        ."</tr>";
  }
    ".</table>"
  ?>

</body>
</html>
