<?php include __DIR__.'/menu.html.php'; ?>

<h1>Barátnő elérhetősége</h1>

<form method="POST" action="">

    <?php
    if (!empty($errors)) {

        echo '<h2 style="color: red;">Hiba a mentés közben!</h2>';
    }
    ?>
    <input type="hidden" name="token" value="<?php echo $view['form']->csrfToken('sajat') ?>">

    <label for="zip">Név</label><br>
    <input
        <?php echo (!empty($errors['name'])) ? 'style="border: 1px solid red;"' : ''; ?>
        type="text" name="name" id="name" value="<?php echo $name; ?>"><br>

    <?php
    if (!empty($errors['name']))
    {
        echo '<ul style="color: red;">';
        foreach ($errors['name'] AS $error) {
            echo '<li>'.$error.'</li>';
        }
    }
    echo '</ul>';
    ?>
    <br>

    <label for="zip">Telefon</label><br>
    <select name="phone1">
        <option>Válassz!</option>
        <option value="3620" <?php if ($phone1=='3620') { echo 'selected'; } ?>>20</option>
        <option value="3630" <?php if ($phone1=='3630') { echo 'selected'; } ?>>30</option>
        <option value="3670" <?php if ($phone1=='3670') { echo 'selected'; } ?>>70</option>
    </select>

    <input
        <?php echo (!empty($errors['phone'])) ? 'style="border: 1px solid red;"' : ''; ?>
        type="text" name="phone2" id="phone2" value="<?php echo $phone2; ?>">
    <br>

    <?php
    if (!empty($errors['phone']))
    {
        echo '<ul style="color: red;">';
        foreach ($errors['phone'] AS $error) {
            echo '<li>'.$error.'</li>';
        }
    }
    echo '</ul>';
    ?>

    <br>
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
