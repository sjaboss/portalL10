<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * La contraseña actual que se está utilizando en la fábrica.
     */
    protected static ?string $password;

    /**
     * Define el estado predeterminado del modelo.
     * Este método crea los datos de ejemplo para los usuarios.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombres' => $this->faker->firstName, // Genera un nombre aleatorio
            'apellidos' => $this->faker->lastName, // Genera un apellido aleatorio
            'telefono' => $this->faker->phoneNumber, // Genera un número de teléfono aleatorio
            'email' => $this->faker->unique()->safeEmail, // Genera un correo electrónico único
            'foto' => null, // Deja el campo 'foto' como nulo por defecto
            'password' => bcrypt('password'), // Genera una contraseña predeterminada 'password'
            'email_verified_at' => now(), // Marca el email como verificado con la fecha actual
            'remember_token' => Str::random(10), // Genera un token de sesión aleatorio
        ];
    }

    /**
     * Indica que la dirección de correo electrónico del modelo no debe estar verificada.
     * Este método cambia el estado del modelo para no tener el campo 'email_verified_at' configurado.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null, // Establece 'email_verified_at' como nulo, indicando que el email no está verificado
        ]);
    }
}
