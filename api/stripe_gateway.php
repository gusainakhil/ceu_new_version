<?php
require_once('vendor/autoload.php');

\Stripe\Stripe::setApiKey('sk_test_51PQD2lRwnCC1gHnZEkmCLTqc5J6KsOfPriIfqmtoSzfKXZGku7EV9cUZCkQUpkk1URTiXkZvPR1Yt7JBVHLLaNEh00p9WltXPk');

// Get the token from the frontend
$token = $_POST['token'];

try {
  // Create a PaymentIntent
  $paymentIntent = \Stripe\PaymentIntent::create([
    'amount' => 5000, // $50 in cents
    'currency' => 'usd',
    'payment_method' => $token,
    'confirmation_method' => 'manual',
    'confirm' => true,
  ]);

  echo json_encode(['success' => true, 'paymentIntent' => $paymentIntent]);
} catch (\Stripe\Exception\CardException $e) {
  echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>