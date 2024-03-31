<!-- White page to show the submitted survey data -->
@if($surveyData)
<table>
    <thead>
        <tr>
            <th>Field</th>
            <th>Value</th>
        </tr>
    </thead>
    <tbody>
        @foreach($surveyData as $field => $value)
        <!-- if value of any column is empty then dont show that -->
        @if(!empty($value))
        <tr>
            <td>{{ ucfirst(str_replace('_', ' ', $field)) }}</td>
            <td>
                <!-- Showing married as yes or no -->
                @if($field === 'married' && $value == 1)
                Yes
                @elseif($field === 'married' && $value == 0)
                No
                @else
                {{ $value }}
                @endif
            </td>
        </tr>
        @endif
        @endforeach
    </tbody>
</table>
@endif