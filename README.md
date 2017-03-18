RSS Feed Checker
====

概要
----
RSSの更新をチェックして、メール送ったりする君です


## 対応しているRSSフォーマット
* [RSS2.0](tree/master/src/RssFeed/Parser/Rss2.php)

チェックしたいRSSフォーマットが上記にないなら [ParserInterface](tree/master/src/RssFeed/ParserInterface.php) を実装するParserを書いてPRをお送り下さい

## 対応している更新通知先
* [メール](tree/master/src/UpdateNotify/Notifier/Mail.php)

通知したい方法が上記にないなら [NotifierInterface](tree/master/src/UpdateNotify/NotifierInterface.php) を実装するNotifierを書いてPRをお送り下さい

## 想定している使い方
* ブログに更新があれば #あとで読む タグを付けてはてなブックマークする


使い方
----
1. このリポジトリをclone
    * `git clone git@github.com:pinkumohikan/rss-feed-checker.git`
1. `config/general.yml` を開き、監視対象と更新通知方法を設定する
1. cronとかで定期実行する
    * ` */10 * * * * php path-to-repository/bin/check-update.php > /dev/null`


動作環境
----
* php 7.0以上
* automake


セットアップ
----

何も考えずに下記のコマンドを叩いて下さい
不安だったらMakefileを読んで下さい

```
make install
```


Contribution
----
お気軽にどうぞ！
IssueからでもPRからでも大歓迎です


ライセンス
----
MIT


作った人
----
* [Hokuto Shinoda](https://github.com/pinkumohikan)
    * Twitter: [@pinkumohikan](https://twitter.com/pinkumohikan)
    * Blog: [https://pinkumohikan.com](https://pinkumohikan.com)
