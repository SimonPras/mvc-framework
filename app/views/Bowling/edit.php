<!DOCTYPE html>
<html>

<head>
    <title>Registration Form</title>
</head>

<body>
    <?php if (isset($errorMessage)) { ?>
        <div class="error"><?php echo $errorMessage ?></div>
    <?php } ?>
    <h1>Registration Form</h1>
    <form action="<?= URLROOT; ?>/Bowling/CreateAccount" method="post">

        <label>Voornaam:</label>
        <input type="text" name="voornaam" required>
        <label>Tussenvoegsel:</label>
        <input type="text" name="tussenvoegsel">
        <label>Achternaam:</label>
        <input type="text" name="achternaam" required>
        <label>Roepnaam:</label>
        <input type="text" name="mobiel" required>
        <label>email:</label>
        <input type="text" name="email" required>
        <label>IsVolwassen:</label>
        <input type="checkbox" name="isVolwassen" value="1" required>
        <!-- <button Id='submitted' type="submit">Register</button> -->

        <?php
        // if (isset($_POST['submitted'])) {
        //     echo "successfully made account";
        // }

        ?>

    </form>
</body>

</html>