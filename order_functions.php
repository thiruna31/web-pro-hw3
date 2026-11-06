<?php
// Keep all order information on the server, not in the welcome-back cookie.
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
const NOT_SELECTED = '(not selected)';
function menuChoices(): array {
    return [
        'dessert' => ['Cheesecake', 'Chocolate Cake', 'Carrot Cake', 'Tiramisu'],
        'drink' => ['Coffee', 'Hot Chocolate', 'Root Beer', 'Tea', 'Milk'],
        'drinkSize' => ['Small', 'Medium', 'Large']
    ];
}
function cleanChoice(string $field): string {
    $value = $_POST[$field] ?? '';
    if (!is_string($value)) return NOT_SELECTED;
    $value = trim($value);
    return in_array($value, menuChoices()[$field], true) ? $value : NOT_SELECTED;
}
function order(): string {
    foreach (['dessert', 'drink', 'drinkSize'] as $field) {
        $_SESSION[$field] = cleanChoice($field);
    }
    return 'Dessert: ' . h(sessionValue('dessert')) . '<br>'
        . 'Drink: ' . h(sessionValue('drink')) . '<br>'
        . 'Drink size: ' . h(sessionValue('drinkSize'));
}
function h(string $value): string { return htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); }
function sessionValue(string $key): string {
    return isset($_SESSION[$key]) && is_string($_SESSION[$key]) ? $_SESSION[$key] : NOT_SELECTED;
}
function dessertSelected(string $value): string { return sessionValue('dessert') === $value ? 'selected' : ''; }
function drinkSelected(string $value): string { return sessionValue('drink') === $value ? 'selected' : ''; }
function drinkSizeSelected(string $value): string { return sessionValue('drinkSize') === $value ? 'checked' : ''; }
function completedChoiceCount(): int {
    $count = 0;
    foreach (['dessert', 'drink', 'drinkSize'] as $key) if (sessionValue($key) !== NOT_SELECTED) $count++;
    return $count;
}
function completionMessage(): string {
    $count = completedChoiceCount();
    if ($count === 3) return 'All three choices are saved. Your order is ready.';
    if ($count === 0) return 'Choose a dessert, drink, and size to get started.';
    return "You have saved {$count} of 3 choices. You can leave the others blank.";
}
function pairingSuggestion(): string {
    $dessert = sessionValue('dessert'); $drink = sessionValue('drink');
    if ($dessert === NOT_SELECTED || $drink === NOT_SELECTED) return 'Pick a dessert and drink to see a pairing idea.';
    $ideas = [
        'Cheesecake|Coffee' => 'Cheesecake and coffee are a nice cafe combination.',
        'Chocolate Cake|Milk' => 'Chocolate cake and milk are a classic match.',
        'Tiramisu|Coffee' => 'Coffee goes especially well with tiramisu.',
        'Carrot Cake|Tea' => 'Tea is a lighter match for carrot cake.'
    ];
    return $ideas[$dessert . '|' . $drink] ?? "{$dessert} with {$drink} sounds like a good break.";
}
function dessertPrice(): float {
    return ['Cheesecake'=>4.25,'Chocolate Cake'=>4.50,'Carrot Cake'=>4.00,'Tiramisu'=>4.75][sessionValue('dessert')] ?? 0.0;
}
function drinkPrice(): float {
    $base = ['Coffee'=>2.25,'Hot Chocolate'=>2.75,'Root Beer'=>2.50,'Tea'=>2.00,'Milk'=>1.75];
    $drink = sessionValue('drink');
    if (!isset($base[$drink])) return 0.0;
    $extra = ['Small'=>0.0,'Medium'=>0.60,'Large'=>1.15];
    return $base[$drink] + ($extra[sessionValue('drinkSize')] ?? 0.0);
}
function formattedTotal(): string { return '$' . number_format(dessertPrice() + drinkPrice(), 2); }
function orderProfile(): string {
    $total = dessertPrice() + drinkPrice();
    if ($total >= 6.50) return 'Full cafe combo';
    if ($total >= 4.00) return 'Dessert break';
    if ($total > 0) return 'Light snack';
    return 'No selections yet';
}
function pricingNote(): string {
    if (sessionValue('drink') !== NOT_SELECTED && sessionValue('drinkSize') === NOT_SELECTED)
        return 'Choose a size to confirm the drink price; the estimate currently uses the base price.';
    return 'Prices are sample estimates for this class project.';
}
