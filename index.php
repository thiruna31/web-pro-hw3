<?php
require_once __DIR__ . '/order_functions.php';
$welcome = 'Welcome! Take your time choosing something good.';
if (isset($_COOKIE['lastVisit']) && ctype_digit((string) $_COOKIE['lastVisit'])) {
    $welcome = 'Welcome back! Your last visit was ' . date('M j, Y, g:i a', (int) $_COOKIE['lastVisit']) . '.';
}
?>
<!doctype html>
<html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Chez Session | Order Form</title><link rel="stylesheet" href="styles.css"></head>
<body><header class="site-header"><div class="container"><p class="eyebrow">Homework 03 · PHP sessions</p><h1>Chez Session <span aria-hidden="true">🍮</span></h1><p>A little dessert break, made your way.</p><nav aria-label="Main navigation"><a aria-current="page" href="index.php">Order</a><a href="about.php">How it works</a></nav></div></header>
<main class="container"><p class="welcome" role="status"><?= h($welcome) ?></p>
<div class="layout"><section class="panel"><h2>Build your order</h2><p class="muted">Everything is optional. Your choices will still be here when you come back from the receipt.</p>
<form action="process_order.php" method="post">
<label for="dessert">Dessert</label><select id="dessert" name="dessert"><option value="none">Choose a dessert</option>
<?php foreach (menuChoices()['dessert'] as $choice): ?><option value="<?= h($choice) ?>" <?= dessertSelected($choice) ?>><?= h($choice) ?></option><?php endforeach; ?></select>
<label for="drink">Drink</label><select id="drink" name="drink"><option value="none">Choose a drink</option>
<?php foreach (menuChoices()['drink'] as $choice): ?><option value="<?= h($choice) ?>" <?= drinkSelected($choice) ?>><?= h($choice) ?></option><?php endforeach; ?></select>
<fieldset><legend>Drink size</legend><div class="radios">
<?php foreach (menuChoices()['drinkSize'] as $choice): ?><label class="radio"><input type="radio" name="drinkSize" value="<?= h($choice) ?>" <?= drinkSizeSelected($choice) ?>> <?= h($choice) ?></label><?php endforeach; ?>
</div></fieldset><button type="submit">Send to kitchen</button></form>
<p><a class="secondary-link" href="forget_order.php">Forget my order</a></p></section>
<aside class="stack"><section class="panel"><h2>Saved choices</h2><p><?= h(completionMessage()) ?></p><p class="muted"><?= h(pairingSuggestion()) ?></p></section><section class="panel"><h2>Estimated total</h2><p class="total"><?= h(formattedTotal()) ?></p><p><strong><?= h(orderProfile()) ?></strong></p><p class="muted"><?= h(pricingNote()) ?></p></section></aside></div></main>
<footer class="container">Made for Web Programming · Thirunavukkarasu Palaniappa</footer></body></html>
