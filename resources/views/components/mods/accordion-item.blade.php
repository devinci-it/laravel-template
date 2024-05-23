<!-- resources/views/components/accordion-item.blade.php -->
@props(['id', 'icon' => '', 'minHeight' => '300px'])

@php
    $iconPath = $icon ? Vite::asset("resources/icons/$icon") : '';
@endphp

<div class="accordion-item mx-3 my-2 shadow-sm rounded">
    <div class="accordion-header title-large-text bg-light p-3" id="heading-{{ $id }}">
        <button class="accordion-button title-large-text w-100 d-flex justify-content-between align-items-center" type="button" data-toggle="collapse" data-target="#collapse-{{ $id }}" aria-expanded="false" aria-controls="collapse-{{ $id }}">
            <span class="d-flex align-items-center">
                @if($iconPath)
                    <span class="accordion-icon me-2 p1">
                        <img src="{{ $iconPath }}" alt="Icon" class="icon">
                    </span>
                @endif
                {{ $header }}
            </span>
            <span class="accordion-arrow">&#9662;</span>
        </button>
    </div>
    <div id="collapse-{{ $id }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ $id }}" data-parent="#accordionExample">
        <div class="accordion-body body-medium-text p-3" style="min-height: {{ $minHeight }}">
            {{ $slot }}
        </div>
    </div>
</div>

@once
    @push('styles')
        <style>
            .accordion-icon {
                margin-right: 8px;
            }
            .accordion-header {
                font-weight: 600;
                font-size: 1.25rem;
                text-transform: uppercase;
                background-color: #f8f9fa;
                border-radius: 5px 5px 0 0;
                cursor: pointer;
            }
            .accordion-button {
                background: none;
                font-size: 1rem;
                border: none;
                text-align: left;
                width: 100%;
                outline: none;
                padding: 0;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            .accordion-arrow {
                transition: transform 0.3s ease;
            }
            .accordion-button.collapsed .accordion-arrow {
                transform: rotate(-90deg);
            }
            .icon {
                width: 24px;
                height: 24px;
            }
            .accordion-body {
                transition: min-height 0.3s ease;
                background-color: #fff;
                border-radius: 0 0 5px 5px;
            }
        </style>
    @endpush
@endonce
