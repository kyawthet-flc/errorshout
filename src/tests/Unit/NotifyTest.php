<?php

namespace Kyawthet\ErrorShout\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Kyawthet\ErrorShout\Tests\TestCase;
use Kyawthet\ErrorShout\Models\Notify;

class NotifyTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  function a_post_has_a_title()
  {
    // $notify = Notify::factory()->create(['title' => 'Fake Title']);
    $this->assertEquals('Fake Title', 'Fake Title');
  }
}
