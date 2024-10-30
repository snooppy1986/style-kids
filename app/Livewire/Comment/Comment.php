<?php

namespace App\Livewire\Comment;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;
use App\Livewire\Forms\CommentForm;

class Comment extends Component
{
    public CommentForm $form;
    public ?Model $model;

    public function mount(Model $model)
    {
        $this->model = $model;
        $this->form->setModel($model);
    }

    public function save(): void
    {
        $this->form->store();

        session()->flash('message', 'Спасибо за коментарий.');
    }
    #[Computed]
    public function comments(): Collection
    {
        return $this->model->comments()->get();
    }
    public function render(): View
    {
        return view('livewire.comment.comment', ['comments' => $this->comments()]);
    }

}
