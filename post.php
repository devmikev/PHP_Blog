<?php
    require('config/config.php');
    require('config/db.php');

    // Check for submit
    if(isset($_POST['delete'])) {
        // Get form data
        $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);

        $query = "DELETE FROM posts WHERE id = {$delete_id}";
        
        // die($query);

        if(mysqli_query($conn, $query)) {
            header('Location: '.ROOT_URL.'');
        } else {
            echo 'Error: ' . mysqli_error($conn);
        }
    }

    // get ID
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Create Query
    $query = 'SELECT * FROM posts WHERE id = ' . $id;

    // Get Result
    $result = mysqli_query($conn, $query);

    // Fetch Data
    $post = mysqli_fetch_assoc($result);
    // var_dump($posts);

    // Free Result
    mysqli_free_result($result);

    // Close Connection
    mysqli_close($conn);

?>

<?php include('inc/header.php'); ?>
    <div class="container">
        <div class="card">
            <h1 class="card-header"><?php echo $post['title']; ?></h1>
            <div class="card-body">
                <small>Created on <?php echo $post['created_at']; ?>
                    <?php echo $post['author']; ?></small>
                    <p class="card-text"><?php echo $post['body']; ?></p>
                    <form class="float-right" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input type="hidden" name="delete_id" value="<?php echo $post['id']; ?>">
                        <input type="submit" name="delete" value="Delete" class="btn btn-danger btn-sm">
                    </form>
                    <a class="btn btn-default" href="<?php echo ROOT_URL; ?>editpost.php?id=<?php echo $post['id']; ?>">Edit</a>
                    <a href="<?php echo ROOT_URL; ?>" class="btn btn-default">Go back</a>
            </div>
        </div>
    </div>
<?php include('inc/footer.php');
