@php
    /**
     * Renders a rectangular sub-link card.
     *
     * @param string $title The title of the card.
     * @param string $slot The main content of the card.
     * @param string $link The URL the card links to.
     * @param string $linkText The text for the link.
     */
@endphp

<div class="card">
    @isset($header)
        <div class="card-header">
            {{ $header }}
        </div>
    @endisset

    <div class="card-body">
        {{ $slot }}
    </div>

    @isset($footer)
        <div class="card-footer">
            {{ $footer }}
        </div>
    @endisset
</div>



