# README

EC-CUBEの開発に関連する具体的なことを表記しています。

公式ドキュメント

https://doc4.ec-cube.net/



## summary

1. composerのインストール（基本的にはcomposerはグルーバルにもたせないで、プロジェクトごとに個別に持たせるようにする）
2. Macにphp環境を作成する
3. Docker環境を起動
4. 開発用簡易メーラー

Docker環境での開発のアクセス先は以下になります。

- EC-CUBE: http://localhost:9100/

- MailCatcher: http://localhost:1080/



## Develop env の構築

#### 1. composerのインストール

composer-setup.phpをダウンロードしてから、composer.pharをインストール。最終的にcomposer-setup.phpは削除してよい。

```
$ php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
$ php -r "if (hash_file('sha384', 'composer-setup.php') === 'e5325b19b381bfd88ce90a5ddb7823406b2a38cff6bb704b0acc289a09c8128d4a8ce2bbafcd1fcbdc38666422fe2806') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
$ php composer-setup.php
$ php -r "unlink('composer-setup.php');"
```

コンポーザーを実行

```
$ php composer.phar update
```

ext-intlがないと叱られるのでインストールしておく

```
Problem 1
    - The requested PHP extension ext-intl * is missing from your system. Install or enable PHP's intl extension.
```





#### 2. Macにphp環境を作成する

ext-intlの設定がデフォルトのPHPに施すのが難しいので、brewでインストールして新しいものを使う。

```
$ brew install php@7.3
```

インストール先が`/usr/local/opt/php@7.3/bin/php`になるので、パスを通してあげる。

```
$ vi .bash_profile
追記↓
export PATH="/usr/local/opt/php@7.3/bin:$PATH"
```

保存したら`source .bash_profile`してからターミナルを再起動（これ重要）

zshを使っている場合は以下。

```
~/.zshenv
export PATH="/usr/local/opt/php@7.3/bin:$PATH"
-----
~/.bash_profile
export PATH="/usr/local/opt/php@7.3/bin:$PATH"
```

ターミナルを再起動してからインストールを確認します。

```
$ php --version
PHP 7.3.20 (cli) (built: Jul  9 2020 23:50:54) ( NTS )
```

これで既存のphpからbrewでインストールした方のphpを使えるようになります。





#### 3. Docker環境を起動

EC-CUBEにはあらかじめDockerファイルが付属しているので、それを使う。

```
$ cd /PROJECT_DIR/ (例) cd /Users/osamuyamakami/Documents/mywork/docker/ec-cube
$ docker-compose up -d
（これで立ち上がる）
$ docker-compose ps -a
        Name                       Command               State                       Ports                     
---------------------------------------------------------------------------------------------------------------
ec-cube_ec-cube_1       docker-php-entrypoint apac ...   Up      0.0.0.0:4430->443/tcp, 0.0.0.0:9100->80/tcp   
ec-cube_mailcatcher_1   mailcatcher --no-quit --fo ...   Up      0.0.0.0:1025->1025/tcp, 0.0.0.0:1080->1080/tcp
ec-cube_mysql_1         docker-entrypoint.sh mysqld      Up      0.0.0.0:13306->3306/tcp, 33060/tcp            
ec-cube_postgres_1      docker-entrypoint.sh postgres    Up      0.0.0.0:15432->5432/tcp
```

`localhost:9100`にアクセスするとEC-CUBEが立ち上がっています。ポートを9100に変更しているので注意。

停止するときは、

```
$ docker-compose down
```



#### 4. 開発用簡易メーラー

`localhost:1080/`にアクセスします。

