

<?php
session_start();

  require_once("./dbconfig.php");

    $ID = $_POST['ID'];
    $Password = $_POST['Password'];



      //$sql = 'select count(password) as cnt from table_board where password=password("' . $Password . '") and id = ' . $ID;
      $sql = "select id, password, name from table_user where  id='$ID' and password=password('$Password')";
  ?>
    <script>
      alert("<?php echo $sql?>");
    </script>
  <?php
      $result = $db->query($sql);
      //$rowCount = $result->num_rows;

      $row = $result->fetch_assoc();
      //$user = "1";
      if(isset($row['id'])){
      $_SESSION['ID'] = $row['id'];
      $_SESSION['Password'] = $row['password'];
      $_SESSION['Name'] = $row['name'];
      ?>
      <script>
      	alert("<?php echo 'Login OK, Welcome to my Board_free.'?>");
        location.replace('./index.php');
      </script>
      <?php
    } else {
?>
<script>
  alert("<?php echo 'Login Failed, Please try again.'?>");
  history.back();
</script>
<?php
}
 ?>
