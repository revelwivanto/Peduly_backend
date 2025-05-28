<?php

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure there is at least one user and category to associate activities with
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'role_id' => 2, // Agent role
                'name' => 'Agent Demo',
                'username' => 'agent',
                'email' => 'agent@mail.com',
                'password' => bcrypt('password'),
                'image' => 'default.png',
                'about' => 'Demo agent account'
            ]);
        }

        $category = Category::first();
        if (!$category) {
            $category = Category::create([
                'name' => 'Default Category',
                'slug' => 'default-category'
            ]);
        }

        DB::table('properties')->insert([
            [
                'title' => 'Guided Historical City Walk',
                'slug' => Str::slug('Guided Historical City Walk'),
                'description' => 'Discover the rich history of the city on this guided walking tour.',
                'price' => 125.00,
                'price_with_tshirt' => 225.00,
                'target' => 'Yatim Piatu',
                'featured' => true,
                'activity_type' => 'Outdoor',
                'difficulty_level' => 'easy',
                'image' => 'images2.jpg',
                'start_time' => '10:00:00',
                'end_time' => '13:00:00',
                'date' => Carbon::now()->addDays(rand(1, 30))->format('Y-m-d'),
                'duration' => 180,
                'max_participants' => 15,
                'min_participants' => 2,
                'city' => 'Surabaya',
                'city_slug' => Str::slug('Surabaya'),
                'meeting_point' => 'Tunjungan',
                'user_id' => $user->id,
                'category_id' => $category->id,
                'included_items' => json_encode(['Guide', 'Map']),
                'excluded_items' => json_encode(['Snacks']),
                'cancellation_policy' => 'Free cancellation up to 24 hours before start.',
                'video' => null,
                'location_latitude' => '48.8566',
                'location_longitude' => '2.3522',
                'nearby' => 'Museum, Old Buildings',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'title' => 'Sushi Creations with Orphans',
                'slug' => Str::slug('Sushi Creations with Orphans'),
                'description' => 'Createa Sushi with Salmons With Orphans',
                'price' => 125.00,
                'price_with_tshirt' => 225.00,
                'target' => 'Yatim Piatu',
                'featured' => true,
                'activity_type' => 'Masak',
                'difficulty_level' => 'easy',
                'image' => 'images1.jpg',
                'start_time' => '10:00:00',
                'end_time' => '13:00:00',
                'date' => Carbon::now()->addDays(rand(1, 30))->format('Y-m-d'),
                'duration' => 180,
                'max_participants' => 15,
                'min_participants' => 2,
                'city' => 'Surabaya',
                'city_slug' => Str::slug('Surabaya'),
                'meeting_point' => 'Tunjungan',
                'user_id' => $user->id,
                'category_id' => $category->id,
                'included_items' => json_encode(['Guide', 'Map']),
                'excluded_items' => json_encode(['Snacks']),
                'cancellation_policy' => 'Free cancellation up to 24 hours before start.',
                'video' => null,
                'location_latitude' => '48.8566',
                'location_longitude' => '2.3522',
                'nearby' => 'Museum, Old Buildings',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'title' => 'Origami Creations with Opa oma',
                'slug' => Str::slug('Origami Creations with Opa oma'),
                'description' => 'Create beautiful origami creations with the help of our Opa oma.',
                'price' => 160.00,
                'price_with_tshirt' => 260.00,
                'target' => 'Orang Tua',
                'featured' => false,
                'activity_type' => 'Workshop',
                'difficulty_level' => 'easy',
                'image' => 'images3.jpg',
                'start_time' => '18:00:00',
                'end_time' => '20:00:00',
                'date' => Carbon::now()->addDays(rand(1, 30))->format('Y-m-d'),
                'duration' => 120,
                'max_participants' => 30,
                'min_participants' => 10,
                'city' => 'Depok',
                'city_slug' => Str::slug('Depok'),
                'meeting_point' => 'Margo City',
                'user_id' => $user->id,
                'category_id' => $category->id,
                'included_items' => json_encode(['Boat Ride', 'Light Refreshments']),
                'excluded_items' => json_encode(['Dinner']),
                'cancellation_policy' => '50% refund for cancellations within 48 hours.',
                'video' => null,
                'location_latitude' => '36.7783',
                'location_longitude' => '-119.4179',
                'nearby' => 'Beach, Restaurants',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]
        ]);
    }
}
