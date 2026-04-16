# 📇 名刺管理アプリ（Meishi Hub）

営業活動を「見える化」する名刺管理アプリ

---

## 📌 プロジェクト概要

本アプリは、名刺情報を中心に会社・商談・TODOを一元管理できるWebアプリケーションです。
営業活動の効率化と情報の整理を目的として開発しています。

---

## 🎯 主な機能

* 🏢 会社管理
* 📇 名刺管理
* 💼 商談管理
* ✅ TODO管理
* 🔐 ユーザー認証（ログイン / ログアウト）

---

## 📝 主なページ・機能詳細

### 📊 ダッシュボード

* 総名刺数・取引会社数・案件数・売上を一覧表示
* 最近追加した名刺を表示
* 未完了のToDoを表示し、優先タスクを可視化

---

### 🏢 会社・名刺管理画面

* 登録している会社一覧を表示
* 会社をクリックすると以下を確認可能

  * 所属する名刺一覧
  * 関連する案件情報
* 会社単位で情報を一元管理

---

### 💼 案件管理画面

* 進行中の案件を5つのステータスで管理

  * 未対応 / 進行中 / 商談中 / 成約 / 失注
* 各案件に対して以下を管理可能

  * 進捗度
  * 金額
  * 商談メモ
* 案件ごとにToDoを紐づけてタスク管理が可能

---

### ✅ ToDo管理画面

* タスクを「完了 / 未完了」で管理
* 一覧で状態を把握できるシンプルなUI
* 案件と連動したタスク管理にも対応

---

## 🚀 インストール手順

```bash
git clone https://github.com/itsuki3102pj22/meishi-hub.git
cd meishi-hub
cp .env.example .env
composer install
npm install
php artisan key:generate
php artisan migrate
npm run dev
```

※ Docker使用の場合

```bash
docker-compose up -d
```

---

## 🔐 テストユーザー（デモ用）

※本番データではありません

* Email: [test@example.com](mailto:test@example.com)
* Password: password

---

## 📁 プロジェクト構造

```
src/
 ├── app/
 ├── database/
 ├── resources/
 │   ├── views/
 ├── routes/
 └── ...
```

---

## 🗂️ データモデル

| モデル     | 説明     |
| ------- | ------ |
| User    | ユーザー情報 |
| Company | 会社情報   |
| Card    | 名刺情報   |
| Deal    | 商談情報   |
| Todo    | タスク管理  |

---

## 🔄 リレーションシップ

* User hasMany Company
* Company hasMany Card
* Card hasMany Deal
* User hasMany Todo

---

## 🛠️ 技術スタック

* PHP / Laravel
* Blade
* Tailwind CSS
* MySQL
* Docker

---

## 📝 主なページ・ビュー

* ダッシュボード
* 名刺一覧 / 登録 / 編集
* 会社管理画面
* 商談管理画面
* TODO管理画面
* ログイン画面

---

## 🔐 セキュリティ機能

* Laravel認証機能
* 認証ミドルウェアによるアクセス制御
* ユーザーごとのデータ分離

---

## 💻 開発用コマンド

```bash
php artisan serve
php artisan migrate
php artisan make:model
php artisan make:controller
php artisan route:list
```

---

## 🐛 トラブルシューティング

### DB接続エラー

.env の DB設定を確認

### キャッシュ問題

```bash
php artisan config:clear
php artisan cache:clear
```

### npmエラー

```bash
npm install
npm run dev
```

---
