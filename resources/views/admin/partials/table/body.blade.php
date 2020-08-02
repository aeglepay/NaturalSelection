<tbody>
    @foreach($records as $record)
    <tr>
        @foreach($columns as $column)
        <td data-title="{{ ucwords(__($column)) }}" class="justify-content-center">
            @switch($column)

            @case('email')
            <a href="mailto:{{ $record->$column }}">{{ $record->$column }}</a>
            @break

            @case('phone')
            <a href="tel:{{ $record->$column }}">{{ $record->$column }}</a>
            @break

            @case('user_id')
            @case('staff_id')
            @case('client_id')
            <a href="{{ url("users/{$record->user->id}") }}">
                <div class="td-content customer-name">
                    <img src="{{ $record->user->avatar ?? 'https://api.adorable.io/avatars/55/' }}" alt="{{ $record->user->name }}" class="rounded-circle" width="50px">
                    {{ $record->user->name }}
                </div>
            </a>
            @break

            @case('category_id')
            {{ $record->category->title }}
            @break

            @case('created_at')
            @case('updated_at')
            {{ $record->$column->diffForHumans() }}
            @break

            @case('amount')
            @case('fee')
            ${{ $record->$column }}
            @break

            @case('frequency')
            {{ $record->$column }}x/month
            @break

            @case('duration')
            {{ $record->$column }} month(s)
            @break

            @case('active')
            {!! $record->$column ? '<span class="text-success" data-feather="check"></span>' : '<span class="text-danger" data-feather="x"></span>'  !!}
            @break

            @case('name')
            @if($table == 'users')
            <div class="td-content customer-name">
                <img src="{{ $record->avatar ?? 'https://api.adorable.io/avatars/55/' }}" alt="{{ $record->name }}" class="rounded-circle" width="50px">
                {{ $record->name }}
            </div>
            @else
            {{ $record->name }}
            @endif
            @break

            @default
            {{ $record->$column }}
            @break

            @endswitch
        </td>
        @endforeach
        @if($table !== 'payments')
        <td>
            @include('admin.partials.table.actions')
        </td>
        @endif
    </tr>
    @endforeach
</tbody>
