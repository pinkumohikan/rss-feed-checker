RSS Feed Checker
====

RSSの更新をチェックして、更新が有った際に通知を行います

### 対応しているRSSフォーマット
* [RSS2.0](src/RssFeed/Parser/Rss20.php)

利用したいRSSフォーマットが上記にないなら [ParserInterface](src/RssFeed/ParserInterface.php) を実装するParserを書いてPRをお送り下さい

### 対応している更新通知先
* [メール](src/UpdateNotify/Notifier/Mail.php)

通知したい方法が上記にないなら [NotifierInterface](src/UpdateNotify/NotifierInterface.php) を実装するNotifierを書いてPRをお送り下さい


使い方
----
1. このリポジトリをclone
    * `git clone --depth 1 https://github.com/pinkumohikan/rss-feed-checker.git`
1. 依存パッケージをinstall
    * `make setup`
1. 監視対象を設定
    * `vim config/general.yml`
1. cronとかで定期実行する
    * ` */10 * * * * php path-to-repository/bin/check-update.php >> check.log 2>&1`


動作環境
----
* php 7.0以上


ライセンス
----
MIT


コントリビューション
----
お気軽にどうぞ！
IssueからでもPRからでも大歓迎です


開発者、協力者
----
* [@pinkumohikan](https://github.com/pinkumohikan)
    * Twitter: [@pinkumohikan](https://twitter.com/pinkumohikan)
    * Blog: [https://blog.pinkumohikan.com/](https://blog.pinkumohikan.com/)
* [Ikezoe Makoto](https://github.com/IkezoeMakoto)
    * Twitter: [@for__3](https://twitter.com/for__3)
