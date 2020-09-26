<?php

namespace App\DataFixtures;

abstract class AbstractDataFixtures
{
	const CATEGORIES = [
		'animals' => [
			'bear',
			'bird',
			'bulldog',
		],
		'actions' => [
			'breaking up',
			'cooking',
			'crying',
		],
	];
}