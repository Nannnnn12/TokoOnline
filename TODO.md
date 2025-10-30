# TODO: Add Midtrans payment option to checkout page

- [x] Update checkout.blade.php to add Midtrans payment radio button alongside COD.
- [x] Update CheckoutController.php to handle midtrans payment method, create transaction, generate snap token, and redirect to payment page.
- [x] Create resources/views/user/payment.blade.php with Midtrans Snap.js integration.
- [x] Add route for payment page if needed.

# TODO: Add "belum dibayar" status and payment button for unpaid orders

- [x] Create migration to add 'belum_dibayar' status to transactions table.
- [x] Run migration to update database schema.
- [x] Update CheckoutController to set status to 'belum_dibayar' for Midtrans payments.
- [x] Update orders/index.blade.php to show "Bayar" button for 'belum_dibayar' status.
