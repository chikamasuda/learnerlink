<?php

namespace Tests\Feature;

use App\User;
use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * ダミーユーザーログイン
     */
    public function dummyLogin()
    {
        $user = factory(User::class, 'default')->create(); //ダミーユーザー生成
        return $this->actingAs($user) //ログイン
            ->withSession(['user_id' => $user->id]) //idをセッションに設定
            ->get(route('home')); //home画面にリダイレクト
    }

    /**
     * PostControllerのCRUD処理のルート確認
     */
    public function testPostPath()
    {
        //投稿一覧画面のルート確認
        $response = $this->dummyLogin();
        $response = $this->get('/posts');
        $response->assertStatus(200);

        //投稿追加のルート確認
        $post = [
            'content' => '投稿',
            'id' => 1,
        ];

        //まだ投稿データはDBに入っていないかテスト
        $this->assertDatabaseMissing('posts', $post);

        //投稿追加
        $response = $this->post('/posts/add/', $post);

        //投稿データがDBに入っているかテスト
        $this->assertDatabaseHas('posts', $post);

        //投稿一覧画面にリダイレクト
        $response->assertStatus(302)
            ->assertRedirect('/posts');

        //編集詳細画面表示のルート確認
        $response = $this->get('/posts/edit/1');
        $response->assertStatus(200);

        //存在しないIDを指定した場合のルート確認
        $response = $this->get('/posts/edit/0');
        $response->assertStatus(404);

        //以下から投稿更新のルート確認
        $post = [
            'content' => '編集',
        ];

        //投稿を更新
        $response = $this->post('/posts/update/1', $post);

        //投稿一覧画面にリダイレクト
        $response->assertStatus(302)
            ->assertRedirect('/posts');

        //投稿データがDBに入っているかテスト
        $this->assertDatabaseHas('posts', $post);

        //投稿削除
        $response = $this->delete('/posts/delete/1');

        //投稿一覧画面にリダイレクト
        $response->assertStatus(302)
            ->assertRedirect('/posts');

        //投稿データがDBから削除されたかテスト
        $this->assertDatabaseMissing('posts', $post);
    }
}
