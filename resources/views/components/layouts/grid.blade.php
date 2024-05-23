<!-- resources/views/components/layouts/grid.blade.php -->
@php
    /**
     * Render a customizable grid layout.
     *
     * This Blade component renders a grid layout with a specified number of columns or a custom grid template,
     * where each column can contain custom content. The grid layout is responsive, adjusting the number of columns
     * based on the screen size.
     *
     * @param string $name The base name used to generate dynamic class names for the container and columns.
     * @param string|null $gridTemplate A custom grid-template-columns value. If not provided, an equal column layout will be used based on the 'columns' parameter.
     * @param int $columns The number of equal-sized columns to render if 'gridTemplate' is not provided. Default is 3 columns.
     * @param string $gap The gap between columns. Default is '20px'.
     * @param string|null $containerClass Additional classes for the grid container. Automatically includes a dynamically generated class based on the 'name' parameter.
     * @param string|null $columnClass Additional classes for each grid column. Automatically includes a dynamically generated class based on the 'name' parameter.
     *
     * @return void
     */
@endphp

@props([
    'name', // Require a name to generate dynamic class names
    'gridTemplate' => null, // Allows custom grid-template-columns value
    'columns' => 3, // Default to a 3-column grid if gridTemplate is not provided
    'gap' => '20px', // Default gap between columns
])

@php
    $containerClass = "{$name}-grid-container";
    $columnClass = "{$name}-grid-item";
    $gridTemplateColumns = $gridTemplate ?? 'repeat(' . $columns . ', 1fr)';
@endphp

    @push('styles')
        <style>
            .{{ $containerClass }} {
                display: grid;
                grid-template-columns: {{ $gridTemplateColumns }};
                gap: {{ $gap }};
            }

            @media (max-width: 1200px) {
                .{{ $containerClass }} {
                    grid-template-columns: {{ $gridTemplate ?? 'repeat(' . min($columns, 2) . ', 1fr)' }}; /* Default to 2 equal columns */
                }
            }

            @media (max-width: 768px) {
                .{{ $containerClass }} {
                    grid-template-columns: 1fr; /* Single column on small screens */
                }
            }

            .{{ $columnClass }} {
                /* Ensure content takes up available space */
                width: 100%;
            }
        </style>
    @endpush

<div class="{{ $containerClass }} p3 my2">
    @for ($i = 1; $i <= ($gridTemplate ? substr_count($gridTemplate, ' ') + 1 : $columns); $i++)
        <div class="col col-{{ $i }} {{ $columnClass }} my3">
            @if (isset(${'slot' . $i}))
                {{ ${'slot' . $i} }}
            @else
                <!-- Render empty state component or leave blank -->
                <x-empty-state />
            @endif
        </div>
    @endfor
</div>
