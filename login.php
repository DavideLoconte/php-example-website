<?php require 'components/session.php'; ?>

<!DOCTYPE html>
<html lang="en">

<?php require "components/head.php"; ?>

<body>

    <?php require "components/header.php";?>

    <h5>Login</h5> 

    <form method="POST" action="actions/login.php" id="login-form" class="form">
        <label for="username" class="form-label">Username:</label>
        <input type="text" id="username" name="username" class="form-input" required>
        <br>
        <label for="password" class="form-label">Password:</label>
        <input type="password" id="password" name="password" class="form-input" required>
        <br>
        <button type="submit" class="form-button">Login</button>
    </form>

    <?php require "components/error.php";?>
    <?php require "components/footer.php";?>

</body>
</html>
