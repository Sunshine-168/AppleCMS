<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>安装完毕</title>
    <link rel="stylesheet" href="{{ asset('css/install.css') }}?v={{ @filemtime(public_path('css/install.css')) ?: '1' }}">
</head>
<body>
<div class="wrap install-done">
    <div class="brand"><span class="logo">苹</span> 苹果v12 安装</div>
    <div class="card" style="display:block">
        <div class="done">
            <div class="mark">✓</div>
            <h1>安装完毕</h1>
            <p class="muted"><strong>{{ $siteName }}</strong> 可以使用了。请用刚才设置的密码登录后台。</p>
            <p class="account">后台账号 <strong>{{ $username }}</strong></p>
            @if($demo)
                <p class="hint">已写入默认分类和示例影片。采集资源前，先在「采集资源」里绑定分类。</p>
            @endif
            @php
                $baotaCron = preg_replace('/^\* \* \* \* \* /', '', \App\Support\PhpCli::scheduleCronLine());
            @endphp
            <div class="install-next">
                <h2>还差这一步</h2>
                <p>宝塔用户：计划任务新建 Shell 脚本，周期选每分钟，粘贴下面这一行。不配的话，采集和监控不会自己跑。</p>
                <div class="code">
                    <button type="button" class="copy" data-copy>复制</button>
                    <pre><code>{{ $baotaCron }}</code></pre>
                </div>
                <p class="hint">命令里要是 <code>bin/php</code>，不要用 <code>php-fpm</code>。照着哪一栏填，看 <a href="{{ url('/install?way=baota') }}#baota-guide">宝塔图解</a>。</p>
            </div>
            <div class="btns">
                <a class="btn" href="{{ url('/admin/login') }}">进入后台</a>
                <a class="btn-muted" href="{{ url('/') }}">打开前台</a>
                <a class="btn-muted" href="{{ url('/install?way=baota') }}">宝塔图解</a>
                <a class="btn-muted" href="{{ url('/install?way=deploy') }}">上线部署说明</a>
            </div>
        </div>
    </div>
</div>
<script>
document.querySelectorAll('[data-copy]').forEach(function (btn) {
    btn.addEventListener('click', function () {
        var code = btn.parentElement && btn.parentElement.querySelector('code');
        if (!code) return;
        var text = code.innerText;
        function done() {
            btn.textContent = '已复制';
            setTimeout(function () { btn.textContent = '复制'; }, 1500);
        }
        function fallback() {
            var ta = document.createElement('textarea');
            ta.value = text;
            ta.setAttribute('readonly', '');
            ta.style.position = 'fixed';
            ta.style.left = '-9999px';
            document.body.appendChild(ta);
            ta.select();
            try { document.execCommand('copy'); done(); } catch (e) {}
            document.body.removeChild(ta);
        }
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(text).then(done).catch(fallback);
        } else {
            fallback();
        }
    });
});
</script>
</body>
</html>
