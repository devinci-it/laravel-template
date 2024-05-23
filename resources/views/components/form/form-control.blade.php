@props(['label', 'name', 'type' => 'text', 'value' => '', 'placeholder' => '', 'required' => false, 'hideLabel' => false])

<div class="form-group">
    <label for="{{ $name }}" @if($hideLabel) style="display:none;" @endif>{{ $label }}</label>
    <input
        type="{{ $type }}"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $hideLabel ? $label : $placeholder }}"
        @if($required) required @endif
        class="form-control"
    >
    @error($name)
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

@push('styles')
    <style>
        .form-group {
            margin-bottom: 1rem;
        }

        .form-control {
            width: 100%;
            padding: 0.5rem;
            margin-top: 0.25rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .text-danger {
            color: #e3342f;
            font-size: 0.875rem;
        }
    </style>
@endpush
