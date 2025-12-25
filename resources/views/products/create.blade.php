@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Tambah Produk Baru</h1>
            <p class="text-gray-500 mt-1">Isi informasi lengkap produk rajutan Anda.</p>
        </div>
        <a href="{{ route('products.index') }}" class="px-6 py-3 rounded-full border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Batal & Kembali
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="p-8" id="productForm">
            @csrf

            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">Informasi Dasar</h3>
                
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Produk</label>
                        <input type="text" name="name" placeholder="Contoh: Syal Wol Merah Maroon" 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition duration-200" required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div x-data="{ 
                            open: false, 
                            selectedId: '', 
                            selectedName: 'Pilih Kategori' 
                        }" class="relative">
                            
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>

                            <input type="hidden" name="category_id" x-model="selectedId" required>

                            <button type="button" 
                                    @click="open = !open" 
                                    @click.outside="open = false"
                                    class="w-full bg-white px-4 py-3 rounded-lg border border-gray-300 flex justify-between items-center transition duration-200 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500 text-left">
                                
                                <span x-text="selectedName" :class="selectedId ? 'text-gray-900' : 'text-gray-500'"></span>
                                
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div x-show="open" 
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute z-50 mt-1 w-full bg-white shadow-xl rounded-lg border border-gray-100 py-1 overflow-hidden"
                                style="display: none;"> @foreach($categories as $category)
                                    <div @click="selectedId = '{{ $category->id }}'; selectedName = '{{ $category->name }}'; open = false"
                                        class="px-4 py-3 cursor-pointer transition-colors duration-150 flex items-center justify-between group hover:bg-pink-500 hover:text-white">
                                        
                                        <span class="font-medium">{{ $category->name }}</span>
                                        
                                        <span x-show="selectedId == '{{ $category->id }}'" class="text-pink-600 group-hover:text-white font-bold">
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Harga (Rupiah)</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">Rp</span>
                                <input type="number" name="price" placeholder="0" 
                                    class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition duration-200" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">Inventaris & Detail</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Stok Awal</label>
                        <input type="number" name="stock" value="1" 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition duration-200" required>
                    </div>

                    <div x-data="{ 
                        open: false, 
                        selectedId: 'pre-order', 
                        selectedName: 'Pre-Order (PO)' 
                    }" class="relative">
                        
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status Penjualan</label>

                        <input type="hidden" name="status" x-model="selectedId">

                        <button type="button" 
                                @click="open = !open" 
                                @click.outside="open = false"
                                class="w-full bg-white px-4 py-3 rounded-lg border border-gray-300 flex justify-between items-center transition duration-200 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500 text-left">
                            
                            <span x-text="selectedName" class="text-gray-900"></span>
                            
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="open" 
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute z-50 mt-1 w-full bg-white shadow-xl rounded-lg border border-gray-100 py-1 overflow-hidden"
                            style="display: none;">
                            
                            <div @click="selectedId = 'pre-order'; selectedName = 'Pre-Order (PO)'; open = false"
                                class="px-4 py-3 cursor-pointer transition-colors duration-150 flex items-center justify-between group hover:bg-pink-500 hover:text-white">
                                <span class="font-medium">Pre-Order (PO)</span>
                                <span x-show="selectedId == 'pre-order'" class="text-pink-600 group-hover:text-white font-bold"></span>
                            </div>

                            <div @click="selectedId = 'ready'; selectedName = 'Ready Stock'; open = false"
                                class="px-4 py-3 cursor-pointer transition-colors duration-150 flex items-center justify-between group hover:bg-pink-500 hover:text-white">
                                <span class="font-medium">Ready Stock</span>
                                <span x-show="selectedId == 'ready'" class="text-pink-600 group-hover:text-white font-bold"></span>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Produk</label>
                    <textarea name="description" rows="5" placeholder="Jelaskan bahan, ukuran, dan cara perawatan..." 
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition duration-200" required></textarea>
                </div>
            </div>

            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">Foto Produk</h3>
                
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:bg-gray-50 transition relative" id="upload-container">
                    
                    <input type="file" name="image" id="image-input" 
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20" 
                        accept="image/*" required onchange="previewImage(event)">
                    
                    <div id="placeholder-view" class="text-gray-500">
                        <span class="block text-4xl mb-2">📷</span>
                        <span class="font-medium text-pink-600">Klik untuk upload foto</span>
                        <span class="block text-xs mt-1">Format JPG, PNG (Max 2MB)</span>
                    </div>

                    <div id="preview-view" class="hidden relative z-10">
                        <img id="image-preview" src="#" alt="Preview" class="mx-auto max-h-64 rounded shadow-lg border border-gray-200">
                        <p id="file-name" class="mt-2 text-sm text-gray-600 font-medium"></p>
                        <p class="text-xs text-pink-500 mt-1">Klik gambar untuk mengganti</p>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-100">
                <button type="reset" onclick="resetPreview()" class="text-gray-500 hover:text-gray-700 font-medium px-6 transition">Reset</button>
                
                <button type="submit" class="bg-gradient-to-r from-pink-500 to-rose-600 hover:from-pink-600 hover:to-rose-700 text-white font-bold py-3 px-8 rounded-full shadow-lg transform hover:-translate-y-0.5 transition duration-200">
                    Simpan Produk
                </button>
            </div>

        </form>
    </div>
</div>

<script>
    function previewImage(event) {
        const input = event.target;
        const placeholder = document.getElementById('placeholder-view');
        const previewView = document.getElementById('preview-view');
        const imagePreview = document.getElementById('image-preview');
        const fileName = document.getElementById('file-name');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                fileName.textContent = input.files[0].name;
                
                // Switch Tampilan
                placeholder.classList.add('hidden');
                previewView.classList.remove('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function resetPreview() {
        const input = document.getElementById('image-input');
        const placeholder = document.getElementById('placeholder-view');
        const previewView = document.getElementById('preview-view');
        const imagePreview = document.getElementById('image-preview');

        input.value = ''; 
        imagePreview.src = '#';
        
        previewView.classList.add('hidden'); 
        placeholder.classList.remove('hidden'); 
    }
</script>
@endsection