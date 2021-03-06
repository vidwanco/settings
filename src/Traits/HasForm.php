<?php

namespace Vidwan\Settings\Traits;

use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Contracts\View\View;
use Vidwan\Settings\Form;
use Vidwan\Settings\Settings;

/**
 * Has Form Trait
 */
trait HasForm
{
    /**
     * Parse Form key Attribute
     *
     * @param array $attributes
     * @param array $attributesFor an label id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function formLabel(array $attributes = [], array $attributesFor = []): View|ViewFactory
    {
        return Settings::label(
            $this,
            $attributes,
            array_key_exists('label', $attributesFor) ? $attributesFor['label'] : []
        );
    }

    /**
     * Setting Input View
     *
     * @param array $attributes
     * @param array $attributesFor an input type
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function formInput(array $attributes = [], array $attributesFor = []): View|ViewFactory
    {
        return Settings::input(
            $this,
            $attributes,
            array_key_exists('input', $attributesFor) ? $attributesFor['input'] : []
        );
    }

    /**
     * Get a Complete Form
     *
     * @param array $attributes
     * @return \Vidwan\Settings\Form
     */
    public function form(): Form
    {
        return Settings::form(self::all());
    }
}
