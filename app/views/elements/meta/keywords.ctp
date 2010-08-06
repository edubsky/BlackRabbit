<?php
if (!isset($keywords)) {
	$keywords = "greenpeace, energy [r]evolution, peace & love";
} elseif (is_array($keywords)) {
	$keywords = implode(", ", $keywords);
}
?>
  <meta name="keywords" content="<?php echo $keywords; ?>" />
