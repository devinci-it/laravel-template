<div class="search-results">
    <div class="search-meta">
        <h2>Search Results for "{{ $searchTerm }}"</h2>
        <p>{{ $results->total() }} results found</p>
    </div>

    <div class="results-list" id="results-list">
        @foreach ($results as $result)
            <a href="/view/{{ $result->getModel()->id }}" class="result-item">
                <h3>{{ $result->title }} ^</h3> <!-- Append caret (^) to the title -->
                <p>{{ $result->description }}</p>
                <a>View More</a>
            </a>
        @endforeach
    </div>

    <div id="pagination">
        {{ $results->links() }}
    </div>
</div>

<style>
    .search-results {
        font-family: Arial, sans-serif;
        margin: 20px;
    }

    .search-meta {
        margin-bottom: 20px;
    }

    .results-list .result-item {
        display: block;
        padding: 10px;
        border-bottom: 1px solid #ddd;
        text-decoration: none; /* Remove default underline from links */
        color: #333; /* Set link color */
    }

    .results-list .result-item:last-child {
        border-bottom: none;
    }

    .result-item h3 {
        margin: 0;
        font-size: 1.2em;
        color: #333;
    }

    .result-item p {
        margin: 5px 0 0;
        color: #666;
    }

    .result-item h3::after {
        content: " ^"; /* Add caret (^) after the title */
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const nextLink = document.querySelector('#pagination .pagination .page-link[rel="next"]');
                    if (nextLink) {
                        const url = nextLink.getAttribute('href');
                        observer.unobserve(entry.target);
                        fetchMoreResults(url);
                    }
                }
            });
        }, {
            root: null,
            rootMargin: '0px',
            threshold: 1.0
        });

        function fetchMoreResults(url) {
            fetch(url)
                .then(response => response.text())
                .then(data => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(data, 'text/html');
                    const newResults = doc.querySelector('#results-list').innerHTML;
                    const newPagination = doc.querySelector('#pagination').innerHTML;

                    document.querySelector('#results-list').insertAdjacentHTML('beforeend', newResults);
                    document.querySelector('#pagination').innerHTML = newPagination;

                    const nextLink = document.querySelector('#pagination .pagination .page-link[rel="next"]');
                    if (nextLink) {
                        observer.observe(nextLink);
                    }
                });
        }

        const nextLink = document.querySelector('#pagination .pagination .page-link[rel="next"]');
        if (nextLink) {
            observer.observe(nextLink);
        }
    });
</script>
