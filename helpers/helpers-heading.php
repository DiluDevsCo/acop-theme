<?php
function almus_applyAlignment($acf_array, $class = '')
{
    $element = isset($acf_array['head']) ? $acf_array['head'] : 'div';
    $title_heading = isset($acf_array['title_heading']) ? $acf_array['title_heading'] : 'New title';
    $text_color = isset($acf_array['text_color']) ? $acf_array['text_color'] : '#000000';
    $align_image = isset($acf_array['align_text']) ? $acf_array['align_text'] : 'align_left';

    $alignment = '';
    if ($align_image === 'align_left') {
        $alignment = 'text-left';
    } elseif ($align_image === 'align_right') {
        $alignment = 'text-right';
    } else {
        $alignment = 'text-center';
    }
    return "<{$element} style=\"color:{$text_color};\" class=\"text-3xl font-bold pb-3 {$alignment} {$class}\">{$title_heading}</{$element}>";
}
