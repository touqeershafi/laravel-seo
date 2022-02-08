<?php

namespace RalphJSmit\Laravel\SEO\Support;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\View;

abstract class Tag implements Renderable
{
    public string $tag;

    public array $attributesPipeline = [];

    public function render(): View
    {
        return view("seo::tags.tag", [
            'tag' => $this->tag,
            'attributes' => $this->collectAttributes(),
            'inner' => $this->inner ?? null,
        ]);
    }

    public function collectAttributes(): array
    {
        return collect($this->attributes ?? get_object_vars($this))
            ->except(['tag', 'inner', 'attributesPipeline'])
            ->pipeThrough($this->attributesPipeline)
            ->all();
    }
}