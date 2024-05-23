<!-- Sublink Card Component -->

@php
    /**
     * Renders a sublink card component.
     *
     * @param string $title The title of the card.
     * @param string $slot The main content of the card.
     * @param string $link The URL the card links to.
     * @param string $linkText The text for the link.
     */
@endphp

<div {{ $attributes->merge(['class' => 'sublink-card-container']) }}>
    <h1 class="title-small-text">{{ $title }}</h1>
    <p class="sublink-card-content">{{ $slot }}</p>
    <a href="{{ $link }}" class="sublink-card-link">{{ $linkText }}</a>
</div>

@push('styles')
    <style>
        /* Sublink Card Styles */

        .sublink-card-container {
            background-color: #f8f8f8; /* Light grey background */
            padding: 20px;
            border-radius: 10px;
            max-width: 240px;
            margin: 20px auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }

        .sublink-card-title {
            border-bottom: solid var(--border-color) 1px;
            font-size: 2em;
            color: var(--text-color);
            font-weight: 700;
            width: 75%;
            margin: 0;
            font-size: min(15vw, 140px);
            font-weight: 343.301;
            font-stretch: 75%;
            font-variation-settings: "ital" 0, "wdth" 86;
            outline: 0px;
        }

        .sublink-card-content {
            font-size: 1em;
            color: #666;
            margin: 20px 0;
        }

        .sublink-card-link {
            display: inline-block;
            font-size: .8em;
            color: #0a1b20; /* Blue color */
            text-decoration: none;
            font-weight: bold;
        }

        .sublink-card-link:hover {
            text-decoration: underline; /* Underline on hover */
        }

        /* Media query for smaller screens */
        @media (max-width: 768px) {
            .sublink-card-title {
                font-weight: normal;
                font-size: 1rem;
                width: 100%; /* Make the title full width on smaller screens */
            }

            .sublink-card-container {
                flex: 1;
                max-width: 100%; /* Make the container full width */
                margin: 10px; /* Adjust margin for smaller screens */
                padding: 10px; /* Adjust padding for smaller screens */
            }

            .sublink-card-content {
                font-size: .7rem;
                color: var(--border-color);
            }
        }
    </style>
@endpush
