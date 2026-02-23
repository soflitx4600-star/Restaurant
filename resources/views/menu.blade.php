<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú - RestoApp</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    <div class="bg-gray-900 text-white text-center py-12 px-4">
        <h1 class="text-5xl font-bold mb-2">🍔 Nuestro Menú</h1>
        <p class="text-xl text-gray-400">Ingredientes frescos, recetas caseras y mucho amor.</p>
    </div>

    <div class="max-w-5xl mx-auto py-10 px-4">

        @foreach($categories as $category)
            @if($category->products->count() > 0)
                
                <h2 class="text-3xl font-bold text-orange-600 mb-6 mt-10 border-b-2 border-orange-200 pb-2">
                    {{ $category->name }}
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach($category->products as $product)
                        
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden flex flex-col hover:shadow-2xl transition">
                            
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-56 object-cover">
                            @else
                                <div class="w-full h-56 bg-gray-200 flex items-center justify-center text-gray-500">
                                    <span>Sin foto 📷</span>
                                </div>
                            @endif

                            <div class="p-6 flex flex-col flex-grow">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-xl font-bold text-gray-900">{{ $product->name }}</h3>
                                    <span class="text-lg font-bold text-orange-600">
                                        ${{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                </div>
                                <p class="text-gray-600 text-sm mb-4 flex-grow">
                                    {{ $product->description }}
                                </p>
                            </div>
                        </div>

                    @endforeach
                </div>
            @endif
        @endforeach

    </div>

</body>
</html>