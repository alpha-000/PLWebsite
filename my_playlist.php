<html>
<body>
  <?php
  echo $_POST["username2"];
  echo "<table>"."<tr>"
       ."<th>".'Song'."<th>"
       ."<th>".'Artist'."<th>"
       ."<th>".'Album'."<th>"
       ."<th>"."</th>"
       ."</tr>";
       $library = fopen($_POST["username2"]."library.txt", "r");
  do {
        list($s,$at,$ab) = explode(" ", fgets($library));
        if(strlen($s) == 0)
          break;
        echo "<tr>"
        ."<td>".$s."<td>"
        ."<td>".$at."<td>"
        ."<td>".$ab."<td>"
        ."<td>"."<button type = \"submit\"> play"."</button>"
        ."</tr>";
  } while(!feof($library));
    echo ".</table>";
    ?>
    <form method="post" action="store.php">
  <p align="middle"><b>Buy More Songs!</b>
  <button type="submit">Go Back:</button>
  </p>
</form>
</body>
</html>
