<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Conge;
use Illuminate\Database\Eloquent\Factories\Factory;

class CongeFactory extends Factory
{
    /**
     * Le nom du modèle associé à la factory.
     *
     * @var string
     */
    protected $model = Conge::class;

    /**
     * Définir les valeurs par défaut pour les champs de la table.
     *
     * @return array
     */
    public function definition()
    {
        $dateDebut = $this->faker->date();

        $dateFin = $this->faker->dateTimeBetween($dateDebut, "$dateDebut +20 days");

        return [
            'user_id' => User::inRandomOrder()->first()->id, 
            'date_debut' => $dateDebut,
            'date_fin' => $dateFin,
            'status' => $this->faker->randomElement(['pending', 'refused', 'accepted']),
        ];
    }
}
