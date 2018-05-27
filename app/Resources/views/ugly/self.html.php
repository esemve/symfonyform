<?php
    /** @var \Symfony\Bundle\FrameworkBundle\Templating\Helper\FormHelper $formHelper */
    $formHelper = $view['form'];
?>

<?php include __DIR__.'/menu.html.php'; ?>

<h1>Saját címem</h1>

<?php echo $formHelper->widget($form); ?>

<?php include __DIR__.'/footer.html.php'; ?>