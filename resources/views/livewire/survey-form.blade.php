<div class="container mt-5">

    <!-- Show below Field on page 1 only -->
    @if($currentPage === 1)
    <!-- Page 1 Fields -->
    <div class="row">

        <!-- Field for first name -->
        <div class="col-md-6 mb-3">
            <input type="text" wire:model="firstName" name="firstName" class="form-control mb-1" placeholder="Enter first name">
            @error('firstName') <span class="text-danger">{{ $message }}</span>@enderror
        </div>

        <!-- Field for last name -->
        <div class="col-md-6 mb-3">
            <input type="text" wire:model="lastName" name="lastName" class="form-control mb-1" placeholder="Enter last name">
            @error('lastName') <span class="text-danger">{{ $message }}</span>@enderror
        </div>

        <!-- Field for address -->
        <div class="col-md-12 mb-3">
            <input type="text" wire:model="address" name="address" class="form-control mb-1" placeholder="Enter your addres">
            @error('address') <span class="text-danger">{{ $message }}</span>@enderror
        </div>

        <!-- Field for city -->
        <div class="col-md-6 mb-3">
            <input type="text" wire:model="city" name="city" class="form-control mb-1" placeholder="Enter your city">
            @error('city') <span class="text-danger">{{ $message }}</span>@enderror
        </div>

        <!-- Field for country -->
        <div class="col-md-6 mb-3">
            <input type="text" wire:model="country" name="country" class="form-control mb-1" placeholder="Enter your country">
            @error('country') <span class="text-danger">{{ $message }}</span>@enderror
        </div>

        <!-- Select for dob Month -->
        <div class="col-md-4 mb-3">
            <select name="" wire:model="dobMonth" id="" class="form-control mb-1">
                <option value="">-- Select Month --</option>
                @if(!empty($months) && count($months) > 0)
                @foreach($months as $month)
                <option value="{{ $month }}">{{ $month }}</option>
                @endforeach
                @endif
            </select>
            @error('dobMonth') <span class="text-danger">{{ $message }}</span>@enderror
        </div>

        <!-- Select for dob Day -->
        <div class="col-md-4 mb-3">
            <select name="" wire:model="dobDay" id="" class="form-control mb-1">
                <option value="">-- Select Day --</option>
                @if(!empty($days) && count($days) > 0)
                @foreach($days as $day)
                <option value="{{ $day }}">{{ $day }}</option>
                @endforeach
                @endif
            </select>
            @error('dobDay') <span class="text-danger">{{ $message }}</span>@enderror
        </div>


        <!-- Select for dob Year -->
        <div class="col-md-4 mb-3">
            <select name="" wire:model="dobYear" id="" class="form-control mb-1">
                <option value="">-- Select Year --</option>
                @if(!empty($years) && count($years) > 0)
                @foreach($years as $year)
                <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
                @endif
            </select>
            @error('dobYear') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
    </div>

    <button wire:click="nextPage" class="btn btn-primary">Next</button>


    @elseif($currentPage === 2)
    <!-- Page 2 Fields -->
    <div class="row">

        <!-- Select for marriage -->
        <div class="col-md-12 mb-3">
            <label class="mb-2">Are you married?</label>
            <select name="" wire:model.live="married" id="" class="form-control mb-1">
                <option value="">-- Select --</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
            @error('married') <span class="text-danger">{{ $message }}</span>@enderror
        </div>

        <!--  Show marriage date fields only when marriage is selected as yes -->
        @if($married === 'Yes')
        <!-- Select for date of marriage month -->
        <div class="col-md-4 mb-3">
            <select name="" wire:model="dateOfMarriageMonth" id="" class="form-control mb-1">
                <option value="">-- Select Month --</option>
                @if(!empty($months) && count($months) > 0)
                @foreach($months as $month)
                <option value="{{ $month }}">{{ $month }}</option>
                @endforeach
                @endif
            </select>
            @error('dateOfMarriageMonth') <span class="text-danger">{{ $message }}</span>@enderror
        </div>


        <!-- Select for date of marriage day -->
        <div class="col-md-4 mb-3">
            <select name="" wire:model="dateOfMarriageDay" id="" class="form-control mb-1">
                <option value="">-- Select Day --</option>
                @if(!empty($days) && count($days) > 0)
                @foreach($days as $day)
                <option value="{{ $day }}">{{ $day }}</option>
                @endforeach
                @endif
            </select>
            @error('dateOfMarriageDay') <span class="text-danger">{{ $message }}</span>@enderror
        </div>


        <!-- Select for date of marriage year -->
        <div class="col-md-4 mb-3">
            <select name="" wire:model="dateOfMarriageYear" id="" class="form-control mb-1">
                <option value="">-- Select Year --</option>
                @if(!empty($years) && count($years) > 0)
                @foreach($years as $year)
                <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
                @endif
            </select>
            @error('dateOfMarriageYear') <span class="text-danger">{{ $message }}</span>@enderror
        </div>


        <div class="col-md-12 mb-3">
            <input type="text" wire:model="countryOfMarriage" name="addres" class="form-control mb-1" placeholder="Country of Marriage">
            @error('countryOfMarriage') <span class="text-danger">{{ $message }}</span>@enderror
        </div>

        <!-- Show below fields only when married is selected as NO -->
        @elseif($married === 'No')
        <!-- Select for widowed -->
        <div class="col-md-12 mb-3">
            <label class="mb-2">Are you widowed?</label>
            <select name="" wire:model="widowed" id="" class="form-control mb-1">
                <option value="">-- Select --</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
            @error('widowed') <span class="text-danger">{{ $message }}</span>@enderror
        </div>


        <!-- Select for widowed -->
        <div class="col-md-12 mb-3">
            <label class="mb-2">Have you ever been married in the past?</label>
            <select name="" wire:model="everMarried" id="" class="form-control mb-1">
                <option value="">-- Select --</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
            @error('everMarried') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
        @endif
    </div>

    <button wire:click="previousPage" class="btn btn-secondary mr-2">Previous</button>
    <button wire:click="submitForm" class="btn btn-primary mr-2">Submit</button>
    @endif

    @if($surveyData)
    @if($submissionSuccess)
    <div class="alert alert-success mb-4" role="alert">
        Thank You! Survey submitted successfully.
    </div>
    @endif
    <div>
        <livewire:survey-data :surveyData="$surveyData" />
        <div>
            <button wire:click="resetForm" class="btn btn-info mr-2">Go Back</button>
        </div>
    </div>
    @endif

</div>