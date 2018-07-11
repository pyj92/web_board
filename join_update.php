<?php

	require_once("./dbconfig.php");

	if(isset($_POST['ID']) and isset($_POST['Password']) and isset($_POST['Name'])){
		$ID = $_POST['ID'];
		$Password = $_POST['Password'];
		$Name = $_POST['Name'];

		$sql = "insert into table_user (id, password, name) values('$ID', password('$Password'), '$Name')";
		$result = $db->query($sql);
		$URL = "./index.php"
?>
<script>
alert("Welcome to my Board_free. Please Login.")
location.replace("<?php echo $URL?>");
</script>
<?php
	}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Board_free | Youngjin</title>
  </head>
  <body>

  </body>
</html>
