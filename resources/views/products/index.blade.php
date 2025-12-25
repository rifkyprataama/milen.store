@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Katalog Produk</h1>
            <p class="text-gray-500 mt-1">Kelola stok dan etalase toko rajutan Anda.</p>
        </div>
        <a href="{{ route('products.create') }}" class="group flex items-center gap-2 bg-gradient-to-r from-pink-500 to-rose-600 hover:from-pink-600 hover:to-rose-700 text-white font-bold py-3 px-6 rounded-full shadow-lg transform hover:-translate-y-0.5 transition duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:rotate-90 transition duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span>Tambah Produk</span>
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="py-4 px-6 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Produk</th>
                        <th class="py-4 px-6 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th class="py-4 px-6 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="py-4 px-6 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="py-4 px-6 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Stok</th>
                        <th class="py-4 px-6 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($products as $product)
                    <tr class="hover:bg-gray-50 transition duration-150 group">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-4">
                                <div class="h-14 w-14 flex-shrink-0 rounded-lg overflow-hidden border border-gray-200 shadow-sm relative">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" class="h-full w-full object-cover" alt="{{ $product->name }}">
                                    @else
                                        <div class="h-full w-full bg-gray-100 flex items-center justify-center text-gray-400">
                                            <span class="text-xs">No IMG</span>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="font-bold text-gray-900 group-hover:text-pink-600 transition">{{ $product->name }}</div>
                                    <div class="text-xs text-gray-500 truncate max-w-[150px]">{{ Str::limit($product->description, 40) }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-50 text-purple-700 border border-purple-100">{{ $product->category->name }}</span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="font-bold text-gray-800">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        </td>
                        <td class="py-4 px-6 text-center">
                            @if($product->status == 'ready')
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700 border border-green-200"><span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>Ready</span>
                            @else
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-700 border border-amber-200"><span class="w-2 h-2 rounded-full bg-amber-500"></span>Pre-Order</span>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-center text-sm font-medium text-gray-600">{{ $product->stock }} pcs</td>

                        <td class="py-4 px-6 text-right space-x-2">
                            <a href="{{ route('products.edit', $product->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-50 text-blue-600 hover:bg-blue-100 transition" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </a>

                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-red-50 text-red-600 hover:bg-red-100 transition" title="Hapus">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="bg-gray-50 rounded-full p-6 mb-4"><span class="text-4xl">🧶</span></div>
                                <h3 class="text-lg font-medium text-gray-900">Belum ada produk</h3>
                                <p class="text-gray-500 mb-6 max-w-sm mx-auto">Mulai tambahkan koleksi rajutan terbaikmu untuk dilihat oleh pelanggan.</p>
                                <a href="{{ route('products.create') }}" class="text-pink-600 font-semibold hover:underline">+ Tambah Produk Pertama</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Pilih semua form yang punya class '.delete-form'
    const deleteForms = document.querySelectorAll('.delete-form');

    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            // 1. Cegah form agar tidak langsung dikirim
            e.preventDefault();

            // 2. Tampilkan Popup Konfirmasi SweetAlert
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data produk ini akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33', // Warna merah untuk tombol hapus
                cancelButtonColor: '#3085d6', // Warna biru untuk batal
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true // Tombol batal di kiri, hapus di kanan
            }).then((result) => {
                // 3. Jika user klik "Ya, Hapus!"
                if (result.isConfirmed) {
                    // Kirim form secara manual
                    form.submit();
                }
            });
        });
    });
</script>
@endsection