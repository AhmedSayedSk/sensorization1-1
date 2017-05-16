<?php

return [
	'larg_size' => env('CAROUSEL_UPLOAD_LARG_SIZE', public_path('uploaded/products/carousel_gallery/larg/')),
	'small_size' => env('CAROUSEL_UPLOAD_SMALL_SIZE', public_path('uploaded/products/carousel_gallery/small/')),
	'max_uploads' => env('CAROUSEL_MAX_UPLOADS', 2),
];