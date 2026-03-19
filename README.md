# free_market

# アプリケーション名：contact-form


## 環境構築
Dockerビルド
docker-compose up -d --build

Laravel環境構築
docker-compose exec php bash
composer create-project "laravel/laravel=8.*" . --prefer-dist

fortifyインストール
composer require laravel/fortify
php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"

## 使用技術(実行環境)
 nginx:1.21.1
 mysql 8.0.26
 PHP 8.1.34
 Laravel Framework 8.83.29
 laravel/fortify

## ER図
er.drawio.pngを参照ください。

## URL
お問い合わせフォーム入力ページ      /
お問い合わせフォーム確認ページ      /confirm
サンクスページ                     /thanks
管理画面                          /admin
検索                              /search
検索リセット                       /reset   
お問い合わせフォーム削除            /delete
ユーザ登録                        /register
ログイン                          /login
ログアウト                        /logout
エクスポート                      /export# free_market
