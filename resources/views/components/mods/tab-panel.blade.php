<!-- resources/views/components/mods/tab-panel.blade.php -->
@php
    /**
     * Blade Component: Tab Panel
     *
     * This component renders a tab panel with dynamic tabs and corresponding content.
     * It accepts an array of tab names and displays content for each tab using dynamic slots.
     *
     * @props
     * - tabs: An array of strings representing the names of the tabs.
     *
     * @slots
     * - Dynamic slots corresponding to each tab name. For example, if the tab name is 'Cat1',
     *   you should define a slot with the name 'tabCat1' in the parent view to render the content
     *   for that tab. The content of the slot can be accessed in the component using
     *   `{{ ${"tab" . $tab} ?? '' }}`.
     *
     * @styles
     * - Includes styles to make the tabs look modern and minimalistic.
     *   The active tab is highlighted, and tab content is displayed based on the selected tab.
     *
     * @scripts
     * - Includes a vanilla JavaScript script to handle tab switching functionality.
     *   When a tab is clicked, it becomes active, and the corresponding tab content is displayed.
     */
@endphp
<div id="tab-panel">
    <ul class="tabs">
        @foreach ($tabs as $index => $tab)
            <li
                class="tab {{ $index === 0 ? 'active' : '' }}"
                data-index="{{ $index }}"
            >
                {{ $tab }}
            </li>
        @endforeach
    </ul>
    <div class="tab-content">
        @foreach ($tabs as $index => $tab)
            <div class="tab-pane {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}">
                {{ ${"tab" . $tab} ?? '' }}
            </div>
        @endforeach
    </div>
</div>

@push('styles')
    <style>
        .tabs {
            display: flex;
            list-style-type: none;
            padding: 0;
            margin: 0;
            border-bottom: 2px solid #ddd;
        }
        .tabs .tab {
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border-bottom: 2px solid transparent;
        }
        .tabs .tab:hover {
            background-color: #f0f0f0;
        }
        .tabs .tab.active {
            border-bottom: 2px solid #007bff;
            color: #03324c;
            font-weight: bold;
        }
        .tab-content {
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #ddd;
            border-top: none;
        }
        .tab-pane {
            display: none;
        }
        .tab-pane.active {
            display: block;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabs = document.querySelectorAll('#tab-panel .tabs .tab');
            const panes = document.querySelectorAll('#tab-panel .tab-pane');

            tabs.forEach(tab => {
                tab.addEventListener('click', function () {
                    const index = this.getAttribute('data-index');

                    // Update active tab
                    tabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');

                    // Update active pane
                    panes.forEach(pane => pane.classList.remove('active'));
                    document.querySelector(`#tab-panel .tab-pane[data-index="${index}"]`).classList.add('active');
                });
            });
        });
    </script>
@endpush
