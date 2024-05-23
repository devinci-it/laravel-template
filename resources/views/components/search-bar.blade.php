<form method="GET" action="{{ url()->current() }}">
    <input type="search" name="query" placeholder="Search Query" value="{{ request('query') }}">
    <button type="submit">Search</button>
</form>
