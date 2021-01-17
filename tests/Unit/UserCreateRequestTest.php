<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UserCreateRequest;
use Tests\TestCase;

class UserCreateRequestTest extends TestCase
{
  /**
   * 新規登録のフォームリクエストのバリデーションテスト
   *
   * @param array 項目名の配列
   * @param array 値の配列
   * @param boolean 期待値(true:バリデーションOK, false:バリデーションNG)
   * @dataProvider UserCreationProvider
   */
  public function testUserCreation(array $keys, array $values, bool $expect)
  {
    //入力項目の配列($keys)と値の配列($values)から、連想配列を生成する
    $dataList = array_combine($keys, $values);

    $request = new UserCreateRequest();
    //フォームリクエストで定義したルールを取得
    $rules = $request->rules();
    //validatorファザードでバリデーターのインスタンスを取得、その際に入力情報をバリデーションルールを引数で渡す
    $validator = Validator::make($dataList, $rules);
    //入力情報がバリデーションルールを満たしている場合はtrue,満たしていない場合はfalseが返る
    $result = $validator->passes();
    //期待値（＄expect）と結果($result）を比較
    $this->assertEquals($expect, $result);
  }

  public function UserCreationProvider()
  {
    return [
      'ok' => [
        ['name', 'email', 'password', 'password_confirmation', 'language', 'address', 'self_introduction'],
        ['testuser', 'test@example.com', 'password', 'password', 'PHP', '東京都', 'テストユーザーです。'],
        true
      ],
      '名前必須エラー' => [
        ['name', 'email', 'password', 'password_confirmation', 'language', 'address', 'self_introduction'],
        [null, 'test@example.com', 'password', 'password', 'PHP', '東京都', 'テストユーザーです。'],
        false
      ],
      '名前形式エラー' => [
        ['name', 'email', 'password', 'password_confirmation', 'language', 'address', 'self_introduction'],
        [1, 'test@example.com', 'password', 'password', 'PHP', '東京都', 'テストユーザーです。'],
        false
      ],
      '名前最大文字数エラー' => [
        ['name', 'email', 'password', 'password_confirmation', 'language', 'address', 'self_introduction'],
        [str_repeat('a', 13), 'test@example.com', 'password', 'password', 'PHP', '東京都', 'テストユーザーです。'],
        false
      ],
      'ok' => [
        ['name', 'email', 'password', 'password_confirmation', 'language', 'address', 'self_introduction'],
        [str_repeat('a', 12), 'test@example.com', 'password', 'password', 'PHP', '東京都', 'テストユーザーです。'],
        true
      ],
      'email必須エラー' => [
        ['name', 'email', 'password', 'password_confirmation', 'language', 'address', 'self_introduction'],
        ['testuser', null, 'password', 'password', 'PHP', '東京都', 'テストユーザーです。'],
        false
      ],
      'email形式エラー' => [
        ['name', 'email', 'password', 'password_confirmation', 'language', 'address', 'self_introduction'],
        ['testuser', 'test@example.', 'password', 'password', 'PHP', '東京都', 'テストユーザーです。'],
        false
      ],
      'email最大文字数エラー' => [
        ['name', 'email', 'password', 'password_confirmation', 'language', 'address', 'self_introduction'],
        ['testuser', str_repeat('a', 256), 'password', 'password', 'PHP', '東京都', 'テストユーザーです。'],
        false
      ],
      'emailユニークエラー' => [
        ['name', 'email', 'password', 'password_confirmation', 'language', 'address', 'self_introduction'],
        ['testuser', $this->user->email, 'password', 'password', 'PHP', '東京都', 'テストユーザーです。'],
        false
      ],
      'password必須エラー' => [
        ['name', 'email', 'password', 'password_confirmation', 'language', 'address', 'self_introduction'],
        ['testuser', 'test@example.com', '', '', 'PHP', '東京都', 'テストユーザーです。'],
        false
      ],
      'password最小文字数エラー' => [
        ['name', 'email', 'password', 'password_confirmation', 'language', 'address', 'self_introduction'],
        ['testuser', 'test@example.com', 'passw', 'passw', 'PHP', '東京都', 'テストユーザーです。'],
        false
      ],
      'password一致エラー' => [
        ['name', 'email', 'password', 'password_confirmation', 'language', 'address', 'self_introduction'],
        ['testuser', 'test@example.com', 'password', 'password1', 'PHP', '東京都', 'テストユーザーです。'],
        false
      ],
      '言語必須エラー' => [
        ['name', 'email', 'password', 'password_confirmation', 'language', 'address', 'self_introduction'],
        ['testuser', 'test@example.com', 'password', 'password', null, '東京都', 'テストユーザーです。'],
        false
      ],
      '言語形式エラー' => [
        ['name', 'email', 'password', 'password_confirmation', 'language', 'address', 'self_introduction'],
        ['testuser', 'test@example.com', 'password', 'password', 1, '東京都', 'テストユーザーです。'],
        false
      ],
      '言語最大文字数エラー' => [
        ['name', 'email', 'password', 'password_confirmation', 'language', 'address', 'self_introduction'],
        ['testuser', 'test@example.com', 'password', 'password', str_repeat('a', 13), '東京都', 'テストユーザーです。'],
        false
      ],
      'ok' => [
        ['name', 'email', 'password', 'password_confirmation', 'language', 'address', 'self_introduction'],
        ['testuser', 'test@example.com', 'password', 'password', str_repeat('a', 12), '東京都', 'テストユーザーです。'],
        true
      ],
      '居住地必須エラー' => [
        ['name', 'email', 'password', 'password_confirmation', 'language', 'address', 'self_introduction'],
        ['testuser', 'test@example.com', 'password', 'password', 'PHP', null, 'テストユーザーです。'],
        false
      ],
      '居住地形式エラー' => [
        ['name', 'email', 'password', 'password_confirmation', 'language', 'address', 'self_introduction'],
        ['testuser', 'test@example.com', 'password', 'password', 'PHP', 1, 'テストユーザーです。'],
        false
      ],
      '居住地最大文字数エラー' => [
        ['name', 'email', 'password', 'password_confirmation', 'language', 'address', 'self_introduction'],
        ['testuser', 'test@example.com', 'password', 'password', 'PHP', str_repeat('a', 13), 'テストユーザーです。'],
        false
      ],
      'ok' => [
        ['name', 'email', 'password', 'password_confirmation', 'language', 'address', 'self_introduction'],
        ['testuser', 'test@example.com', 'password', 'password', 'PHP', str_repeat('a', 12), 'テストユーザーです。'],
        true
      ],
      '自己紹介必須エラー' => [
        ['name', 'email', 'password', 'password_confirmation', 'language', 'address', 'self_introduction'],
        ['testuser', 'test@example.com', 'password', 'password', 'PHP', '東京都', null],
        false
      ],
      '自己紹介形式エラー' => [
        ['name', 'email', 'password', 'password_confirmation', 'language', 'address', 'self_introduction'],
        ['testuser', 'test@example.com', 'password', 'password', 'PHP', '東京都', 1],
        false
      ],
      '自己紹介文字数エラー' => [
        ['name', 'email', 'password', 'password_confirmation', 'language', 'address', 'self_introduction'],
        ['testuser', 'test@example.com', 'password', 'password', 'PHP', '東京都', str_repeat('a', 256)],
        false
      ],
      'ok' => [
        ['name', 'email', 'password', 'password_confirmation', 'language', 'address', 'self_introduction'],
        ['testuser', 'test@example.com', 'password', 'password', 'PHP', '東京都', str_repeat('a', 255)],
        true
      ],
    ];
  }
}
