@php
    /**
     * ItemGroups Component
     *
     *
     * @component
     * @param array $groups Array of groups with categories and items.
     *
     * Example usage:
     * <x-mods.item-groups :groups="$groups" />
     *
     * Each group should be an array with the category as the key and an array of items as the value:
     * [
     *     'Category 1' => [['name' => 'Item 1.1', 'link' => 'http://example.com'], ...],
     *     'Category 2' => [['name' => 'Item 2.1', 'link' => 'http://example.com'], ...],
     * ]
     */
@endphp

<div style="min-height:100%;overflow-y: auto;">

    @foreach($groups as $category => $items)
        <div class="group">
            <div class="category">
                <p class="category-text caption-text gray">{{ $category }}</p>
            </div>
            <div class="items">
                @foreach($items as $item)
                    <div class="item">
                        <a href="{{ $item['link'] ?? '' }}" class="item-text caption-text">{{ $item['name'] }}</a>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>

@push('styles')
    <style>
        .stacked {
            margin: 12px;
            color: var(--text-color);
            width: 100%;
            background-color: #fff;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .group {
            /* overflow-y: scroll; */
            border-bottom: 1px solid var(--border-color);
            font-weight: 400;
            margin-bottom: 20px;
        }

        .items {
            margin-bottom: 3px;
            padding: 3px 0;
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .category {
            padding: 10px 20px;
            border-bottom: 1px solid var(--border-color);
        }

        .item-text {
            padding: 3px 5px;
            border-bottom: solid 1px var(--border-color);
            margin: 0;
            text-decoration: none;
            color: var(--text-color);
        }

        .item-text:hover {
            text-decoration: underline;
        }
    </style>
@endpush
