<?php 
    // This is a component that displays an error message if available in the
    // error_message variable
    if (isset($_SESSION['error_message'])) {
?>
    <div class="error-message" style="color: red;">
        <?php echo htmlspecialchars($_SESSION['error_message']); ?>
    </div>

<?php }; ?>
