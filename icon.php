<?php /* 60 Lines */

// SETTINGS
$cssClassOrTagName = '.icon.';
$cssClassOrTagEnd  = '';


// MAIN
$css = '/*

CSS Tabler-Icons
================

> v1.0.0 (2020-04-09)

__Download [Tabler Icons](https://github.com/tabler/tabler-icons/releases) 
and run `icon.php` on e.g. localhost. 
It will read SVG icons from the folder `tabler` and build css from it.
Now you can use the `tabler.css` without the SVG Icons!__

License
-------

Licensed under the MIT License.

The icons that are used in this code are from https://github.com/tabler/tabler-icons/

They are also licensed under the MIT License.

© 2020 [phpSoftware](https://github.com/phpSoftware/CSS-Tabler-Icons)

*/
'.PHP_EOL.rtrim($cssClassOrTagName,'. [').' {
  display: inline-block;
  height: 24px;
  width: 24px;
  vertical-align: -0.125px;
  background-size: contain;'.PHP_EOL.'}'.PHP_EOL;
$html = '';
$counter = 0;
foreach (glob("tabler/*.svg") as $file) {
  ++$counter;
  $svg = file_get_contents($file);
  $svg = str_replace ("\n", '', rtrim($svg));
  $svg = str_replace (' />', '/>', $svg);
  $svg = str_replace(array('<','"','>'), array('%3C',"'",'%3E'), $svg);
  $name = str_replace(array('tabler/','.svg'), array('',''), $file);
  $svg = str_replace(" class='icon icon-tabler icon-tabler-{$name}'", '', $svg);
  // MAKE heart ICON RED - change hex e71837 for red if you like ;-)
  if ($name == 'heart') $svg = str_replace("stroke='currentColor'", "stroke='%23e71837'", $svg);
  $css .= PHP_EOL.$cssClassOrTagName.$name.$cssClassOrTagEnd.' {
  background-image: url("data:image/svg+xml,'.$svg.'");'.PHP_EOL.'}'.PHP_EOL;
  $html .= "<i class='icon {$name}'></i>";
}
file_put_contents('tabler.css', $css);
$header = '<!DOCTYPE HTML><html><head><meta charset="UTF-8"><title>Tabler Icons CSS Test</title>'.
          '<link href="tabler.css" rel="stylesheet"></head><body><tt><h1>'.$counter.' Tabler Icons CSS Test</h1>';
file_put_contents('test.htm', $header.$html);
echo '<tt><b>'.$counter.' Tabler Icons CSS is ready, <a target="test" style="color:firebrick" href="test.htm">test it</a>!';
