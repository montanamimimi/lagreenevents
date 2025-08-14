<?php 

$ru = '';

if (get_locale() == "ru_RU") {
    $ru = '_ru';
}

$items = get_field('figures' . $ru, 'options');

?>

<?php 

foreach ($items as $item) { ?>
    <div class="hero__number">
        <div class="hero__number-num"><h2><?php echo $item['number']; ?></h2></div>
        <div class="hero__number-desc"><?php echo $item['text']; ?></div>
    </div>
<?php } ?>

