<?php
include "db.inc.php";

$query = "SELECT * FROM tdtable";
$result = mysqli_query($connection, $query);


// add todos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $todo = $_POST['todo'];

    // validation for empty
    if (empty($todo)) {
        $error = "field is empty!";

    } else {
        $sql = "INSERT INTO tdtable(name) VALUES('$todo');";
        $results = mysqli_query($connection, $sql);

        // update after adding
        if (!$results) {
            die("Failed");
        } else {
            header("Location:index.php?todo-added");
        }
    }
}
// for delete
if (isset($_GET['delete_todo'])) {
    $deleteTodo = $_GET['delete_todo'];
    $sql2 = "DELETE FROM tdtable WHERE id = $deleteTodo";
    $result2 = mysqli_query($connection, $sql2);

    // auto uptade page
    if (!$result2) {
        die("Failed");
    } else {
        header("Location:index.php?todo-deleted");
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
        <h3>Add New ToDo</h3>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="form-group">
                <input type="text" class="form-control" name="todo" placeholder="write here...">
            </div>
            <?php
            if (isset($error)) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
            ?>
            <div class="form-group">
                <input type="submit" class="btn btn-success btn-block" value="Add New Task">
            </div>
        </form>
    </div>
    <div class="table-div">
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <td>ID</td>
            <td>Todo</td>
            <td>Edit Todo</td>
            <td>Delete Todo</td>
            </thead>
            <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                $todo_id = $row["id"];
                $todo_name = $row["name"];
                ?>
                <tr>
                    <td><?php echo $todo_id; ?></td>
                    <td><?php echo $todo_name; ?></td>
                    <td><a href="edit.php?edit-todo=<?php echo $todo_id; ?>" class="btn btn-success">Edit</a></td>
                    <td><a href="index.php?delete_todo=<?php echo $todo_id; ?>" class="btn btn-danger">Delete</a></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>