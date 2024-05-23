<!-- resources/views/components/info-card.blade.php -->
<div class="info-card">
    @if (isset($header))
        <div class="info-card-header title-small-text">
            {{ $header }}
        </div>
    @endif
    <div class="info-card-body">
        @foreach ($data as $key => $value)
            <div class="info-card-row">
                <div class="info-card-key">{{ $key }}</div>
                <div class="info-card-value">{{ $value }}</div>
            </div>
        @endforeach
    </div>
    @if (isset($footer))
        <div class="info-card-footer caption-text gray">
            {{ $footer }}
        </div>
    @endif
</div>

@push('styles')

    <style>
        /* Add this to your main stylesheet or within a <style> block in your Blade view */
        .info-card {
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            padding: 20px;
            margin: 20px;
            max-width: 400px;
            font-family: 'HubotSans', sans-serif;
        }
        /* Add this to your main stylesheet or within a <style> block in your Blade view */
        .info-card {
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            background-color: #fffcfc;
            padding: 20px;
            margin: 20px;
            max-width: 400px;
        }

        .info-card-header,
        .info-card-footer {
          padding-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }

        .info-card-footer {
            border-top: 1px solid #ddd;
            border-bottom: none;
        }

        .info-card-body {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .info-card-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .info-card-row:last-child {
            border-bottom: none;
        }

        .info-card-key {
            font-weight: bold;
            color: #333;
        }

        .info-card-value {
            color: #666;
        }

    </style>
@endpush
