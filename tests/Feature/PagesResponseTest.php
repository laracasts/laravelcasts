<?php

use function Pest\Laravel\get;

it('gives successful response for home page', function() {
	// Act & Assert
	get(route('home'))->assertSuccessful();
});
