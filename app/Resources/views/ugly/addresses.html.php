<?php
/** @var \Symfony\Bundle\FrameworkBundle\Templating\Helper\FormHelper $formHelper */
$formHelper = $view['form'];
?>

<?php include __DIR__.'/menu.html.php'; ?>

<h1>Barátnő elérhetősége</h1>

<?php echo $formHelper->start($form); ?>

<?php echo $formHelper->row($form['zip']); ?>
<?php echo $formHelper->row($form['city']); ?>
<?php echo $formHelper->row($form['address']); ?>
<?php echo $formHelper->row($form['name']); ?>
<div>
    <?php //echo $formHelper->label($form['phone2']); ?>
    <?php //echo $formHelper->errors($form['phone1']); ?>
    <?php //echo $formHelper->errors($form['phone2']); ?>
    <?php //echo $formHelper->widget($form['phone1']); ?>
    <?php //echo $formHelper->widget($form['phone2']); ?>
</div>


<?php echo $formHelper->end($form); ?>

<?php include __DIR__.'/footer.html.php'; ?>