# TODO: Fix Checkout Now Button

- [x] Remove direct POST form for checkout now and use link to checkout.index instead
- [x] Update JavaScript to modify checkout link URL with selected quantity

# TODO: Create OrderRelationManager

- [x] Add orders relationship in Product model using hasManyThrough
- [x] Create OrderRelationManager to display orders and order items for products
- [x] Update ProductResource to include OrderRelationManager
- [x] Create view for order items modal
