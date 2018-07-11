<?php
	ob_start();
	session_start();
	require_once("./dbconfig.php");
if(isset($_SESSION['ID'])){
	$ID = $_SESSION['ID'];
	$Password = $_SESSION['Password'];

	//$_POST['no']이 있을 때만 $no 선언
	if(isset($_POST['no'])) {
		$No = $_POST['no'];
	}

	//no이 없다면(글 쓰기라면) 변수 선언
	if(empty($No)) {
		//$ID = $_POST['ID'];
		$date = date('Y-m-d H:i:s');
	}

	//항상 변수 선언
	//$Password = $_POST['Password'];
	$Title = $_POST['Title'];
	$Content = $_POST['Content'];
}
//글 수정
if(isset($No)) {
	//수정 할 글의 비밀번호가 입력된 비밀번호와 맞는지 체크
	$sql = "select count(password) as cnt from table_board where password=password('$Password') and no =$No";
?>
	<script>
		alert('<?php echo $sql?>');
	</script>
<?php
	$result = $db->query($sql);
	$row = $result->fetch_assoc();

	//비밀번호가 맞다면 업데이트 쿼리 작성 Modify부분
	if($row['cnt']) {
		$sql = "update table_board set title='$Title', content='$Content' where no=$No";
		$msgState = 'Modify';
	//틀리다면 메시지 출력 후 이전화면으로
	} else {
		$msg = "Fail query : Sorry, lt's not your writing.";
?>
		<script>
//			alert('<?php echo $sql?>');
			alert("<?php echo $msg?>");
			history.back();
		</script>
<?php
		exit;
	}

//글 등록
} else {
	$sql = "insert into table_board (no, title, content, date, hit, id, password) values(null, '$Title', '$Content', '$date', 0, '$ID', password('$Password'))";

	$msgState = 'Write';
}

//메시지가 없다면 (오류가 없다면)
if(empty($msg)) {
	$result = $db->query($sql);

	//쿼리가 정상 실행 됐다면,
	if($result) {
		$msg = $msgState . ' ok';
		if(empty($No)) {
			$No = $db->insert_id;
		}
		$replaceURL = './view.php?no=' . $No;
	} else {
		$msg = $msgState . ' Failed';
?>
		<script>
			alert("<?php echo $msg?>");

			history.back();
		</script>
<?php
		exit;
	}
}
?>

<!--파일 업로드-->
<?php
// 설정
$name = $_FILES['file_upload']['name'];
if($name){
	$dirRoot = $_SERVER["DOCUMENT_ROOT"];
	$file_date_dir = $No;

	if(is_dir($dirRoot."./uploadfile/".$file_date_dir)){
		//echo "폴더 존재 O";
	}else{
		//echo "폴더 존재 X";
		//윈도우에서 폴더 생성
		@mkdir($dirRoot."./uploadfile/".$file_date_dir, 0777);
		//리눅스에서 폴더 생성
		//system("mkdir ./uploadfile/".$file_date_dir);
	}
$uploads_dir = './uploadfile/' . $No;
$allowed_ext = array('jpg','jpeg','png','gif');
//$_SESSION['filename'] = $name;

// 변수 정리
$error = $_FILES['file_upload']['error'];
//$name = $_FILES['file_upload']['name'];
$ext = array_pop(explode('.', $name));

// 오류 확인
if( $error != UPLOAD_ERR_OK ) {
	switch( $error ) {
		case UPLOAD_ERR_INI_SIZE:
		case UPLOAD_ERR_FORM_SIZE:
			echo "Over size ($error)";
			break;
			case UPLOAD_ERR_NO_FILE:
			echo "No file ($error)";
			break;
		default:
			echo "No file upload ($error)";
	}
	exit;
}

// 확장자 확인
if( !in_array($ext, $allowed_ext) ) {
	echo "허용되지 않는 확장자입니다.";
	exit;
}

// 파일 이동
move_uploaded_file( $_FILES['file_upload']['tmp_name'], "$uploads_dir/$name");
?>
<script>
	alert("<?php echo 'File : ' . $name . ' upload ok'?>");
</script>
<?php
}
?>
<script>
	alert("<?php echo $msg?>");
	location.replace("<?php echo $replaceURL?>");
</script>
