<?php
/**
 * Created by PhpStorm.
 * User: strever
 * Date: 16/1/3
 * Time: 上午1:59
 */

namespace App\Services;

use Michelf\MarkdownExtra;
use Michelf\SmartyPants;

class Markdowner {

    public function toHtml($mdStr) {
        $html = $this->preTransformText($mdStr);
        $html = MarkdownExtra::defaultTransform($html);
        $html = SmartyPants::defaultTransform($html);
        $html = $this->postTransformText($html);
        return $html;
    }

    protected function preTransformText($text)
    {
        return $text;
    }

    protected function postTransformText($text)
    {
        return $text;
    }
}