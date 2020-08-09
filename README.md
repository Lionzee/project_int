Project Brief Explanation.

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
