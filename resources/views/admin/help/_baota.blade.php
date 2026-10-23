@php
    $cronLine = \App\Support\PhpCli::scheduleCronLine();
    $baotaScript = preg_replace('/^\* \* \* \* \* /', '', $cronLine) ?: $cronLine;
    $baotaExample = '/www/server/php/84/bin/php /www/wwwroot/你的站点/artisan schedule:run >> /dev/null 2>&1';
    $baotaFill = str_contains($baotaScript, 'php-fpm') ? $baotaExample : $baotaScript;
    $menus = ['首页', '网站', 'FTP', '数据库', '监控', '安全', '文件', '计划任务', '软件商店', '设置'];
    $photo = function (string $file): string {
        $name = $file === '2-root.png' ? '3-run.png' : $file;
        $rel = 'assets/images/guide/'.$name;
        $abs = public_path($rel);
        if (! is_file($abs)) {
            return '';
        }

        return asset($rel).'?v='.filemtime($abs);
    };
@endphp
@once
<style>
.baota-lead { margin: 0 0 8px; color: var(--muted, #4e5969); line-height: 1.65; font-size: 15px; }
.baota-steps { list-style: none; margin: 0; padding: 0; }
.baota-steps > li { display: block; padding: 22px 0 6px; border-top: 1px solid var(--line, #e5e6eb); }
.baota-steps > li:first-child { border-top: 0; padding-top: 8px; }
.baota-copy h3 { margin: 0 0 6px; font-size: 20px; }
.baota-copy p { margin: 0 0 12px; color: var(--text, #1d2129); line-height: 1.7; font-size: 15px; }
.baota-fig { margin: 0 0 8px; }
.baota-note { margin: 8px 0 0; font-size: 14px; color: #86909c; line-height: 1.55; }
.bt-photo { display: block; width: 100%; height: auto; border: 1px solid #d0d5dd; border-radius: 8px; }
.bt-shot { border: 1px solid #c5cad3; border-radius: 8px; overflow: hidden; background: #eef0f3; box-shadow: 0 10px 28px rgba(20, 24, 32, .12); }
.bt-chrome { display: flex; align-items: center; gap: 6px; height: 32px; padding: 0 12px; background: #eceff3; border-bottom: 1px solid #d5d9e0; color: #4e5969; font-size: 12px; }
.bt-chrome i { width: 9px; height: 9px; border-radius: 50%; background: #c5c8ce; display: block; }
.bt-chrome b { margin-left: 6px; color: #1d2129; font-weight: 600; }
.bt-app { display: grid; grid-template-columns: 132px minmax(0, 1fr); min-height: 250px; }
.bt-side { background: #2c3338; color: #d5d8de; padding: 8px 0 12px; font-size: 13px; }
.bt-side div { padding: 8px 14px; }
.bt-side .on { background: #20a53a; color: #fff; font-weight: 700; }
.bt-main { padding: 14px; min-width: 0; }
.bt-search { display: flex; gap: 8px; margin-bottom: 10px; }
.bt-search span, .bt-input, .bt-select { background: #fff; border: 1px solid #d9dde3; border-radius: 3px; padding: 7px 10px; font-size: 13px; color: #1d2129; }
.bt-search span { flex: 1; color: #86909c; }
.bt-table { width: 100%; border-collapse: collapse; background: #fff; font-size: 13px; }
.bt-table th, .bt-table td { text-align: left; padding: 10px 12px; border-bottom: 1px solid #eee; }
.bt-table th { background: #fafafa; color: #4e5969; font-weight: 600; }
.bt-table tr.is-dim { color: #a0a6b0; }
.bt-btn { display: inline-block; padding: 4px 12px; border-radius: 3px; background: #20a53a; color: #fff; font-style: normal; font-size: 13px; font-weight: 700; }
.bt-btn.is-plain { background: #fff; color: #4e5969; border: 1px solid #d9dde3; font-weight: 600; }
.bt-hit { outline: 3px solid #e23d3d; outline-offset: 3px; }
.bt-call { display: inline-block; margin-left: 8px; padding: 2px 8px; border-radius: 99px; background: #e23d3d; color: #fff; font-size: 12px; font-weight: 700; vertical-align: middle; }
.bt-form { background: #fff; border: 1px solid #e6e8eb; border-radius: 4px; padding: 14px 16px; display: flex; flex-direction: column; gap: 12px; }
.bt-line { display: grid; grid-template-columns: 88px minmax(0, 1fr); gap: 10px; align-items: center; font-size: 13px; }
.bt-line > span { color: #4e5969; }
.bt-input, .bt-select { display: block; width: 100%; box-sizing: border-box; word-break: break-all; }
.bt-input.is-bad { background: #fdecea; border-color: #e7a3a3; color: #b71c1c; text-decoration: line-through; }
.bt-input.is-good, .bt-select.is-good { background: #e8f5e9; border-color: #8fce96; color: #1b5e20; font-weight: 700; }
.bt-url { padding: 10px 12px; border-radius: 6px; background: #fff; border: 1px solid #8fce96; color: #1b5e20; font-weight: 700; font-size: 16px; word-break: break-all; }
.bt-script { margin: 0; padding: 10px; border-radius: 4px; background: #1e2228; color: #d6f5d6; font-size: 12px; line-height: 1.5; white-space: pre-wrap; word-break: break-all; font-family: Consolas, "SF Mono", Menlo, monospace; }
.bt-browser { background: #fff; }
.bt-addr { display: flex; align-items: center; gap: 8px; padding: 10px 12px; background: #f4f5f7; border-bottom: 1px solid #e5e6eb; }
@media (max-width: 760px) {
    .bt-app { grid-template-columns: 92px minmax(0, 1fr); }
    .bt-side { font-size: 12px; }
    .bt-side div { padding: 7px 8px; }
    .bt-line { grid-template-columns: 72px minmax(0, 1fr); }
    .baota-copy h3 { font-size: 18px; }
}
</style>
@endonce
<div class="card guide" id="baota-guide">
    <div class="pane">
        <h2>宝塔怎么配</h2>
        <p class="baota-lead">不用学命令。左边菜单的名字和面板里一样，<strong>红圈就是要点的地方</strong>。面板换了皮肤也没关系，认字就行。</p>
        <ol class="baota-steps">
            <li>
                <div class="baota-copy">
                    <h3>第 1 步　安装 PHP 8.4</h3>
                    <p>左边点「软件商店」，搜索 PHP。认准 <strong>PHP-8.4</strong> 那一行。右边还是「安装」就点安装；已经是「设置」和「卸载」，就是装好了。装完后，网站的 PHP 版本选 8.4。</p>
                </div>
                <figure class="baota-fig">
                    @if($photo('1-php.png') !== '')
                        <img class="bt-photo" src="{{ $photo('1-php.png') }}" alt="软件商店安装 PHP 8.4">
                    @else
                    <div class="bt-shot">
                        <div class="bt-chrome"><i></i><i></i><i></i><b>软件商店</b></div>
                        <div class="bt-app">
                            <aside class="bt-side">
                                @foreach($menus as $name)
                                    <div @class(['on' => $name === '软件商店'])>{{ $name }}</div>
                                @endforeach
                            </aside>
                            <div class="bt-main">
                                <div class="bt-search"><span>搜索：PHP</span></div>
                                <table class="bt-table">
                                    <thead><tr><th>名称</th><th>状态</th><th>操作</th></tr></thead>
                                    <tbody>
                                        <tr class="is-dim"><td>PHP-7.4</td><td>未安装</td><td><em class="bt-btn is-plain">安装</em></td></tr>
                                        <tr>
                                            <td>PHP-8.4</td>
                                            <td>未安装</td>
                                            <td><em class="bt-btn bt-hit">安装</em><span class="bt-call">点这里</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif
                    <p class="baota-note">红圈在 PHP-8.4 右边的「安装」。灰色那一行不要当网站 PHP。装好后点「设置」，打开「禁用函数」，删掉 putenv、proc_open、shell_exec、exec、symlink、popen。安装页会列出还禁用着的名字。</p>
                </figure>
            </li>
            <li>
                <div class="baota-copy">
                    <h3>第 2 步　运行目录选 /public</h3>
                    <p>左边点「网站」，点你的域名，再点「设置」里的「网站目录」。「网站目录」保持项目根，例如 <strong>/www/wwwroot/你的域名</strong>。下面的「运行目录」从 <strong>/</strong> 改成 <strong>/public</strong>，再点保存。页面上没有「运行目录」时，把网站目录末尾改成 <strong>/public</strong>。没改的话，打开首页是空白的 404，项目根里的说明页会告诉你点哪里。</p>
                </div>
                <figure class="baota-fig">
                    @if($photo('2-root.png') !== '')
                        <img class="bt-photo" src="{{ $photo('2-root.png') }}" alt="网站目录填写 public">
                    @else
                    <div class="bt-shot">
                        <div class="bt-chrome"><i></i><i></i><i></i><b>网站 · 设置 · 网站目录</b></div>
                        <div class="bt-app">
                            <aside class="bt-side">
                                @foreach($menus as $name)
                                    <div @class(['on' => $name === '网站'])>{{ $name }}</div>
                                @endforeach
                            </aside>
                            <div class="bt-main">
                                <div class="bt-form">
                                    <div class="bt-line"><span>域名</span><b class="bt-input">你的域名</b></div>
                                    <div class="bt-line"><span>网站目录</span><b class="bt-input">/www/wwwroot/你的域名</b></div>
                                    <div class="bt-line"><span>现在</span><b class="bt-input is-bad">运行目录 /</b></div>
                                    <div class="bt-line">
                                        <span>运行目录</span>
                                        <b class="bt-input is-good bt-hit">/public</b>
                                    </div>
                                    <div><span class="bt-call">改成 /public，再点保存</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <p class="baota-note">网站目录保持项目根。红字那行是还没改的运行目录，绿框 /public 才是要点保存的。</p>
                </figure>
            </li>
            <li>
                <div class="baota-copy">
                    <h3>第 3 步　两个文件夹允许写入</h3>
                    <p>左边点「文件」，打开网站目录，要能看见 <strong>public</strong> 和 <strong>storage</strong>。勾上 <strong>bootstrap</strong> 和 <strong>storage</strong> 两个文件夹。右上角点「更多」，再点「权限」。所有者保持 <strong>www</strong>，勾上「应用到子目录」，点绿色「确认」。上面三列勾选不用改。不改的话，安装页会打不开。</p>
                </div>
                <figure class="baota-fig">
                    @if($photo('3-perm-open.png') !== '' || $photo('3-perm.png') !== '')
                        @if($photo('3-perm-open.png') !== '')
                            <img class="bt-photo" src="{{ $photo('3-perm-open.png') }}" alt="勾上 bootstrap 和 storage，再点更多里的权限">
                        @endif
                        @if($photo('3-perm.png') !== '')
                            <img class="bt-photo" src="{{ $photo('3-perm.png') }}" alt="所有者保持 www，勾上应用到子目录后确认" style="margin-top:12px">
                        @endif
                    @else
                    <div class="bt-shot">
                        <div class="bt-chrome"><i></i><i></i><i></i><b>文件 · 权限</b></div>
                        <div class="bt-app">
                            <aside class="bt-side">
                                @foreach($menus as $name)
                                    <div @class(['on' => $name === '文件'])>{{ $name }}</div>
                                @endforeach
                            </aside>
                            <div class="bt-main">
                                <div class="bt-form">
                                    <div class="bt-line"><span>当前目录</span><b class="bt-input">/www/wwwroot/你的域名</b></div>
                                    <div class="bt-line"><span>选中</span><b class="bt-input">storage、bootstrap/cache</b></div>
                                    <div class="bt-line">
                                        <span>所有者</span>
                                        <b class="bt-input is-good bt-hit">www</b>
                                    </div>
                                    <div><span class="bt-call">所有者填 www，并允许写入</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <p class="baota-note">只改这两个文件夹。不要把整个磁盘都交给 www。</p>
                </figure>
            </li>
            <li>
                <div class="baota-copy">
                    <h3>第 4 步　用浏览器打开安装页</h3>
                    <p>地址栏输入你的域名，后面加上 <strong>/install</strong>。页面上只有三步：环境检查、数据库、管理员。自己先试用就选「文件数据库」。正式站选 MySQL，先在左边「数据库」里建一个空库。</p>
                </div>
                <figure class="baota-fig">
                    @if($photo('4-install.png') !== '')
                        <img class="bt-photo" src="{{ $photo('4-install.png') }}" alt="浏览器打开 /install">
                    @else
                    <div class="bt-shot bt-browser">
                        <div class="bt-chrome"><i></i><i></i><i></i><b>浏览器</b></div>
                        <div class="bt-addr">
                            <b class="bt-url bt-hit">http://你的域名/install</b>
                            <span class="bt-call">地址栏这样写</span>
                        </div>
                        <div class="bt-main">
                            <div class="bt-form">
                                <div class="bt-line"><span>第 1 步</span><b class="bt-input is-good">环境检查</b></div>
                                <div class="bt-line"><span>第 2 步</span><b class="bt-input">数据库</b></div>
                                <div class="bt-line"><span>第 3 步</span><b class="bt-input">管理员</b></div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <p class="baota-note">已经用域名开站了，就不要再运行 php artisan serve。</p>
                </figure>
            </li>
            <li>
                <div class="baota-copy">
                    <h3>第 5 步　计划任务，每分钟一次</h3>
                    <p>左边最下面点红框里的「计划任务」，再点绿色「添加任务」。任务类型保持 <strong>Shell 脚本</strong>。任务名称写「苹果定时」。执行周期不要用现在的「每天」，点开改成 <strong>N分钟</strong>，数字填 <strong>1</strong>。脚本框只粘贴下面这一行，不要自己加星号，也不要写成 php-fpm。最后点绿色「确定」。不添加这一条，采集不会自己跑。</p>
                    <div class="code">
                        <button type="button" class="copy" data-copy>复制</button>
                        <pre><code>{{ $baotaFill }}</code></pre>
                    </div>
                </div>
                <figure class="baota-fig">
                    @if($photo('5-cron-open.png') !== '' || $photo('5-cron.png') !== '')
                        @if($photo('5-cron-open.png') !== '')
                            <img class="bt-photo" src="{{ $photo('5-cron-open.png') }}" alt="左边点计划任务，再点添加任务">
                        @endif
                        @if($photo('5-cron.png') !== '')
                            <img class="bt-photo" src="{{ $photo('5-cron.png') }}" alt="计划任务里改成每分钟并贴上命令" style="margin-top:12px">
                        @endif
                    @else
                    <div class="bt-shot">
                        <div class="bt-chrome"><i></i><i></i><i></i><b>计划任务</b></div>
                        <div class="bt-app">
                            <aside class="bt-side">
                                @foreach($menus as $name)
                                    <div @class(['on' => $name === '计划任务'])>{{ $name }}</div>
                                @endforeach
                            </aside>
                            <div class="bt-main">
                                <div class="bt-form">
                                    <div class="bt-line"><span>任务类型</span><b class="bt-select is-good bt-hit">Shell 脚本</b></div>
                                    <div class="bt-line"><span>执行周期</span><b class="bt-select is-good">N 分钟 · 1</b></div>
                                    <div class="bt-line"><span>脚本内容</span><pre class="bt-script">{{ $baotaFill }}</pre></div>
                                    <div><em class="bt-btn bt-hit">添加任务</em><span class="bt-call">填完点这个</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <p class="baota-note">命令里要能看到 bin/php。如果出现 php-fpm，换成 bin/php 再添加。</p>
                </figure>
            </li>
        </ol>
    </div>
</div>
