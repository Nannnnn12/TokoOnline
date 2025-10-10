# TODO for Database Schema Setup and Filament Product Resource

## Database Schema Implementation
- [ ] Create migration to add phone_number (string, nullable) and address (longtext, nullable) to users table.
- [ ] Create Store model and migration (fields: name string, description longtext nullable, whatsapp string nullable, facebook string nullable, instagram string nullable, toko_pedia string nullable, timestamps).
- [ ] Create Category model and migration (fields: category_name string unique, icon string nullable, timestamps).
- [ ] Update existing products migration (add: name string, description longtext nullable, price integer, stock integer, status string default 'active', store_id foreignId to stores.id, timestamps already there).
- [ ] Create ProductImage model and migration (fields: product_id foreignId to products.id, image_file string, timestamps).
- [ ] Update Product model to add relations (belongsTo Store, hasMany ProductImage).

## Filament Resource
- [ ] Create Filament Resource for Product (app/Filament/Resources/ProductResource.php) with form fields: TextInput for name, Textarea for description, TextInput for price and stock, Select for status ('active', 'inactive') and store_id (from Store model), and optionally Repeater or separate resource for images.
- [ ] Configure table columns in the resource for all product fields, including relation to store.

## Followup
- [ ] Run php artisan migrate to apply all changes.
- [ ] Create a sample store and category via seeder or manually.
- [ ] Test Product CRUD in Filament admin panel at /admin/products (create, read, update, delete; verify relations and forms).
- [ ] Update TODO.md as steps are completed.
