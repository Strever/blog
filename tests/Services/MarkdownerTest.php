<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MarkdownerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    protected $markdown;

    public function setup()
    {
        $this->markdown = new \App\Services\Markdowner();
    }

    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testSimpleParagraph()
    {
        $this->assertEquals("<p>test</p>\n", $this->markdown->toHtml('test'));
    }
}
