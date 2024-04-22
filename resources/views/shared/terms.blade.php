<!-- data-terms-and-agreement.blade.php -->
@extends('layouts.app')

@php
    // Define your static links here
    $githubLink = 'https://github.com/YourGitHub';
    $pyPiLink = 'https://pypi.org/user/YourPyPI';
    $packagistLink = 'https://packagist.org/users/YourPackagist';
    $licenseLink = 'link-to-license';
@endphp

@section('content')
<main>
    <div class="container">
       <span>

           <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path d="M2.5 1.75v11.5c0 .138.112.25.25.25h3.17a.75.75 0 0 1 0 1.5H2.75A1.75 1.75 0 0 1 1 13.25V1.75C1 .784 1.784 0 2.75 0h8.5C12.216 0 13 .784 13 1.75v7.736a.75.75 0 0 1-1.5 0V1.75a.25.25 0 0 0-.25-.25h-8.5a.25.25 0 0 0-.25.25Zm13.274 9.537v-.001l-4.557 4.45a.75.75 0 0 1-1.055-.008l-1.943-1.95a.75.75 0 0 1 1.062-1.058l1.419 1.425 4.026-3.932a.75.75 0 1 1 1.048 1.074ZM4.75 4h4.5a.75.75 0 0 1 0 1.5h-4.5a.75.75 0 0 1 0-1.5ZM4 7.75A.75.75 0 0 1 4.75 7h2a.75.75 0 0 1 0 1.5h-2A.75.75 0 0 1 4 7.75Z"></path></svg>
           <p class="caption-text">Details on data privacy and usage policies</p>
        </span>
        <h1 class="title-large-text">Data Terms and Agreement</h1>


        @php
            $content = [
                [
                    "title" => "Data Collection",
                    "text" => "We collect basic information when you use our web app, such as your IP address and browsing activity, solely for the purpose of improving our services."
                ],
                [
                    "title" => "Use of Cookies",
                    "text" => "We use cookies to enhance your browsing experience. By using our web app, you consent to the use of cookies in accordance with our Cookie Policy."
                ],
                [
                    "title" => "Data Security",
                    "text" => "We employ standard security measures to protect your data from unauthorized access or disclosure."
                ],
                [
                    "title" => "Data Sharing",
                    "text" => "We do not share your personal information with third parties."
                ],
                [
                    "title" => "Your Rights",
                    "text" => "You have the right to request access to or deletion of your personal information."
                ],
                [
                    "title" => "Built with ❤️ by a Solo Developer",
                    "text" => "Curious how this website was built? I'm a solo developer and I'd love to share insights into the development process. Check out the source code on <a href='{{ $githubLink }}' class='bodysmall'>GitHub</a>, and let's collaborate! Find my projects on <a href='{{ $pyPiLink }}' class='bodysmall'>PyPI</a> and <a href='{{ $packagistLink }}' class='bodysmall'>Packagist</a>."
                ],
                [
                    "title" => "License",
                    "text" => "This web app is licensed under the MIT License, which provides an additional layer of protection for both users and developers. View the license details <a href='{{ $licenseLink }}' class='bodysmall'>here</a>."
                ],
                [
                    "title" => "Changes to This Agreement",
                    "text" => "We may update these terms from time to time, with any changes becoming effective immediately upon posting."
                ],
                [
                    "title" => "Need Help Building Your Own Web App?",
                    "text" => "Ask us how we built this website! We offer expert services to help you create your own custom web applications. Contact us at [Your Contact Information] to learn more."
                ]
            ];
        @endphp

        @foreach ($content as $section)
            <div class="section">
                <p class="title-small-text">{{ $section['title'] }}</p>
            </div>
            <p class="body-small-text">{{ $section['text'] }}</p>

            @endforeach

    </div>
</main>

@endsection

@push('styles')
<style>
        body {
            font-family: 'Hubot Sans', sans-serif;
            color: #333;
            line-height: 1.6;
            margin-top: 20px;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

       

        .section-heading {
            font-size: 18px;
            margin-bottom: 20px;
        }

      
   /* Add this CSS code to your styles section or CSS file */
.main-container{
    max-width: 95%;
    display: flex ;
}
.data-terms-agreement {
    font-family: 'HubotSans', sans-serif;
    color: var(--text-color); /* Adjust color as needed */
    line-height: 1;
}
.section{
    border-bottom: solid 1px var(--border-color);
}

.container {
	max-width: 750px;
	margin: 0 auto;
	padding: 20px;
	display: flex;
	flex-direction: column;
	gap: 38px;
	padding: 38px 0;
	margin-bottom: 29px;
}

.sub-heading {
    margin-bottom: 10px; /* Adjust margin as needed */
}

</style>
@endpush