<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Enregistre une réservation de tourisme
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'place_name' => 'required|string|max:100',
            'place_type' => 'required|in:hotel,restaurant,activity',
            'date' => 'required|date|after_or_equal:today',
            'price' => 'required|string',
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'email' => 'required|email|max:150',
        ]);

        $reservation = Reservation::create([
            'user_id' => Auth::check() ? Auth::id() : 1, // Démo
            'place_name' => $validated['place_name'],
            'place_type' => $validated['place_type'],
            'date' => $validated['date'],
            'status' => 'confirmed',
            'price' => $validated['price'],
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Réservation enregistrée avec succès !',
                'booking' => $reservation
              ]);
        }

        return redirect()->back()->with('success', 'Votre réservation a bien été reçue ! TunisBot a été averti.');
    }
}
