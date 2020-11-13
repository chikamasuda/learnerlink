<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * ログイン画面を表示
     */
    public function testLoginView()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        // 認証されていないことを確認
        $this->assertGuest();
    }

    /**
     * ユーザー一覧へアクセス（ログイン画面へリダイレクト）
     */
    public function testNonloginAccess()
    {
        $response = $this->get('home');
        $response->assertStatus(302)
                 ->assertRedirect('/login'); // リダイレクト先を確認
        // 認証されていないことを確認
        $this->assertGuest();
    }

    /**
     * ログイン処理を実行
     */
    public function testLogin()
    {
        // 認証されていないことを確認
        $this->assertGuest();
        // ダミーログイン
        $response = $this->dummyLogin();
        $response->assertStatus(200);
        // 認証を確認
        $this->assertAuthenticated();
    }
    
    /**
     * ダミーユーザーログイン
     */
    private function dummyLogin()
    {
        $user = factory(User::class, 'default')->create();
        return $this->actingAs($user)
                    ->withSession(['user_id' => $user->id])
                    ->get(route('home')); // homeにリダイレクト
    }
}

