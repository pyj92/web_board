<!--<? session_start(); ?>-->

<?php
	ob_start();
	session_start();
	require_once("./dbconfig.php");

	//$ID = $_POST['ID'];
	//$Password = $_POST['Password'];
	//$No = $_POST['no'];
/*	if(isset($ID)){
	$ID = $_POST['ID'];
	$Password = $_POST['Password'];
	echo $ID . $Password;
}*/
/*	if(isset($_POST['ID'])){
	$ID = $_POST['ID'];
	$Password = $_POST['Password'];
?>
<script>
	alert("<?php echo $ID . $Password?>");
</script>
<?php } ?>*/
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Board_free | Youngjin</title>
	<link rel="stylesheet" href="./css/normalize.css" />
	<link rel="stylesheet" href="./css/board.css" />
</head>
<body>
	<!--<form action="./write.php" method="post">-->
	<article class="boardArticle">
		<h3>Youngjin's Board</h3>
		<h4>
		<?php
		if(isset($_SESSION['ID'])){
			$ID = $_SESSION['ID'];
			echo "Welcome to my Board_free. All functions are available.  Hello $ID.";
		} else {
			echo "Welcome to my Board_free. You are guest. Please login.";
		}
		?>
	</h4>
		<div id="boardList">
			<div class="btnSet">
				<?php
				if(isset($_SESSION['ID'])){
					?>
					<a href="./logout.php">Logout</a>
					<a href="./write.php">Write</a>
				<?php
			} else {
				?>
				<a href="./main.php">Login</a>
				<a href="./join.php">Join</a>
				<?php
			}

			?>
			</div>
		<table>
		<thead>
			<tr>
				<th scope="col" class="no">Number</th>
				<th scope="col" class="title">Title</th>
				<th scope="col" class="id">Writer</th>
				<th scope="col" class="date">Date</th>
				<th scope="col" class="hit">Hit</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$sql = 'select * from table_board order by no DESC';
				$result = $db->query($sql);
				while($row = $result->fetch_assoc()) {
			?>
			<tr>
				<td class="no"><?php echo $row['no']?></td>
				<?php
					$titlelen = strlen($row['title']);
					if($titlelen==0){
				?>
				<td class="title"><a href="./view.php?no=<?php echo $row['no'] ?>" class="btnWrite btn">&nbsp</a></td>
				<?php
					} else {
				?>
				<td class="title">
					<script>
			      this.document.getElementById("loginValues").submit();
			    </script>
					<a href="./view.php?no=<?php echo $row['no'] ?>" class="btnWrite btn"><?php echo $row['title']?></a></td>
				<?php
					}
				?>
				<td class="id"><?php echo $row['id']?></td>
				<td class="date"><?php echo $row['date']?></td>
				<td class="hit"><?php echo $row['hit']?></td>
			</tr>
				<?php
					}
				?>
		</tbody>
		</table>
		</div>
		<!--<input type="submit" value="Write" />-->
	</article>
<!--</form>-->
</body>
</html>
