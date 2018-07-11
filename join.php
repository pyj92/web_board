<?php

	require_once("./dbconfig.php");
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Board_free | Youngjin</title>
  </head>
  <body>
    <form method="post" action="./join_update.php">
    <table>
      <tbody>
      <tr>
        <th><label for="ID">ID: </label></th>
        <td><input id="ID" type="text" name="ID" /></td>
      </tr>
      <tr>
        <th><label for="Password">PW: </label></th>
        <td><input id="Password" type="text" name="Password" /></td>
      </tr>
      <tr>
        <th><label for="Name">NAME: </label></th>
        <td><input id="Name" type="text" name="Name" /></td>
      </tr>
      <tr>
      <td><input type="submit" value="Join" /></td>
      </tr>
      </tbody>
    </table>
    </form>
  </body>
</html>
