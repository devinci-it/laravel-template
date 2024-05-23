@php
    /**
     * Blade Component: Page Header
     *
     * This component renders a header for a web page.
     * It accepts props for the section header, pre-text, section sub-header,
     * breadcrumb items with their respective paths, and an optional icon.
     *
     * @props
     * - sectionHeader: The main header/title of the section.
     * - preText: Any text to be displayed before the main header.
     * - sectionSubHeader: Sub-header or additional information for the section.
     * - breadCrumb: An array of breadcrumb items. Each item should be an associative
     *               array with 'label' (text to display) and 'path' (URL path).
     * - icon: The filename of the icon to be displayed.
     */
@endphp

@props([
    'sectionHeader',
    'preText' => null,
    'sectionSubHeader' => null,
    'breadCrumb' => [],
    'icon' => null,
])

<div style="padding-bottom: 5px; margin-bottom: 20px;">
    <!-- Render optional icon -->
    @if($icon)
        <img src="{{ Vite::asset('resources/icons/' . $icon) }}" alt="Icon" class="header-icon">
    @endif

    @if($preText)
        <p style="margin-bottom: 10px; font-weight: 400" class="py0 round btn">{{ $preText }}</p>
    @endif

    <h1 style="margin-bottom: 2px;" class="title-large-text">{{ $sectionHeader }}</h1>

    @if($sectionSubHeader)
        <h2 style="margin-bottom: 2px;" class="subtitle-text">{{ $sectionSubHeader }}</h2>
    @endif

    @if(count($breadCrumb) > 0)
        <ul style="margin-bottom: 3px; border-top: 1px solid var(--border-color);">
            @foreach($breadCrumb as $item)
                <li style="display: inline-block; margin-right: 10px;">
                    <a href="{{ $item['path'] }}" style="text-decoration: none;" class="caption-text gray">{{ $item['label'] . ' /' }}</a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
