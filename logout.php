<?php
session_start();
session_unset();
session_destroy();
?>
<script>
	alert("Logout OK, Good bye.");
	location.replace('./index.php');
</script>
