<?php

declare(strict_types=1);
namespace Tests\Authorization;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

final class AuthorizationServiceTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @var User $user
     */
    private User $user;

    /**
     * @var string $token
     */
    private string $token;

    /**
     * @var bool $isInit
     */
    private bool $isInit = true;


    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        if ($this->isInit) {
            $this->user = factory(User::class)->create();
            $this->isInit = false;
        }
    }

    /**
     * @test
     */
    public function testLogin(): void
    {
        $credentials = [
            'login' => $this->user->email,
            'password' => 'password'
        ];

        $this->json(Request::METHOD_POST, route('login'), $credentials)
            ->assertStatus(Response::HTTP_ACCEPTED)
            ->assertJsonStructure(['id','success','data' => ['token']]);
        $this->assertEquals(1, DB::table('oauth_access_tokens')->where('user_id', $this->user->id)->count());
    }

    /**
     * @test
     */
    public function testLogout(): void
    {
        $credentials = [
            'login' => $this->user->email,
            'password' => 'password'
        ];

        $result = $this->json(Request::METHOD_POST, route('login'), $credentials);

        $token = $result->json('data.token');

        $this->json(Request::METHOD_GET, route('logout'), [], [
            'Authorization' => "Bearer {$token}"
        ])->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertEquals(1, DB::table('oauth_access_tokens')->where(['user_id' => $this->user->id, 'revoked' => 1])->count());
    }
}
