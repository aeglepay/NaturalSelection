<thead>
    <tr>
        @foreach($columns as $column)
            @switch($column)
            @case('email')
            <th>Email Address</th>
            @break

            @case('phone')
            <th>Phone Number</th>
            @break

            @case('user_id')
            <th>
            @if(in_array($table, ['users', 'customers']))
            {{ __('name')}}
            @else
            {{ __('user_id')}}
            @endif
            </th>
            @break

            @default
            <th>{{ ucwords(__($column)) }}</th>
            @break
            @endswitch
        @endforeach
        @if($table !== 'payments')
        <th>Actions</th>
        @endif
    </tr>
</thead>
