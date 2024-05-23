<!-- resources/views/components/layouts/app.blade.php -->
@php
/**
* Main layout template.
*
* This template defines the overall structure of the HTML document,
* including the header, sidebar, and main content sections. It uses
* Blade directives to include partial views and yield content sections,
* and it integrates Vite for asset management.
*
* @use('Illuminate\Support\Facades\Vite')
* Facilitates the integration of Vite for handling JavaScript and CSS assets.
*/
@endphp

@use('Illuminate\Support\Facades\Vite')


    <!DOCTYPE html>
    <html lang="en">
        @include('partials.header')
        <body>

            <div class="container">

            <aside>
                @yield('sidebar')
            </aside>

            <main class="full p3 m3">
                @yield('content')
            </main>
        </div>

            <!-- Add your JavaScript links here -->


            @stack('scripts')
            @stack('styles')

        </body>

    </html>
