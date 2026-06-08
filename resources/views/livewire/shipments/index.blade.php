<div x-data="{ sidebarOpen: localStorage.getItem('sidebarOpen') === 'true' }"
    x-init="$watch('sidebarOpen', value => localStorage.setItem('sidebarOpen', value))"
    x-on:toggle.window="sidebarOpen = !sidebarOpen"
    class="flex flex-col w-full translate-all duration-300"
    x-bind:class="sidebarOpen ? 'md:ml-[20%] md:w-[80%]' : 'ml-0'">
     
    <x-page-menu>
    <div>
        <span class="text-2xl text-white font-sans font-semibold">Data Pengiriman</span>
    </div>

    <div class="flex flex-col sm:flex-row justify-around gap-3.5">
        <x-button wire:click='finishManualShipment' style='white'>Selesaikan Pengiriman</x-button>
        <x-button wire:click='exportExcel' style='green'>Cetak .xlsx</x-button>
    </div>

    </x-page-menu>
    
    <livewire:shipments.table lazy />

    <x-modal title="Selesaikan Pengiriman" name="finish-manual-shipment">
        <x-slot:icon>
            <x-icons.round-warning class="size-5 text-red-600" />
        </x-slot:icon>
        <livewire:shipments.finish-manual-shipment />
    </x-modal>
 </div>