<?php

namespace App\View\Components\blog;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Show extends Component
{
    /**
     * Create a new component instance.
     */

    protected $except = ['post'];

    public function __construct(public Post $post)
    {
    }

    public function changeTitle()
    {
        return $this->post->title = "new title";
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.blog.show');
    }
}
