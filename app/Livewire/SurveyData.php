<?php

namespace App\Livewire;

use Livewire\Component;

class SurveyData extends Component
{
    public $surveyData;

    public function mount($surveyData)
    {
        $this->surveyData = $surveyData;
    }

    public function render()
    {
        return view('livewire.survey-data');
    }
}
