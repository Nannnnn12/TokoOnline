# Update Checkout Controller to Save Shipping Data

## Tasks
- [x] Update validation in CheckoutController store method to include province, city, district, postal_code, courier, courier_service, shipping_cost (made nullable to allow checkout without shipping selection)
- [x] Modify Transaction creation in store method to save the new fields
- [x] Update total calculation to include shipping_cost (product_total + shipping_cost) with null coalescing
- [x] Apply changes to all checkout scenarios: direct product, single product from checkout page, and cart checkout
- [ ] Test the checkout process to verify data is saved correctly in transactions table
