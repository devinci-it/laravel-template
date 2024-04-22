@use('Illuminate\Support\Facades\Vite')
<!DOCTYPE html>
<html lang="en">
    @include('partials.header')
<body>
    @include('partials.navbar')

    <div class="container">
        <aside>
            @include('partials.aside')
        </aside>

        <main>
            @yield('content')
        </main>
    </div>

    @include('partials.footer')

    <!-- Add your JavaScript links here -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    // When the page is fully loaded...
    $(document).ready(function() {
        // Make an AJAX call
        $.ajax({
            // to this URL. Replace with your own URL.
            url: '/path/to/your/api',
            // using this HTTP method. Common methods are 'GET', 'POST', 'PUT', 'DELETE'.
            type: 'GET',
            // Expecting this type of data in response. Common types are 'json', 'html', 'text'.
            dataType: 'json',
            // If the request is successful, do this.
            success: function(data) {
                // For now, just log the data to the console.
                console.log(data);
                // You can add code here to do something with the data.
            },
            // If the request fails, do this.
            error: function(error) {
                // For now, just log the error to the console.
                console.log(error);
                // You can add code here to handle the error.
            }
        });
    });
</script>
</body>
</html>
