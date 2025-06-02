<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Basic Haircut',
                'description' => 'Simple haircut service with washing and styling.',
                'price' => 150000,
                'image' => 'services/haircut.jpg',
            ],
            [
                'name' => 'Hair Coloring',
                'description' => 'Professional hair coloring with premium products.',
                'price' => 350000,
                'image' => 'services/coloring.jpg',
            ],
            [
                'name' => 'Facial Treatment',
                'description' => 'Deep cleansing facial with massage and mask.',
                'price' => 250000,
                'image' => 'services/facial.jpg',
            ],
            [
                'name' => 'Manicure & Pedicure',
                'description' => 'Complete nail care for hands and feet.',
                'price' => 200000,
                'image' => 'services/manicure.jpg',
            ],
            [
                'name' => 'Body Massage',
                'description' => '60-minute relaxing full body massage.',
                'price' => 300000,
                'image' => 'services/massage.jpg',
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}

