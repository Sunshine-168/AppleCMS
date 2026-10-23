# 苹果CMS V12 · AppleCMS

基于 Laravel 构建的新一代开源影视 CMS 系统

**AppleCMS V12（苹果CMS）** 是一款基于 Laravel 框架开发的免费开源影视内容管理系统，专注于影视建站、视频点播、影视资源聚合及多终端内容分发，为开发者和站长提供高效、灵活、易扩展的一站式影视建站解决方案。

系统采用现代化架构设计，支持 PC、手机、平板及 APP 多终端自适应访问，兼顾网站性能、用户体验与搜索引擎优化（SEO）。

**AppleCMS V12 — 让影视建站更简单，让开源创造更多可能。**

当前版本 **1.0.1**。

---

## 更新记录

每一版都写在这里，新的放最上面。写清改了什么，不要只写版本号。

### 1.0.1

- **安装**：安装页增加「宝塔配置」。按五步做：安装 PHP 8.4、运行目录选 `/public`、`storage` 和 `bootstrap/cache` 交给 `www`、打开 `/install`、计划任务每分钟跑一次。命令用 `/www/server/php/84/bin/php`，不要用 `php-fpm`，不要再写 `* * * * *`。装完页可以直接复制这一行。安装说明按网页安装、宝塔配置、Shell、Docker、上线部署五个入口来写。
- **采集**：后台「今天 / 本周 / 全部」每次只采 1 页，采完自动下一页。中途超时会从断开的那一页继续。命令行可同时拉多页：`php artisan video:collect --jobs=4`（1 到 8）。
- **Docker**：镜像取消 PHP 30 秒限制。容器启动后自己每分钟执行 `schedule:run`，不用再配 crontab。
- **验证码**：后台可以改用开源 Cap。不填的话仍用原来的算术图。
- **环境**：PHP 要求 8.4+。

### 1.0.0

首次发布。

- 网页安装、Shell 脚本、Docker 三种方式装站。
- 影视分类、播放、采集、会员、专题、资讯和插件。
- 计划任务负责定时采集和运行监控。

---

## 系统介绍

苹果 CMS V12 用 Laravel 做影视站：分类、影片、播放、采集、会员、专题都在一套程序里。前台模板用 `@vod*` 标签，扩展放在 `plugins/`。协议 MIT。

代码开放，无加密、无隐藏后门，可以自己部署，也可以二次开发。试用可以只用 SQLite，不必先装 MySQL。

**官方唯一 Telegram 联系方式：** [@sanpang](https://t.me/sanpang)

**温馨提示：** 请认准官方唯一联系方式，谨防冒充与诈骗。

---

## 环境要求

需要 **PHP 8.4+**。

| 项目 | 要求 |
|------|------|
| PHP | 8.4+ |
| 数据库 | MySQL 5.7+ / 8.0（正式站）；SQLite（本机试用） |
| PHP 扩展 | `pdo`、`mbstring`、`openssl`、`curl`、`fileinfo`、`tokenizer`、`xml`、`ctype`、`json` |
| Web 服务 | Nginx / Apache；本机也可用 `php artisan serve` |
| 可选 | Docker、Composer |

---

## 系统特色

- **免费开源**：代码开放透明，无加密、无隐藏后门，支持自主部署与二次开发。
- **Laravel 架构**：基于现代化 PHP 框架，结构清晰，易于维护和扩展。
- **多端自适应**：一套系统适配电脑、手机、平板及 APP。
- **影视资源聚合**：支持视频点播、影视资源采集与内容管理。
- **SEO 友好**：站点地图、RSS、robots，助力搜索引擎收录。
- **灵活扩展**：模板分离、`@vod*` 标签、插件目录，功能可以按需打开。

---

## 功能列表

- 免费点播、详情、播放、下载
- 多线路、选集
- 分类、筛选、搜索、标签
- 影视资源采集，并对外提供 JSON / XML 资源接口
- 会员注册登录、收藏、观看历史、签到、邀请
- 影片评分、评论、分享、留言
- 专题、演员、角色、分集剧情
- 影视资讯
- 网址聚合导航
- 广告位（顶栏、底栏、播放器、正文）
- 在线支付与积分（插件）
- 微信公众号（插件）
- 弹幕、播放页讨论、直播、漫画、小说、图集（插件，可关）
- 计划任务：采集、点击重置、运行监控

---

## 基础架构

- 网站自适应，模板在 `resources/views/themes/default/`
- 插件放 `plugins/`，后台可开关
- 伪静态，并兼容常见影视站地址形式
- 数据缓存、全文搜索（可关，关了回退普通检索）
- 历史观看记录
- 定时任务（采集和监控都靠这一条）
- 安装页五个入口：网页安装、宝塔配置、Shell、Docker、上线部署

---

## 先选你的场景

安装页顶部就是这五个入口，和下面几节对应。

| 安装页 | 什么时候用 | 往下看 |
|---|---|---|
| 网页安装 | 环境已经好了，想在浏览器里点完 | [方式 C：网页安装](#方式-c网页安装) |
| 宝塔配置 | 用宝塔、有域名，按图填 | [宝塔上线](#宝塔上线)，页面地址 `/install?way=baota` |
| Shell | 本机或宝塔终端已有 PHP 8.4，一条命令装完 | [方式 B：Shell](#方式-bshell) |
| Docker | 本机已装 Docker | [方式 A：Docker](#方式-adocker) |
| 上线部署 | 要改 nginx、php.ini | [宝塔上线](#宝塔上线) 末尾，装好后后台「环境」是同一套说明 |
| 装好了，不知道进哪 | | [装好后怎么进](#装好后怎么进) |
| `/install` 打不开、500、定时不跑 | | [打不开时](#打不开时) |

代码必须放在**项目根**（能看到 `artisan`、`install.sh`、`public/` 的那一层）。宝塔里「网站目录」填这一层，「运行目录」选 `/public`。终端命令也在项目根执行。

```bash
git clone <你的仓库地址> AppleCms
cd AppleCms
```

没有 Git 就把压缩包解到这一层，再 `cd` 进去。

---

## 本机试用

装完都用 http://127.0.0.1:8010/ 。Docker、Shell、网页安装三选一。宝塔正式站看下一节。

### 方式 A：Docker

```bash
docker compose up --build
```

浏览器打开 http://127.0.0.1:8010/install ，选「文件数据库」，设管理员。容器会自己每分钟跑计划任务，本机试用不用再配 crontab。PHP 没有 30 秒限制。

不想点网页、一条命令装完：

```bash
AUTO_INSTALL=1 INSTALL_PASSWORD=YourPass#1 docker compose up --build
```

后台账号 `admin`，密码是 `INSTALL_PASSWORD`。

### 方式 B：Shell

Linux / macOS / 宝塔终端，在项目根：

```bash
bash install.sh YourPass#1
```

不写密码时默认 `admin123`。脚本会装 Composer 依赖、生成密钥、建 SQLite、写入示例分类。

Windows（先把 `php`、`composer` 加进 PATH）：

```powershell
.\install.ps1 YourPass#1
```

本机没有 Nginx 时再开内置服务：

```bash
php artisan serve --host=0.0.0.0 --port=8010
```

宝塔已经用域名反代了，**不要**再跑 `artisan serve`，直接打开你的域名。

### 方式 C：网页安装

项目根执行：

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Windows 第二行改成 `copy .env.example .env`。然后：

- 本机：`php artisan serve --host=0.0.0.0 --port=8010`，打开 http://127.0.0.1:8010/install
- 宝塔：打开 `http://你的域名/install`

三步：环境检查 → 数据库 → 管理员。试用选文件数据库；正式站选 MySQL（先建好空库再填）。

和脚本等价的一条命令：

```bash
php artisan video:install --password=YourPass#1 --demo
```

---

## 宝塔上线

没有电脑基础的，打开安装页的 **宝塔配置** 一栏，按五张示意图填：`http://你的域名/install?way=baota`。

顺序就这五步：

1. 软件商店安装 **PHP 8.4**，网站 PHP 也选 8.4。
2. 「网站目录」填项目根（例如 `/www/wwwroot/你的域名`）。「运行目录」从 `/` 改成 `/public` 再保存。没改时打开首页会看到说明页，按页面上的步骤点即可。
3. `storage`、`bootstrap/cache` 所有者改为 `www`，并允许写入。
4. 浏览器打开 `http://你的域名/install`，或在项目根执行 `bash install.sh YourPass#1`。正式站用 MySQL，字符集 `utf8mb4`。
5. 计划任务：Shell 脚本，每分钟一次。命令用 `/www/server/php/84/bin/php`，不要用 `php-fpm`，脚本里不要再写 `* * * * *`。

装好后进 `http://你的域名/admin/login`。`.env` 里把 `APP_URL` 改成你的域名，`APP_ENV=production`，`APP_DEBUG=false`，然后执行 `php artisan config:clear`。

nginx 和 php.ini 见安装页「上线部署」，或后台说明「环境」（同一套宝塔图）。

---

## 装好后怎么进

| | 本机 Docker / `artisan serve` | 宝塔 / 已有域名 |
|---|---|---|
| 前台 | http://127.0.0.1:8010/ | `http://你的域名/` |
| 后台 | http://127.0.0.1:8010/admin/login | `http://你的域名/admin/login` |
| 账号 | `admin` | 网页安装时你填的账号 |

脚本没写密码时，默认密码是 `admin123`。Docker 自动安装默认也是 `admin123`，上线务必改掉。

---

## 打不开时

| 现象 | 先查 |
|---|---|
| `/install` 或全站 500 | `storage`、`bootstrap/cache` 不能写；或还没有 `APP_KEY`（先 `php artisan key:generate`） |
| 打开首页是 404，或看到「还差一步」 | 宝塔「运行目录」改成 `/public` 并保存。没有这一栏时，把网站目录末尾改成 `/public` |
| 提示已经装过 | 删掉 `storage/app/install.lock`，再打开 `/install` |
| 计划任务没反应、监控没数据 | 任务用了 `php-fpm` 而不是 `/bin/php`；到「系统 → 监控」复制正确命令 |
| 日志里有 `pcntl_signal` | 把本仓库更新后再跑 `schedule:run`。宝塔 PHP 常禁用这个函数，程序已兼容 |
| 采集网页点「今天」中途断 | 当前版本会一页一页接着采。若连单独一页也被掐断，再把 PHP `max_execution_time` 和 nginx `fastcgi_read_timeout` 调大 |

重装：删 `storage/app/install.lock`，必要时清空库或删 `database/database.sqlite`，再走安装。

---

## 前台页面

| 路径 | 说明 |
|------|------|
| `/` | 首页 |
| `/type/{id}` `/show` `/search` | 分类、筛选、搜索 |
| `/vod/{id}` `/play/{id}` | 详情、播放 |
| `/latest` `/topics` `/actors` `/arts` | 更新、专题、演员、资讯 |
| `/member` | 会员中心 |

模板在 `resources/views/themes/default/`。

---

## 目录结构

```
├── app/                         # 业务代码
├── plugins/                     # 插件（广告、支付、微信、弹幕等）
├── resources/views/themes/      # 前台模板
├── public/                      # 宝塔「运行目录」选 /public
├── routes/                      # 前台、后台、接口路由
├── install.sh / install.ps1     # 一条命令安装
├── docker-compose.yml           # Docker
└── artisan                      # Laravel 命令入口
```

---

## 联系我们

**官方唯一 Telegram 联系方式：** [@sanpang](https://t.me/sanpang)

**温馨提示：** 请认准官方唯一联系方式，谨防冒充与诈骗。

## 参与贡献

1. Fork 本仓库
2. 新建功能分支
3. 提交代码
4. 新建 Pull Request

本程序供学习交流与合法建站使用。请遵守所在地法律法规，勿用于违法用途。
