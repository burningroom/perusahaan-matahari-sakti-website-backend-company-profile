<div>

    <x-ts-side-bar smart navigate thin-scroll>
        <x-slot:brand>
            <div class="flex justify-start pl-3 pt-4">
                <img alt="{{ config('app.name') }} Logo" class="w-32 object-contain" loading="lazy" x-bind:src="darkTheme ?
                                    '{{ asset('assets/logos/logo.png') }}' :
                                    '{{ asset('assets/logos/logo.png') }}'" />
            </div>
        </x-slot:brand>


        <x-ts-side-bar.item text="Dashboard" icon="home" :route="route('admin.dashboard')" />
        {{-- <x-ts-side-bar.item text="Table" icon="cog" :route="route('admin.table')" /> --}}
        <x-ts-side-bar.item text="Konten Global" opened>
            <x-ts-side-bar.item text="Slider Beranda" icon="tabler.align-box-left-middle" :route="route('admin.global.slider-beranda')"  />
            <x-ts-side-bar.item text="Peta Lokasi" icon="tabler.align-box-left-middle" />
            <x-ts-side-bar.item text="Galeri" icon="tabler.align-box-left-middle" />
            <x-ts-side-bar.item text="Ulasan" icon="tabler.align-box-left-middle" />
            <x-ts-side-bar.item text="Footer" icon="tabler.align-box-left-middle" />
        </x-ts-side-bar.item>
        <x-ts-side-bar.item text="Kategori Produk" opened>
            <x-ts-side-bar.item text="Slider" icon="tabler.align-box-left-middle" />
            <x-ts-side-bar.item text="Daftar Kategori Produk" icon="tabler.align-box-left-middle" />
        </x-ts-side-bar.item>
        <x-ts-side-bar.item text="Produk" opened>
            <x-ts-side-bar.item text="Daftar Produk" icon="tabler.align-box-left-middle" />
        </x-ts-side-bar.item>
    </x-ts-side-bar>

</div>