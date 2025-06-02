<?php

namespace Database\Seeders;

use App\Models\Beautician;
use Illuminate\Database\Seeder;

class BeauticianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $beauticians = [
            [
                'name' => 'Siti Rahayu',
                'specialty' => 'Hair Styling',
                //'experience' => 5,
                'photo' => 'beauticians/siti.jpg',
            ],
            [
                'name' => 'Dewi Anggraini',
                'specialty' => 'Facial Treatment',
                //'experience' => 3,
                'photo' => 'beauticians/dewi.jpg',
            ],
            [
                'name' => 'Maya Putri',
                'specialty' => 'Nail Art',
                //'experience' => 4,
                'photo' => 'beauticians/maya.jpg',
            ],
            [
                'name' => 'Rina Wijaya',
                'specialty' => 'Body Treatment',
                //'experience' => 6,
                'photo' => 'beauticians/rina.jpg',
            ],
        ];

        foreach ($beauticians as $beautician) {
            Beautician::create($beautician);
        }
    }
}

