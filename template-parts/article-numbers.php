<?php 

$ru = '';

if (get_locale() == "ru_RU") {
    $ru = '_ru';
}

$items = get_field('figures' . $ru, 'options');

?>
<h2><?php echo __('About us in figures', 'lg-theme'); ?></h2>

<?php 

foreach ($items as $item) { ?>
    <div class="article__number">
        <div class="article__number-num"><h2><?php echo $item['number']; ?></h2></div>
        <div class="article__number-desc"><?php echo $item['text']; ?></div>
    </div>
<?php } ?>
