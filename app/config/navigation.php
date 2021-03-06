<?php

// Defining menu structure here
// the items that need to appear when user is logged in should have logged_in set as true
return array(

	'menu' => array(
		array(
			'label' => '浏览',
			'route' => 'browse.recent',
			'active' => array('/','popular','comments')
		),
		array(
			'label' => '分类',
			'route' => 'browse.categories',
			'active' => array('categories*')
		),
		array(
			'label' => '标签',
			'route' => 'browse.tags',
			'active' => array('tags*')
		),
		array(
			'label' => '新建trick',
			'route' => 'tricks.new',
			'active' => array('user/tricks/new'),
			// 'logged_in' => true
		),
		array(
					'label' => '上传本地图片',
					'route' => 'image.new_local',
					'active' => array('user/image/new'),
					// 'logged_in' => true
		),
		array(
					'label' => '抓取网络图片',
					'route' => 'image.new_net',
					'active' => array('user/image/new_net'),
					// 'logged_in' => true
			),
		array(
			'label' => '图片',
			'route' => 'image.show',
			'active' => array('image*'),
				// 'logged_in' => true
		),
		array(
				'label' => '产品',
				'route' => 'product.show',
				'active' => array('product*'),
				// 'logged_in' => true
		),
		array(
				'label' => '购物车',
				'route' => 'cart.show',
				'active' => array('cart*'),
				// 'logged_in' => true
		),
	),

	'browse' => array(
		array(
			'label' => '最新',
			'route' => 'browse.recent',
			'active' => array('/')
		),
		array(
			'label' => '最流行',
			'route' => 'browse.popular',
			'active' => array('popular')
		),
		array(
			'label' => '推荐',
			'route' => 'browse.comments',
			'active' => array('comments')
		),
	),

);
