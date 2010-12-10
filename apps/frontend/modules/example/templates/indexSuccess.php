<?php foreach($cars as $car) : ?>
	<h2><?=$car->getMake() . ' ' . $car->getModel()?></h2>
	<p>Slug: <?=$car->getSlug()?></p>
<?php endforeach; ?>