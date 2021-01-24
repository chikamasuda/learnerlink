# Learner Link

プログラミングの学習者向けのマッチングサイトです。
新規登録後に他のユーザーと相互にいいねがついたらマッチング成立となり、マッチングが成立した相手とチャットでコミュニケーションを取ることができます。
また、掲示板機能もあり、学習状況など近況報告を投稿し合うこともできます。

<img width="700" alt="スクリーンショット 2021-01-25 2 04 09" src="https://user-images.githubusercontent.com/66733811/105637644-d292f200-5eb1-11eb-9846-55361d19558a.png">

レスポンシブにも対応しているので、スマートフォンから見ることもできます。

<img width="200" alt="スクリーンショット 2021-01-20 16 22 15" src="https://user-images.githubusercontent.com/66733811/105140908-b6065b00-5b3b-11eb-9b77-3f2961de4016.png">


## URL

https://learner-link.com/

※ゲストログインページから登録なしでログインできます。

## Title

Learner Link

## WEBアプリケーションを作成した背景・理由

プログラミングのオンライン学習をしている中、自分や周囲の人がなかなか学習仲間ができず孤独を感じ、モチベーションの維持が難しいという問題を解決するために作りました。


## 使用技術

・言語：HTML/CSS/PHP/JavaScript

・フレームワーク：Laravel/Bootstrap

・ライブラリ：jQuery

・データベース：MySQL

・開発環境：Docker

・バージョン管理：git/GitHub

・テスト：PHP Unit

・外部API：Pusher

## 制作物

Webアプリケーション

## 制作期間

サーバーアップまで1ヶ月。現在も改良中です。

## 機能一覧

・ログイン機能

・ゲストログイン機能

・ログアウト機能

・ユーザーのCRUD機能（作成・表示・更新・退会）

・掲示板の投稿のCRUD機能（作成・表示・更新・削除）

・ページネーション機能

・画像ファイルアップロード機能

・データベースに関する機能（リレーション、ORM)

・ユーザーへのいいね機能

・マッチング機能

・チャット機能（外部APIのPusherを使用。メッセージのPOST送信はAjaxを使用して実装。）

・検索機能

・Unitテスト

・Featureテスト
