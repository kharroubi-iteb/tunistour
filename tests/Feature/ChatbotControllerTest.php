<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Lieu;
use App\Models\Reservation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;

class ChatbotControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Teste que l'API chatbot retourne bien une réponse structurée valide (Section 5.3.B)
     */
    public function test_chatbot_returns_valid_response(): void
    {
        // On génère de la donnée factice via Eloquent
        $user = User::factory()->create();
        
        Lieu::create([
            'name' => 'Carthage',
            'region' => 'Tunis',
            'description' => 'Thermes d\'Antonin de Carthage antique.',
            'category' => 'monument',
            'rating' => 4.8,
            'latitude' => 36.8528,
            'longitude' => 10.3333
        ]);

        // Mock Http pour l'API externe de l'IA (requis par la section 5.5 "Mocker les appels IA")
        Http::fake([
            'generativelanguage.googleapis.com/*' => Http::response([
                'candidates' => [
                    [
                        'content' => [
                            'parts' => [
                                ['text' => 'Bienvenue à Carthage ! Les Thermes d\'Antonin sont superbes.']
                            ]
                        ]
                    ]
                ]
            ], 200)
        ]);

        $response = $this->actingAs($user)->postJson('/api/chatbot', [
            'message' => 'Parle-moi de Carthage'
        ]);

        // Assertions requises par la section 4.7
        $response->assertStatus(200);
        $response->assertJsonStructure(['success', 'reply']);
        $response->assertJsonFragment([
            'reply' => 'Bienvenue à Carthage ! Les Thermes d\'Antonin sont superbes.'
        ]);
    }
}
