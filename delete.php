<?php
	ob_start();
	session_start();
	require_once("./dbconfig.php");
echo "1";
 
	if(isset($_SESSION['ID'])){
	//$_GET['no']이 있어야만 글삭제가 가능함.
	if(isset($_GET['no'])) {
		$No = $_GET['no'];
		$Password = $_SESSION['Password'];
	}
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
	<article class="boardArticle">
		<h3>Board_free_delete</h3>
		<?php
			if(isset($No)) {
				$sql = 'select count(no) as cnt from table_board where no = ' . $No;
				$result = $db->query($sql);
				$row = $result->fetch_assoc();
				if(empty($row['cnt'])) {
		?>
		<script>
			alert('do not exist');
			history.back();
		</script>
		<?php
			exit;
				}

				$sql = 'select title from table_board where no = ' . $No;
				$result = $db->query($sql);
				$row = $result->fetch_assoc();
		?>
		<div id="boardDelete">
			<form action="./delete_update.php" method="post">
				<input type="hidden" name="no" value="<?php echo $No?>">
				<table>
					<thead>
						<tr>
							<th scope="col" colspan="2">Delete</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th scope="row">Title</th>
							<td><?php echo $row['title']?></td>
						</tr>
					</tbody>
				</table>
				<label for="Password">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp정말로 삭제하시겠습니까?</label>
				<td><input type="hidden" name="Password" id="Password" value="<?=$Password;?>"></td>
				<div class="btnSet">
					<button type="submit" class="btnSubmit btn">Delete</button>
					<a href="./index.php" class="btnList btn">List</a>
				</div>
			</form>
		</div>
	<?php
		//$no이 없다면 삭제 실패
		} else {
	?>
		<script>
			alert('Please use the normal route.');
			history.back();
		</script>
	<?php
			exit;
		}
	?>
	</article>
</body>
</html>

<?php } else {
	 ?>
	 <script>
	 alert("Sorry, Need your ID. Please Login.");
	 history.back();
	 </script>
 <?php } ?>
