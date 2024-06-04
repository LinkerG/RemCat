<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Team;
use App\Http\Controllers\LoginController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeamController;
use Illuminate\Http\Request;
class MatchEmailTest extends TestCase
{
    use RefreshDatabase;

    public function testMatchEmail()
    {
        $userController = new UserController();
        $teamController = new TeamController();

        $email = 'test@example.com';

        $userRequest = new Request([
            'user_name' => 'pruebaUsuario',
            'email' => $email,
            'password' => 'user',
            'profilePhoto' => 'default.png',
        ]);

        $teamRequest = new Request([
            'email' => $email,
            'password' => 'team',
            'team_name' => 'pruebaEquipo',
            'image_team' => 'default.png',
        ]);

        $userController->store($userRequest);
        $teamController->store($teamRequest);

        $response = $this->get('matchEmail/' . $email);

        $response->assertJson([
            'exists' => true
        ]);
    }
}
