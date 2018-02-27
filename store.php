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

</body>
</html>
