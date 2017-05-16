<?php

$PN = config('setting.productNameKeywords.en.one'); // Product Name
$SN = config('setting.productNameKeywords.en.much'); // productS Name

return [
	// frontend number
	'1' => [

		// pages titles
		'PT' => [
			'T1' => 'Home',
			'T2' => 'All categories',
			'T3' => 'Search on products',
			'T4' => 'Success payment',
			'T5' => 'My cart',
			'T6' => 'Dashboard',
			'T7' => 'Edit my information',
		],

		'navbar' => [
			'T1' => "all $SN",
			'T2' => "documentations",
			'T3' => "contact us",
			'T4' => "about us",
			'T5' => "sign up",
			'T6' => "login",
			'T7' => "profile",
			'T8' => "admin panel",
			'T9' => "my cart",
			'T10' => "logout",
			'T11' => "language",
			'T12' => "categories",
			'T13' => "Home page",
		],

		'add-ons' => [
			// Liftnav filter 1
			'LNF1' => [
				'T1' => "Advanced filter $SN",
				'T3' => "Filter",
				'T5' => "Name",
				'T6' => "Price",
				'T7' => "search on discounted price",
				'T8' => "From: :price :currency",
				'T9' => "To: :price :currency",
				'T10' => "Sales",
				'T11' => "Show all",
				'T12' => "Main categories",
				'T13' => "You can search by multi inputs",
			],

			// products section 1
			'PS1' => [
				'T1' => "sales: ",
				'T2' => "read more",
				'T3' => "add to cart",
				'T4' => "amount: ",
			],
		],

		// main index 1
		'I1' => [
			'T1' => 'Hello world !!',
		],

		// All products categories view page
		'APCVP' => [
			'T1' => "no $SN yet",
		],

		// Product search view 1
		'PSV1' => [
			'T1' => 'Result: :result_count product',
			'T2' => 'There is no identical results',
			'T3' => "Try again :)",
		],

		// Product show 1
		'PS1' => [
			'T1' => '%:discount discount',
			'T2' => 'Add to cart',
			'T3' => "Show the $PN page [Admins]",
			'T4' => 'category',
			'T5' => 'stars',
			'T6' => 'views',
			'T7' => 'Payment by delivery',
			'T8' => 'Payment by paypal',
			'T9' => 'tags',
			'T10' => 'No tags yet',
			'T11' => 'description',
		],

		// User profile
		'UP' => [
			'left-nav' => [
				'T1' => 'Setting',
				'T2' => 'Profile',
				'T3' => 'Cart items',
				'T4' => 'Update my information',
			], 

			// Dashboard
			'DB' => [
				'T1' => 'My profile',
				'T2' => 'Welcome: :name',
			], 

			// cart view page
			'CVP' => [
				'T1' => 'Cart items',
				'T2' => 'Shopping now',
				'T3' => 'image',
				'T4' => 'name',
				'T5' => 'discount (%)',
				'T6' => 'quantity (piece)',
				'T7' => 'price (1 piece)',
				'T8' => 'price (all pieces)',
				'T9' => 'currency',
				'T10' => 'options',
				'T11' => 'Total price:',
				'T12' => 'pay by paypal',
				'T13' => 'pay on delivery',
				'T14' => 'Clear cart',
				'T15' => 'Back to products',
			],

			// Edit information
			'EI' => [
				'T1' => 'Edit my information',
				'T2' => 'Your name',
				'T3' => 'Email address',
				'T4' => 'Available Country for delivery payment',
				'T5' => 'Address',
				'T6' => 'You need to enter your country & address because delivery payment',
				'T7' => 'Update my information',
				'T8' => 'Information was updated successfully :)',
			], 
		],

	]
];