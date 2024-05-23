<div {{ $attributes->merge(['class' => 'multi-step-form']) }}>
    {{ $slot }}

    <div class="form-navigation">
        <button type="button" class="prev-step btn round" style="display: none;" onclick="prevStep()">Previous</button>
        <button type="button" class="next-step btn round" onclick="nextStep()">Next</button>
        <button type="submit" class="submit-form btn round" style="display: none;">Submit</button>
    </div>
</div>

@push('styles')
    <style>
        .multi-step-form{
            width: 100%;
        }
        .multi-step-form .step {
            display: none;
            width: 100%;
        }

        .multi-step-form .step.active {
            display: block;
        }

        .form-navigation {
            display: flex;
            justify-content: space-between;
            margin-top: 1rem;
        }

        .form-navigation button {
            cursor: pointer;
        }


        /* Smooth shake animation */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            50% { transform: translateX(5px); }
            75% { transform: translateX(-5px); }
        }

        .shake {
            animation: shake 0.3s;
        }
        .form-group{
            width: 100%;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let steps = document.querySelectorAll('.multi-step-form .step');
            let prevButton = document.querySelector('.prev-step');
            let nextButton = document.querySelector('.next-step');
            let submitButton = document.querySelector('.submit-form');
            let currentStep = 0;

            function initialize() {
                steps = document.querySelectorAll('.multi-step-form .step');
                prevButton = document.querySelector('.prev-step');
                nextButton = document.querySelector('.next-step');
                submitButton = document.querySelector('.submit-form');

                if (steps.length > 0) {
                    showStep(currentStep);
                } else {
                    console.error('No steps found');
                }
            }

            function showStep(stepIndex) {
                steps.forEach((step, index) => {
                    step.classList.toggle('active', index === stepIndex);
                });

                if (prevButton) {
                    prevButton.style.display = stepIndex === 0 ? 'none' : 'inline-block';
                }
                if (nextButton) {
                    nextButton.style.display = stepIndex === steps.length - 1 ? 'none' : 'inline-block';
                }
                if (submitButton) {
                    submitButton.style.display = stepIndex === steps.length - 1 ? 'inline-block' : 'none';
                }
            }

            window.nextStep = function () {
                if (currentStep < steps.length - 1) {
                    currentStep++;
                    showStep(currentStep);
                }
            }

            window.prevStep = function () {
                if (currentStep > 0) {
                    currentStep--;
                    showStep(currentStep);
                }
            }

            // Initialize the multi-step form after the DOM is fully loaded
            initialize();
        });
    </script>
@endpush
