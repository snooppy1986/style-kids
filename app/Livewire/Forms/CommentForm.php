<?php

namespace App\Livewire\Forms;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CommentForm extends Form
{
    public ?Model $model;
    public string $name = '';
    public string $email = '';
    public int $rating = 0;
    public string $body = '';

    public function setModel(Model $model){
        $this->model = $model;
    }
    public function rules()
    {
        return [
            'name' => 'required|string|min:2|max:256',
            'email' => 'email|nullable',
            'rating' => 'integer|nullable',
            'body' => 'nullable|max:4096',
        ];
    }

    public function store()
    {
        $this->validate();
        $this->model->comments()->create(
            [
                'name' => $this->name,
                'email' => $this->email,
                'rating' =>$this->rating,
                'body' => $this->body,
                'active' => 1,
            ]
        );
        $this->reset(['rating', 'body']);
    }

}
