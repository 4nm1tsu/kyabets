## ステージング環境
[ここ](https://3ch0.mydns.jp/kyabets/public/)

## Routing
- [GET]/timeline
- [POST]/timeline
- [GET]/timeline/{id}
- [POST]/timeline/{id}
- :sushi:[UPDATE]/timeline/{id}→投稿の編集(投稿者のみ可能)
- :sushi:[DELETE]/timeline/{id}→投稿の削除(投稿者のみ可能)
- [GET]/profile/{id}
- [GET]/archive
- [GET]/archive/upload
- [POST]/archive/upload
- :sushi:[DELETE]/archie/{id}→アーカイブの削除（投稿者のみ可能）
- [GET]/ranking

## Entity
- User
  - One-to-Many:Badge
  - One-to-Many:Bbs
- Bbs
  - Many-to-One:User
  - One-to-Many:Reply
-Reply
  - Many-to-One:Bbs
-Badge
  - Many-to-One:User
