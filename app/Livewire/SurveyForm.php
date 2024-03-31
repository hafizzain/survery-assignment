<?php

namespace App\Livewire;

use App\Models\Survey;
use Carbon\Carbon;
use Livewire\Component;

class SurveyForm extends Component
{
    public $submissionSuccess = false;
    public $marriageSelected = false;
    public $currentPage = 1;
    public $firstName;
    public $lastName;
    public $address;
    public $city;
    public $country;
    public $dobMonth;
    public $dobDay;
    public $dobYear;
    public $married;
    public $dateOfMarriageMonth;
    public $dateOfMarriageDay;
    public $dateOfMarriageYear;
    public $countryOfMarriage;
    public $widowed = 'No';
    public $everMarried = 'No';
    public $months = [];
    public $days = [];
    public $years = [];
    public $surveyData = [];


    public function mount()
    {
        $this->months = range(1, 12);
        $this->days = range(1, 31);
        $this->years = array_reverse(range(date('Y') - 100, date('Y')));
    }

    // Function for switching page to next
    public function nextPage()
    {
        if ($this->currentPage === 1) {
            $this->validatePageOne();
        } elseif ($this->currentPage === 2 && $this->marriageSelected) {
            $this->validatePageTwo();
        }

        $this->currentPage++;
    }

    // Function for switching page to previous
    public function previousPage()
    {
        $this->currentPage--;
    }

    public function updatedMarried($value)
    {
        $this->marriageSelected = $value === 'Yes';

        // Reset marriage feields if not married
        if (!$this->marriageSelected) {
            $this->resetMarriageFields();
        }
    }

    // Reset marriage fields if the married propert is changed 
    public function updated($propertyName)
    {
        if ($propertyName === 'married' && $this->married === 'No') {
            $this->resetMarriageFields();
        }
    }

    // Function to reset marriage fields
    public function resetMarriageFields()
    {
        $this->dateOfMarriageMonth = null;
        $this->dateOfMarriageDay = null;
        $this->dateOfMarriageYear = null;
        $this->countryOfMarriage = null;
    }


    // Validate function for the page 1 fields
    protected function validatePageOne()
    {
        $this->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'dobMonth' => 'required',
            'dobDay' => 'required',
            'dobYear' => 'required',
        ]);
    }

    // Validate function for the page 2 fields
    protected function validatePageTwo()
    {
        $rules = [];
        if ($this->married === 'Yes') {

            // Validate below fields if married is selected as yes
            $rules = [
                'dateOfMarriageMonth' => 'required',
                'dateOfMarriageDay' => 'required',
                'dateOfMarriageYear' => 'required',
                'countryOfMarriage' => 'required',
            ];

            // Validating the date of marriage should be 18 years after the dob
            $rules['dateOfMarriageYear'] = [
                'required',
                function ($attribute, $value, $fail) {
                    $dob = \Carbon\Carbon::createFromDate($this->dobYear, $this->dobMonth, $this->dobDay);
                    $marriageDate = \Carbon\Carbon::createFromDate($this->dateOfMarriageYear, $this->dateOfMarriageMonth, $this->dateOfMarriageDay);
                    if ($dob->diffInYears($marriageDate) < 18) {
                        $fail('You are not eligible to apply because your marriage occured before your 18th birthday.');
                    }
                }
            ];
        } elseif ($this->married === 'No') {
            // Validate following if married is selected as no
            $rules = [
                'widowed' => 'required',
                'everMarried' => 'required',
            ];
        }

        $this->validate($rules);
    }

    public function submitForm()
    {
        if ($this->currentPage === 2) {
            $this->validatePageTwo();
        }

        // Collect all form data
        $surveyData = [
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'address' => $this->address,
            'city' => $this->city,
            'country' => $this->country,
            'dob' => Carbon::createFromDate($this->dobYear, $this->dobMonth, $this->dobDay),
            'married' => $this->married === 'Yes',
            'date_of_marriage' => ($this->married === 'Yes') ? Carbon::createFromDate(
                $this->dateOfMarriageYear,
                $this->dateOfMarriageMonth,
                $this->dateOfMarriageDay
            ) : null,
            'country_of_marriage' => $this->countryOfMarriage,
            'widowed' => $this->widowed,
            'ever_married' => $this->everMarried,
        ];

        // Craete record of the survery in database
        Survey::create($surveyData);
        $this->currentPage = null;
        $this->submissionSuccess = true;
        $this->surveyData = $surveyData;
    }

    // Reset page with all default values and go to page 1
    public function resetForm()
    {
        $this->currentPage = 1;
        $this->reset();
        $this->months = range(1, 12);
        $this->days = range(1, 31);
        $this->years = array_reverse(range(date('Y') - 100, date('Y')));
    }

    public function render()
    {
        return view('livewire.survey-form');
    }
}
