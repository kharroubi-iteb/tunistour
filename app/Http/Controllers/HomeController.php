<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lieu;
use App\Models\Reservation;
use App\Models\CommercialPlace;

class HomeController extends Controller
{
    /**
     * Page d'accueil dynamique répertoriant tous les lieux et commerces de Tunisie
     */
    public function index(Request $request)
    {
        // On récupère tous les monuments avec leurs hôtels et restaurants associés
        $lieux = Lieu::with('commercialPlaces')->get();

        // On récupère les 10 dernières réservations enregistrées en base locale
        $reservations = Reservation::orderBy('id', 'desc')->get();

        // Récupération éventuelle de filtres de recommandation IA simulés
        $filterType = $request->query('pref_type'); // 'monument' ou 'exploration'
        $filteredLieux = $lieux;
        if ($filterType) {
            $filteredLieux = $lieux->where('category', $filterType);
        }

        return view('home', compact('lieux', 'reservations', 'filteredLieux', 'filterType'));
    }

    /**
     * Affiche un monument spécifique par son ID
     */
    public function showMonument($id)
    {
        $monument = Lieu::with('commercialPlaces')->findOrFail($id);
        return view('show', compact('monument'));
    }
}
