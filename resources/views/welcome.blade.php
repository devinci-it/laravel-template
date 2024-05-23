@extends('components.layouts.app')

@php

use App\Models\Product;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
$products = Product::all();
// Assuming $products is your collection of products
$perPage = 10; // Number of items per page
$page = LengthAwarePaginator::resolveCurrentPage() ?? 1;

// Paginate the collection
$paginatedProducts = new LengthAwarePaginator(
    $products->forPage($page, $perPage), // Get items for the current page
    $products->count(), // Total number of items
    $perPage, // Number of items per page
    $page // Current page number
);

// Pass $paginatedProducts to the view


    $menuItems = [
        [
            'title' => 'Profile',
            'action' => 'openProfile',
            'icon' => asset('icons/profile.svg'),
            'shortcut' => 'Ctrl+P',
            'jsFunction' => null,
        ],
        [
            'title' => 'Settings',
            'action' => null,
            'icon' => asset('icons/settings.svg'),
            'shortcut' => 'Ctrl+S',
            'jsFunction' => 'openSettings()',
        ],
        [
            'title' => 'Logout',
            'action' => 'logout',
            'icon' => asset('icons/logout.svg'),
            'shortcut' => 'Ctrl+L',
            'jsFunction' => null,
        ],
    ];

    $groups=[

        "Partials"=>[
            ['name'=>"footer","link"=>"#footer"],
            ['name'=>"header","link"=>"#footer"],
            ['name'=>"sidebar","link"=>"#footer"],
            ['name'=>"navbar","link"=>"#footer"],
            ],
    "Form"=>[
        ['name'=>"form","link"=>"#form"],
        ['name'=>"input","link"=>"#form"],
        ['name'=>"select","link"=>"#form"],
        ['name'=>"checkbox","link"=>"#form"],
        ['name'=>"radio","link"=>"#form"],
        ['name'=>"textarea","link"=>"#form"],
        ['name'=>"multi-step-form","link"=>"#form"],
        ['name'=>"file-upload","link"=>"#form"],
        ['name'=>"multi-input","link"=>"#form"],
        ]
    ]

@endphp

@section('content')



    <x-layouts.grid name="sample1" columns="2" gridTemplate="1fr 3fr" gap="30px">

        <x-slot name="slot1">

            <x-mods.item-groups :groups="$groups" />

        </x-slot>

        <x-slot name="slot2"  style="padding-right: 20px;">

            <section id="modal">
                <x-mods.page-header
                    sectionHeader="Modal"
                    :breadCrumb="[ ['label' => 'Home', 'path' => '/'], ['label' => 'Form Upload', 'path' => '#odal'] ]"

                    preText="Mods"
                />
            <button onclick="showModal_modal1()" class="btn round">Open Modal 1</button>
            <button onclick="showModal_modal2()" class="btn round">Open Modal 2</button>

            <x-shared.modal name="modal1">
                <x-slot name="title">
                    Example Modal 1
                </x-slot>
                <p>This is the content of modal 1.</p>
            </x-shared.modal>
            <x-shared.modal name="modal2">
                <x-slot name="title">
                    Example Modal 2
                </x-slot>
                <p>This is the content of modal 2.</p>
            </x-shared.modal>

            </section>
            <section id="accordion">



                <x-mods.page-header
                    sectionHeader="Accordion"
                    :breadCrumb="[ ['label' => 'Home', 'path' => '/'],
                                   ['label' => 'Accordion', 'path' => '#accordion']
                                   ]"
                    preText="Mods"
                />

                <x-layouts.accordion>
                        <x-mods.accordion-item id="item1">
                            <x-slot name="header">Item 1</x-slot>
                            Content for item 1
                        </x-mods.accordion-item>

                        <x-mods.accordion-item id="item2">
                            <x-slot name="header">Item 2</x-slot>
                            Content for item 2
                        </x-mods.accordion-item>

                        <x-mods.accordion-item id="item3" icon="home.svg">
                            <x-slot name="header">Item 3</x-slot>
                            Content for item 3
                        </x-mods.accordion-item>
                    </x-layouts.accordion>




            </section>

            <section id="crud-table">
                <x-mods.page-header
                    sectionHeader="CRUD Table"
                    :breadCrumb="[ ['label' => 'Home', 'path' => '/'], ['label' => 'Form Upload', 'path' => '#crud_table'] ]"
                    preText="Mods"/>

                    <h1>Products</h1>
                @livewire('crud-table', ['data' => $products,'columns'=>["id","name","price","quantity"]])
            </section>
            <section id=multistep-form">
                <x-mods.page-header
                    sectionHeader="Multi-Step Form"
                    preText="Form"
                    :breadCrumb="[ ['label' => 'Home', 'path' => '/'], ['label' => 'Form Upload', 'path' => 'multistep-form'] ]"
                />
                <form method="POST" action="/submit-form">
                    @csrf
                    <x-form.multi-step-form>
                        <div class="step">
                            <x-form.form-control
                                label="First Name"
                                name="first_name"
                                placeholder="Enter your first name"
                                required
                            />
                        </div>

                        <div class="step">
                            <x-form.form-control
                                label="Email"
                                name="email"
                                type="email"
                                placeholder="Enter your email"
                                required
                            />
                        </div>

                        <div class="step">
                            <x-form.form-control
                                label="Password"
                                name="password"
                                type="password"
                                placeholder="Enter your password"
                                required
                            />
                        </div>
                    </x-form.multi-step-form>
                </form>


            </section>

            <section id=form-upload">
                <x-mods.page-header
                    sectionHeader="Form Upload"
                    preText="Form"
                    :breadCrumb="[ ['label' => 'Home', 'path' => '/'], ['label' => 'Form Upload', 'path' => '#form-upload'] ]"
                />

                <form method="POST" action="/submit-form" enctype="multipart/form-data">
                    @csrf
                    <x-form.file-upload name="other_files" :showPreview="false" />
                    <button type="submit" class="btn">Submit</button>
                </form>


            </section>

            <section id="menu-items" class="p3">
                <x-mods.page-header
                    sectionHeader="Menu Dropdown"
                    :breadCrumb="[ ['label' => 'Home', 'path' => '/'], ['label' => 'Form Upload', 'path' => '#menu-items'] ]"

                    preText="Form"
                />
                <x-mods.menu-dropdown :menuItems="$menuItems" />
            </section>
            <section id="multi-input">
                <form method="POST" action="/submit-form">
                @csrf
                <x-form.multi-input
                    label="Categories"
                    name="categories"
                    placeholder="Enter a category"
                    required
                />
                <button type="submit" class="btn input form-input">Submit</button>
            </form>

            </section>
            <section id="info-card">
                <x-mods.info-card :data="[
    'Name' => 'John Doe',
    'Email' => 'john.doe@example.com',
    'Phone' => '+1 (555) 123-4567',
    'Address' => '123 Main St, Anytown, USA'
]" />

                <!-- In your Blade view, e.g., resources/views/welcome.blade.php -->
                <x-mods.info-card :data="[
    'Name' => 'John Doe',
    'Email' => 'john.doe@example.com',
    'Phone' => '+1 (555) 123-4567',
    'Address' => '123 Main St, Anytown, USA'
]">
                    <x-slot name="header">
                        User Information
                    </x-slot>
                    <x-slot name="footer">
                        Last updated: {{ now()->toDateTimeString() }}
                    </x-slot>
                </x-mods.info-card>


            </section>
            <section id="empty-state">
                <x-mods.page-header
                    sectionHeader="Empty State"
                    :breadCrumb="[ ['label' => 'Home', 'path' => '/'],
                                   ['label' => 'Empty State', 'path' => '#empty-state']
                                   ]"
                    preText="Shared"
                />
                <x-empty-state
                    title="No products found"
                    description="There are no products available at this time."/>

            </section>
            <section id="search-component" class="search-component">

                <!-- resources/views/components/search.blade.php -->
@php
           $model = Product::class;
           $searchColumns = ['name'];

@endphp
                @livewire('search-bar', ['model' => \App\Models\Product::class, 'searchColumns' => ['name', 'description']])
{{--                <x-search-bar :model="\App\Models\Product::class" :searchColumns="['name', 'description']" />--}}
             @if(request()->has('query') && request('query') != '')
                    @dd($results)

                @endif
                <x-search-results :results="$paginatedProducts" :searchTerm="'Sale'" />

            </section>

            <section id="tab-panel">

                <x-mods.page-header
                    sectionHeader="Tab Panel"
                    :breadCrumb="[ ['label' => 'Home', 'path' => '/'], ['label' => 'Tab Panel', 'path' => '#tab-panel'] ]"

                    preText="Mods"
                />

                <x-mods.tab-panel :tabs="['Cat1', 'Cat2']">
                    <x-slot name="tabCat1">
                        <p>Content for Tab 1</p>
                    </x-slot>
                    <x-slot name="tabCat2">
                        <p>Content for Tab 2</p>
                    </x-slot>
                </x-mods.tab-panel>

            </section>



        </x-slot>




    </x-layouts.grid>
@endsection



@push('styles')

    <style>
        section{
            border-bottom:solid 1px var(--text-color);
            margin-bottom: 20px;
            padding-bottom: 20px;
        }
        .sample1-grid-item{
            height: 100vh;
            overflow-y: auto;
        }
    </style>
@endpush
