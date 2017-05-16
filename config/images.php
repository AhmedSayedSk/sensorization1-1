<?php

return [
    'full_size' => env('IMAGE_UPLOAD_FULL_SIZE', public_path('uploaded/products/images/full_size/')),
    'icon_size' => env('IMAGE_UPLOAD_ICON_SIZE', public_path('uploaded/products/images/icon_size/')),
    'max_uploads' => env('IMAGES_MAX_UPLOADS', 8),
];