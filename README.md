# Telegram Reminder Bot <br>

you can set a message as reminder in with time, maybe its important or not but this bot will remind you that message on scheduled time
## Usage <br>
Setup the repository <br>
```
git clone https://github.com/coswat/reminder-bot.git
cd reminder-bot
composer install
```
## set your bot token
```php

//ApiController.php
protected string $bot_token = 'BOT TOKEN';

```
## connecting 
```
https://api.telegram.org/bot<<TOKEN HERE>>/setWebhook?url=https://example.com/reminder-bot/index.php

```
## cron job

set example.com/reminder-bot/cron/script.php as cron job link

<p align="center"><a href="https://github.com/coswat/router#coswat"><img src="http://randojs.com/images/barsSmallTransparentBackground.gif" alt="Animated footer bars" width="100%"/></a></p>
<br/>
<p align="center"><a href="https://github.com/coswat/router#"><img src="http://randojs.com/images/backToTopButtonTransparentBackground.png" alt="Back to top" height="29"/></a></p>


