<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\Game;
use App\Models\User;
use App\Models\Role;
use App\Models\Type;
use App\Models\GameLevel;

use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TypeTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(GameTableSeeder::class);
    }
}

class TypeTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        Type::create(['label' => "Admin"]);
        Type::create(['label' => "Staff"]);
        Type::create(['label' => "Joueur"]);
    }

}

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create([
            'username' => "BigBoss",
            'firstname' => "Pierre",
            'lastname' => "Legrand",
            'date_of_birth' => "2002-03-24",
            'email' => "pierre.legrand@gmail.com",
            'password' => Hash::make("password"),
            'email_verified_at' => Carbon::now()
        ]);

        User::create([
            'username' => "TheKing",
            'firstname' => "Clément",
            'lastname' => "Dupont",
            'date_of_birth' => "1997-06-15",
            'email' => "clement.dupont@gmail.com",
            'password' => Hash::make("password"),
            'email_verified_at' => Carbon::now()
        ]);

        User::create([
            'username' => "BadBoy",
            'firstname' => "Jordan",
            'lastname' => "Maillard",
            'date_of_birth' => "2003-10-04",
            'email' => "jordan.maillard@gmail.com",
            'password' => Hash::make("password"),
            'email_verified_at' => Carbon::now()
        ]);
    }

}

class GameTableSeeder extends Seeder {

    public function run()
    {
        DB::table('games')->delete();
        DB::table('roles')->delete();
        DB::table('game_levels')->delete();

        // Creator role
        Role::create([
            'type_id' => 1,
            'label' => "Créateur"
        ]);

        /// League Of Legends
        // Jeu
        Game::create(['name' => "League Of Legends"]);

        // Rôles
        Role::create([
            'type_id' => 2,
            'game_id' => 1,
            'label' => "Manager"
        ]);
        Role::create([
            'type_id' => 2,
            'game_id' => 1,
            'label' => "Analyste"
        ]);
        Role::create([
            'type_id' => 3,
            'game_id' => 1,
            'label' => "Toplaner"
        ]);
        Role::create([
            'type_id' => 3,
            'game_id' => 1,
            'label' => "Jungler"
        ]);
        Role::create([
            'type_id' => 3,
            'game_id' => 1,
            'label' => "Midlaner"
        ]);
        Role::create([
            'type_id' => 3,
            'game_id' => 1,
            'label' => "ADCarry"
        ]);
        Role::create([
            'type_id' => 3,
            'game_id' => 1,
            'label' => "Support"
        ]);

        // Niveaux de jeu
        GameLevel::create([
            'game_id' => 1,
            'label' => "Fer I",
            'order' => 1
        ]);
        GameLevel::create([
            'game_id' => 1,
            'label' => "Fer II",
            'order' => 2
        ]);
        GameLevel::create([
            'game_id' => 1,
            'label' => "Fer III",
            'order' => 3
        ]);
        GameLevel::create([
            'game_id' => 1,
            'label' => "Fer IV",
            'order' => 4
        ]);
        GameLevel::create([
            'game_id' => 1,
            'label' => "Bronze I",
            'order' => 5
        ]);
        GameLevel::create([
            'game_id' => 1,
            'label' => "Bronze II",
            'order' => 6
        ]);
        GameLevel::create([
            'game_id' => 1,
            'label' => "Bronze III",
            'order' => 7
        ]);
        GameLevel::create([
            'game_id' => 1,
            'label' => "Bronze IV",
            'order' => 8
        ]);
        GameLevel::create([
            'game_id' => 1,
            'label' => "Argent I",
            'order' => 9
        ]);
        GameLevel::create([
            'game_id' => 1,
            'label' => "Argent II",
            'order' => 10
        ]);
        GameLevel::create([
            'game_id' => 1,
            'label' => "Argent III",
            'order' => 11
        ]);
        GameLevel::create([
            'game_id' => 1,
            'label' => "Argent IV",
            'order' => 12
        ]);
        GameLevel::create([
            'game_id' => 1,
            'label' => "Or I",
            'order' => 13
        ]);
        GameLevel::create([
            'game_id' => 1,
            'label' => "Or II",
            'order' => 14
        ]);
        GameLevel::create([
            'game_id' => 1,
            'label' => "Or III",
            'order' => 15
        ]);
        GameLevel::create([
            'game_id' => 1,
            'label' => "Or IV",
            'order' => 16
        ]);
        GameLevel::create([
            'game_id' => 1,
            'label' => "Platine I",
            'order' => 17
        ]);
        GameLevel::create([
            'game_id' => 1,
            'label' => "Platine II",
            'order' => 18
        ]);
        GameLevel::create([
            'game_id' => 1,
            'label' => "Platine III",
            'order' => 19
        ]);
        GameLevel::create([
            'game_id' => 1,
            'label' => "Platine IV",
            'order' => 20
        ]);
        GameLevel::create([
            'game_id' => 1,
            'label' => "Diamant I",
            'order' => 21
        ]);
        GameLevel::create([
            'game_id' => 1,
            'label' => "Diamant II",
            'order' => 22
        ]);
        GameLevel::create([
            'game_id' => 1,
            'label' => "Diamant III",
            'order' => 23
        ]);
        GameLevel::create([
            'game_id' => 1,
            'label' => "Diamant IV",
            'order' => 24
        ]);
        GameLevel::create([
            'game_id' => 1,
            'label' => "Maître",
            'order' => 25
        ]);
        GameLevel::create([
            'game_id' => 1,
            'label' => "Grand Maître",
            'order' => 26
        ]);
        GameLevel::create([
            'game_id' => 1,
            'label' => "Challenger",
            'order' => 27
        ]);

        /// Counter-Strike : Global Offensive
        // Jeu
        Game::create(['name' => "Counter-Strike : Global Offensive"]);

        // Rôles
        Role::create([
            'type_id' => 2,
            'game_id' => 2,
            'label' => "Manager"
        ]);
        Role::create([
            'type_id' => 2,
            'game_id' => 2,
            'label' => "Analyste"
        ]);
        Role::create([
            'type_id' => 3,
            'game_id' => 2,
            'label' => "Sniper"
        ]);
        Role::create([
            'type_id' => 3,
            'game_id' => 2,
            'label' => "Fusil d'assaut"
        ]);

        // Niveaux de jeu
        GameLevel::create([
            'game_id' => 2,
            'label' => "Argent I",
            'order' => 1
        ]);
        GameLevel::create([
            'game_id' => 2,
            'label' => "Argent II",
            'order' => 2
        ]);
        GameLevel::create([
            'game_id' => 2,
            'label' => "Argent III",
            'order' => 3
        ]);
        GameLevel::create([
            'game_id' => 2,
            'label' => "Argent IV",
            'order' => 4
        ]);
        GameLevel::create([
            'game_id' => 2,
            'label' => "Argent Elite",
            'order' => 5
        ]);
        GameLevel::create([
            'game_id' => 2,
            'label' => "Argent Elite Master",
            'order' => 6
        ]);
        GameLevel::create([
            'game_id' => 2,
            'label' => "Nova d'Or I",
            'order' => 7
        ]);
        GameLevel::create([
            'game_id' => 2,
            'label' => "Nova d'Or II",
            'order' => 8
        ]);
        GameLevel::create([
            'game_id' => 2,
            'label' => "Nova d'Or III",
            'order' => 9
        ]);
        GameLevel::create([
            'game_id' => 2,
            'label' => "Maître Nova d’Or",
            'order' => 10
        ]);
        GameLevel::create([
            'game_id' => 2,
            'label' => "Maître Gardien I",
            'order' => 11
        ]);
        GameLevel::create([
            'game_id' => 2,
            'label' => "Maître Gardien II",
            'order' => 12
        ]);
        GameLevel::create([
            'game_id' => 2,
            'label' => "Maître Gardien Elite",
            'order' => 13
        ]);
        GameLevel::create([
            'game_id' => 2,
            'label' => "Maître Gardien Distingué",
            'order' => 14
        ]);
        GameLevel::create([
            'game_id' => 2,
            'label' => "Aigle Légendaire",
            'order' => 15
        ]);
        GameLevel::create([
            'game_id' => 2,
            'label' => "Maître Aigle Légendaire",
            'order' => 16
        ]);
        GameLevel::create([
            'game_id' => 2,
            'label' => "Maître Suprême Première Classe",
            'order' => 17
        ]);
        GameLevel::create([
            'game_id' => 2,
            'label' => "Elite Mondiale",
            'order' => 18
        ]);

        /// Hearthstone
        // Jeu
        Game::create(['name' => "Hearthstone"]);

        // Rôles
        Role::create([
            'type_id' => 2,
            'game_id' => 3,
            'label' => "Manager"
        ]);
        Role::create([
            'type_id' => 2,
            'game_id' => 3,
            'label' => "Analyste"
        ]);
        Role::create([
            'type_id' => 3,
            'game_id' => 3,
            'label' => "Joueur Standard"
        ]);
        Role::create([
            'type_id' => 3,
            'game_id' => 3,
            'label' => "Joueur Libre"
        ]);

        // Niveaux de jeu
        GameLevel::create([
            'game_id' => 3,
            'label' => "Rang 50 -> 25",
            'order' => 1
        ]);
        GameLevel::create([
            'game_id' => 3,
            'label' => "Rang 25 -> 20",
            'order' => 2
        ]);
        GameLevel::create([
            'game_id' => 3,
            'label' => "Rang 20 -> 15",
            'order' => 3
        ]);
        GameLevel::create([
            'game_id' => 3,
            'label' => "Rang 15 -> 10",
            'order' => 4
        ]);
        GameLevel::create([
            'game_id' => 3,
            'label' => "Rang 10 -> 5",
            'order' => 5
        ]);
        GameLevel::create([
            'game_id' => 3,
            'label' => "Rang 5 -> 1",
            'order' => 6
        ]);
        GameLevel::create([
            'game_id' => 3,
            'label' => "Légende",
            'order' => 7
        ]);
    }

}
