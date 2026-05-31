@extends('layouts.app')

@section('title', 'TunisBot IA - Guide de Voyage Intelligent')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Chat Header with descriptive info -->
    <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div class="flex items-center gap-3.5">
            <div class="bg-amber-500/10 text-amber-600 p-3 rounded-2xl flex items-center justify-center">
                <i class="fa-solid fa-robot text-2xl animate-pulse"></i>
            </div>
            <div>
                <h2 class="text-lg font-black text-slate-900 leading-tight">Discutez avec TunisBot IA</h2>
                <p class="text-xs text-gray-500 mt-1">Notre guide virtuel est connecté à vos réservations et aux destinations tunisiennes en temps réel.</p>
            </div>
        </div>
        <button onclick="clearChat()" class="self-start md:self-auto bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold px-4 py-2.5 rounded-xl transition-all flex items-center gap-2">
            <i class="fa-solid fa-trash-can"></i>
            <span>Effacer la conversation</span>
        </button>
    </div>

    <!-- Chat Console Container -->
    <div class="bg-slate-900 rounded-3xl border border-slate-800 shadow-xl overflow-hidden flex flex-col">
        <!-- Status bar -->
        <div class="bg-slate-950 px-6 py-3 border-b border-slate-850 flex items-center justify-between">
            <div class="flex items-center gap-2 text-[10px] text-gray-400 font-mono">
                <span class="flex h-1.5 w-1.5 rounded-full bg-emerald-500 animate-ping"></span>
                <span>SYSTEM: COMPAGNON INTELLIGENT ACTIF</span>
            </div>
            <span class="text-[10px] text-amber-300 bg-amber-500/10 px-2 py-0.5 rounded border border-amber-500/20 font-mono font-bold">API GEMINI PROXY</span>
        </div>

        <!-- Chat messages view area -->
        <div id="chatContainer" class="p-6 space-y-4 h-[440px] overflow-y-auto font-sans text-xs scroll-smooth">
            <!-- Bot message -->
            <div class="flex gap-3 max-w-[85%]">
                <div class="w-8 h-8 rounded-full bg-amber-500 text-white flex items-center justify-center text-xs shrink-0 shadow-md">
                    🤖
                </div>
                <div class="bg-slate-800 text-slate-200 rounded-2xl p-4 leading-relaxed space-y-2">
                    <p><strong>Aslama !</strong> Je suis votre guide de voyage <strong>TunisBot</strong> 🇹🇳.</p>
                    <p>Je peux vous aider à planifier votre séjour, répondre à des interrogations historiques sur Carthage ou l'amphithéâtre d'El Jem, ou même lister vos réservations courantes.</p>
                    <div class="text-[11px] text-amber-300/90 pt-1">
                        Exemples de questions :
                        <ul class="list-disc pl-4 mt-1 space-y-1 font-mono text-[10px]">
                            <li>"Quels hôtels trouve-t-on à Sidi Bou Saïd ?"</li>
                            <li>"Affiche mes voyages validés actuellement"</li>
                            <li>"Parle-moi de la colline de Carthage"</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Typing input footer bar -->
        <div class="bg-slate-950 p-4 border-t border-slate-850">
            <form id="chatForm" onsubmit="sendMessage(event)" class="flex gap-2">
                @csrf
                <input 
                    type="text" 
                    id="userInput" 
                    required
                    autocomplete="off"
                    placeholder="Posez vos questions à TunisBot (ex: Quels sont les hôtels à Sidi Bou Saïd ?)..." 
                    class="flex-1 bg-slate-900 border border-slate-800 rounded-2xl px-4 py-3.5 text-xs text-white placeholder-slate-500 outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all"
                >
                <button type="submit" class="bg-red-600 hover:bg-red-500 text-white font-extrabold text-xs px-5 rounded-2xl transition-all flex items-center gap-2 shadow-lg shadow-red-600/10">
                    <span>Envoyer</span>
                    <i class="fa-solid fa-paper-plane"></i>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function sendMessage(event) {
    event.preventDefault();
    const input = document.getElementById('userInput');
    const msg = input.value.trim();
    if(!msg) return;

    input.value = '';
    appendMessage('user', msg);

    // Loader animation insertion
    const loaderId = appendMessage('bot', `
        <div class="flex items-center gap-2">
            <svg class="animate-spin h-4 w-4 text-amber-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span class="font-mono text-[10px] text-slate-400">TunisBot analyse des données en Tunisie...</span>
        </div>
    `, true);

    fetch('/api/chatbot', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ message: msg })
    })
    .then(r => r.json())
    .then(data => {
        const loaderElem = document.getElementById(loaderId);
        if(loaderElem) loaderElem.remove();
        
        if(data.success) {
            appendMessage('bot', data.reply);
        } else {
            appendMessage('bot', data.reply || "Une erreur s'est produite lors du décodage de la réponse.");
        }
    })
    .catch(err => {
        const loaderElem = document.getElementById(loaderId);
        if(loaderElem) loaderElem.remove();
        appendMessage('bot', "Désolé, TunisBot rencontre des difficultés temporaires de communication. Veuillez réessayer.");
    });
}

let msgId = 0;
function appendMessage(sender, text, isLoader = false) {
    const chatContainer = document.getElementById('chatContainer');
    const div = document.createElement('div');
    const id = 'msg-' + (++msgId);
    div.id = id;
    
    if (sender === 'user') {
        div.className = 'flex gap-3 max-w-[85%] ml-auto justify-end';
        div.innerHTML = `
            <div class="bg-red-600 text-white rounded-2xl p-4 leading-relaxed shadow-md">
                \${text}
            </div>
            <div class="w-8 h-8 rounded-full bg-slate-800 text-slate-300 flex items-center justify-center text-xs shrink-0 border border-slate-700">
                👤
            </div>
        `;
    } else {
        div.className = 'flex gap-3 max-w-[85%]';
        div.innerHTML = `
            <div class="w-8 h-8 rounded-full bg-amber-500 text-white flex items-center justify-center text-xs shrink-0 shadow-md">
                🤖
            </div>
            <div class="bg-slate-800 text-slate-200 rounded-2xl p-4 leading-relaxed border border-slate-750/30 shadow-inner">
                \${text}
            </div>
        `;
    }

    chatContainer.appendChild(div);
    chatContainer.scrollTop = chatContainer.scrollHeight;
    return id;
}

function clearChat() {
    const chatContainer = document.getElementById('chatContainer');
    chatContainer.innerHTML = '';
    appendMessage('bot', "Le chat a été réinitialisé avec succès ! Comment puis-je vous aider à explorer la Tunisie ?");
}
</script>
@endsection
