<div>
    @include('livewire.admin.global._modal-up-or-cr')
    <h1 class="page-heading">Slider Beranda</h1>
    <p class="paragraph">Atur Semua Konten Slider Beranda Di Sini</p>

    <div class="mt-4 bg-[var(--bg-1)] rounded-lg border border-[var(--border)]">
        <div class="flex items-center justify-between p-4">
            <h1 class="font-semibold ">Daftar Konten</h1>
            <div class="flex items-center gap-2">
                <div class="w-full max-w-sm">
                    <x-forms.search />
                </div>

                <x-buttons.button iconClass="ti ti-plus" class="gap-2 max-w-[180px] w-full" color="primary"
                    wire:click="modalAdd" target="modalAdd">
                    Buat Konten
                </x-buttons.button>

            </div>
        </div>
        <x-tables.table>
            <x-slot:thead>
                <tr>
                    <x-tables.th class="!w-5 !text-center">
                        No
                    </x-tables.th>
                    <x-tables.th>
                        Media
                    </x-tables.th>
                    <x-tables.th>
                        Judul
                    </x-tables.th>
                    <x-tables.th>
                        Deskripsi
                    </x-tables.th>
                    <x-tables.th>
                        Urutan
                    </x-tables.th>
                    <x-tables.th>
                        Aksi
                    </x-tables.th>

                </tr>
            </x-slot:thead>
            <x-slot:tbody>
                @forelse ($sliders->where('language.code', 'id') as $key => $item)
                <tr wire:key="{{ $key }}">
                    <x-tables.td class="!text-center">
                        {{ $loop->iteration }}
                    </x-tables.td>
                    <x-tables.td>
                        @if($item->media)
                            <img src="{{ Storage::url($item->media) }}" alt="Media" class="w-16 h-16 object-contain">
                        @else
                            <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                <span class="text-gray-500 text-xs">No Image</span>
                            </div>
                        @endif
                    </x-tables.td>
                    <x-tables.td>
                        {{ $item->title }}
                    </x-tables.td>
                    <x-tables.td>
                        <div class="max-w-xs truncate">
                            {{ $item->description }}
                        </div>
                    </x-tables.td>
                    <x-tables.td>
                        <div class="w-20">
                            <x-ts-input 
                                type="number" 
                                min="1" 
                                wire:model.blur="sortNumbers.{{ $item->id }}"
                                wire:change="updateSortNumber('{{ $item->id }}', $event.target.value)"
                                class="text-center"
                                size="sm"
                            />
                        </div>
                    </x-tables.td>
                    <x-tables.td>
                        <div class="flex items-center gap-2">
                            <x-buttons.button 
                                color="warning" 
                                iconClass="ti ti-edit" 
                                size="sm"
                                wire:click="modalEdit('{{ $item->id }}')"
                                title="Edit">
                            </x-buttons.button>
                            <x-buttons.button 
                                color="danger" 
                                iconClass="ti ti-trash" 
                                size="sm"
                                wire:click="delete('{{ $item->id }}')"
                                wire:confirm="Apakah Anda yakin ingin menghapus slider ini?"
                                title="Hapus">
                            </x-buttons.button>
                        </div>
                    </x-tables.td>
                </tr>
                @empty
                <tr>
                    <x-tables.td colspan="6" class="text-center py-8">
                        <div class="flex flex-col items-center gap-2">
                            <i class="ti ti-photo-off text-4xl text-gray-400"></i>
                            <p class="text-gray-500">Belum ada data slider beranda</p>
                        </div>
                    </x-tables.td>
                </tr>
                @endforelse
            </x-slot:tbody>
        </x-tables.table>

        <div class="flex justify-end p-4">
            {{-- {{ $this->datas->links('vendor.pagination.default-pagination') }} --}}
        </div>
    </div>
</div>