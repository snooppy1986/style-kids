<?php

namespace App\Livewire\Comment;

use Livewire\Component;

class RatingStarsAndCountReviews extends Component
{
    public object $comments;
    public bool $margin=false;
    public bool $showCountReviews=false;
    public int $rating;

    public function mount()
    {
        $this->avgRating();
    }

    public function avgRating(): int
    {
        return $this->rating = $this->comments->avg('rating') ? $this->comments->avg('rating') : 0;
    }

    public function render()
    {
        return view('livewire.comment.rating-stars-and-count-reviews');
    }
}
