<?php
    /** @var \Symfony\Bundle\FrameworkBundle\Templating\Helper\FormHelper $formHelper */
    $formHelper = $view['form'];
?>

<?php include __DIR__.'/menu.html.php'; ?>

<h1>Saját címem</h1>

<?php echo $formHelper->start($form); ?>

<?php echo $formHelper->row($form['zip']); ?>
<?php echo $formHelper->row($form['city']); ?>
<?php echo $formHelper->row($form['address']); ?>

<input type="submit" value="Mentés" />

<?php echo $formHelper->end($form); ?>

<?php include __DIR__.'/footer.html.php'; ?>