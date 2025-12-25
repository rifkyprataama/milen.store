<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Milen.store - Rajutan Handmade Istimewa</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3 { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-bold text-pink-600 tracking-tighter">
                Milen.store
            </a>

            <a href="https://wa.me/6281234567890" target="_blank" class="text-sm font-medium text-gray-500 hover:text-pink-600 transition flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                Hubungi Kami
            </a>
        </div>
    </nav>

    <header class="bg-pink-100 py-20 px-6 text-center relative overflow-hidden">
        <div class="relative z-10 max-w-2xl mx-auto">
            <span class="text-pink-600 font-semibold tracking-wider uppercase text-sm mb-2 block">Handmade with Love</span>
            <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                Kehangatan dalam <br> <span class="text-pink-600">Setiap Rajutan</span>
            </h1>
            <p class="text-gray-600 text-lg mb-8 leading-relaxed">
                Temukan koleksi boneka, syal, dan aksesoris rajut buatan tangan yang dibuat penuh cinta khusus untuk Anda.
            </p>
            <a href="#katalog" class="inline-block bg-pink-600 text-white font-bold py-3 px-8 rounded-full shadow-lg hover:bg-pink-700 hover:-translate-y-1 transition transform duration-200">
                Lihat Koleksi
            </a>
        </div>
        
        <div class="absolute top-0 left-0 w-64 h-64 bg-white rounded-full mix-blend-overlay filter blur-3xl opacity-50 -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-pink-300 rounded-full mix-blend-overlay filter blur-3xl opacity-30 translate-x-1/3 translate-y-1/3"></div>
    </header>

    <section id="katalog" class="container mx-auto px-6 py-20">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Katalog Terbaru</h2>
            <div class="h-1 w-20 bg-pink-500 mx-auto rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse($products as $product)
            <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden group flex flex-col h-full">
                <div class="relative h-64 bg-gray-100 overflow-hidden">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" alt="{{ $product->name }}">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                            No Image
                        </div>
                    @endif
                    
                    <div class="absolute top-4 right-4">
                        @if($product->status == 'ready')
                            <span class="bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-sm">READY</span>
                        @else
                            <span class="bg-amber-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-sm">PO</span>
                        @endif
                    </div>
                </div>

                <div class="p-6 flex flex-col flex-grow">
                    <div class="text-xs text-pink-600 font-semibold mb-2 uppercase tracking-wide">{{ $product->category->name }}</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-pink-600 transition">{{ $product->name }}</h3>
                    <p class="text-gray-500 text-sm mb-4 line-clamp-2 flex-grow">{{ $product->description }}</p>
                    
                    <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                        <span class="text-lg font-bold text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        
                        <a href="https://wa.me/6281234567890?text=Halo%20Milen.store,%20saya%20tertarik%20dengan%20produk%20{{ urlencode($product->name) }}" 
                            target="_blank"
                            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-semibold transition flex items-center gap-2">
                            <span>Beli</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-20">
                <p class="text-gray-500 text-lg">Belum ada produk yang ditampilkan.</p>
            </div>
            @endforelse
        </div>
    </section>

    <footer class="bg-gray-900 text-white py-8 border-t border-gray-800">
        <div class="container mx-auto px-6 text-center">
            <h4 class="text-xl font-bold mb-2 font-serif">Milen.store</h4>
            <p class="text-gray-400 text-sm mb-4">Rajutan tangan penuh cinta untuk menemani hari-harimu.</p>
            <div class="text-gray-600 text-xs">
                &copy; {{ date('Y') }} Milen.store. All rights reserved.
            </div>
        </div>
    </footer>

</body>
</html>