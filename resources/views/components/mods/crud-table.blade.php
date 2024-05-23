@props(['columns' => [], 'apiUrl' => '#', 'perPage' => 10])

<div {{ $attributes->merge(['class' => 'dynamic-table-component']) }} data-api-url="{{ $apiUrl }}">
    <table class="table">
        <thead>
        <tr>
            @foreach($columns as $column)
                <th>{{ $column }}</th>
            @endforeach
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        {{ $slot }}
        </tbody>
    </table>

    <div class="pagination-controls">
        <button class="prev-page-button" onclick="prevPage()">Previous</button>
        <span class="page-info">Page 1 of <span id="total-pages"></span></span>
        <button class="next-page-button" onclick="nextPage()">Next</button>
    </div>
</div>

@once
    @push('scripts')
        <script>
            let currentPage = 1;
            const perPage = {{ $perPage }};
            let totalPages;

            function prevPage() {
                if (currentPage > 1) {
                    currentPage--;
                    updateTable();
                }
            }

            function nextPage() {
                if (currentPage < totalPages) {
                    currentPage++;
                    updateTable();
                }
            }

            function updateTable() {
                // Fetch data for current page from backend API using AJAX
                // Update table content
                // You can use Livewire to fetch data and render it here
            }

            // This function can be called from Livewire to update total pages
            function setTotalPages(total) {
                totalPages = Math.ceil(total / perPage);
                document.getElementById('total-pages').innerText = totalPages;
            }
        </script>
    @endpush
@endonce

sample usage aas a anon component say on my Products model
