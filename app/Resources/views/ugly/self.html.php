<?php include __DIR__.'/menu.html.php'; ?>

<h1>Saját címem</h1>

<form method="POST" action="">

    <?php
        if (!empty($errors)) {

            echo '<h2 style="color: red;">Hiba a mentés közben!</h2>';
        }
    ?>
    <input type="hidden" name="token" value="<?php echo $view['form']->csrfToken('sajat') ?>">

    <label for="zip">Irányítószám</label><br>
    <input
        <?php echo (!empty($errors['zip'])) ? 'style="border: 1px solid red;"' : ''; ?>
    type="text" name="zip" id="zip" value="<?php echo $zip; ?>"><br>

    <?php
        if (!empty($errors['zip']))
        {
            echo '<ul style="color: red;">';
            foreach ($errors['zip'] AS $error) {
                echo '<li>'.$error.'</li>';
            }
        }
        echo '</ul>';
    ?>

    <br>
    <label for="city">Város</label><br>
    <input type="text"
        <?php echo (!empty($errors['city'])) ? 'style="border: 1px solid red;"' : ''; ?>
        name="city" id="city" value="<?php echo $city; ?>"><br>
    <?php
    if (!empty($errors['city']))
    {
        echo '<ul style="color: red;">';
        foreach ($errors['city'] AS $error) {
            echo '<li>'.$error.'</li>';
        }
    }
    echo '</ul>';
    ?>
    <br>
    <label for="address">Utca, házszám</label><br>
    <input type="text"
        <?php echo (!empty($errors['address'])) ? 'style="border: 1px solid red;"' : ''; ?>
        name="address" id="address" value="<?php echo $address; ?>"><br>
    <br>
    <?php
    if (!empty($errors['address']))
    {
        echo '<ul style="color: red;">';
        foreach ($errors['address'] AS $error) {
            echo '<li>'.$error.'</li>';
        }
    }
    echo '</ul>';
    ?>

    <input type="submit" value="Mentés">

</form>
