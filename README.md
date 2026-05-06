# free_market

# アプリケーション名：free_market


## 環境構築
Dockerビルド
1. git@github.com:poteneko3104-creator/free_market.git
2. DockerDesktopアプリを立ち上げる
3. docker-compose up -d --build

Laravel環境構築
1. docker-compose exec php bash
2. composer install
3. composer create-project "laravel/laravel=8.*" . --prefer-dist
4. 「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.envファイルを作成
5. .envに以下の環境変数を追加

        DB_CONNECTION=mysql
        DB_HOST=mysql
        DB_PORT=3306
        DB_DATABASE=laravel_db
        DB_USERNAME=laravel_user
        DB_PASSWORD=laravel_pass

6. アプリケーションキーの作成
        php artisan key:generate
7. マイグレーションの実行
        php artisan migrate
8. シーディングの実行
        php artisan db:seed

fortifyインストール
1. docker-compose exec php bash
2. composer require laravel/fortify
3. php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"

stripe実装
1. docker-compose exec php bash
2. composer require stripe/stripe-php

Mailhogの実装
1 .envに以下の環境変数を追加

        MAIL_MAILER=smtp
        MAIL_HOST=mailhog
        MAIL_PORT=1025
        MAIL_USERNAME=null
        MAIL_PASSWORD=null
        MAIL_ENCRYPTION=null
        MAIL_FROM_ADDRESS=example@aaa.com

PHPUnitダウンロード
1. docker-compose exec php bash
2. docker run --rm -v $(pwd):/app php-app composer require --dev phpunit/phpunit

## 使用技術(実行環境)
 nginx:1.21.1
 mysql 8.0.26
 PHP 8.1.34
 Laravel Framework 8.83.29
 laravel/fortify

## ER図
er.drawio.pngを参照ください。

## URL
・開発環境：http://localhost/
・phpMyAdmin:：http://localhost:8080/
・mailhog：http://localhost:8026/
# free_market
# free_market
