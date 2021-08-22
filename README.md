## Laravel Websocket 使用

### 安装 laravel-websocket 和 pusher 官方 拓展

1. 在 composer.json 里面加入
```json
"beyondcode/laravel-websockets": "^2.0.0",
"pusher/pusher-php-server": "^4.0.0", // 版本有限制，5.0 + 暂不支持
```

2. 发布 laravel-websocket
```bash
php artisan vendor:publish --provider="BeyondCode\LaravelWebSockets\WebSocketsServiceProvider" --tag="migrations"

php artisan migrate

php artisan vendor:publish --provider="BeyondCode\LaravelWebSockets\WebSocketsServiceProvider" --tag="config"
```

3. 修改 env
```
# 必须配置
PUSHER_APP_ID=111
PUSHER_APP_KEY=aaa
PUSHER_APP_SECRET=111
PUSHER_APP_CLUSTER=mt1
```

4. 打开 /config/app.php 注释
```php
App\Providers\AppServiceProvider::class,
App\Providers\AuthServiceProvider::class,
App\Providers\BroadcastServiceProvider::class,  # 打开此处
App\Providers\EventServiceProvider::class,
App\Providers\RouteServiceProvider::class,
```

4. 安装前端拓展
```
npm install laravel-echo
npm install pusher-js
```

5. 修改 /resources/js/bootstrap.js
```js
window._ = require('lodash');

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Echo from "laravel-echo"

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'aaa',
    wsHost: window.location.hostname,
    wsPort: 6001,
    forceTLS: false,
    disableStats: true,
});

window.Echo.channel('test-event')
    .listen('EchoTest', (e) => {
        console.log(e);
    });
```


6. 编译前端
```bash
npm run dev
```

7. 将编辑好的文件引入模版
```html
# 可以直接引入 resources/views/welcome.blade.php
<script src="{{asset("js/app.js")}}"></script>
```

8. 启动websocket服务
```bash
php artisan websockets:serve
```

9. 启动队列
```bash
php artisan queue:work
```

10. 打开一个窗口，访问
```bash
http://echo.test/
```

11. 再打开另一个窗口，访问
```bash
http://echo.test/b

# 如果console里出现

{time: 1629645714, pp: "rrr"}

即成功
```
