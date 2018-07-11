<?php
	require_once("./dbconfig.php");

	//$_POST['no']이 있을 때만 $no 선언
	if(isset($_POST['no'])) {
		$No = $_POST['no'];
	}

	$Password = $_POST['Password'];

//글 삭제
if(isset($No)) {
	//삭제 할 글의 비밀번호가 입력된 비밀번호와 맞는지 체크
	$sql = 'select count(password) as cnt from table_board where password=password("' . $Password . '") and no = ' . $No;
?>
	<script>
		alert('<?php echo $sql?>');
	</script>
<?php
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	//비밀번호가 맞다면 삭제 쿼리 작성
	if($row['cnt']) {
		$sql = 'delete from table_board where no = ' . $No;
	//틀리다면 메시지 출력 후 이전화면으로
	} else {
		$msg = "Fail query : Sorry, lt's not your writing.";
?>
		<script>
//			alert('<?php echo $sql?>');
			alert("<?php echo $msg?>");
		//history.back();
		location.replace("./view.php?no=<?php echo $No ?>");
		</script>
<?php
		exit;
	}
}

	$result = $db->query($sql);

//쿼리가 정상 실행 됐다면,
if($result) {
	$msg = 'Delete OK, Delete your writing.';
	$replaceURL = './';
} else {
	$msg = 'Delete failed, Please try again.';
?>
	<script>
		alert("<?php echo $msg?>");
		history.back();
	</script>
<?php
	exit;
}
?>
<script>
	alert("<?php echo $msg?>");
	location.replace("<?php echo $replaceURL?>");
</script>
