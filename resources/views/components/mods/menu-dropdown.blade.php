@php
    /**
     * Blade Component: Menu Dropdown
     *
     * This component renders a customizable menu dropdown with clickable action items.
     *
     * @props
     * - menuItems: Array of menu items with 'title', 'action', 'icon', 'shortcut', and 'jsFunction'.
     *
     * Example usage:
     * <x-mods.menu-dropdown :menuItems="$menuItems" />
     *
     * Each menu item should be an array with the following structure:
     * [
     *     'title' => 'Item Title',
     *     'action' => 'actionName', // Optional Livewire action
     *     'jsFunction' => 'jsFunctionName()', // Optional JavaScript function
     *     'icon' => 'path/to/icon.svg', // Optional
     *     'shortcut' => 'Ctrl+H', // Optional
     * ]
     */
@endphp

@props(['menuItems'])

<div class="menu">
    <button class="trigger btn input round py1" id="settings-button">Menu&nbsp;
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
            <path d="M11.646 15.146L5.854 9.354a.5.5 0 0 1 .353-.854h11.586a.5.5 0 0 1 .353.854l-5.793 5.792a.5.5 0 0 1-.707 0Z"></path>
        </svg>
    </button>
    <div class="overlay-menu" id="overlay-menu">
        @foreach ($menuItems as $item)
            <div
                class="action-list-item"
                @if(isset($item['jsFunction']))
                    onclick="{{ $item['jsFunction'] }}"
                @else
                    wire:click="handleMenuAction('{{ $item['action'] ?? '' }}')"
                @endif
            >
                @isset($item['icon'])
                    <img src="{{ $item['icon'] }}" alt="{{ $item['title'] }}" class="icon">
                @endisset
                <span>{{ $item['title'] }}</span>
                @isset($item['shortcut'])
                    <span class="shortcut">{{ $item['shortcut'] }}</span>
                @endisset
            </div>
        @endforeach
    </div>
</div>

@push('styles')
    <style>
        .menu {
            position: relative;
            display: inline-block;
        }

        .trigger {
            display: flex;
            gap: 1em;
            background: #ffffff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 4px;
        }

        .overlay-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            width: 300px;
            background: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            margin-top: 8px;
            z-index: 1000;
        }

        .menu.show .overlay-menu {
            display: block;
        }

        .action-list-item {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            cursor: pointer;
            border-bottom: 1px solid #f0f0f0;
        }

        .action-list-item:hover {
            background: #f9f9f9;
        }

        .action-list-item:last-child {
            border-bottom: none;
        }

        .icon {
            margin-right: 10px;
            width: 16px;
            height: 16px;
        }

        .shortcut {
            margin-left: auto;
            color: #999;
            font-size: 12px;
        }

        @media (max-width: 768px) {
            .trigger {
                padding: 10px 15px;
            }

            .overlay-menu {
                width: 100%;
                left: 0;
                right: 0;
            }

            .action-list-item {
                padding: 10px 15px;
            }
        }

        @media (max-width: 480px) {
            .trigger {
                padding: 10px;
            }

            .overlay-menu {
                width: 100%;
                left: 0;
                right: 0;
            }

            .action-list-item {
                padding: 10px;
            }

            .icon {
                width: 12px;
                height: 12px;
            }

            .shortcut {
                font-size: 10px;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const menu = document.querySelector('.menu');
            const settingsButton = document.getElementById('settings-button');
            const overlayMenu = document.getElementById('overlay-menu');

            settingsButton.addEventListener('click', function (event) {
                event.stopPropagation();
                menu.classList.toggle('show');
            });

            document.addEventListener('click', function (event) {
                if (!menu.contains(event.target)) {
                    menu.classList.remove('show');
                }
            });

            overlayMenu.addEventListener('click', function (event) {
                event.stopPropagation();
            });
        });
    </script>
@endpush
