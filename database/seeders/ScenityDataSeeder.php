<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ScenityDataSeeder extends Seeder
{
    public function run(): void
    {
        $tables = $this->primaryKeys();
        $data = $this->seedData();

        Schema::disableForeignKeyConstraints();

        foreach (array_reverse(array_keys($tables)) as $table) {
            if (Schema::hasTable($table)) {
                DB::table($table)->truncate();
            }
        }

        foreach ($tables as $table => $primaryKey) {
            if (! Schema::hasTable($table) || empty($data[$table])) {
                continue;
            }

            foreach (array_chunk($data[$table], 50) as $rows) {
                DB::table($table)->insert($rows);
            }
        }

        Schema::enableForeignKeyConstraints();
        $this->syncAutoIncrementValues($tables, $data);
    }

    private function syncAutoIncrementValues(array $tables, array $data): void
    {
        if (DB::getDriverName() !== 'mysql') {
            return;
        }

        foreach ($tables as $table => $primaryKey) {
            if (! Schema::hasTable($table) || empty($data[$table])) {
                continue;
            }

            $maxId = collect($data[$table])->max($primaryKey);
            if ($maxId) {
                DB::statement('ALTER TABLE `' . $table . '` AUTO_INCREMENT = ' . ((int) $maxId + 1));
            }
        }
    }

    private function primaryKeys(): array
    {
        return array (
  'users' => 'user_id',
  'perfumes' => 'perfume_id',
  'library' => 'library_id',
  'preferences' => 'preference_id',
  'weather' => 'weather_id',
  'recommendations' => 'recommendation_id',
  'recommendation_items' => 'item_id',
);
    }

    private function seedData(): array
    {
        return array (
  'users' => 
  array (
    0 => 
    array (
      'user_id' => 1,
      'name' => 'Hamqzah',
      'email' => 'hamqzah@gmail.com',
      'password' => '$2y$12$L9CLr/m0Q21UmqWnF.3MEeVVK2mn6mA0.TvrWvvPWx6/qk7.Bxuw6',
      'role' => 'registered',
      'remember_token' => NULL,
      'created_at' => '2026-07-03 04:08:36',
    ),
    1 => 
    array (
      'user_id' => 2,
      'name' => 'Admin Meow',
      'email' => 'admin@scenity.com',
      'password' => '$2y$12$jSxuumCMonDY./L/kVfrZOsmFDOI/5B7Ufi6wjXa2p8ZzCGCN4LAK',
      'role' => 'admin',
      'remember_token' => NULL,
      'created_at' => '2026-07-03 04:16:27',
    ),
    2 => 
    array (
      'user_id' => 4,
      'name' => 'Aiman',
      'email' => 'aiman@gmail.com',
      'password' => '$2y$12$VOxxg2/SEhvQ9DAGpgE6kequBu7.t7yeQQt70Y2ajRjyBkoM7Ju/q',
      'role' => 'registered',
      'remember_token' => NULL,
      'created_at' => '2026-07-04 19:07:02',
    ),
    3 => 
    array (
      'user_id' => 6,
      'name' => 'Meow',
      'email' => 'meow@gmail.com',
      'password' => '$2y$12$9VJGDkdYFzpkAiGv2gDmW.xxteGOwjb.dpMkgp4RqP88E260xYtZ6',
      'role' => 'registered',
      'remember_token' => NULL,
      'created_at' => '2026-07-05 01:59:44',
    ),
    4 => 
    array (
      'user_id' => 7,
      'name' => 'Ahza',
      'email' => 'ahza@gmail.com',
      'password' => '$2y$12$AaBWAGAxA1OYvx9Pw9gP3./45GInM/r8BXoM8ZAPh4hP723s3EKb.',
      'role' => 'registered',
      'remember_token' => NULL,
      'created_at' => '2026-07-06 18:03:17',
    ),
    5 => 
    array (
      'user_id' => 8,
      'name' => 'Irfan',
      'email' => 'irfanraziq@gmail.com',
      'password' => '$2y$12$1EhEjLi7XROQufFtVTPeduB5OCmwod8yjnEyQfiiXKEGGu38RNPMq',
      'role' => 'registered',
      'remember_token' => NULL,
      'created_at' => '2026-07-06 19:28:50',
    ),
    6 => 
    array (
      'user_id' => 9,
      'name' => 'Noor Hakim',
      'email' => 'noor.hamqzah99@gmail.com',
      'password' => '$2y$12$GuALAwOczjSGuIejP51SnegtTyatU3hhx3jRJkXb7PC0dpgP6FihG',
      'role' => 'registered',
      'remember_token' => NULL,
      'created_at' => '2026-07-07 01:07:55',
    ),
    7 => 
    array (
      'user_id' => 10,
      'name' => 'Danish Ahza',
      'email' => 'danishahza404@gmail.com',
      'password' => '$2y$12$T7WqxBbK/Xzi6Bc1e7Z05en.A7RsTc5MUuo7OFBCjubXp/tCmJPCy',
      'role' => 'registered',
      'remember_token' => NULL,
      'created_at' => '2026-07-07 01:12:13',
    ),
  ),
  'perfumes' => 
  array (
    0 => 
    array (
      'perfume_id' => 1,
      'name' => 'Baccarat Rouge 540',
      'brand' => 'Maison Francis Kurkdjian',
      'scent_family' => 'Woody',
      'top_notes' => 'Saffron, Jasmine',
      'middle_notes' => 'Amberwood, Ambergris',
      'base_notes' => 'Fir Resin, Cedar',
      'longevity' => 'strong',
      'sillage' => 'heavy',
      'weather_suitability' => 'Cold / Overcast',
      'image_url' => 'https://fimgs.net/mdimg/perfume/o.46066.jpg',
      'created_at' => NULL,
      'updated_at' => '2026-07-06 11:13:13',
    ),
    1 => 
    array (
      'perfume_id' => 2,
      'name' => 'Oud Wood',
      'brand' => 'Tom Ford',
      'scent_family' => 'Woody',
      'top_notes' => 'Rosewood, Cardamom',
      'middle_notes' => 'Oud, Sandalwood, Vetiver',
      'base_notes' => 'Tonka Bean, Amber, Vanilla',
      'longevity' => 'moderate',
      'sillage' => 'moderate',
      'weather_suitability' => 'Crisp & Sunny',
      'image_url' => 'https://fimgs.net/mdimg/perfume-thumbs/375x500.89988.jpg',
      'created_at' => NULL,
      'updated_at' => NULL,
    ),
    2 => 
    array (
      'perfume_id' => 3,
      'name' => 'Bleu de Chanel',
      'brand' => 'Chanel',
      'scent_family' => 'Fresh',
      'top_notes' => 'Grapefruit, Lemon, Mint',
      'middle_notes' => 'Ginger, Nutmeg, Jasmine',
      'base_notes' => 'Incense, Vetiver, Cedar',
      'longevity' => 'moderate',
      'sillage' => 'moderate',
      'weather_suitability' => 'Hot / Humid',
      'image_url' => 'https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.9099.2x.avif',
      'created_at' => NULL,
      'updated_at' => NULL,
    ),
    3 => 
    array (
      'perfume_id' => 4,
      'name' => 'Blooming Bouquet',
      'brand' => 'Dior',
      'scent_family' => 'Floral',
      'top_notes' => 'Sweet Pea, Bergamot',
      'middle_notes' => 'Peony, Damascus Rose',
      'base_notes' => 'White Musk',
      'longevity' => 'weak',
      'sillage' => 'soft',
      'weather_suitability' => 'Crisp & Sunny',
      'image_url' => 'https://fimgs.net/mdimg/perfume/o.23280.jpg',
      'created_at' => NULL,
      'updated_at' => NULL,
    ),
    4 => 
    array (
      'perfume_id' => 5,
      'name' => 'Spicebomb Extreme',
      'brand' => 'Viktor & Rolf',
      'scent_family' => 'Spicy',
      'top_notes' => 'Black Pepper, Bergamot',
      'middle_notes' => 'Cinnamon, Saffron, Cumin',
      'base_notes' => 'Bourbon Vanilla, Tobacco, Amber',
      'longevity' => 'strong',
      'sillage' => 'heavy',
      'weather_suitability' => 'Balmy Evening',
      'image_url' => 'https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.30499.2x.avif',
      'created_at' => NULL,
      'updated_at' => NULL,
    ),
    5 => 
    array (
      'perfume_id' => 6,
      'name' => 'Wonderwood',
      'brand' => 'Comme des Garcons',
      'scent_family' => 'Woody',
      'top_notes' => 'Bergamot, Madagascar Pepper',
      'middle_notes' => 'Cedar, Guaiac Wood, Cashmeran',
      'base_notes' => 'Sandalwood, Oud, Vetiver',
      'longevity' => 'moderate',
      'sillage' => 'moderate',
      'weather_suitability' => 'Cold / Overcast',
      'image_url' => 'https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.8991.2x.avif',
      'created_at' => NULL,
      'updated_at' => NULL,
    ),
    6 => 
    array (
      'perfume_id' => 7,
      'name' => 'Encre Noire',
      'brand' => 'Lalique',
      'scent_family' => 'Woody',
      'top_notes' => 'Cypress',
      'middle_notes' => 'Vetiver',
      'base_notes' => 'Musk, Cashmere Wood',
      'longevity' => 'moderate',
      'sillage' => 'moderate',
      'weather_suitability' => 'Cold / Overcast',
      'image_url' => 'https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.1834.2x.avif',
      'created_at' => NULL,
      'updated_at' => NULL,
    ),
    7 => 
    array (
      'perfume_id' => 8,
      'name' => 'Tam Dao EDT',
      'brand' => 'Diptyque',
      'scent_family' => 'Woody',
      'top_notes' => 'Rose, Myrtle, Italian Cypress',
      'middle_notes' => 'Sandalwood, Cedar',
      'base_notes' => 'Spices, Amber, White Musk',
      'longevity' => 'weak',
      'sillage' => 'soft',
      'weather_suitability' => 'Crisp & Sunny',
      'image_url' => 'https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.3956.2x.avif',
      'created_at' => NULL,
      'updated_at' => NULL,
    ),
    8 => 
    array (
      'perfume_id' => 9,
      'name' => 'Terre d\'Hermes EDT',
      'brand' => 'Hermes',
      'scent_family' => 'Woody',
      'top_notes' => 'Orange, Grapefruit',
      'middle_notes' => 'Flint, Pepper',
      'base_notes' => 'Woody Notes, Oakmoss, Benzoin',
      'longevity' => 'moderate',
      'sillage' => 'moderate',
      'weather_suitability' => 'Crisp & Sunny',
      'image_url' => 'https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.17.2x.avif',
      'created_at' => NULL,
      'updated_at' => NULL,
    ),
    9 => 
    array (
      'perfume_id' => 10,
      'name' => 'Royal Oud',
      'brand' => 'Creed',
      'scent_family' => 'Woody',
      'top_notes' => 'Lemon, Pink Berry, Bergamot',
      'middle_notes' => 'Cedar, Galbanum, Angelica Root',
      'base_notes' => 'Regal Oud, Sandalwood, Tonkin Musk',
      'longevity' => 'strong',
      'sillage' => 'heavy',
      'weather_suitability' => 'Balmy Evening',
      'image_url' => 'https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.12317.2x.avif',
      'created_at' => NULL,
      'updated_at' => NULL,
    ),
    10 => 
    array (
      'perfume_id' => 11,
      'name' => 'Wood Sage & Sea Salt',
      'brand' => 'Jo Malone',
      'scent_family' => 'Woody',
      'top_notes' => 'Ambrette Seeds',
      'middle_notes' => 'Sea Salt',
      'base_notes' => 'Sage',
      'longevity' => 'weak',
      'sillage' => 'soft',
      'weather_suitability' => 'Hot / Humid',
      'image_url' => 'https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.25529.2x.avif',
      'created_at' => NULL,
      'updated_at' => NULL,
    ),
    11 => 
    array (
      'perfume_id' => 12,
      'name' => 'Greenley',
      'brand' => 'Parfums de Marly',
      'scent_family' => 'Woody',
      'top_notes' => 'Green Apple, Calabrian Bergamot',
      'middle_notes' => 'Cashmeran, Pomarose, Violet',
      'base_notes' => 'Oakmoss, Musk, Amberwood',
      'longevity' => 'moderate',
      'sillage' => 'moderate',
      'weather_suitability' => 'Hot / Humid',
      'image_url' => 'https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.62101.2x.avif',
      'created_at' => NULL,
      'updated_at' => NULL,
    ),
    12 => 
    array (
      'perfume_id' => 13,
      'name' => 'Chrome',
      'brand' => 'Azzaro',
      'scent_family' => 'Fresh',
      'top_notes' => 'Lemon, Rosemary, Bergamot',
      'middle_notes' => 'Jasmine, Cyclamen, Coriander',
      'base_notes' => 'Musk, Cedar, Sandalwood, Oakmoss',
      'longevity' => 'weak',
      'sillage' => 'soft',
      'weather_suitability' => 'Hot / Humid',
      'image_url' => 'https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.788.2x.avif',
      'created_at' => NULL,
      'updated_at' => NULL,
    ),
    13 => 
    array (
      'perfume_id' => 14,
      'name' => 'Viking',
      'brand' => 'Creed',
      'scent_family' => 'Fresh',
      'top_notes' => 'Pink Pepper, Spicy Mint, Lemon',
      'middle_notes' => 'Lavender, Clove, Allspice',
      'base_notes' => 'Sandalwood, Vetiver, Patchouli',
      'longevity' => 'strong',
      'sillage' => 'heavy',
      'weather_suitability' => 'Cold / Overcast',
      'image_url' => 'https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.41698.2x.avif',
      'created_at' => NULL,
      'updated_at' => NULL,
    ),
    14 => 
    array (
      'perfume_id' => 15,
      'name' => 'Explorer',
      'brand' => 'Montblanc',
      'scent_family' => 'Fresh',
      'top_notes' => 'Bergamot, Pink Pepper, Clary Sage',
      'middle_notes' => 'Haitian Vetiver, Leather',
      'base_notes' => 'Ambrosan, Akigalawood, Patchouli Leaf',
      'longevity' => 'moderate',
      'sillage' => 'moderate',
      'weather_suitability' => 'Crisp & Sunny',
      'image_url' => 'https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.52002.2x.avif',
      'created_at' => NULL,
      'updated_at' => NULL,
    ),
    15 => 
    array (
      'perfume_id' => 16,
      'name' => 'Y EDP',
      'brand' => 'Yves Saint Laurent',
      'scent_family' => 'Fresh',
      'top_notes' => 'Apple, Ginger, Bergamot',
      'middle_notes' => 'Sage, Juniper Berries, Geranium',
      'base_notes' => 'Amberwood, Tonka Bean, Cedar',
      'longevity' => 'strong',
      'sillage' => 'heavy',
      'weather_suitability' => 'Balmy Evening',
      'image_url' => 'https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.50757.2x.avif',
      'created_at' => NULL,
      'updated_at' => NULL,
    ),
    16 => 
    array (
      'perfume_id' => 17,
      'name' => 'Artisan Pure',
      'brand' => 'John Varvatos',
      'scent_family' => 'Fresh',
      'top_notes' => 'Clementine, Mandarin, Lemon, Thyme',
      'middle_notes' => 'Petitgrain, Ginger',
      'base_notes' => 'Woody Notes, Orris Root, Musk',
      'longevity' => 'weak',
      'sillage' => 'soft',
      'weather_suitability' => 'Hot / Humid',
      'image_url' => 'https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.46623.2x.avif',
      'created_at' => NULL,
      'updated_at' => NULL,
    ),
    17 => 
    array (
      'perfume_id' => 18,
      'name' => 'H24 EDT',
      'brand' => 'Hermes',
      'scent_family' => 'Fresh',
      'top_notes' => 'Clary Sage',
      'middle_notes' => 'Narcissus, Rosewood',
      'base_notes' => 'Sclarene',
      'longevity' => 'moderate',
      'sillage' => 'moderate',
      'weather_suitability' => 'Crisp & Sunny',
      'image_url' => 'https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.65147.2x.avif',
      'created_at' => NULL,
      'updated_at' => NULL,
    ),
    18 => 
    array (
      'perfume_id' => 19,
      'name' => 'Reflection Man',
      'brand' => 'Amouage',
      'scent_family' => 'Fresh',
      'top_notes' => 'Rosemary, Pimento, May Rose',
      'middle_notes' => 'Orris Root, Jasmine, Neroli',
      'base_notes' => 'Sandalwood, Cedar, Patchouli, Vetiver',
      'longevity' => 'strong',
      'sillage' => 'heavy',
      'weather_suitability' => 'Crisp & Sunny',
      'image_url' => 'https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.920.2x.avif',
      'created_at' => NULL,
      'updated_at' => NULL,
    ),
    19 => 
    array (
      'perfume_id' => 20,
      'name' => 'J\'adore',
      'brand' => 'Dior',
      'scent_family' => 'Floral',
      'top_notes' => 'Pear, Melon, Magnolia, Peach',
      'middle_notes' => 'Jasmine, Lily-of-the-Valley, Tuberose',
      'base_notes' => 'Musk, Vanilla, Blackberry, Cedar',
      'longevity' => 'moderate',
      'sillage' => 'moderate',
      'weather_suitability' => 'Crisp & Sunny',
      'image_url' => 'https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.210.2x.avif',
      'created_at' => NULL,
      'updated_at' => NULL,
    ),
    20 => 
    array (
      'perfume_id' => 21,
      'name' => 'Delina Exclusif',
      'brand' => 'Parfums de Marly',
      'scent_family' => 'Floral',
      'top_notes' => 'Litchi, Pear, Bergamot',
      'middle_notes' => 'Turkish Rose, Agarwood (Oud), Incense',
      'base_notes' => 'Vanilla, Amber, Woody Notes',
      'longevity' => 'strong',
      'sillage' => 'heavy',
      'weather_suitability' => 'Cold / Overcast',
      'image_url' => 'https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.50370.2x.avif',
      'created_at' => NULL,
      'updated_at' => NULL,
    ),
    21 => 
    array (
      'perfume_id' => 22,
      'name' => 'Flowermarket',
      'brand' => 'Maison Margiela',
      'scent_family' => 'Floral',
      'top_notes' => 'Crushed Leaves, Freesia',
      'middle_notes' => 'Sambac Jasmine, Egyptian Jasmine, Tuberose',
      'base_notes' => 'Peach, Cedar, Oakmoss',
      'longevity' => 'weak',
      'sillage' => 'soft',
      'weather_suitability' => 'Crisp & Sunny',
      'image_url' => 'https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.15260.2x.avif',
      'created_at' => NULL,
      'updated_at' => NULL,
    ),
    22 => 
    array (
      'perfume_id' => 23,
      'name' => 'Lyric Man',
      'brand' => 'Amouage',
      'scent_family' => 'Floral',
      'top_notes' => 'Lime, Bergamot',
      'middle_notes' => 'Rose, Angelica, Ginger, Saffron',
      'base_notes' => 'Pine Tree, Incense, Sandalwood, Musk',
      'longevity' => 'strong',
      'sillage' => 'heavy',
      'weather_suitability' => 'Balmy Evening',
      'image_url' => 'https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.4622.2x.avif',
      'created_at' => NULL,
      'updated_at' => NULL,
    ),
    23 => 
    array (
      'perfume_id' => 24,
      'name' => 'Toy Boy',
      'brand' => 'Moschino',
      'scent_family' => 'Floral',
      'top_notes' => 'Pink Pepper, Pear, Indonesian Nutmeg',
      'middle_notes' => 'Rose, Magnolia, Clove, Flax',
      'base_notes' => 'Cashmeran, Haitian Vetiver, Ambermax',
      'longevity' => 'strong',
      'sillage' => 'heavy',
      'weather_suitability' => 'Cold / Overcast',
      'image_url' => 'https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.55858.2x.avif',
      'created_at' => NULL,
      'updated_at' => NULL,
    ),
    24 => 
    array (
      'perfume_id' => 25,
      'name' => 'L\'Acquarossa',
      'brand' => 'Fendi',
      'scent_family' => 'Floral',
      'top_notes' => 'Sicilian Mandarin, Calabrian Bergamot',
      'middle_notes' => 'Red Lantana, Rose, Orange Blossom',
      'base_notes' => 'Dark Wood, Patchouli, Musk',
      'longevity' => 'moderate',
      'sillage' => 'moderate',
      'weather_suitability' => 'Balmy Evening',
      'image_url' => 'https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.18706.2x.avif',
      'created_at' => NULL,
      'updated_at' => NULL,
    ),
    25 => 
    array (
      'perfume_id' => 26,
      'name' => 'Fleur Narcotique',
      'brand' => 'Ex Nihilo',
      'scent_family' => 'Floral',
      'top_notes' => 'Litchi, Bergamot, Peach',
      'middle_notes' => 'Peony, Orange Blossom, Jasmine',
      'base_notes' => 'Musk, Moss, Woody Notes',
      'longevity' => 'moderate',
      'sillage' => 'moderate',
      'weather_suitability' => 'Hot / Humid',
      'image_url' => 'https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.27571.2x.avif',
      'created_at' => NULL,
      'updated_at' => NULL,
    ),
    26 => 
    array (
      'perfume_id' => 27,
      'name' => 'Oajan',
      'brand' => 'Parfums de Marly',
      'scent_family' => 'Spicy',
      'top_notes' => 'Cinnamon, Honey, Osmanthus',
      'middle_notes' => 'Benzoin, Labdanum, Amber, Artemisia',
      'base_notes' => 'Tonka Bean, Vanilla, Patchouli, Musk',
      'longevity' => 'strong',
      'sillage' => 'heavy',
      'weather_suitability' => 'Cold / Overcast',
      'image_url' => 'https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.21548.2x.avif',
      'created_at' => NULL,
      'updated_at' => NULL,
    ),
    27 => 
    array (
      'perfume_id' => 28,
      'name' => 'Eyes Closed',
      'brand' => 'Byredo',
      'scent_family' => 'Spicy',
      'top_notes' => 'Cinnamon, Cardamom',
      'middle_notes' => 'Carrot, Ginger, Orris',
      'base_notes' => 'Papyrus, Patchouli',
      'longevity' => 'moderate',
      'sillage' => 'moderate',
      'weather_suitability' => 'Cold / Overcast',
      'image_url' => 'https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.76339.2x.avif',
      'created_at' => NULL,
      'updated_at' => NULL,
    ),
    28 => 
    array (
      'perfume_id' => 29,
      'name' => 'L\'Eau d\'Issey Intense',
      'brand' => 'Issey Miyake',
      'scent_family' => 'Spicy',
      'top_notes' => 'Yuzu, Bergamot, Sweet Orange',
      'middle_notes' => 'Nutmeg, Lotus, Cinnamon, Saffron',
      'base_notes' => 'Incense, Papyrus, Ambergris, Benzoin',
      'longevity' => 'moderate',
      'sillage' => 'moderate',
      'weather_suitability' => 'Crisp & Sunny',
      'image_url' => 'https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.1998.2x.avif',
      'created_at' => NULL,
      'updated_at' => NULL,
    ),
    29 => 
    array (
      'perfume_id' => 30,
      'name' => 'Declaration',
      'brand' => 'Cartier',
      'scent_family' => 'Spicy',
      'top_notes' => 'Artemisia, Caraway, Coriander, Birch',
      'middle_notes' => 'Cardamom, Ginger, Pepper, Iris',
      'base_notes' => 'Cedar, Vetiver, Leather, Amber',
      'longevity' => 'weak',
      'sillage' => 'soft',
      'weather_suitability' => 'Crisp & Sunny',
      'image_url' => 'https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.307.2x.avif',
      'created_at' => NULL,
      'updated_at' => NULL,
    ),
    30 => 
    array (
      'perfume_id' => 31,
      'name' => 'Noir Extreme',
      'brand' => 'Tom Ford',
      'scent_family' => 'Spicy',
      'top_notes' => 'Cardamom, Nutmeg, Saffron, Mandarin',
      'middle_notes' => 'Kulfi, Rose, Mastich, Orange Blossom',
      'base_notes' => 'Vanilla, Amber, Woody Notes, Sandalwood',
      'longevity' => 'strong',
      'sillage' => 'heavy',
      'weather_suitability' => 'Balmy Evening',
      'image_url' => 'https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.29675.2x.avif',
      'created_at' => NULL,
      'updated_at' => NULL,
    ),
    31 => 
    array (
      'perfume_id' => 32,
      'name' => 'Guerlain Homme Intense',
      'brand' => 'Guerlain',
      'scent_family' => 'Spicy',
      'top_notes' => 'Mint, Rhubarb',
      'middle_notes' => 'Geranium',
      'base_notes' => 'Vetiver, Cedar, Patchouli',
      'longevity' => 'moderate',
      'sillage' => 'moderate',
      'weather_suitability' => 'Hot / Humid',
      'image_url' => 'https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.6679.2x.avif',
      'created_at' => NULL,
      'updated_at' => NULL,
    ),
    32 => 
    array (
      'perfume_id' => 33,
      'name' => 'Red Tobacco',
      'brand' => 'Mancera',
      'scent_family' => 'Spicy',
      'top_notes' => 'Cinnamon, Agarwood (Oud), Saffron',
      'middle_notes' => 'Patchouli, Jasmine',
      'base_notes' => 'Tobacco, Madagascar Vanilla, Amber',
      'longevity' => 'strong',
      'sillage' => 'heavy',
      'weather_suitability' => 'Cold / Overcast',
      'image_url' => 'https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.46663.2x.avif',
      'created_at' => NULL,
      'updated_at' => NULL,
    ),
    33 => 
    array (
      'perfume_id' => 34,
      'name' => 'Herod',
      'brand' => 'Parfums de Marly',
      'scent_family' => 'Oriental',
      'top_notes' => 'Cinnamon, Pepper',
      'middle_notes' => 'Tobacco Leaf, Incense, Osmanthus, Labdanum',
      'base_notes' => 'Vanilla, Iso E Super, Musk, Cedar',
      'longevity' => 'strong',
      'sillage' => 'heavy',
      'weather_suitability' => 'Cold / Overcast',
      'image_url' => 'https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.16939.2x.avif',
      'created_at' => NULL,
      'updated_at' => NULL,
    ),
    34 => 
    array (
      'perfume_id' => 35,
      'name' => 'Habit Rouge EDT',
      'brand' => 'Guerlain',
      'scent_family' => 'Oriental',
      'top_notes' => 'Lemon, Brazilian Redwood, Bergamot',
      'middle_notes' => 'Rose, Carnation, Sandalwood, Cinnamon',
      'base_notes' => 'Leather, Vanilla, Amber, Benzoin',
      'longevity' => 'moderate',
      'sillage' => 'moderate',
      'weather_suitability' => 'Crisp & Sunny',
      'image_url' => 'https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.16.2x.avif',
      'created_at' => NULL,
      'updated_at' => NULL,
    ),
    35 => 
    array (
      'perfume_id' => 36,
      'name' => 'Chergui',
      'brand' => 'Serge Lutens',
      'scent_family' => 'Oriental',
      'top_notes' => 'Tobacco Leaf, Honey',
      'middle_notes' => 'Amber, Hay, Incense',
      'base_notes' => 'Sandalwood, Iris, Musk',
      'longevity' => 'moderate',
      'sillage' => 'moderate',
      'weather_suitability' => 'Balmy Evening',
      'image_url' => 'https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.2762.2x.avif',
      'created_at' => NULL,
      'updated_at' => NULL,
    ),
    36 => 
    array (
      'perfume_id' => 37,
      'name' => 'Shalimar EDP',
      'brand' => 'Guerlain',
      'scent_family' => 'Oriental',
      'top_notes' => 'Citruses, Bergamot, Cedar',
      'middle_notes' => 'Iris, Patchouli, Jasmine, Rose',
      'base_notes' => 'Vanilla, Leather, Incense, Opoponax',
      'longevity' => 'strong',
      'sillage' => 'heavy',
      'weather_suitability' => 'Cold / Overcast',
      'image_url' => 'https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.53.2x.avif',
      'created_at' => NULL,
      'updated_at' => NULL,
    ),
    37 => 
    array (
      'perfume_id' => 38,
      'name' => 'Ambre Nuit',
      'brand' => 'Dior',
      'scent_family' => 'Oriental',
      'top_notes' => 'Bergamot, Grapefruit',
      'middle_notes' => 'Damask Rose, Pink Pepper',
      'base_notes' => 'Ambergris, Guaiac Wood, Cedar',
      'longevity' => 'moderate',
      'sillage' => 'moderate',
      'weather_suitability' => 'Balmy Evening',
      'image_url' => 'https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.7092.2x.avif',
      'created_at' => NULL,
      'updated_at' => NULL,
    ),
    38 => 
    array (
      'perfume_id' => 39,
      'name' => 'Xerjoff Naxos',
      'brand' => 'Xerjoff',
      'scent_family' => 'Oriental',
      'top_notes' => 'Lavender, Bergamot, Lemon',
      'middle_notes' => 'Honey, Cinnamon, Cashmeran, Jasmine',
      'base_notes' => 'Tobacco Leaf, Tonka Bean, Vanilla',
      'longevity' => 'strong',
      'sillage' => 'heavy',
      'weather_suitability' => 'Balmy Evening',
      'image_url' => 'https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.30529.2x.avif',
      'created_at' => NULL,
      'updated_at' => NULL,
    ),
    39 => 
    array (
      'perfume_id' => 40,
      'name' => 'Velvet Oriental Musk',
      'brand' => 'Dolce & Gabbana',
      'scent_family' => 'Oriental',
      'top_notes' => 'Cumin, Saffron, Cardamom',
      'middle_notes' => 'Damask Rose, Cypriol Oil',
      'base_notes' => 'Musk, Sandalwood, Tonka Bean, Amber',
      'longevity' => 'weak',
      'sillage' => 'soft',
      'weather_suitability' => 'Hot / Humid',
      'image_url' => 'https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.55167.2x.avif',
      'created_at' => NULL,
      'updated_at' => NULL,
    ),
    40 => 
    array (
      'perfume_id' => 41,
      'name' => 'Noir de Noir',
      'brand' => 'Tom Ford',
      'scent_family' => 'Oriental',
      'top_notes' => 'Saffron',
      'middle_notes' => 'Black Rose, Truffle, Floral Notes',
      'base_notes' => 'Patchouli, Vanilla, Agarwood (Oud), Oakmoss',
      'longevity' => 'strong',
      'sillage' => 'heavy',
      'weather_suitability' => 'Cold / Overcast',
      'image_url' => 'https://fimgs.net/mdimg/perfume-thumbs/dark-375x500.1822.2x.avif',
      'created_at' => NULL,
      'updated_at' => NULL,
    ),
  ),
  'library' => 
  array (
    0 => 
    array (
      'library_id' => 1,
      'user_id' => 7,
      'perfume_id' => 3,
      'rating' => 4,
      'added_at' => '2026-07-06 11:22:15',
    ),
    1 => 
    array (
      'library_id' => 2,
      'user_id' => 7,
      'perfume_id' => 2,
      'rating' => 2,
      'added_at' => '2026-07-06 11:22:55',
    ),
    2 => 
    array (
      'library_id' => 3,
      'user_id' => 8,
      'perfume_id' => 4,
      'rating' => 4,
      'added_at' => '2026-07-06 11:30:07',
    ),
    3 => 
    array (
      'library_id' => 4,
      'user_id' => 8,
      'perfume_id' => 1,
      'rating' => 5,
      'added_at' => '2026-07-06 14:20:14',
    ),
    4 => 
    array (
      'library_id' => 5,
      'user_id' => 8,
      'perfume_id' => 28,
      'rating' => 2,
      'added_at' => '2026-07-06 15:27:19',
    ),
    5 => 
    array (
      'library_id' => 6,
      'user_id' => 8,
      'perfume_id' => 6,
      'rating' => 4,
      'added_at' => '2026-07-06 15:27:40',
    ),
    6 => 
    array (
      'library_id' => 7,
      'user_id' => 8,
      'perfume_id' => 11,
      'rating' => 5,
      'added_at' => '2026-07-06 15:39:32',
    ),
  ),
  'preferences' => 
  array (
  ),
  'weather' => 
  array (
  ),
  'recommendations' => 
  array (
  ),
  'recommendation_items' => 
  array (
  ),
);
    }
}