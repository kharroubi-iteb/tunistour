<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lieu;
use App\Models\Reservation;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class ChatbotController extends Controller
{
    /**
     * Traite la requête utilisateur, récupère les données et appelle l'API Gemini.
     */
    public function handleChat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000'
        ]);

        $userQuery = trim($request->input('message'));
        $userId = Auth::check() ? Auth::id() : 1; // ID 1 par défaut pour démo

        // ETAPE 3 (DU CAHIER DES CHARGES) : Récupération des données pertinentes depuis Eloquent
        $lieux = Lieu::all()->toArray();
        $reservationsRecentes = Reservation::where('user_id', $userId)
            ->orderBy('id', 'desc')
            ->limit(3)
            ->get()
            ->toArray();

        // ETAPE 4 : Construction d'un prompt intelligent (contexte + données + question)
        $promptContext = "Tu es 'TunisBot', un guide de voyage IA hautement qualifié pour la Tunisie. ";
        $promptContext .= "Voici la base de données actuelle des destinations touristiques tunisiennes sous forme JSON :\n";
        $promptContext .= json_encode($lieux, JSON_PRETTY_PRINT) . "\n\n";
        $promptContext .= "Et voici l'historique des réservations de l'utilisateur connecté actuelle :\n";
        $promptContext .= json_encode($reservationsRecentes, JSON_PRETTY_PRINT) . "\n\n";
        $promptContext .= "Instructions:\n";
        $promptContext .= "1. Utilise rigoureusement ces données réelles pour répondre précisément à l'utilisateur.\n";
        $promptContext .= "2. Si l'utilisateur demande ses réservations ou commandes, récite les détails récents ci-dessus.\n";
        $promptContext .= "3. Réponds de façon polie, chaleureuse, en français ou tunisien s'il te plaît, en mettant en valeur la Tunisie (Carthage, Sidi Bou Said, Tozeur, etc.).\n";
        $promptContext .= "4. Si la requête est hors contexte touristique, dévie gentiment avec humour digne d'un tunisien.\n\n";
        $promptContext .= "Question de l'utilisateur : '" . $userQuery . "'";

        // ETAPE 5 : Appel à la nouvelle API Google Gemini via HTTP Client de Laravel Guzzle
        $apiKey = env('GEMINI_API_KEY');
        if (!$apiKey) {
            return response()->json([
                'success' => false,
                'reply' => "Erreur : La clé API 'GEMINI_API_KEY' n'est pas configurée dans le fichier .env de Laravel."
            ], 500);
        }

        try {
            // URL de l'API Gemini 3.5 Flash ou version stable courante
            $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-3.5-flash:generateContent?key=" . rawurlencode($apiKey);

            $response = Http::timeout(10)->post($url, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $promptContext]
                        ]
                    ]
                ]
              ]);

            if ($response->failed()) {
                throw new \Exception("L'API Gemini a retourné un code d'erreur : " . $response->status());
            }

            // Extraction du texte de la réponse générée (Format standard Google GenAI)
            $data = $response->json();
            $generatedText = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;

            if (!$generatedText) {
                throw new \Exception("Impossible de décoder le contenu généré par l'IA.");
            }

            // ETAPE 6 : Historique des conversations sauvegardé en base de données
            // (Optionnel) Ici, on peut insérer dans la table des messages de chat
            
            return response()->json([
                'success' => true,
                'reply' => $generatedText,
                'retrieved_db_records' => count($lieux)
            ]);

        } catch (\Exception $e) {
            // Gestion des erreurs robuste imposée par la section 4.5 du cahier des charges
            return response()->json([
                'success' => false,
                'reply' => "Désolé ! J'ai rencontré un problème de connexion avec mon cerveau IA (" . $e->getMessage() . "). Veuillez réessayer sous peu.",
                'error' => $e->getMessage()
            ], 200); // Retour de secours élégant pour l'interface de chat
        }
    }
}
