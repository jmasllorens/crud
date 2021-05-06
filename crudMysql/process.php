<?php

session_start();

$mysqli = new mysqli('localhost', 'root', null, 'crud') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$realname = '';
$dirtyname = '';

if(isset($_POST['save'])) 
    {
        $realname = $_POST['realname'];
        $dirtyname = $_POST['dirtyname'];

        $mysqli->query("INSERT INTO embrutanoms (realname, dirtyname) VALUES ('$realname', '$dirtyname')") or
            die($mysqli->error);
        
        $_SESSION['message'] = "L'embrutanom s'ha guardat ben brutament!";
        $_SESSION['msg_type'] = "success";

        header("location: index.php");
    }

if(isset($_GET['delete'])) 
    {
        $id = $_GET['delete'];

        $mysqli->query("DELETE FROM embrutanoms WHERE id=$id") or
            die($mysqli->error/*()*/);

        $_SESSION['message'] = "L'embrutanom ha caigut en l'oblit!";
        $_SESSION['msg_type'] = "danger";

        header("location: index.php");

    }

if(isset($_GET['edit']))
{
        $id = $_GET['edit'];
        $update = true;
        $result = $mysqli->query("SELECT * FROM embrutanoms WHERE id=$id") or
            die($mysqli->error/*()*/);

            if(count(['$result'])==1)
            {
                $row = $result->fetch_array();
                $realname = $row['realname'];
                $dirtyname = $row['dirtyname'];
            }
}

if(isset($_POST['update']))
{
    $id = $_POST['id'];
    $realname = $_POST['realname'];
    $dirtyname = $_POST['dirtyname'];

    $mysqli->query("UPDATE embrutanoms SET realname='$realname', dirtyname='$dirtyname' WHERE id=$id") or
        die($mysqli->error);

    $_SESSION['message'] = "L'embrutanom s'ha resignificat ben brutament!";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
}

?>