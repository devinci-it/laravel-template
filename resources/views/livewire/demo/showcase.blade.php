<!-- resources/views/livewire/showcase.blade.php -->

<div class="showcase-component border p-4 rounded shadow-sm mb-4">
    <h2 class="text-xl font-bold mb-2">{{ $title }}</h2>
    <p class="text-gray-700 mb-4">{{ $docstring }}</p>

    <!-- Rendered Component -->
    <div class="rendered-component mb-4">
        {{ $component }}
    </div>

    <!-- Toggle Button -->
    <button onclick="toggleCode('{{ $title }}')" class="bg-blue-500 text-white py-2 px-4 rounded">
        Show/Hide Code
    </button>

    <!-- Code Block -->
    <div id="code-block-{{ $title }}" class="code-block mt-4 hidden">
        <pre class="bg-gray-100 p-4 rounded"><code>{{ $code }}</code></pre>
    </div>
</div>

<script>
    function toggleCode(title) {
        var codeBlock = document.getElementById('code-block-' + title);
        if (codeBlock.classList.contains('hidden')) {
            codeBlock.classList.remove('hidden');
        } else {
            codeBlock.classList.add('hidden');
        }
    }
</script>

<style>
    .hidden {
        display: none;
    }
</style>
