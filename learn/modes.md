# 🎚 Modes

Apified works on Actions, they execute based on the Mode.

<details>

<summary>URL Mode</summary>

URL Mode uses URL Parameters to operate. To enable this mode, add the following line to your Apified config:

```json
"url.enabled": true
```

So now your config should look something like this:

```php
$api = new Apified\Core([
    "url.enabled": true
]);
```

Now you can execute action by adding `?action=<actionname>` but it's not required. To make actions required add the following line to Apified config:

```
"url.actionRequired": true
```

Now your config should look like this:

```php
$api = new Apified\Core([
    "url.enabled": true,
    "url.actionRequired": true
]);
```

</details>

<details>

<summary>File Mode</summary>

Make a main file where your config will be. We will name it Main.php. Paste following lines into it:

{% code title="Main.php" lineNumbers="true" %}
```php
<?php

include_once './Apified.php';

$api = new Apified\Core([]);

function getApi() {
  global $api;
  return $api;
}
```
{% endcode %}

The function return the $api variable so we can use it in other files.\
Now create a file named HelloWorld.php and paste following code into it:

{% code title="HelloWorld.php" lineNumbers="true" %}
```php
<?php

include_once './Apified.php';
include_once './Main.php';

$api = getApi();
$ac = new Apified\Actions();

function HelloWorld($params) {
  echo 'Hello World!';
}

$ac->get('HelloWorld', 'HelloWorld', []);

$api->init();
```
{% endcode %}

</details>

<details>

<summary>Manual Mode</summary>

Make a main file where your config will be. We will name it Main.php. Paste following lines into it:

{% code title="Main.php" lineNumbers="true" %}
```php
<?php

include_once './Apified.php';

$api = new Apified\Core([]);
$ac = new Apified\Actions();

function getApi() {
  global $api;
  return $api;
}

function getAc() {
  global $ac;
  return $ac;
}
```
{% endcode %}

The function return the $api variable so we can use it in other files.\
Now create a file named HelloWorld.php and paste following code into it:

{% code title="HelloWorld.php" lineNumbers="true" %}
```php
<?php

include_once './Apified.php';
include_once './Main.php';

$api = getApi();
$ac = getAc();

function HelloWorld($params) {
  echo 'Hello World!';
}

$ac->get('HelloWorld', 'HelloWorld', []);
```
{% endcode %}

Now create another file named Hi.php and paste following code into it:

```php
<?php

include_once './Apified.php';
include_once './HelloWorld.php';

$ac = getAc();

$ac->exec('HelloWorld');
```

</details>

{% hint style="warning" %}
When using File Mode or Manual Mode you **NEED** to use **THE SAME INSTANCE OF APIFIED AND APIFIED ACTIONS OR ELSE IT WILL NOT WORK!**
{% endhint %}
