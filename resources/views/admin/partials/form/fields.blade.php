
<div class="row">
@foreach($fields as $field)
@php($value = isset($record) ? $record->$field : '')
@php($id = isset($record) ? "{$table}_{$field}_{$record->id}" : "{$table}_{$field}")
@switch($field)

@case('image')
@case('avatar')
@case('attachment')
<div class="form-group col-md-4">
    <div class="custom-file-container" data-upload-id="{{ $id }}" data-image="{{ isset($record) ? asset($value) : asset('img/theme/favicon.png')}}">
        <label>{{ ucwords(str_singular(__($table))) }} {{ ucwords(__($field)) }} <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
        <label class="custom-file-container__custom-file">
            <input type="file" name="{{ $field }}" class="custom-file-container__custom-file__custom-file-input" accept="image/*">
            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
            <span class="custom-file-container__custom-file__custom-file-control"></span>
        </label>
        <div class="custom-file-container__image-preview"></div>
    </div>
</div>
@break

@case('user_id')
<div class="form-group col-md-4">
    <label class="form-label text-muted">
        Select {{ ucwords(__($field)) }}
    </label>
    <select id="{{ $id }}" name="{{ $field }}" class="form-control basic">
        @foreach(App\User::all() as $item)
        <option {{ ($value == $item->id) ? 'selected' : null }} value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </select>
</div>
@break

@case('category_id')
<div class="form-group col-md-4">
    <label class="form-label text-muted">
        Select {{ ucwords(__($field)) }}
    </label>
    <select id="{{ $id }}" name="{{ $field }}" class="form-control basic">
        @foreach(App\Models\Category::all() as $item)
        <option {{ ($value == $item->id) ? 'selected' : null }} value="{{ $item->id }}">{{ $item->title }}</option>
        @endforeach
    </select>
</div>
@break

@case('brands')
<div class="form-group col-md-4">
    <label class="form-label text-muted">
        Select {{ ucwords(__($field)) }}
    </label>
    <select id="{{ $id }}" name="{{ $field }}" class="form-control basic" multiple="multiple">
        @foreach(App\Models\Brand::all() as $item)
        <option {{ (is_array($value) && in_array($item->id, $value)) ? 'selected' : null }} value="{{ $item->id }}">{{ $item->title }}</option>
        @endforeach
    </select>
</div>
@break

@case('payment_id')
<div class="form-group col-md-4">
    <label class="form-label text-muted">
        Select {{ ucwords(__($field)) }}
    </label>
    <select id="{{ $id }}" name="{{ $field }}" class="form-control basic">
        @foreach(App\Models\Payment::all() as $item)
        <option {{ ($value == $item->id) ? 'selected' : null }} value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </select>
</div>
@break

@case('icon')
<div class="form-group col-md-4">
    <label class="form-label text-muted">
        Select {{ ucwords(__($field)) }}
    </label>
    <select id="{{ $id }}" name="{{ $field }}" class="form-control basic">
        @foreach(icons() as $item)
        <option {{ ($value == $item) ? 'selected' : null }} value="{{ $item }}">{{ $item }}</option>
        @endforeach
    </select>
</div>
@break

@case('role')
<div class="form-group col-md-4">
    <label class="form-label text-muted">
        Select {{ ucwords(__($field)) }}
    </label>
    <select id="{{ $id }}" name="{{ $field }}" class="form-control basic">
    @foreach(['admin', 'customer'] as $item)
        <option {{ ($value == $item) ? 'selected' : null }} value="{{ $item }}">{{ ucfirst($item) }}</option>
    @endforeach
    </select>
</div>
@break

@case('status')
@case('active')
<div class="form-group col-md-4">
    <label class="form-label text-muted">
        Set {{ str_singular(__($table)) }} status
    </label>
    <select id="{{ $id }}" name="{{ $field }}" class="form-control basic">
    @if($table == 'users')
        @foreach(['Inactive', 'Active'] as $key => $item)
        <option {{ ($value == $key) ? 'selected' : null }} value="{{ $key }}">{{ ucfirst($item) }}</option>
    @endforeach
    @else
        @foreach(['admin', 'customer'] as $item)
        <option {{ ($value == $item) ? 'selected' : null }} value="{{ $item }}">{{ ucfirst($item) }}</option>
    @endforeach
    @endif
    </select>
</div>
@break


@case('location')
<div class="form-group col-md-4">
    <label class="form-label text-muted">
        Set {{ str_singular(__($table)) }} location
    </label>
    <select id="{{ $id }}" name="{{ $field }}" class="form-control basic">
    @if($table == 'menus')
        @foreach(['header' => 'Header', 'footer_first' => 'First Footer Column', 'footer_last' => 'Last Footer Column'] as $key => $item)
        <option {{ ($value == $key) ? 'selected' : null }} value="{{ $key }}">{{ ucfirst($item) }}</option>
    @endforeach
    @else
        @foreach(['admin', 'customer'] as $item)
        <option {{ ($value == $item) ? 'selected' : null }} value="{{ $item }}">{{ ucfirst($item) }}</option>
    @endforeach
    @endif
    </select>
</div>
@break

@case('type')
<div class="form-group col-md-4">
    <label class="form-label text-muted">
        {{ ucwords(str_singular(__($table))) }} {{ strtolower(__($field)) }}
    </label>
    <select id="{{ $id }}" name="{{ $field }}" class="form-control basic">
    @if($table == 'menus')
        @foreach(['parent', 'child'] as $item)
        <option {{ ($value == $item) ? 'selected' : null }} value="{{ $item }}">{{ ucfirst($item) }}</option>
    @endforeach
    @else
        @foreach(['type'] as $item)
        <option {{ ($value == $item) ? 'selected' : null }} value="{{ $item }}">{{ ucfirst($item) }}</option>
    @endforeach
    @endif
    </select>
</div>
@break

@case('bio')
@case('details')
@case('content')
<div class="form-group col-md-8">
    <label class="form-label text-muted">
        {{ ucwords(__($field)) }}
    </label>
    <div class="editor d-none"></div>
    <textarea type="text" id="{{ $id }}" name="{{ $field }}" class="form-control p-2" placeholder="Enter {{ str_singular(__($table)) }} {{ strtolower(__($field)) }}" rows="15">{{ $value }}</textarea>
</div>
@break

@case('title')
@case('name')
<div class="form-group col-md-8">
    <label class="form-label text-muted">
        {{ ucwords(__($field)) }}
    </label>
    <input type="text" id="{{ $id }}" name="{{ $field }}" class="form-control" placeholder="Enter {{ str_singular(__($table)) }} {{ strtolower(__($field)) }}" value="{{ $value }}">
</div>
@break

@case('email')
<div class="form-group col-md-4">
    <label class="form-label text-muted">
        {{ ucwords(__($field)) }}
    </label>
    <input type="email" id="{{ $id }}" name="{{ $field }}" class="form-control" placeholder="Enter {{ str_singular(__($table)) }} {{ strtolower(__($field)) }}" value="{{ $value }}">
</div>
@break

@case('amount')
@case('fee')
<div class="form-group col-md-4">
    <label class="form-label text-muted">
        {{ ucwords(__($field)) }} ($)
    </label>
    <input type="number" id="{{ $id }}" name="{{ $field }}" class="form-control" placeholder="Enter {{ str_singular(__($table)) }} {{ strtolower(__($field)) }}" value="{{ $value }}">
</div>
@break

@case('order')
<div class="form-group col-md-3">
    <label class="form-label text-muted">
        {{ ucwords(__($field)) }}
    </label>
    <input type="number" id="{{ $id }}" name="{{ $field }}" class="form-control" placeholder="{{ ucwords(str_singular(__($table))) }} {{ strtolower(__($field)) }}" value="{{ $value }}">
</div>
@break

@case('phone')
<div class="form-group col-md-4">
    <label class="form-label text-muted">
        {{ ucwords(__($field)) }}
    </label>
    <input type="tel" id="{{ $id }}" name="{{ $field }}" class="form-control" placeholder="Enter {{ str_singular(__($table)) }} {{ strtolower(__($field)) }}" value="{{ $value }}">
</div>
@break

@case('link')
<div class="form-group col-md-5">
    <label class="form-label text-muted">
        {{ ucwords(__($field)) }} (without <code>http</code>, <code>https</code> or <code>www</code>)
    </label>
    <input type="url" id="{{ $id }}" name="{{ $field }}" class="form-control" placeholder="Enter {{ str_singular(__($table)) }} {{ strtolower(__($field)) }}" value="{{ $value }}">
</div>
@break

@case('joined')
@case('exited')
@case('filing')
@case('mention')
@case('hearing')
@case('trial')
@case('ruling')
@case('start')
@case('end')
<div class="form-group col-md-4">
    <label class="form-label text-muted">
        {{ ucwords(__($field)) }} Date
    </label>
    <input type="tel" id="{{ $id }}" name="{{ $field }}" class="form-control date" placeholder="Select {{ ucwords(__($field)) }} Date" value="{{ $value }}">
</div>
@break

@default
<div class="form-group col-md-4">
    <label class="form-label text-muted">
        {{ ucwords(__($field)) }}
    </label>
    <input type="text" id="{{ $id }}" name="{{ $field }}" class="form-control" placeholder="Enter {{ str_singular(__($table)) }} {{ strtolower(__($field)) }}" value="{{ $value }}">
</div>
@break

@endswitch
@endforeach
</div>
