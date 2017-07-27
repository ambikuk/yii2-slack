# Yii2 Slack integration

## Installation

add

```
"ambikuk/yii2-slack": "*"
```

to the ```require``` section of your `composer.json` file.

this extension just wrapper to https://github.com/maknz/slack

Also, you should configure [incoming webhook](https://api.slack.com/incoming-webhooks) inside your Slack team.

## Usage

Configure component:

```php
...
    'components' => [
        'slack' => [
            'class' => 'ambikuk\yiislack\Slack',
            'url' => '<slack incoming webhook url here>',
            'username' => 'Slack Bot',
            'channel' => '#channel'
        ],
    ],
...
```

Now you can send messages right into slack channel via next command:

```php
Yii::$app->slack->send('New alert from the monitoring system', [
    'fallback' => 'Current server stats',
    'text' => 'Current server stats',
    'color' => 'danger',
    'fields' => [
        [
          'title' => 'CPU usage',
          'value' => '90%',
          'short' => true // whether the field is short enough to sit side-by-side other fields, defaults to false
        ],
        [
          'title' => 'RAM usage',
          'value' => '2.5GB of 4GB',
          'short' => true
        ]
    ]
]);
```
