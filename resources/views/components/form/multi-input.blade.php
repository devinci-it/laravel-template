@props(['label', 'name', 'placeholder' => '', 'required' => false])

<div class="form-group">
    <label for="{{ $name }}_input">{{ $label }}</label>
    <div id="{{ $name }}_container" class="multi-input-container">
        <div class="multi-input-item">
            <input
                style="margin:0; border-radius:5px 0 0 5px;"
                type="text"
                id="{{ $name }}_input"
                name="{{ $name }}_temp"
                placeholder="{{ $placeholder }}"
                @if($required) required @endif
                class="form-control input round py0 my0"
            >
            <button type="button" class="add-btn py0 my0 input" onclick="addInput('{{ $name }}')">+</button>
        </div>
    </div>
</div>

@push('styles')
    <style>
        .form-group {
            margin-bottom: 1rem;
        }

        .form-control {
            width: calc(100% - 2rem);
            padding: 0.5rem;
            border-radius: 4px;
            display: inline-block;
        }

        .add-btn, .remove-btn {
            cursor: pointer;
            padding: 6px 10px;
            border-radius: 0 5px 5px 0;
        }

        /*.add-btn {*/
        /*    background-color: #5cb85c;*/
        /*    color: #fff;*/
        /*}*/

        /*.remove-btn {*/
        /*    background-color: #d9534f;*/
        /*    color: #fff;*/
        /*}*/

        .multi-input-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .multi-input-text {
            display: flex;
            align-items: center;
            padding: 0.5rem;
            border-radius: 4px;
            margin-bottom: 0.5rem;
        }

        .multi-input-text span {
            margin-right: 1rem;
        }
    </style>
@endpush

@push('scripts')
    <script>
        function addInput(name) {
            const container = document.getElementById(`${name}_container`);
            const inputField = document.getElementById(`${name}_input`);
            let inputValue = inputField.value.trim();
            inputValue = sanitizeInput(inputValue);

            if (inputValue) {
                const newItem = document.createElement('div');
                newItem.className = 'multi-input-text';
                newItem.innerHTML = `
                    <span class="capsule tag" >${inputValue}</span>
                    <input type="hidden" name="${name}[]" value="${inputValue}">
                    <button type="button" class="remove-btn btn" onclick="removeInput(this)">×</button>
                `;
                container.appendChild(newItem);
                inputField.value = '';
            }
        }

        function removeInput(button) {
            const item = button.parentNode;
            item.parentNode.removeChild(item);
        }

        function sanitizeInput(input) {
            const element = document.createElement('div');
            element.innerText = input;
            return element.innerHTML;
        }
    </script>
@endpush
