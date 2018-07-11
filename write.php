<?php
	ob_start();
	session_start();
	require_once("./dbconfig.php");

	$No = $_GET['no'];

	if(isset($_SESSION['ID'])) {
		$ID = $_SESSION['ID'];
		$Password = $_SESSION['Password'];


	if(isset($No)) {
		$sql = "select title, content, id from table_board where no = '$No'";
		$result = $db->query($sql);
		$row = $result->fetch_assoc();
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Board_free | Youngjin</title>
	<link rel="stylesheet" hrel="./css/normalize.css" />
	<link rel="stylesheet" hrel="./css/board.css" />
</head>
<body>
	<article class="boardArticle">
		<h3>Board_free_write<h3>
		<div id="boardWrite">
			<form action="./write_update.php" method="post" enctype='multipart/form-data'>
				<table id="boardWrite">
					<tbody>
						<tr>
							<th scope="row"><label for="no">No</label></th>
							<td class="no">
						<?php
						if(isset($No)) {
							echo $No;
						?>
						<input type="hidden" name="no" id="no" value="<?=$No?>">
						<?php } ?>
					</td>
					</tr>
						<tr>
							<th scope="row"><label for="ID">ID</label></th>
							<td class="id">
								<?php
								if(isset($ID)) {
									echo $_SESSION['ID'];
								?>
								<input type="hidden" name="ID" id="ID" value="<?=$ID?>">
								<?php } ?>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="Password">Your ID's Password</label></th>
							<td class="password"><input type="hidden" name="Password" id="Password" value="<?=$Password;?>"></td>
						</tr>
						<tr>
							<th scope="row"><label for="Title">Title</label></th>
							<td class="title"><input type="text" name="Title" id="Title" value="<?php echo isset($row['title'])?$row['title']:null?>"></td>
						</tr>
						<tr>
							<th scope="row"><label for="Content">Content</label></th>
							<td class="content"><textarea name="Content" id="Content"><?php echo isset($row['content'])?$row['content']:null?></textarea></td>
						</tr>
					</tbody>
				</table>
				<div>
				<input type='file' name='file_upload' id="file_upload">

					</button>
					<!--//파일업로드 버튼 파일선택부분-->
				</div>
				<div class="btnset">
					<button type="submit" class="btnSubmit btn">
						<?php echo isset($No)?'Modify':'Write'?>
					</button>
					<a href="./index.php" class="btnList btn">List</a>
				</div>
			</form>
		</div>
	</article>
</body>
</html>

<?php
} else {
	?>
	<script>
	alert("Sorry, Need your ID. Please Login.");
	history.back();
	</script>
<?php } ?>
