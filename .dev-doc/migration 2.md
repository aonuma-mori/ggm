# migration

サイトごと移動する際の手順書です。



1. バーチャルホストの作成（何らかのWEBサーバーを準備）
2. DocumentRoot直下でgit pullする。
3. phpでcomposerを実行。
4. .envの設定
5. .htaccessの設定 (EC-CUBE)
6. .htaccessの設定 (Wordpress)



### バーチャルホストの作成（何らかのWEBサーバーを準備）

`ggm-do.com`ドメインで何らかのwebサーバーを作成して、DocumentRootにアクセスできるようにしておきます。

### DocumentRoot直下でgit pullする

リポジトリのクレデンシャル系（SSHなど）を予め設定しておく必要があります。

```
(サーバーログイン)
$ cd /PATH/ (DocumentRootに移動)
$ git pull origin master
```



### phpでcomposerを実行

```
/usr/local/php7.1/bin/php composer.phar install
```



### .envの設定

Googleドライブのproduct-envの中身をコピーして作成するか、マイグレーション元の本番環境から.envをコピーして持ってくる。



### .htaccessの設定 (EC-CUBE)

symfony用の.htaccessを作成します。同様にproduct-htaccessをコピーするか、本番環境からコピーします。

デフォルトとの修正点は、

- Symfony内でwordpressを実行
- IP制限 / Basic認証などのセキュリティーの設定



### .htaccessの設定 (Wordpress)

Wordpress用の.htaccessを作成します。同様にproduct-htaccessをコピーするか、本番環境からコピーします。