<html>
<body>
<form method="get" action="store.php">
  <?php echo "<table>"."<tr>"
       ."<th>".'Song'."<th>"
       ."<th>".'Artist'."<th>"
       ."<th>".'Album'."<th>"
       ."<th>"."</th>"
       ."</tr>";
       $library = fopen($_POST["username"]."library.txt", "r");
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
  <p align="middle"><b>Buy More Songs!</b>
  <button type="submit">Go Back:</button>
  </p>
</form>
</body>
</html>
