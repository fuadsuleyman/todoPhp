<?php
    include "db.inc.php";

    if (isset($_GET['edit-todo'])) {
        $editId = $_GET['edit-todo'];
    }

    if(isset($_POST['edit_todo'])){
        $editTodo = $_POST['todo'];

        $sql4 = "UPDATE tdtable SET name = '$editTodo' WHERE id = $editId";
        $result4 = mysqli_query($connection, $sql4);

        if(!$result4){
            die("Failed");
        }else{
            header("Location: index.php?updated");
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDO</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="todo">
        <h1>"success begins from planning"</h1>
        <h3>Edit Your ToDo</h3>
        <form action="" method="POST">
            <?php
            $sql3 = "SELECT *FROM tdtable WHERE id = $editId";
            $result3 = mysqli_query($connection, $sql3);
            $data = mysqli_fetch_array($result3);
            ?>
            <div class="form-group">
                <input type="text" class="form-control" name="todo" placeholder="write here..."
                       value="<?php echo $data['name']; ?>">
            </div>
            <div class="form-group">
                <input type="submit" name="edit_todo" class="btn btn-success btn-block" value="Add Edited Task">
            </div>
        </form>
    </div>
</div>

</body>
</html>