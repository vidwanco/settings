<?php

namespace Vidwan\Settings;

use Closure;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;

class Form
{
    /**
     * Form Action
     *
     * @var string
     */
    protected $action;

    /**
     * Form Method
     *
     * @var string
     */
    protected $method;

    /**
     * Input Attributes
     *
     * @var array
     */
    protected array $input = [];

    /**
     * Attributes for a type of Input or Label, etc.
     * example: checkbox or radio
     *
     * @var array
     */
    protected array $attributesFor = [];

    /**
     * Input Form Attributes
     *
     * @var array
     */
    protected array $form = [];

    /**
     * Input Lable Attributes
     *
     * @var array
     */
    protected array $label = [];

    /**
     * Input Block Attributes
     *
     * @var array
     */
    protected array $block = [];

    /**
     * Form Button Type
     *
     * @var string
     */
    protected string $buttonType = 'submit';

    /**
     * Form Button Attributes
     *
     * @var array
     */
    protected array $button = [];

    /**
     * Eloquent Collection
     *
     * @var \Illuminate\Database\Eloquent\Collection
     */
    protected $collection;

    /**
     * Form is Multipart Type
     *
     * @var bool
     */
    protected bool $upload = false;

    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * Set Form Method
     *
     * @param string $method
     * @return self
     */
    public function method(string $method): self
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Set Form Action
     *
     * @param string $action
     * @return self
     */
    public function action(string $action): self
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Set Input Attributes
     *
     * @param array $attributes
     * @return self
     */
    public function inputAttributes(array $attributes): self
    {
        $this->input = $attributes;

        return $this;
    }

    /**
     * Set Input Attributes
     *
     * @param array $attributes
     * @return self
     */
    public function inputAttributesFor(string $for, array|Closure $attributes): self
    {
        $this->attributesFor['input'][$for] = is_callable($attributes) ? $attributes($this->collection) : $attributes;

        return $this;
    }

    /**
     * Set Input Invaild Class
     *
     * @param string $attributes
     * @return self
     */
    public function inValidClass(string $class): self
    {
        $this->attributesFor['is-invalid']['input'] = $class;

        return $this;
    }

    /**
     * Set Invaild Icon
     *
     * @param string $attributes
     * @return self
     */
    public function inValidIcon(string $icon): self
    {
        $this->attributesFor['is-invalid']['icon'] = $icon;

        return $this;
    }

    /**
     * Set Invaild Icon Class
     *
     * @param string $attributes
     * @return self
     */
    public function inValidIconClass(string $class): self
    {
        $this->attributesFor['is-invalid']['icon_class'] = $class;

        return $this;
    }

    /**
     * Set Invalid Message Attributes
     *
     * @param array $attributes
     * @return self
     */
    public function inValidMessageAttributes(array $attributes): self
    {
        $this->attributesFor['is-invalid']['message'] = $attributes;

        return $this;
    }

    /**
     * Set Label Attributes
     *
     * @param array $attributes
     * @return self
     */
    public function labelAttributes(array $attributes): self
    {
        $this->label = $attributes;

        return $this;
    }

    /**
     * Set Input Attributes
     *
     * @param array $attributes
     * @return self
     */
    public function labelAttributesFor(string $for, array|Closure $attributes): self
    {
        $this->attributesFor['label'][$for] = is_callable($attributes) ? $attributes($this->collection) : $attributes;

        return $this;
    }

    /**
     * Set Form Attributes
     *
     * @param array $attributes
     * @return self
     */
    public function formAttributes(array $attributes): self
    {
        $this->form = $attributes;

        return $this;
    }

    /**
     * Set Form Button Attributes
     *
     * @param array $attributes
     * @return self
     */
    public function buttonAttributes(array $attributes): self
    {
        $this->button = $attributes;

        return $this;
    }

    /**
     * Set Form Button Text
     *
     * @param string $text
     * @return self
     */
    public function buttonText(string $text): self
    {
        $this->attributesFor['button']['text'] = $text;

        return $this;
    }

    /**
     * Set Form Button Icon
     *
     * @param string $icon
     * @return self
     */
    public function buttonIcon(string $icon): self
    {
        $this->attributesFor['button']['icon'] = $icon;

        return $this;
    }

    /**
     * Set Form Button Icon
     *
     * @param string $class
     * @return self
     */
    public function buttonIconClass(string $class): self
    {
        $this->attributesFor['button']['icon']['class'] = $class;

        return $this;
    }

    /**
     * Set Input Block Attributes
     *
     * @param array $attributes
     * @return self
     */
    public function blockAttributes(array $attributes): self
    {
        $this->block = $attributes;

        return $this;
    }

    /**
     * Set Uploadable
     *
     * @param mixed $uploadable
     * @return self
     */
    public function uploadable(Closure|bool $uploadable = true): self
    {
        $this->upload = is_callable($uploadable) ? $uploadable() : $uploadable;

        return $this;
    }

    /**
     * Getter Function for Form Attributes
     *
     * @return array
     */
    public function getFormAttributes(): array
    {
        return $this->form;
    }

    /**
     * Getter Function for Input Attributes
     *
     * @return array
     */
    public function getInputAttributes(): array
    {
        return $this->input;
    }

    /**
     * Getter Function for Label Attributes
     *
     * @return array
     */
    public function getLabelAttributes(): array
    {
        return $this->label;
    }

    /**
     * Getter Function for Input For Attributes
     *
     * @return array
     */
    public function getAttributesFor(): array
    {
        return $this->attributesFor;
    }

    /**
     * Getter Function for Block Attributes
     *
     * @return array
     */
    public function getBlockAttributes(): array
    {
        return $this->block;
    }

    /**
     * Getter Function for Method
     *
     * @return ?string
     */
    public function getMethod(): ?string
    {
        return $this->method;
    }

    /**
     * Getter Function for Action
     *
     * @return ?string
     */
    public function getAction(): ?string
    {
        return $this->action;
    }

    /**
     * Getter Function for Action
     *
     * @return string
     */
    public function getButtonType(): string
    {
        return $this->buttonType;
    }

    /**
     * Getter Function for Block Attributes
     *
     * @return array
     */
    public function getButtonAttributes(): array
    {
        return $this->button;
    }

    /**
     * Getter Function for Uploadable
     *
     * @return bool
     */
    public function isUploadable(): bool
    {
        return $this->upload;
    }

    /**
     * Render the Form View
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function render(): View|ViewFactory
    {
        return Settings::formRender($this->collection, $this);
    }
}
