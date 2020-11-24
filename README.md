Project Brief Explanation.

Tech Interview test.
Creating an API for
- User Registration,Login
- Creating Items
- Like item
- Displaying item count

Goal :
1. A database that has been normalized in the process of the making
2. Proper use of Laravel's migration, seeding, model, and controller
3. CRUD mechanism for images and likes data that are ready to be used by frontend via AJAX

Implementation :
1. Using JwtAuth for Authentication and API guarding.
2. User Management : Register, Login 
3. Item : 
    Create - Creating new item,
    Update - Updating item name and description,
    Update Image - Updating the image,
    Delete - Delete the item,
    item/all - getting all created items,
    item/byUser - getting item by user id,
4. Likes
    Create - like an item,
    Delete - unlike it,
    Like-list - show like data, 
5. Using Accessor to getLikeCountAttribute() .. right in the item model.
6. Using Laravel Storage and basic php file upload + custom filenaming.

JWT Tutorial :
https://medium.com/@newrey9227/belajar-autentikasi-api-di-laravel-menggunakan-jwt-c8c52d82e9d4
1. Gunakan perintah, php artisan jwt:secret 
untuk membuat jwt secret.


User Guide :
1. Lakukan registrasi/login dengan memasukka nama,email,dan password. untuk mendapatkan respon berupa token. (https://imgur.com/NGLO3Rh)
2. Untuk mengakses api dengan middleware jwt:auth, kita diharuskan memasukkan token yg kita dapatkan pada bagian Auth dengan tipe
Bearer Token. (https://imgur.com/Evo5SHB) 
