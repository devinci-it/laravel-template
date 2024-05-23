<!-- resources/views/components/empty-state.blade.php -->
<div class="empty-state">
    <div class="empty-state-container">
        <!-- Placeholder for the SVG -->
        <div class="empty-state-icon">
            <!-- Add your SVG here -->
        </div>
        <svg width="100" height="86" viewBox="0 0 100 86" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M90.7407 66.6667H9.25921L1.85181 77.7779V79.6297C1.85181 80.612 2.24202 81.554 2.9366 82.2486C3.63118 82.9432 4.57323 83.3334 5.55551 83.3334H94.4444C95.4267 83.3334 96.3687 82.9432 97.0633 82.2486C97.7579 81.554 98.1481 80.612 98.1481 79.6297V77.7779L90.7407 66.6667Z" stroke="#333333" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M1.85181 77.7781H98.1481" stroke="#333333" stroke-width="3" stroke-linejoin="round"/>
            <path d="M57.4073 25.926H75.9258M57.4073 18.5186H83.3332M90.7818 11.9148L12.0438 11.1112C11.3162 11.1112 10.6184 11.4002 10.1039 11.9148C9.58934 12.4293 9.30029 13.1271 9.30029 13.8547V66.6668H90.7818V11.9148Z" stroke="#333333" stroke-width="3" stroke-linejoin="round"/>
            <mask id="mask0_23_14" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="100" height="86">
                <path d="M100 0H0V85.1852H100V0Z" fill="white"/>
            </mask>
            <g mask="url(#mask0_23_14)">
            </g>
        </svg>

        <p class="empty-state-message">No content available</p>
        <button class="btn round" onclick="location.reload();">
            <svg id="reload"  xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M3.38 8A9.502 9.502 0 0 1 12 2.5a9.502 9.502 0 0 1 9.215 7.182.75.75 0 1 0 1.456-.364C21.473 4.539 17.15 1 12 1a10.995 10.995 0 0 0-9.5 5.452V4.75a.75.75 0 0 0-1.5 0V8.5a1 1 0 0 0 1 1h3.75a.75.75 0 0 0 0-1.5H3.38Zm-.595 6.318a.75.75 0 0 0-1.455.364C2.527 19.461 6.85 23 12 23c4.052 0 7.592-2.191 9.5-5.451v1.701a.75.75 0 0 0 1.5 0V15.5a1 1 0 0 0-1-1h-3.75a.75.75 0 0 0 0 1.5h2.37A9.502 9.502 0 0 1 12 21.5c-4.446 0-8.181-3.055-9.215-7.182Z"/></svg>
            &nbsp;Reload</button>
    </div>
</div>

@once
    @push('styles')
        <style>
            .empty-state {
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100%;
                background-color: #f9f9f9;
                padding: 20px;
                box-sizing: border-box;
                border-radius: 20px;

            }

            .empty-state-container {
                text-align: center;
                color: #555;
            }

            .empty-state-icon {
                margin-bottom: 20px;
            }

            .empty-state-message {
                font-size: 1.2rem;
                margin-bottom: 10px;
            }
            #reload{
                transition: all ease 500ms;
            }

            .empty-state-action {
                color: var(--text-color);
                border: none;
                font-size: 1rem;
                cursor: pointer;
                border-radius: 5px;
                transition: background-color 0.3s;
            }
            #reload:hover{
                transform: rotate(185deg);

            }


        </style>
    @endpush
@endonce
