<?php
    require('config/config.php');
    require('config/db.php');

    // Create Query
    $query = 'SELECT * FROM posts';

    // Get Result
    $result = mysqli_query($conn, $query);

    // Fetch Data
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // var_dump($posts);

    // Free Result
    mysqli_free_result($result);

    // Close Connection
    mysqli_close($conn);

?>
<?php include('inc/header.php'); ?>
    <div class="container">
        <h1>Posts</h1>
            <?php foreach($posts as $post) : ?>
            <div class="card mt-4">
                <h3 class="card-header"><?php echo $post['title']; ?></h3>
                <div class="card-body">
                    <small>Created on <?php echo $post['created_at']; ?>
                        <?php echo $post['author']; ?></small>
                        <p class="card-text"><?php echo $post['body']; ?></p>
                        <a class="btn btn-default" href="<?php echo ROOT_URL; ?>post.php?id=<?php echo $post['id']; ?>">Read more</a>
                </div>
            </div>
            <?php endforeach; ?>
    </div>
<?php include('inc/footer.php');