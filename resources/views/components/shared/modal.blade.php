
@props(['name'=>''])

@php
/**
      * Modal component.
      *
      * This component creates a modal overlay with customizable content.
      * It accepts a 'name' parameter to differentiate between multiple instances.
      *
      * Usage:
      * ```
      * <x-modal name="uniqueName">
      *     <x-slot name="title">
      *         Modal Title
      *     </x-slot>
      *     <p>This is the content of the modal.</p>
      * </x-modal>
      * ```
      *
      * @param {string} name - The unique identifier for the modal instance.
      */
@endphp

<div class="modal-overlay" id="modalOverlay_{{ $name }}" style="display: none;">
    <div class="modal" id="modal_{{ $name }}">
        <div class="modal-header">
            <h2 class="title-small-text">{{ $title ?? 'Modal Title' }}</h2>
            <button class="close-btn btn" id="closeBtn_{{ $name }}">&times;</button>
        </div>
        <div class="modal-body">
            {{ $slot }}
        </div>
        <div class="modal-footer">
            <button class="confirm-btn btn round" id="confirmBtn_{{ $name }}">Confirm</button>
        </div>
    </div>
</div>

@push('styles')
    <style>
        /* Animation for modal shake */
        @keyframes shake {
            0% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            50% { transform: translateX(5px); }
            75% { transform: translateX(-3px); }
            100% { transform: translateX(0); }
        }

        .shake {
            animation: shake 0.3s ease-in-out;
        }

        /* Styles for the modal overlay */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        /* Styles for the modal itself */
        .modal {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            width: 500px;
            max-width: 80%;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .modal-body {
            margin: 20px 0;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }

        /* Close button styles */
        .close-btn, .confirm-btn {
            background: none;
            border: none;
            font-size: 1.2em;
            cursor: pointer;
        }

        .confirm-btn {
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 1em;
            margin-left: 10px;
        }


        /* Disable scrolling on the body when modal is open */
        body.modal-open {
            overflow: hidden;
        }
    </style>
@endpush
@push('scripts')
    <script>


        document.addEventListener('DOMContentLoaded', function () {
            const modalOverlay = document.getElementById('modalOverlay_{{ $name }}');
            const modal = document.getElementById('modal_{{ $name }}');
            const closeBtn = document.getElementById('closeBtn_{{ $name }}');
            const confirmBtn = document.getElementById('confirmBtn_{{ $name }}');

            function showModal() {
                modalOverlay.style.display = 'flex';
                document.body.classList.add('modal-open');
            }

            function hideModal() {
                modalOverlay.style.display = 'none';
                document.body.classList.remove('modal-open');
            }

            function shakeModal() {
                modal.classList.add('shake');
                setTimeout(() => {
                    modal.classList.remove('shake');
                }, 500);
            }

            closeBtn.addEventListener('click', hideModal);
            confirmBtn.addEventListener('click', hideModal);

            // Close modal when clicking outside the modal
            modalOverlay.addEventListener('click', function (event) {
                if (event.target === modalOverlay) {
                    shakeModal();
                }
            });

            // Optionally, you can export the showModal function to be called from other scripts
            window.showModal_{{ $name }} = showModal;
        });
    </script>
@endpush
