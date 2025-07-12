<?php 

$languages = pll_the_languages([
  'raw' => 1,
]); 
$current_lang = pll_current_language();

if ($current_lang == 'en') { 
    echo '<a href="' . $languages['ru']['url'] . '">ENG</a>';
} else {
    echo '<a href="' . $languages['en']['url'] . '">РУС</a>';
}
// var_dump($languages);
// var_dump($current_lang);
?>