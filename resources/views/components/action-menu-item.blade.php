@php
/**
* Renders an action menu item with an icon and a label.
*
* @param array $action The action data containing 'name' and 'icon'.
*
* Example usage:
* <x-action-menu-item :action="['name' => 'Edit', 'icon' => 'edit-icon.svg']" />
* <x-action-menu-item :action="['name' => 'Delete', 'icon' => 'delete-icon.svg']" />
*/
@endphp

@props(['action'])


<div class="action-menu">
    <button class="btn action-btn">
        <img src="{{ Vite::asset('resources/icons/' . $action['icon']) }}" alt="{{ $action['name'] }}" class="menu-icon">
        <span class="label">{{ $action['name'] }}</span>
    </button>
</div>

@push('styles')
    <style>
        .action-menu {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .action-btn {
            background: none;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .action-btn:hover {
            transform: scale(1.1);
        }

        .menu-icon {
            width: 20px; /* Adjust as needed */
            height: 20px; /* Adjust as needed */
            object-fit: contain;
        }

        .label {
            opacity: 30%;
            transition: opacity 0.3s ease;
            margin-left: 10px; /* Adjust spacing between icon and label */
        }

        .action-btn:hover .label {
            opacity: 1;
        }
    </style>
@endpush
