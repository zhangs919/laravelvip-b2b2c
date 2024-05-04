<?php

namespace Tests\Unit\Modules\Frontend\Http\Controllers;

use App\Modules\Frontend\Http\Controllers\HomeController;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{

	public function testHome()
	{
		$response = $this->get('http://www.lrw.test/');
		$response->assertStatus(200);

	}
}
