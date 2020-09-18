<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、インストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さずにこのファイルを "wp-config.php" という名前でコピーして
 * 直接編集して値を入力してもかまいません。
 *
 * このファイルは、以下の設定を含みます。
 *
 * * MySQL 設定
 * * 秘密鍵
 * * データベーステーブル接頭辞
 * * ABSPATH
 *
 * @link https://ja.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// 注意:
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.osdn.jp/%E7%94%A8%E8%AA%9E%E9%9B%86#.E3.83.86.E3.82.AD.E3.82.B9.E3.83.88.E3.82.A8.E3.83.87.E3.82.A3.E3.82.BF 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define( 'DB_NAME', 'eccubedb' );

/** MySQL データベースのユーザー名 */
define( 'DB_USER', 'dbuser' );

/** MySQL データベースのパスワード */
define( 'DB_PASSWORD', 'secret' );

/** MySQL のホスト名 */
define( 'DB_HOST', 'mysql' );

/** データベースのテーブルを作成する際のデータベースの文字セット */
define( 'DB_CHARSET', 'utf8mb4' );

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define( 'DB_COLLATE', '' );

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'v<g#4 4DezooE3X!BA)0Xh]e!A<n?i>zuZZPlV2}P2]jk?,i W;vTZJ)[~+Rj9b$' );
define( 'SECURE_AUTH_KEY',  'e{7#U.Ub90e^FD)%X y0nlNWf%?_c)#Fv<bY]wK5^C_b8VJ3j%D5qh|M/+R@q5AF' );
define( 'LOGGED_IN_KEY',    '7PbonBF; <%eWsbYmA.5hgRoqYAv>3FGmdvzS0QK3PjHPyek]+Yi;[]c~w.$2/?L' );
define( 'NONCE_KEY',        'b :s(I7Y05ewn$=6GB<G(NRNkkS~_3U9ROK?X/?hC,l^b@QzS,P3uf2L52}jH: !' );
define( 'AUTH_SALT',        'R^daat`yxp$&L-ri<SRT+^C>>+F9ZQ(ncH!i%Lfq.rQ]K](+=EtpS)L[TCK0v$G1' );
define( 'SECURE_AUTH_SALT', '`PLIH$OCsCG  ns#$qnc8=xM5Ktv8N=~dC9vS,}L^ ^;kFSBgWt,ru/H<HFj%dun' );
define( 'LOGGED_IN_SALT',   'Sr::n|b6efDG$.Ui:S8R5GL)5Olq43AM2,~u99jAi&C87&cyef+tPH^q;FQc/(j0' );
define( 'NONCE_SALT',       '#!DG%)+?(,>?*gy FZ/ql  0(Jg@J@l3C`|r)`3=p2#~QitY6B4F5<fIa7Y;Ap0u' );

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix = 'ggm_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 *
 * その他のデバッグに利用できる定数についてはドキュメンテーションをご覧ください。
 *
 * @link https://ja.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* 編集が必要なのはここまでです ! WordPress でのパブリッシングをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
