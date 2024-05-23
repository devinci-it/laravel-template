<div>
    @livewireStyles


    <x-section-header
        sectionHeader="devinci-it/bladekit"
        :breadCrumb="[ ['label' => 'Home', 'path' => '/'], ['label' => 'Dashboard', 'path' => '/dashboard'] ]"/>
    <livewire:menu-component :menu-items="$menuItems"/>

    <div class="grid-container p3 my2">
        <livewire:stacked-component :groups="$sideBarGroups" class="custom-stacked-class"/>

        <div class="flex flex-row card-grid" style="gap:20px; flex-wrap: wrap;">
            <x-sidebar :items="[ ['label' => 'Sidebar Item 33'], ['label' => 'Sidebar Item 22'],]"/>

            <x-cards.square title="LOREM IPSUM" subtitle="Subheading" link="#" linkText="READ MORE >">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit iste veniam aut, exercitationem quam
                officia.
            </x-cards.square>

            <x-head-sub-link-card title="LOREM IPSUM" subtitle="Subheading" link="#" linkText="READ MORE >">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit iste veniam aut, exercitationem quam
                officia.
            </x-head-sub-link-card>

            <x-head-sub-link-card title="LOREM IPSUM" subtitle="Subheading" link="#" linkText="READ MORE >">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit iste veniam aut, exercitationem quam
                officia.
            </x-head-sub-link-card>

            <x-head-sub-link-card title="LOREM IPSUM" subtitle="Subheading" link="#" linkText="READ MORE >">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit iste veniam aut, exercitationem quam
                officia.
            </x-head-sub-link-card>
        </div>
    </div>

    <section class="p3 my1">
        <h1>Livewire Button Demo</h1>
        <div class="button-container">
            <button wire:click="actionWired" class="form-input btn round">ClickMe</button>
            <x-tags.action-capsule wire:click="actionWired" text_content="Click me" navigateUrl="/" style="top: 100px;">
            </x-tags.action-capsule>
        </div>
    </section>

    @push('styles')
        <style>
            .grid-container {
                display: grid;
                grid-template-columns: 1fr 3fr;
                gap: 20px;
                align-items: start;
                height: 100%;
            }


            .tag-wrapper {
                height: 100vh;
                display: flex;
                flex-direction: row;
                gap: 15px;
            }

            .button-container {
                display: flex;
                gap: 15px;
                flex-direction: row;
                align-items: center;
                justify-content: flex-start;
                align-content: stretch;
                flex-wrap: wrap;
            }

            .stacked-component-container, .card-grid-container {
                height: 100%;
                overflow-y: auto; /* Add vertical scroll if content overflows */
            }

        </style>
    @endpush

    @livewireScripts
</div>
