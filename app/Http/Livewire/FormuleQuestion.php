<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\UserQuestionAnswer;

class FormuleQuestion extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.formule-question', [UserQuestionAnswer::with('questions.options')
        ->paginate(10)])->extends('layouts.default', ['page_title', 'Home'])
        ->section('content');
    }
}
