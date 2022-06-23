# Diff Details

Date : 2022-06-23 21:57:16

Directory c:\\xampp\\htdocs\\shopbanhanglaravel

Total : 46 files,  3508 codes, 103 comments, 376 blanks, all 3987 lines

[Summary](results.md) / [Details](details.md) / [Diff Summary](diff.md) / Diff Details

## Files
| filename | language | code | comment | blank | total |
| :--- | :--- | ---: | ---: | ---: | ---: |
| [app/Http/Controllers/CategoryProduct.php](/app/Http/Controllers/CategoryProduct.php) | PHP | 11 | 0 | 4 | 15 |
| [app/Http/Controllers/ContactController.php](/app/Http/Controllers/ContactController.php) | PHP | 23 | 4 | 9 | 36 |
| [app/Http/Controllers/GalleryController.php](/app/Http/Controllers/GalleryController.php) | PHP | 98 | 25 | 14 | 137 |
| [app/Http/Controllers/HomeController.php](/app/Http/Controllers/HomeController.php) | PHP | 15 | 0 | 2 | 17 |
| [app/Http/Controllers/PostController.php](/app/Http/Controllers/PostController.php) | PHP | 69 | 5 | 28 | 102 |
| [app/Http/Controllers/Product.php](/app/Http/Controllers/Product.php) | PHP | 109 | 3 | 21 | 133 |
| [app/Http/Controllers/SliderController.php](/app/Http/Controllers/SliderController.php) | PHP | 12 | 0 | 2 | 14 |
| [app/Models/CategoryProductModels.php](/app/Models/CategoryProductModels.php) | PHP | 3 | 0 | 1 | 4 |
| [app/Models/Comment.php](/app/Models/Comment.php) | PHP | 14 | 0 | 5 | 19 |
| [app/Models/Contact.php](/app/Models/Contact.php) | PHP | 11 | 0 | 4 | 15 |
| [app/Models/Gallery.php](/app/Models/Gallery.php) | PHP | 11 | 0 | 4 | 15 |
| [app/Models/Post.php](/app/Models/Post.php) | PHP | 3 | 0 | 1 | 4 |
| [app/Models/Product.php](/app/Models/Product.php) | PHP | 3 | 0 | 1 | 4 |
| [app/Models/Rating.php](/app/Models/Rating.php) | PHP | 11 | 0 | 4 | 15 |
| [composer.json](/composer.json) | JSON | 1 | 0 | 0 | 1 |
| [composer.lock](/composer.lock) | JSON | 56 | 0 | 0 | 56 |
| [public/backend/css/bootstrap-tagsinput.css](/public/backend/css/bootstrap-tagsinput.css) | CSS | 55 | 0 | 1 | 56 |
| [public/backend/js/bootstrap-tagsinput.min.js](/public/backend/js/bootstrap-tagsinput.min.js) | JavaScript | 1 | 5 | 1 | 7 |
| [public/frontend/css/lightgallery.min.css](/public/frontend/css/lightgallery.min.css) | CSS | 818 | 0 | 149 | 967 |
| [public/frontend/css/lightslider.css](/public/frontend/css/lightslider.css) | CSS | 350 | 16 | 26 | 392 |
| [public/frontend/css/main.css](/public/frontend/css/main.css) | CSS | -1 | 0 | 0 | -1 |
| [public/frontend/css/prettify.css](/public/frontend/css/prettify.css) | CSS | 26 | 1 | 3 | 30 |
| [public/frontend/js/lightgallery-all.min.js](/public/frontend/js/lightgallery-all.min.js) | JavaScript | 2 | 3 | 0 | 5 |
| [public/frontend/js/lightslider.js](/public/frontend/js/lightslider.js) | JavaScript | 1,102 | 11 | 27 | 1,140 |
| [public/frontend/js/prettify.js](/public/frontend/js/prettify.js) | JavaScript | 28 | 0 | 0 | 28 |
| [resources/views/admin/add_product.blade.php](/resources/views/admin/add_product.blade.php) | PHP | 4 | 0 | 0 | 4 |
| [resources/views/admin/all_brand_product.blade.php](/resources/views/admin/all_brand_product.blade.php) | PHP | 1 | 0 | 0 | 1 |
| [resources/views/admin/all_category_product.blade.php](/resources/views/admin/all_category_product.blade.php) | PHP | 11 | 0 | 0 | 11 |
| [resources/views/admin/all_product.blade.php](/resources/views/admin/all_product.blade.php) | PHP | 3 | 0 | -1 | 2 |
| [resources/views/admin/category_post/list_category_post.blade.php](/resources/views/admin/category_post/list_category_post.blade.php) | PHP | 1 | 0 | 0 | 1 |
| [resources/views/admin/comment/list_comment.blade.php](/resources/views/admin/comment/list_comment.blade.php) | PHP | 86 | 0 | 3 | 89 |
| [resources/views/admin/coupon/list_coupon.blade.php](/resources/views/admin/coupon/list_coupon.blade.php) | PHP | 1 | 0 | 0 | 1 |
| [resources/views/admin/edit_product.blade.php](/resources/views/admin/edit_product.blade.php) | PHP | 4 | 0 | 0 | 4 |
| [resources/views/admin/gallery/add_gallery.blade.php](/resources/views/admin/gallery/add_gallery.blade.php) | PHP | 22 | 21 | 1 | 44 |
| [resources/views/admin/post/edit_post.blade.php](/resources/views/admin/post/edit_post.blade.php) | PHP | 75 | 0 | 4 | 79 |
| [resources/views/admin/post/list_post.blade.php](/resources/views/admin/post/list_post.blade.php) | PHP | 1 | 0 | -1 | 0 |
| [resources/views/admin/slider/list_slider.blade.php](/resources/views/admin/slider/list_slider.blade.php) | PHP | 1 | 0 | 0 | 1 |
| [resources/views/admin/users/all_users.blade.php](/resources/views/admin/users/all_users.blade.php) | PHP | -6 | 0 | 1 | -5 |
| [resources/views/admin_layout.blade.php](/resources/views/admin_layout.blade.php) | PHP | 164 | 1 | 21 | 186 |
| [resources/views/index.blade.php](/resources/views/index.blade.php) | PHP | 122 | 3 | 11 | 136 |
| [resources/views/pages/contact/contact.blade.php](/resources/views/pages/contact/contact.blade.php) | PHP | 24 | 0 | 5 | 29 |
| [resources/views/pages/post/category_post.blade.php](/resources/views/pages/post/category_post.blade.php) | PHP | 25 | 0 | 7 | 32 |
| [resources/views/pages/post/post.blade.php](/resources/views/pages/post/post.blade.php) | PHP | 34 | 0 | 7 | 41 |
| [resources/views/pages/product/show_details.blade.php](/resources/views/pages/product/show_details.blade.php) | PHP | 40 | 0 | 0 | 40 |
| [resources/views/pages/product/tag.blade.php](/resources/views/pages/product/tag.blade.php) | PHP | 41 | 0 | 4 | 45 |
| [routes/web.php](/routes/web.php) | PHP | 23 | 5 | 7 | 35 |

[Summary](results.md) / [Details](details.md) / [Diff Summary](diff.md) / Diff Details