<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RestoApp - Sabor Único</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Lato', sans-serif; }
        h1, h2, h3 { font-family: 'Playfair Display', serif; }
        .scroll-smooth { scroll-behavior: smooth; }
    </style>
</head>
<body class="bg-white text-gray-800 antialiased scroll-smooth">

    <nav class="fixed w-full z-50 bg-white/90 backdrop-blur-md shadow-sm transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex-shrink-0 flex items-center gap-2 cursor-pointer" onclick="window.scrollTo(0,0)">
                    <span class="text-3xl">🍔</span>
                    <span class="font-bold text-2xl tracking-tighter text-gray-900">Resto<span class="text-orange-600">App</span></span>
                </div>
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="#inicio" class="text-gray-600 hover:text-orange-600 font-medium transition">Inicio</a>
                    <a href="#nosotros" class="text-gray-600 hover:text-orange-600 font-medium transition">Nosotros</a>
                    <a href="#menu" class="text-gray-600 hover:text-orange-600 font-medium transition">Destacados</a>
                    <a href="/menu" class="px-5 py-2 bg-orange-600 text-white rounded-full font-bold hover:bg-orange-700 transition shadow-lg hover:shadow-orange-500/30">
                        Ver Carta Completa 📖
                    </a>
                </div>
                <a href="/admin" class="text-sm font-bold text-gray-400 hover:text-gray-900">Staff 🔒</a>
            </div>
        </div>
    </nav>

    <header id="inicio" class="relative h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1544025162-d76694265947?q=80&w=2069&auto=format&fit=crop" 
                 class="w-full h-full object-cover brightness-50" 
                 alt="Restaurante Ambiente">
        </div>

        <div class="relative z-10 text-center px-4 max-w-5xl mx-auto mt-16">
            <span class="text-orange-400 font-bold tracking-widest uppercase mb-4 block animate-fade-in-up">Experiencia Gastronómica</span>
            <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight drop-shadow-lg">
                El placer de comer <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-red-500">como en casa</span>
            </h1>
            <p class="text-xl text-gray-200 mb-10 max-w-2xl mx-auto font-light">
                Descubrí sabores auténticos, ingredientes frescos y recetas que cuentan historias.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/menu" class="px-8 py-4 bg-orange-600 text-white text-lg font-bold rounded-full shadow-xl hover:bg-orange-700 transition transform hover:-translate-y-1">
                    Ordenar Ahora 🍽️
                </a>
                <a href="#nosotros" class="px-8 py-4 bg-white/10 backdrop-blur-sm border border-white/30 text-white text-lg font-bold rounded-full hover:bg-white/20 transition">
                    Conocenos
                </a>
            </div>
        </div>
    </header>

    <section id="nosotros" class="py-24 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1559339352-11d035aa65de?q=80&w=1974&auto=format&fit=crop" class="rounded-lg shadow-2xl w-full object-cover h-[500px]" alt="Chef cocinando">
                    <div class="absolute -bottom-10 -right-10 w-48 h-48 bg-orange-100 rounded-lg -z-10"></div>
                    <div class="absolute -top-10 -left-10 w-32 h-32 border-4 border-orange-500 rounded-lg -z-10"></div>
                </div>
                
                <div>
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">Nuestra Pasión por la <span class="text-orange-600">Cocina Real</span></h2>
                    <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                        Desde 2010, RestoApp nació con una misión simple: traer los sabores tradicionales a la mesa moderna. Cada plato es preparado al momento con ingredientes seleccionados de productores locales.
                    </p>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                        No somos solo un restaurante, somos un lugar de encuentro. Ya sea que vengas por nuestras famosas milanesas o por un trago de autor, te prometemos una experiencia inolvidable.
                    </p>
                    
                    <div class="grid grid-cols-2 gap-6">
                        <div class="flex items-center gap-3">
                            <div class="p-3 bg-orange-100 text-orange-600 rounded-full">🌿</div>
                            <span class="font-bold text-gray-700">100% Fresco</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="p-3 bg-orange-100 text-orange-600 rounded-full">🔥</div>
                            <span class="font-bold text-gray-700">Parrilla a Leña</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="p-3 bg-orange-100 text-orange-600 rounded-full">🍷</div>
                            <span class="font-bold text-gray-700">Vinos Boutique</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="p-3 bg-orange-100 text-orange-600 rounded-full">🚀</div>
                            <span class="font-bold text-gray-700">Envío Rápido</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="menu" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <span class="text-orange-600 font-bold uppercase tracking-widest">Favoritos del Chef</span>
            <h2 class="text-4xl font-bold text-gray-900 mt-2 mb-12">Nuestros Platos Estrella</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition duration-300">
                    <div class="h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1594212699903-ec8a3eca50f5?q=80&w=2071&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="Hamburguesa">
                    </div>
                    <div class="p-8 text-left">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Burger Royal</h3>
                        <p class="text-gray-500 mb-4">Doble carne, cheddar fundido, bacon crocante y nuestra salsa secreta.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-bold text-orange-600">$8.500</span>
                            <a href="/menu" class="text-sm font-bold text-gray-900 underline">Ver detalles</a>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition duration-300 transform md:-translate-y-4 border-2 border-orange-100">
                    <div class="h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1600891964092-4316c288032e?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="Bife">
                    </div>
                    <div class="p-8 text-left relative">
                        <div class="absolute top-0 right-0 bg-orange-600 text-white text-xs font-bold px-3 py-1 rounded-bl-lg">MÁS VENDIDO</div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Ojo de Bife</h3>
                        <p class="text-gray-500 mb-4">500g de carne de primera calidad, acompañada de papas rústicas.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-bold text-orange-600">$18.000</span>
                            <a href="/menu" class="text-sm font-bold text-gray-900 underline">Ver detalles</a>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition duration-300">
                    <div class="h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1563379926898-05f4575a45d8?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="Pasta">
                    </div>
                    <div class="p-8 text-left">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Sorrentinos</h3>
                        <p class="text-gray-500 mb-4">Rellenos de jamón y mozzarella con salsa rosa y albahaca fresca.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-bold text-orange-600">$11.200</span>
                            <a href="/menu" class="text-sm font-bold text-gray-900 underline">Ver detalles</a>
                        </div>
                    </div>
                </div>

            </div>

            <a href="/menu" class="inline-flex items-center gap-3 px-10 py-4 bg-gray-900 text-white text-lg font-bold rounded-full hover:bg-gray-800 transition transform hover:scale-105 shadow-2xl">
                Explorar Menú Completo 🍕
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                </svg>
            </a>

        </div>
    </section>

    <section class="relative py-24 bg-fixed bg-center bg-cover" style="background-image: url('https://images.unsplash.com/photo-1555396273-367ea4eb4db5?q=80&w=1974&auto=format&fit=crop');">
        <div class="absolute inset-0 bg-black/60"></div>
        <div class="relative z-10 text-center text-white px-4">
            <h2 class="text-4xl font-bold mb-4">¿Querés asegurar tu mesa?</h2>
            <p class="text-xl text-gray-300 mb-8">Las mejores noches se planean con anticipación.</p>
            <a href="https://wa.me/" class="px-8 py-3 bg-green-500 hover:bg-green-600 text-white font-bold rounded-full shadow-lg transition flex items-center justify-center gap-2 w-fit mx-auto">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.017-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                Reservar por WhatsApp
            </a>
        </div>
    </section>

    <footer class="bg-gray-900 text-gray-400 py-12">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
            <div>
                <h3 class="text-white text-xl font-bold mb-4">RestoApp</h3>
                <p class="text-sm">La mejor experiencia culinaria de la ciudad, ahora al alcance de tu mano.</p>
            </div>
            <div>
                <h4 class="text-white font-bold mb-4">Enlaces Rápidos</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#inicio" class="hover:text-orange-500">Inicio</a></li>
                    <li><a href="/menu" class="hover:text-orange-500">Ver Menú Completo</a></li>
                    <li><a href="#nosotros" class="hover:text-orange-500">Sobre Nosotros</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold mb-4">Horarios</h4>
                <ul class="space-y-2 text-sm">
                    <li>Lun - Vie: 12:00 - 15:00 / 20:00 - 00:00</li>
                    <li>Sáb - Dom: 12:00 - 01:00</li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold mb-4">Ubicación</h4>
                <p class="text-sm">Av. Siempreviva 742,<br>Ciudad, Argentina.</p>
            </div>
        </div>
        <div class="text-center border-t border-gray-800 pt-8 text-sm">
            &copy; 2026 RestoApp Inc. Todos los derechos reservados.
        </div>
    </footer>

</body>
</html>