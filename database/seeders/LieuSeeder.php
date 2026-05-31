<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lieu;
use App\Models\CommercialPlace;

class LieuSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Sidi Bou Saïd
        $sidi_bou_said = Lieu::create([
            'name' => 'Sidi Bou Saïd',
            'region' => 'Tunis Nord',
            'description' => 'Un village poétique perché sur une falaise dominant la mer Méditerranée, célèbre pour ses portes cloutées artisanales bleues et ses murs blanchis à la chaux.',
            'category' => 'monument',
            'rating' => 4.9,
            'image_url' => 'https://images.unsplash.com/photo-1534447677768-be436bb09401?auto=format&fit=crop&w=800&q=80',
            'tags' => ['UNESCO', 'Art', 'Mer', 'Romantique'],
            'latitude' => 36.8702,
            'longitude' => 10.3396
        ]);

        CommercialPlace::create([
            'destination_id' => $sidi_bou_said->id,
            'name' => 'Café des Délices (Sidi Bou Saïd)',
            'type' => 'restaurant',
            'price' => '25 DT / boisson',
            'rating' => 4.7,
            'description' => 'Le légendaire café en terrasses superposées offrant un couché de soleil spectaculaire sur le golfe de Tunis.',
            'image_url' => 'https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=800&q=80'
        ]);

        CommercialPlace::create([
            'destination_id' => $sidi_bou_said->id,
            'name' => 'Hôtel Dar Said',
            'type' => 'hotel',
            'price' => '320 DT / nuit',
            'rating' => 4.9,
            'description' => 'Une luxueuse demeure bourgeoise du XIXe siècle réaménagée en hôtel-boutique d\'exception au cœur du village.',
            'image_url' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=800&q=80'
        ]);

        // 2. Carthage
        $carthage = Lieu::create([
            'name' => 'Site d\'Antonin, Carthage',
            'region' => 'Tunis Banlieue',
            'description' => 'Les majestueux vestiges des Thermes d\'Antonin de l\'antique Carthage, symbole de la grandeur carthaginoise et romaine en Afrique du Nord.',
            'category' => 'monument',
            'rating' => 4.8,
            'image_url' => 'https://images.unsplash.com/photo-1508919801845-fc2ae1bc2a28?auto=format&fit=crop&w=800&q=80',
            'tags' => ['Patrimoine', 'Histoire', 'Romains', 'Phéniciens'],
            'latitude' => 36.8528,
            'longitude' => 10.3333
        ]);

        CommercialPlace::create([
            'destination_id' => $carthage->id,
            'name' => 'Villa Didon Carthage',
            'type' => 'hotel',
            'price' => '410 DT / nuit',
            'rating' => 4.8,
            'description' => 'Un hôtel au design contemporain suspendu sur les hauteurs de Carthage avec une vue panoramique sur les ports puniques.',
            'image_url' => 'https://images.unsplash.com/photo-1582719508461-905c673771fd?auto=format&fit=crop&w=800&q=80'
        ]);

        CommercialPlace::create([
            'destination_id' => $carthage->id,
            'name' => 'Restaurant Le Clos des Oliviers',
            'type' => 'restaurant',
            'price' => '65 DT / convive',
            'rating' => 4.6,
            'description' => 'Une fine gastronomie d\'inspiration méditerranéenne servie dans une splendide cour ombragée.',
            'image_url' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=800&q=80'
        ]);

        // 3. Tozeur
        $tozeur = Lieu::create([
            'name' => 'Tozeur & Chott el-Djerid',
            'region' => 'Sud Tunisien',
            'description' => 'Une oasis saharienne prospère réputée pour ses briques d\'argile ocre artisanales et l\'immensité lunaire de son lac de sel asséché, le Chott el-Djerid.',
            'category' => 'exploration',
            'rating' => 4.7,
            'image_url' => 'https://images.unsplash.com/photo-1509316975850-ff9c5deb0cd9?auto=format&fit=crop&w=800&q=80',
            'tags' => ['Désert', 'Oasis', 'Sahara', 'Culture'],
            'latitude' => 33.9189,
            'longitude' => 8.1332
        ]);

        CommercialPlace::create([
            'destination_id' => $tozeur->id,
            'name' => 'Golden Yasmin Ras El Ain',
            'type' => 'hotel',
            'price' => '150 DT / nuit',
            'rating' => 4.3,
            'description' => 'Un chaleureux hôtel de style oasien situé au cœur de la palmeraie de Tozeur, idéal pour s\'élancer vers le Grand Erg.',
            'image_url' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?auto=format&fit=crop&w=800&q=80'
        ]);

        CommercialPlace::create([
            'destination_id' => $tozeur->id,
            'name' => 'Restaurant Dar Deda Tozeur',
            'type' => 'restaurant',
            'price' => '45 DT / convive',
            'rating' => 4.6,
            'description' => 'Cuisine traditionnelle authentique du Jérid servie dans un cadre envoûtant de briques faites à la main.',
            'image_url' => 'https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=800&q=80'
        ]);

        // 4. El Jem
        $el_jem = Lieu::create([
            'name' => 'Amphithéâtre d\'El Jem',
            'region' => 'Sahel',
            'description' => 'Le plus grand colisée romain d\'Afrique du Nord, extraordinairement bien conservé, classé par l\'UNESCO.',
            'category' => 'monument',
            'rating' => 4.8,
            'image_url' => 'https://images.unsplash.com/photo-1552832230-c0197dd311b5?auto=format&fit=crop&w=800&q=80',
            'tags' => ['UNESCO', 'Arènes', 'Architecture', 'EmpireRomain'],
            'latitude' => 35.2964,
            'longitude' => 10.7042
        ]);

        CommercialPlace::create([
            'destination_id' => $el_jem->id,
            'name' => 'Hôtel Julius El Jem',
            'type' => 'hotel',
            'price' => '120 DT / nuit',
            'rating' => 4.5,
            'description' => 'Hôtel moderne confortable idyllique, à seulement 3 minutes à pied du légendaire Colisée romain.',
            'image_url' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?auto=format&fit=crop&w=800&q=80'
        ]);

        CommercialPlace::create([
            'destination_id' => $el_jem->id,
            'name' => 'Restaurant Le Bonheur El Jem',
            'type' => 'restaurant',
            'price' => '35 DT / convive',
            'rating' => 4.4,
            'description' => 'Savoureuses grillades au feu de bois et couscous tunisien authentique servis sur une terrasse avec une vue directe sur l\'arène.',
            'image_url' => 'https://images.unsplash.com/photo-1498837167922-ddd27525d352?auto=format&fit=crop&w=800&q=80'
        ]);

        // 5. Djerba
        $djerba = Lieu::create([
            'name' => 'Djerba la Douce',
            'region' => 'Sud-Est Tunisien',
            'description' => 'L\'île des mythiques Lotophages chantée par Homère, réunissant de superbes plages de sable blanc, la plus ancienne synagogue El Ghriba et des villages d\'art.',
            'category' => 'exploration',
            'rating' => 4.9,
            'image_url' => 'https://images.unsplash.com/photo-1540206395-68808572332f?auto=format&fit=crop&w=800&q=80',
            'tags' => ['Ile', 'Synagogue', 'Art', 'Plages'],
            'latitude' => 33.8076,
            'longitude' => 10.8451
        ]);

        CommercialPlace::create([
            'destination_id' => $djerba->id,
            'name' => 'Hôtel Hasdrubal Prestige Djerba',
            'type' => 'hotel',
            'price' => '290 DT / nuit',
            'rating' => 4.8,
            'description' => 'Splendide palais oriental face à la plage de Sidi Mehrez, réputé pour sa thalassothérapie d\'élite.',
            'image_url' => 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?auto=format&fit=crop&w=800&q=80'
        ]);

        CommercialPlace::create([
            'destination_id' => $djerba->id,
            'name' => 'Restaurant Port De Pêche Haroun',
            'type' => 'restaurant',
            'price' => '70 DT / convive',
            'rating' => 4.7,
            'description' => 'Prestigieux restaurant sur l\'eau en forme de galion de corsaire, réputé pour ses poissons frais pêchés au lever du jour.',
            'image_url' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=800&q=80'
        ]);
    }
}
