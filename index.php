<?php 
    require 'components/session.php';
    require 'components/login.php';
    require 'components/database.php';
?>

<!DOCTYPE html>
<html lang="en">

<?php require 'components/head.php';?>

<body>
    <?php require 'components/header.php'; ?>
    <h5>Welcome, <?php echo $username; ?>!</h5>
    <h6>Create a New Post</h6>

    <form method="POST" action="actions/post.php">
        <textarea name="content" rows="4" cols="50" placeholder="What's on your mind?" required></textarea>
        <br>
        <button type="submit" name="new_post">Post</button>
    </form> 

    <br>

    <h5>Your Posts</h5>
    
    <?php
        // Fetch posts from friends
        $posts_query = "
            SELECT p.username, p.content, p.created_at
            FROM Posts p
            WHERE p.username = $1
            ORDER BY p.created_at 
            DESC
            LIMIT 10
        ";

        $posts_result = pg_query_params($conn, $posts_query, [$username]);

        if (!$posts_result) {
            die("An error occurred while fetching posts: " . pg_last_error());
        }
    ?>

    <?php if ($posts_result && pg_num_rows($posts_result) > 0) { ?>
    <ul>
        <?php while ($post = pg_fetch_assoc($posts_result)) { ?>
            <li>
                <?php echo htmlspecialchars($post['content']); ?>
                <em>(<?php echo htmlspecialchars($post['created_at']); ?>)</em>
            </li>
        <?php } ?>
    </ul>
    <?php } else { ?>
    <em>No posts yet.</em>
    <?php } ?>

    <?php require 'components/footer.php'; ?>
</body>

</html>
