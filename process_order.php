<?php
require_once __DIR__ . '/order_functions.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php'); exit;
}
$orderSummary = order();
setcookie('lastVisit', (string) time(), ['expires'=>time()+86400,'path'=>'/','samesite'=>'Lax','secure'=>!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off','httponly'=>true]);
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Your Receipt | Chez Session</title><link rel="stylesheet" href="styles.css"></head>
<body><header class="site-header"><div class="container"><p class="eyebrow">Fresh from the kitchen</p><h1>Your order receipt</h1><p>Here is what we saved for this visit.</p></div></header>
<main class="container narrow"><section class="panel"><h2>Order details</h2><p class="receipt"><?= $orderSummary ?></p><p class="total"><?= h(formattedTotal()) ?></p><p class="muted"><?= h(pricingNote()) ?></p></section>
<section class="panel"><h2>A note from the kitchen</h2><p><?= h(completionMessage()) ?></p><p><?= h(pairingSuggestion()) ?></p><p><strong>Order profile:</strong> <?= h(orderProfile()) ?></p></section>
<div class="actions"><a class="button-link" href="index.php">Order Again!</a><a class="secondary-link" href="forget_order.php">Forget Order</a><a class="secondary-link" href="about.php">How sessions work</a></div></main>
<footer class="container">Chez Session · Thirunavukkarasu Palaniappa</footer></body></html>
