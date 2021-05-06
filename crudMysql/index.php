<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>CRUD Embrutanoms</title>
</head>

<body>
    <?php require_once 'process.php'; ?>

    <?php

        if(isset($_SESSION['message'])): ?>
    
    <div class="alert alert-<?=$_SESSION['msg_type']?>">
    
            <?php echo $_SESSION['message'];
                  unset($_SESSION['message']);
            
            ?>
    </div>

    <?php endif ?>

  <div class="container">
    
    <?php
        $mysqli = new mysqli('localhost', 'root', null, 'crud') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM embrutanoms") or die($mysqli->error);
    ?>
        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>NOM</th>
                        <th>EMBRUTANOM</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
        <?php
            while($row = $result->fetch_assoc()): 
        ?>
                <tr>
                    <td><?php echo $row['realname']; ?></td>
                    <td><?php echo $row['dirtyname']; ?></td>
                    <td>
                        <a href="index.php?edit=<?php echo $row['id']; ?>"
                            class="btn btn-secondary">REEMBRUTA</a>
                        <a href="process.php?delete=<?php echo $row['id']; ?>"
                            class="btn btn-danger">OBLIDA</a>
                    </td>
                </tr>
            <?php endwhile; ?>

            </table>
        </div>

    <?php
        function pre_r($array)
        {
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        }

    ?>

    <div class="row justify-content-center">
        <form action="process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label>Nom</label>
                <input type="text" name="realname" class="form-control"
                value="<?php echo $realname; ?>" placeholder="Introdueix el teu nom">
            </div>
            <div class="form-group">
                <label>Embrutanom</label>
                <input type="text" name="dirtyname" class="form-control"
                value="<?php echo $dirtyname; ?>" placeholder="Embruta'l">
            </div>
            <div class="form-group">
            <?php 
                if($update == true)
                {
            ?>
                <button type="submit" class="btn btn-success" name="update">RESIGNIFICA</button>
            <?php ;}
                else
                    { ?>
                
                    
            
                <button type="submit" class="btn btn-warning" name="save">SIGNIFICA'T</button>
                <?php ;}?>
            </div>
        </form>
    </div>
  </div>
</body>
</html>