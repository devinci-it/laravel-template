<!-- resources/views/components/accordion.blade.php -->
<div class="accordion">
    {{ $slot }}
</div>

@push('styles')
    <style>
        .accordion {
            border: 1px solid #ddd;
            border-radius: 5px;
            margin: 20px 0;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .accordion-item {
            border-bottom: 1px solid #ddd;
        }

        .accordion-item:last-child {
            border-bottom: none;
        }

        .accordion-header {
            background-color: #f8f9fa;
            cursor: pointer;
            padding: 0;
        }

        .accordion-button {
            background: none;
            font-size: 1rem;
            border: none;
            text-align: left;
            width: 100%;
            outline: none;
            padding: 1rem;
        }

        .accordion-collapse {
            display: none;
        }

        .accordion-collapse.show {
            display: block;
            border-top: 1px solid #ddd;
            background-color: #fff;
            padding: 1rem;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var accordionButtons = document.querySelectorAll('.accordion-button');

            accordionButtons.forEach(function(button) {
                button.addEventListener('click', function () {
                    var target = document.querySelector(button.getAttribute('data-target'));

                    if (target.classList.contains('show')) {
                        target.classList.remove('show');
                        button.classList.add('collapsed');
                    } else {
                        document.querySelectorAll('.accordion-collapse.show').forEach(function(openItem) {
                            openItem.classList.remove('show');
                        });
                        document.querySelectorAll('.accordion-button').forEach(function(openButton) {
                            openButton.classList.add('collapsed');
                        });
                        target.classList.add('show');
                        button.classList.remove('collapsed');
                    }
                });
            });
        });
    </script>
@endpush
