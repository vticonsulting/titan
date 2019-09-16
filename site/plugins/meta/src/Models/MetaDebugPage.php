<?php

namespace Kirby\Meta\Models;

use Kirby\Cms\Page;

class MetaDebugPage extends Page
{
    public function metadata(): array
    {
        return [
            'robots' => 'noindex, nofollow',
        ];
    }
}