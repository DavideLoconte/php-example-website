<header>
    <h1>A simple example website</h1>

    <hr/>
    <nav>
        <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true): ?>
            <a href="/actions/logout.php">Logout</a>
        <?php else: ?>
            <a href="/login.php" style="margin-right: 10px; margin-left: 10px">Login</a>
            <a href="/signup.php" style="margin-right: 10px; margin-left: 10px">Signup</a>
        <?php endif; ?>
    </nav>
</header>

    <hr/>
