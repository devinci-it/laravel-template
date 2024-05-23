<div {{ $attributes->merge(['class' => 'file-upload-component']) }} data-name="{{ $name }}" data-show-preview="{{ $showPreview }}">
    <input type="file" id="file-input-{{ $name }}" name="{{ $name }}[]" multiple>

    <div class="file-drop-area" id="file-drop-area-{{ $name }}">
        <svg width="110" height="130" viewBox="0 0 110 130" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="0.543457" y="17.8885" width="88" height="114" rx="17" transform="rotate(-11.4706 0.543457 17.8885)" fill="white"/>
            <path d="M1.14005 20.8286C0.810563 19.2049 1.85978 17.6214 3.48354 17.292L66.0025 4.60572C67.6263 4.27623 69.2097 5.32544 69.5392 6.9492L72.0897 19.5187C72.4192 21.1425 74.0027 22.1917 75.6264 21.8622L87.5895 19.4347C89.2133 19.1052 90.7967 20.1544 91.1262 21.7782L108.86 109.171C109.189 110.795 108.14 112.379 106.516 112.708L26.1542 129.015C24.5304 129.345 22.947 128.295 22.6175 126.672L1.14005 20.8286Z" fill="#D9D9D9" fill-opacity="0.95"/>
        </svg>

        <p class="caption-text">Drag & drop files here or click to select files</p>
    </div>

    <div class="upload-progress">
        <!-- Upload progress will be displayed here -->
    </div>
</div>

@once

    @push('scripts')
        <script>
            class FileUploadComponent {
                constructor(element) {
                    this.element = element;
                    this.name = element.dataset.name;
                    this.showPreview = element.dataset.showPreview === 'true';
                    this.fileInput = this.element.querySelector('input[type="file"]');
                    this.fileDropArea = this.element.querySelector('.file-drop-area');
                    this.filePreview = this.element.querySelector('.file-preview tbody');

                    // Bind event handlers
                    this.fileInput.addEventListener('change', this.handleFiles.bind(this));
                    this.fileDropArea.addEventListener('drop', this.handleDrop.bind(this));
                    this.fileDropArea.addEventListener('dragover', this.handleDragOver.bind(this));
                    this.fileDropArea.addEventListener('click', () => {
                        this.fileInput.click();
                    });
                }

                handleFiles(event) {
                    const files = event.target.files;
                    if (this.showPreview) {
                        this.displayFiles(files);
                    }
                }

                handleDrop(event) {
                    event.preventDefault();
                    const files = event.dataTransfer.files;
                    this.addFilesToInput(files);
                    if (this.showPreview) {
                        this.displayFiles(files);
                    }
                }

                handleDragOver(event) {
                    event.preventDefault();
                }

                addFilesToInput(files) {
                    const dataTransfer = new DataTransfer();
                    for (let file of files) {
                        dataTransfer.items.add(file);
                    }
                    this.fileInput.files = dataTransfer.files;
                }

                displayFiles(files) {
                    this.filePreview.innerHTML = '';
                    for (let file of files) {
                        const fileElement = document.createElement('tr');
                        const fileNameCell = document.createElement('td');
                        fileNameCell.textContent = file.name;
                        fileElement.appendChild(fileNameCell);
                        this.filePreview.appendChild(fileElement);
                    }
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                const fileUploadComponents = document.querySelectorAll('.file-upload-component');
                for (let component of fileUploadComponents) {
                    new FileUploadComponent(component);
                }
            });

        </script>
    @endpush
@endonce


@push('styles')
    <style>
        .file-upload-component {
            border: 1px solid #ccc;
            padding: 1rem;
            border-radius: 5px;
            position: relative;
            width: 100%;
            max-width: 300px;
            margin: auto;
        }

        .upload-button {
            padding: 0.5rem 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f8f8f8;
            cursor: pointer;
        }

        .file-drop-area {
            cursor: pointer;
            border: 1px dashed var(--border-color);
            padding: 1rem;
            border-radius: 5px;
            text-align: center;
            margin-top: 1rem;
        }

        .file-preview {
            margin-top: 1rem;
        }

        .file-preview table {
            width: 100%;
            border-collapse: collapse;
        }

        .file-preview th, .file-preview td {
            padding: 0.5rem;
            border: 1px solid #ccc;
            text-align: left;
        }

        .remove-file {
            cursor: pointer;
            color: red;
        }

        .upload-progress {
            margin-top: 1rem;
        }

        .progress-bar {
            width: 0;
            height: 1rem;
            background-color: #5cb85c;
            border-radius: 5px;
        }
    </style>
@endpush
