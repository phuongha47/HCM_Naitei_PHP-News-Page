<?php

namespace Tests\Unit\Models;

use App\Country;
use App\Supplier;
use App\Models\Image;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ImageTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_post_database_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('images', [
            'imageable_id', "link", "imageable_type",
          ]), 1);
    }
    /** @test */
}
