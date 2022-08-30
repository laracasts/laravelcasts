<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('gives successful response for home page', function() {
	// Act & Assert
	get(route('home'))->assertSuccessful();
});
