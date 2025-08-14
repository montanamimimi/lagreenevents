<?php 

$languages = pll_the_languages([
  'raw' => 1,
]); 
$current_lang = pll_current_language();

if ($current_lang == 'en') { 
    $current = 'ENG';
    $switch = 'РУС';
    $link = $languages['ru']['url'];
} else {
    $current = 'РУС';
    $switch = 'ENG';
    $link = $languages['en']['url'];
}


?>

<div class="language-mob">
  <div class="language-mob__wrapper">
    <div class="language-mob__current" data-label="<?php echo $current; ?>">
      <?php echo $current; ?>
    </div>
    <a href="<?php echo $link; ?>" class="language-mob__switcher" data-label="<?php echo $switch; ?>">
      <?php echo $switch; ?>
    </a>
  </div>
</div>