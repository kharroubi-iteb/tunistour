@extends('layouts.app')

@section('title', 'Portail de Voyage TunisTour IA - Tunisie Éternelle')

@section('content')
<div class="space-y-10">

    <!-- Scenic Tunisian Sunset Hero Banner -->
    <div class="relative rounded-3xl overflow-hidden shadow-2xl bg-gradient-to-tr from-rose-950 via-slate-900 to-indigo-950 text-white border border-rose-900/10">
        <div class="absolute inset-0 opacity-30 bg-[radial-gradient(circle_at_bottom_left,_var(--tw-gradient-stops))] from-amber-500 via-rose-700 to-transparent"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-red-600/10 rounded-full blur-3xl"></div>
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 p-8 lg:p-12 relative z-10 items-center">
            <!-- Left Side Core Greetings -->
            <div class="lg:col-span-7 space-y-6">
                <div class="flex flex-wrap gap-2 items-center">
                    <span class="inline-flex items-center gap-1.5 bg-red-500/20 text-red-300 px-3.5 py-1.5 rounded-full text-xs font-bold tracking-wider border border-red-500/30 uppercase">
                        🇹🇳 Destination Tunisie
                    </span>
                    <span class="inline-flex items-center gap-1.5 bg-amber-500/10 text-amber-300 px-3 py-1.5 rounded-full text-xs font-semibold border border-amber-500/20">
                        ☀️ Tunis Temp: 28°C
                    </span>
                </div>
                
                <h1 class="text-4xl lg:text-5xl font-black tracking-tight leading-none text-white">
                    Explorez la Tunisie <br/>
                    <span class="bg-gradient-to-r from-amber-400 via-rose-400 to-red-400 bg-clip-text text-transparent">Évasion Magique & Interactive</span>
                </h1>
                
                <p class="text-slate-200 text-sm max-w-xl leading-relaxed font-medium">
                    Plongez dans les secrets antiques de la colline de <strong>Carthage</strong>, laissez-vous bercer par l'azur poétique de <strong>Sidi Bou Saïd</strong>, et configurez vos préférences de voyage à l'aide de notre intelligence intégrée.
                </p>

                <div class="flex flex-wrap gap-3 pt-2">
                    <a href="#explore-catalog" class="bg-red-600 hover:bg-red-500 text-white font-extrabold px-6 py-3.5 rounded-xl transition-all shadow-lg shadow-red-600/30 text-xs uppercase tracking-wide">
                        <i class="fa-solid fa-compass mr-2"></i> Visiter les hauts lieux
                    </a>
                    <a href="{{ route('chatbot.index') }}" class="bg-white/10 hover:bg-white/20 text-amber-200 font-extrabold px-6 py-3.5 rounded-xl transition-all border border-white/20 text-xs uppercase tracking-wide">
                        <i class="fa-solid fa-wand-magic-sparkles mr-2 animate-pulse text-amber-300"></i> Discuter avec TunisBot IA
                    </a>
                </div>
            </div>

            <!-- Right-Side Interactive Recommendation Simulator Widget -->
            <div class="lg:col-span-5 bg-slate-950/85 backdrop-blur-md rounded-2xl p-6 border border-slate-800 shadow-xl space-y-4">
                <div class="flex items-center gap-2.5 text-amber-400">
                    <i class="fa-solid fa-wand-magic-sparkles"></i>
                    <h3 class="font-bold text-sm tracking-wide text-white uppercase font-sans">Filtrez vos Recommandations</h3>
                </div>
                <p class="text-xs text-slate-300 leading-relaxed">
                    Préférez-vous l'Histoire millénaire, les plages de sable fin ou l'immensité du Sahara ? Sélectionnez vos préférences pour raffiner le catalogue :
                </p>

                <div class="grid grid-cols-2 gap-2.5 pt-2">
                    <a href="{{ route('home') }}?pref_type=monument#explore-catalog" class="flex flex-col items-center p-3 rounded-xl border text-center transition-all bg-slate-900 {{ $filterType === 'monument' ? 'border-red-500 bg-red-950/20' : 'border-slate-800 hover:bg-slate-800' }}">
                        <span class="text-lg">🏛️</span>
                        <span class="text-[11px] font-bold text-white mt-1">Histoire & Antiquités</span>
                    </a>
                    <a href="{{ route('home') }}?pref_type=exploration#explore-catalog" class="flex flex-col items-center p-3 rounded-xl border text-center transition-all bg-slate-900 {{ $filterType === 'exploration' ? 'border-red-500 bg-red-950/20' : 'border-slate-800 hover:bg-slate-800' }}">
                        <span class="text-lg">🌴</span>
                        <span class="text-[11px] font-bold text-white mt-1">Plages & Déserts</span>
                    </a>
                </div>
                @if($filterType)
                    <div class="text-center">
                        <a href="{{ route('home') }}#explore-catalog" class="text-[10px] text-red-400 hover:underline font-semibold block pt-2">
                            <i class="fa-solid fa-times-circle mr-1"></i> Réinitialiser les filtres
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Main Grid: Catalog / Sidebar -->
    <div id="explore-catalog" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Left Side: Interactive Catalog -->
        <div class="lg:col-span-8 space-y-6">
            <div class="border-b border-gray-200 pb-4 flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-black text-slate-800">Catalogue des Lieux d'Exception</h2>
                    <p class="text-xs text-gray-500 mt-1">Cliquez sur n'importe quel hôtel ou restaurant pour lancer votre réservation immédiate.</p>
                </div>
                @if($filterType)
                    <span class="bg-red-50 text-red-700 text-xs font-bold px-3 py-1 rounded-full border border-red-100">
                        Filtre actif : {{ $filterType === 'monument' ? 'Monuments' : 'Oasis & Évasion' }}
                    </span>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($filteredLieux as $place)
                    <div class="bg-white rounded-2xl border border-gray-205 shadow-sm overflow-hidden flex flex-col hover:shadow-md transition-shadow">
                        <!-- Card Hero Image -->
                        <div class="h-48 relative overflow-hidden bg-slate-100">
                            <img src="{{ $place->image_url }}" alt="{{ $place->name }}" class="w-full h-full object-cover">
                            <!-- Star Rating Shield -->
                            <div class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm px-2.5 py-1 rounded-lg flex items-center gap-1 shadow-sm text-[11px] font-bold text-slate-800">
                                <span class="text-amber-500">★</span> {{ $place->rating }}
                            </div>
                            <!-- Region Badge -->
                            <div class="absolute bottom-3 left-3 bg-indigo-950/80 backdrop-blur-sm text-white px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider">
                                <i class="fa-solid fa-map-pin mr-1 text-red-400"></i> {{ $place->region }}
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                            <div>
                                <h3 class="text-base font-extrabold text-slate-900">{{ $place->name }}</h3>
                                <p class="text-xs text-gray-600 mt-2 leading-relaxed">
                                    {{ $place->description }}
                                </p>
                            </div>

                            <!-- Associated Hotels & Restaurants (NATIVE EMBEDDED COMPONENT) -->
                            <div class="pt-3 border-t border-gray-100 space-y-2">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-gray-400 block">
                                    🏨 Hébergements & Restauration associés :
                                </span>
                                <div class="space-y-1.5">
                                    @forelse($place->commercialPlaces as $comm)
                                        <div class="flex items-center justify-between gap-1.5 p-2 bg-gray-50/70 hover:bg-gray-100 rounded-xl border border-gray-250/20 transition-colors text-xs">
                                            <div class="flex items-center gap-2 min-w-0">
                                                <span class="text-sm shrink-0">
                                                    {!! $comm->type === 'hotel' ? '🏨' : '🍽️' !!}
                                                </span>
                                                <div class="min-w-0">
                                                    <p class="font-bold text-slate-800 truncate text-[11px] leading-tight">{{ $comm->name }}</p>
                                                    <p class="text-[10px] text-gray-500 font-mono mt-0.5 leading-none">{{ $comm->price }}</p>
                                                </div>
                                            </div>
                                            <button 
                                                type="button"
                                                onclick="openBookingModal('{{ addslashes($comm->name) }}', '{{ $comm->type }}', '{{ $comm->price }}')"
                                                class="bg-red-600 hover:bg-red-500 text-white font-extrabold text-[10px] px-2.5 py-1 rounded-lg transition-all shrink-0 shadow-sm"
                                            >
                                                Réserver
                                            </button>
                                        </div>
                                    @empty
                                        <p class="text-[11px] text-gray-400 italic">Aucun hôtel ou restaurant enregistré.</p>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Footer Tag Badge Row -->
                            <div class="flex flex-wrap gap-1 pt-1">
                                @if(is_array($place->tags))
                                    @foreach($place->tags as $tag)
                                        <span class="bg-gray-100 text-gray-600 text-[9px] font-bold px-2 py-0.5 rounded-full">
                                            #{{ $tag }}
                                        </span>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-xs text-gray-500 italic">Aucune destination trouvée.</p>
                @endforelse
            </div>
        </div>

        <!-- Right Side: Recent Database Bookings Logs -->
        <div class="lg:col-span-4 space-y-6">
            <div class="bg-white rounded-2xl border border-gray-200 p-5 shadow-sm space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="font-black text-slate-900 text-sm uppercase tracking-wide">Voyages Récents validés</h3>
                    <span class="bg-green-100 text-green-700 text-[10px] font-bold px-2 py-0.5 rounded-full">
                        {{ count($reservations) }} Total
                    </span>
                </div>
                <p class="text-xs text-gray-500">
                    Voici l'historique en temps réel des réservations enregistrées directement dans la base de données :
                </p>

                <div class="space-y-3.5 max-h-[380px] overflow-y-auto pr-1">
                    @forelse($reservations as $res)
                        <div class="p-3 bg-gray-50 rounded-xl border border-gray-200 relative flex items-start gap-2.5">
                            <span class="text-lg">
                                {!! $res->place_type === 'hotel' ? '🏨' : '🍽️' !!}
                            </span>
                            <div class="space-y-1">
                                <p class="text-xs font-bold text-slate-800 leading-tight">
                                    {{ $res->place_name }}
                                </p>
                                <p class="text-[10px] text-gray-500 font-mono">
                                    Par: <strong>{{ $res->prenom }} {{ $res->nom }}</strong>
                                </p>
                                <p class="text-[10px] text-gray-500">
                                    Départ le : <span class="bg-red-50 text-red-600 font-bold px-1.5 py-0.5 rounded text-[9px]">{{ \Carbon\Carbon::parse($res->date)->format('d/m/Y') }}</span>
                                </p>
                                <p class="text-[10px] text-emerald-600 font-bold">
                                    Tarif: {{ $res->price }} &middot; <span class="text-[9px] uppercase px-1 py-0.2 bg-emerald-50 text-emerald-700 rounded select-none">Validé</span>
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center p-6 bg-gray-50 rounded-xl border border-dashed border-gray-200">
                            <i class="fa-solid fa-plane-up text-gray-300 text-lg mb-2 block"></i>
                            <p class="text-[11px] text-gray-400 italic">Aucune réservation pour le moment.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ==================== BOOKING MODAL DIALOG ==================== -->
<div id="bookingModal" class="hidden fixed inset-0 bg-slate-950/80 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-md w-full overflow-hidden shadow-2xl border border-gray-100 flex flex-col">
        
        <!-- Header -->
        <div class="bg-slate-900 text-white p-5 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="text-red-500">✈️</span>
                <h4 class="font-bold text-xs uppercase tracking-wider font-sans">Formulaire de Réservation</h4>
            </div>
            <button type="button" onclick="closeBookingModal()" class="text-gray-400 hover:text-white rounded-full bg-slate-800 p-1.5 transition-colors">
                <i class="fa-solid fa-times text-xs"></i>
            </button>
        </div>

        <form action="{{ route('reservations.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            
            <!-- Target Destination Hidden Inputs -->
            <input type="hidden" id="modalPlaceName" name="place_name">
            <input type="hidden" id="modalPlaceType" name="place_type">
            <input type="hidden" id="modalPrice" name="price">

            <!-- Selected Target Display -->
            <div class="bg-slate-50 border border-slate-200 rounded-2xl p-4 flex items-center gap-3">
                <span id="modalPlaceIcon" class="text-2xl">🏨</span>
                <div>
                    <h5 id="modalPlaceDisplay" class="font-extrabold text-slate-900 text-xs text-sm">Hôtel Nom</h5>
                    <p id="modalPriceDisplay" class="text-xs text-red-500 font-bold mt-1 font-mono">100 DT / nuit</p>
                </div>
            </div>

            <!-- Double Columns: Nom / Prenom -->
            <div class="grid grid-cols-2 gap-3">
                <div class="space-y-1">
                    <label class="text-[10px] font-bold text-gray-600 uppercase block">Prénom : *</label>
                    <input 
                        type="text" 
                        name="prenom" 
                        required 
                        placeholder="Iteb" 
                        value="Iteb"
                        class="w-full bg-gray-100 border border-transparent font-sans text-xs p-3 rounded-xl outline-none focus:bg-white focus:border-red-500 focus:ring-2 focus:ring-red-500 transition-all font-semibold text-slate-800"
                    >
                </div>
                <div class="space-y-1">
                    <label class="text-[10px] font-bold text-gray-600 uppercase block">Nom : *</label>
                    <input 
                        type="text" 
                        name="nom" 
                        required 
                        placeholder="Kharroubi" 
                        value="Kharroubi"
                        class="w-full bg-gray-100 border border-transparent font-sans text-xs p-3 rounded-xl outline-none focus:bg-white focus:border-red-500 focus:ring-2 focus:ring-red-500 transition-all font-semibold text-slate-800"
                    >
                </div>
            </div>

            <!-- E-mail Address -->
            <div class="space-y-1">
                <label class="text-[10px] font-bold text-gray-600 uppercase block">Adresse E-mail : *</label>
                <input 
                    type="email" 
                    name="email" 
                    required 
                    placeholder="exemple@domaine.com" 
                    value="kharroubiiteb44@gmail.com"
                    class="w-full bg-gray-100 border border-transparent font-sans text-xs p-3 rounded-xl outline-none focus:bg-white focus:border-red-500 focus:ring-2 focus:ring-red-500 transition-all font-semibold text-slate-800"
                >
            </div>

            <!-- Date de départ -->
            <div class="space-y-1">
                <label class="text-[10px] font-bold text-gray-600 uppercase block">Date de départ : *</label>
                <input 
                    type="date" 
                    name="date" 
                    required 
                    value="{{ \Carbon\Carbon::now()->addDays(7)->format('Y-m-d') }}"
                    class="w-full bg-gray-100 border border-transparent font-sans text-xs p-3 rounded-xl outline-none focus:bg-white focus:border-red-500 focus:ring-2 focus:ring-red-500 transition-all font-semibold text-slate-800"
                >
            </div>

            <div class="pt-3 flex gap-3">
                <button 
                    type="button" 
                    onclick="closeBookingModal()" 
                    class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold text-xs py-3 rounded-xl transition-all text-center"
                >
                    Annuler
                </button>
                <button 
                    type="submit" 
                    class="flex-1 bg-red-600 hover:bg-red-500 text-white font-bold text-xs py-3 rounded-xl transition-all shadow-md active:scale-95"
                >
                    Confirmer la réservation
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openBookingModal(name, type, price) {
    document.getElementById('modalPlaceName').value = name;
    document.getElementById('modalPlaceType').value = type;
    document.getElementById('modalPrice').value = price;

    document.getElementById('modalPlaceDisplay').textContent = name;
    document.getElementById('modalPriceDisplay').textContent = price;
    
    document.getElementById('modalPlaceIcon').textContent = type === 'hotel' ? '🏨' : '🍽️';

    document.getElementById('bookingModal').classList.remove('hidden');
}

function closeBookingModal() {
    document.getElementById('bookingModal').classList.add('hidden');
}
</script>
@endsection
