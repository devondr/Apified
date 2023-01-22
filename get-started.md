# 🏃♂ Get Started

{% hint style="info" %}
Don't have Apified installed? Go to [#how-to-get-it](./#how-to-get-it "mention")
{% endhint %}

{% hint style="warning" %}
Always replace `<path to Apified folder>` with path to where your Apified files are!
{% endhint %}

Apified has two modes: URL Parameter mode and File mode. URL Parameter mode uses URL Parameters to execute actions, ex. `https://example.com/api.php?action=hello_world`. File mode uses files to operate.

### URL Parameter mode

First, create your endpoint file. We will name it "api.php".\
Paste this code into your file:

```php
<?php 
namespace App;

include_once '<path to Apified folder>/ApiCore.php'
use Apified\ApiCore as API;
use Apified\ApiActions as Actions;

$api = new API([
    'auto.enabled' => true,
    'auto.actionRequired' => true,
]);
$ac = new Actions();

$api->init();
```

Let's break down this code.\
The first line names this namespace 'App'.\
Then we include our Core to our file so we can use Apified.\
Next we declare aliases to our main modules.\
The `$api` variable makes a new instance of our API and enables "auto" mode and makes Apified require an action.\
The last line executes this file.

