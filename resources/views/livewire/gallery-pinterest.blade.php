<div x-data="{ modalOpen: false, selectedImage: null }">

    <div class="columns-1 sm:columns-2 md:columns-3 lg:columns-4 gap-4 space-y-4">
        @forelse ($fotos as $foto)
            <div class="break-inside-avoid relative group rounded-2xl overflow-hidden bg-white border border-gray-200 shadow-sm hover:shadow-xl transition-all duration-300">
                <img src="{{$foto->thumbnail_url}}" alt="Session Photo" loading="lazy" class="w-full h-auto object-cover block">
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-200 p-4 flex flex-col justify-between">
                    <div class="flex justify-end gap-2">
                        <form action="{{route('foto.download')}}" method="get">
                            @csrf
                            <input type="text" name="r2_url" value="{{$foto->r2_url}}" hidden="">
                            <button type="submit" class="p-2 bg-white/80 hover:bg-white rounded-full text-gray-700 transition-colors shadow">
                                <x-lucide-download class="w-4 h-4" />
                            </button>
                        </form>
                        <button class="p-2 bg-white/80 hover:bg-red-500 hover:text-white rounded-full text-gray-700 transition-colors shadow">
                            <x-lucide-trash-2 class="w-4 h-4" />
                        </button>
                    </div>
                    <div class="flex items-center justify-end text-white">
                        <button @click="modalOpen = true; selectedImage = '{{$foto->r2_url}}'"
                                class="text-xs bg-white text-gray-800 font-semibold px-3 py-1.5 rounded-full hover:bg-gray-100 transition-colors shadow">
                            View
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center text-gray-500 py-8">
                Belum ada data yang bisa ditampilkan.
            </div>
        @endforelse
    </div>

    {{-- Loader is now a SIBLING of the columns div, not a descendant --}}
    @if ($fotos->hasMorePages())
        <div
            x-intersect="$wire.loadMore()"
            class="flex justify-center py-4 transition-opacity"
        >
            <div class="w-6 h-6 border-2 border-t-blue-500 border-b-blue-500 rounded-full animate-spin"></div>
        </div>
    @else
        <div class="text-center py-4 text-gray-400">
            Kamu sudah mencapai akhir data.
        </div>
    @endif

    <div x-show="modalOpen"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @keydown.escape.window="modalOpen = false"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm"
         x-cloak>
        <div @click.away="modalOpen = false" class="relative max-w-4xl max-h-[90vh] bg-white rounded-2xl overflow-hidden shadow-2xl flex flex-col">
            <button @click="modalOpen = false" class="absolute top-4 right-4 z-10 p-2 bg-black/50 hover:bg-black/70 text-white rounded-full transition-colors">
                <x-lucide-x class="w-5 h-5" />
            </button>

            <div class="overflow-auto max-h-[85vh]">
                <img :src="selectedImage" alt="Expanded view" class="w-full h-auto object-contain">
            </div>
        </div>
    </div>
</div>
