<?php
$db = mysqli_connect('localhost', 'root', 'root') or 
    die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, 'moviesite') or die(mysqli_error($db));
?>
<html>
 <head>
  <title>Commit2</title>
  <link rel="stylesheet" href="estilo.css" />
 </head>
 <body>
<?php
switch ($_GET['action']) {
case 'add':
    switch ($_GET['type']) {
    case 'people':
        $error = array();
        $people_fullname = isset($_POST['people_fullname']) ?
            trim($_POST['people_fullname']) : '';
        if (empty($people_fullname)) {
            $error[] = urlencode('Please enter a people name.');
        }
        $people_isactor = isset($_POST['people_isactor']) ?
            trim($_POST['people_isactor']) : '';
        if ($people_isactor !=1 && $people_isactor != 0){
            $error[] = urlencode('Please select a actor type.');
        }
        $people_isdirector = isset($_POST['people_isdirector']) ?
            trim($_POST['people_isdirector']) : '';
        if ($people_isdirector != 1 && $people_isdirector !=0) {
            $error[] = urlencode('Please select a director type.');
        }   
        $email = isset($_POST['email']) ?
            trim($_POST['email']) : '';
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error[] = urlencode('Please select a email.');
        }
        if (empty($error)) {
            $query = 'INSERT INTO
                people
                    (people_fullname, people_isactor, people_isdirector,email)
                VALUES
                    ("' . $people_fullname . '",
                    ' . $people_isactor . ',
                    ' . $people_isdirector . ',
                    "' . $email . '")';
        }else {
          header('Location:people.php?action=add' .
              '&error=' . join(urlencode('<br/>') , $error ));
        }      
        break;
    }
    break;
case 'edit':
    switch ($_GET['type']) {
    case 'people':
        $error = array();
        $people_fullname = isset($_POST['people_fullname']) ?
            trim($_POST['people_fullname']) : '';
        if (empty($people_fullname)) {
            $error[] = urlencode('Please enter a people name.');
        }
        $people_isactor = isset($_POST['people_isactor']) ?
            trim($_POST['people_isactor']) : '';
        if ($people_isactor !=1 && $people_isactor != 0){
            $error[] = urlencode('Please select a actor type.');
        }
        $people_isdirector = isset($_POST['people_isdirector']) ?
            trim($_POST['people_isdirector']) : '';
        if ($people_isdirector != 1 && $people_isdirector !=0) {
            $error[] = urlencode('Please select a director type.');
        }   
        $email = isset($_POST['email']) ?
            trim($_POST['email']) : '';
        if (empty($email) && filter_var($email)){
            $error[] = urlencode('Please select a email.');
        }  
        

        if (empty($error)) {
             $query = 'UPDATE 
                    people 
                SET
                    people_fullname = "' . $people_fullname . '",
                    people_isactor = ' . $people_isactor . ',
                    people_isdirector = ' . $people_isdirector . ',
                    email = "' . $email . '"
            WHERE
                people_id = ' . $_POST['people_id'];
        }else {
            header('Location:people.php?action=edit&id=' . $_POST['people_id'] .
                '&error=' . join( urlencode('<br/>') , $error));
        }
        break;
    }
    break;
}

if ($_GET['action'] == 'edit') {
    echo '<h1 id="b">Cambios editados</h1>';
  }else if($_GET['action'] == 'add') {
    echo '<h1 id="c">Persona añadida</h1>';
  }

if (isset($query)) {
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
}
?>
  <h2><a href="admin.php">Return to Index</a></h2>
 </body>
</html>



