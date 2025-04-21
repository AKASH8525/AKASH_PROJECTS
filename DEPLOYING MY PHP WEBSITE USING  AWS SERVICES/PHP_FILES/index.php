<?php include 'header.php'; ?>
<div class="container">
    <h2>Register</h2>
    <?php
    if(isset($_GET['message'])){
        echo "<p class='message'>" . htmlspecialchars($_GET['message']) . "</p>";
    }
    ?>
    <form action="process_registration.php" method="post">
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" placeholder="Your full name" required>
        </div>
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="Your email address" required>
        </div>
        <div class="form-group">
            <button type="submit">Register</button>
        </div>
    </form>
</div>
<?php include 'footer.php'; ?>