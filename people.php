<?php
$db = mysqli_connect('localhost', 'root', 'root') or 
    die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, 'moviesite') or die(mysqli_error($db));

if ($_GET['action'] == 'edit') {
    //retrieve the record's information 
    $query = 'SELECT
            people_fullname, people_isactor, people_isdirector,email
        FROM
            people
        WHERE
            people_id = ' . $_GET['id'];
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    extract(mysqli_fetch_assoc($result));
} else {
    //set values to blank
    $people_fullname = '';
    $people_isactor = 0;
    $people_isdirector = 0;
    $email = '';
   
}

?>
<html>
 <head>
  <title><?php echo ucfirst($_GET['action']); ?> People</title>
  <link rel="stylesheet" href="estilo.css" />
  <style type="text/css">
<!--
#error { background-color: #008626; border: 1px solid #FF0; color: #FFF;
 text-align: center; margin: 10px; padding: 10px; }
-->
  </style>
 </head>
 <body>
 <?php
if (isset($_GET['error']) && $_GET['error'] != '') {
    echo '<div id="error">' . $_GET['error'] . '</div>';
}
?>
  <?php
  if ($_GET['action'] == 'edit') {
    echo '<h1>Cambia los datos</h1>';
  }else if($_GET['action'] == 'add') {
    echo '<h1>Añade la persona</h1>';
  }
  ?>
  <form action="com.php?action=<?php echo $_GET['action']; ?>&type=people"
   method="post">
   <table>
    <tr>
     <td>People Name</td>
     <td><input type="text" name="people_fullname"
      value="<?php echo $people_fullname; ?>"/></td>
    </tr><tr>
     <td>Es un actor</td>
     <td><select name="people_isactor">
        <option value="0">0</option> 
        <option value="1">1</option>
      </select></td>
    </tr><tr>
     <td>Es un director</td>
     <td><select name="people_isdirector">
        <option value="0">0</option> 
        <option value="1">1</option>
      </select></td>
      <tr>
        <td>Email</td>
        <td><input type="text" name="email"
        value="<?php echo $email; ?>"/></td>
      </tr>

    </tr><tr>
     <td colspan="2" >
<?php
if ($_GET['action'] == 'edit') {
    echo '<input type="hidden" value="' . $_GET['id'] . '" name="people_id" />';
}
?>
      <input type="submit" name="submit"
       value="<?php echo ucfirst($_GET['action']); ?>" />
     </td>
    </tr>
   </table>
  </form>
 </body>
</html>

