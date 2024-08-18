<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class ExampleTest extends TestCase
{
    use RefreshDatabase;

   
//     public function test_check_if_a_particular_user_is_present_in_a_database()
//     {
//         // Create a user
//         $user = User::factory()->create(["name" => "Roger"]);

//         // Fetch the user by their name
//         $fetchedUser = DB::table("users")->where('name', 'Roger')->first();
// dd($fetchedUser);
//         // Assert that the fetched user's name matches the created user's name
//         $this->assertEquals($user->name, $fetchedUser->name);
//     }

public function test_check_if_users_getting_fetched_with_id()
{
    // Create 10 users
    $users = User::factory()->create([
        'name' => 'John Doe',
        'email' => 'morga@example.com',
        'password' => 'password123', 
    ]);
     
    // Get the response from the database for the user with ID 1
    $response = DB::table('users')->where('id', 1)->first();

    // Assert that the response is not null
    $this->assertNotNull($response);

    // Define the expected instance data for the user
    $expectedData = [
        'id' => $response->id,
        'name' => $response->name,
        'email' => $response->email,
        'password' => $response->password,
        // Add other fields as needed
    ];

    // Assert that the response matches the expected data
    $this->assertEquals($users->pluck('name')->toArray(), [$expectedData['name']]);
     }
}
