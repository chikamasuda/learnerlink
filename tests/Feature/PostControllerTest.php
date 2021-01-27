<?php

namespace Tests\Feature;

use App\User;
use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    /**
     * ダミーユーザーログイン
     */
    public function dummyLogin()
    {   
        $user = factory(User::class, 'default')->create();//ダミーユーザー生成
        return $this->actingAs($user)//ログイン
            ->withSession(['user_id' => $user->id])//idをセッションに設定
            ->get(route('home')); //home画面にリダイレクト
    }

    /**
     * 一覧表示のルート確認
     */
    public function testGetAllpostsPath()
    {
        $response = $this->dummyLogin();
        $response = $this->get('/posts');
        $response->assertStatus(200);
    }

    /**
     * 編集画面表示のルート確認
     */
    public function testGetPostPath()
    {
        $response = $this->dummyLogin();
        $response = $this->get('/posts/edit/1');
        $response->assertStatus(200);
    }

    /**
     * 存在しないIDを指定した場合
     */
    public function testGetPostPathNoyExists()
    {
        $response = $this->dummyLogin();
        $response = $this->get('/posts/edit/0');
        $response->assertStatus(404);
    }
}
