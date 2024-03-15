<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <style type="text/css">
        .input {
            border-radius: 5px;
            border: solid thin #aaa;
            padding: 10px;
            margin: 4px;
        }
    </style>
</head>

<body>

    <!-- Common header content goes here -->
    <div>
        <h1>E-Registeration IAB</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
                <!-- Add other navigation links as needed -->
            </ul>
        </nav>
    </div>

    <!-- Signup form -->
    <div>
        <h2>Signup</h2>
        <?php if (isset($message)) : ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
        <form method="post" action="<?php echo base_url ();?>main/register_process">
            <input class="input" type="text" name="name" placeholder="Name" required><br>
            <input class="input" type="email" name="email" placeholder="Email" required><br>
            <input class="input" type="password" name="password" placeholder="Password" required><br>
            <br>
            <input class="button" type="submit" value="Signup"><br>
        </form>
    </div>

    <!-- Common footer content goes here -->
    <footer>
        <p>&copy; E-Registeration IAB</p>
    </footer>

</body>

</html>
