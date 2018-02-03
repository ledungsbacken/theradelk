<?php

use App\User;
use App\Role;
use App\Post;
use App\Category;
use App\Subcategory;
use App\View;

use Illuminate\Database\Seeder;

class DevUsersSeeder extends Seeder
{

    const N_POSTS_PER_USER = 10;

    private $devUsers = [
        [
            'name' => 'Robin Sandström',
            'email' => 'ledungsbacken@gmail.com',
            'role' => 'admin',
        ],
        [
            'name' => 'Daniel Ljungqvist',
            'email' => 'tkdanne@gmail.com',
            'role' => 'admin',
        ]
    ];


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $devUsers = $this->devUsers;
        Category::create(['name' => 'IT']);
        Category::create(['name' => 'Sci-fi']);
        Category::create(['name' => 'Entertainment']);
        Category::create(['name' => 'Tech']);
        Subcategory::create(['name' => 'PC', 'category_id' => 1]);
        Subcategory::create(['name' => 'Starwars', 'category_id' => 2]);
        Subcategory::create(['name' => 'Movies', 'category_id' => 3]);
        Subcategory::create(['name' => 'Mobile', 'category_id' => 4]);
        foreach($devUsers as $index => $devUser) {
            // To not create same user twice
            if(User::whereEmail($devUser['email'])->exists()) {
                continue;
            }

            // Create
            $user = factory(User::class)->create(
                [
                    'name' => $devUser['name'],
                    'email' => $devUser['email'],
                    'password' => bcrypt('secret'),
                ]
            );

            // Create posts and link to user
            $posts = factory(Post::class, self::N_POSTS_PER_USER)->create([]);
            $posts->each(function($post) use ($user) {
                Post::where('id', $post->id)->update(['user_id' => $user->id]);
                // $subcategory = factory(Subcategory::class)->create();
                DB::table('post_subcategory')->insert([
                    'post_id' => $post->id,
                    'subcategory_id' => rand(1, 4),
                ]);
                for ($i=0; $i < rand(10, 200); $i++) {
                    DB::table('views')->insert([
                        'post_id' => $post->id,
                    ]);
                }
            });

            // Set role
            $roles = Role::all();
            $role = $roles->where('name', $devUser['role']);
            $user->roles()->attach($role);
        }
    }
}
