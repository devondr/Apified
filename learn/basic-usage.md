# 🪄 Basic Usage

Let's create a new file named Example.php. Don't forget to put Apified.php into the same folder as our new file!

Firstly, we need to import Apified into our file. We will use `include_once`.

{% code title="Example.php" lineNumbers="true" %}
```php
<?php

include_once './Apified.php';
```
{% endcode %}

Now we can use the power of Apified.\
Next we need to create a new instance of Apified.

<pre class="language-php" data-title="Example.php" data-line-numbers><code class="lang-php">&#x3C;?php

include_once './Apified.php';

<strong>$api = new Apified\Core([]); // Create a new instance of Apified
</strong></code></pre>

The `[]` in `Apified\Core()` means that we are creating Apified intance with empty config.

We have Apified in our project, but it doesn't do anything. Let's change that!\
Create and instance of Apified Actions and create a function named `HelloWorld` with argument `$params` that echoes "Hello World!" on call.

<pre class="language-php" data-title="Example.php" data-line-numbers><code class="lang-php">&#x3C;?php

include_once './Apified.php';

$api = new Apified\Core([]); // Create a new instance of Apified
<strong>$ac = new Apified\Actions(); // Create a new instance of Apified Actions
</strong>
<strong>// Example Function
</strong><strong>function HelloWorld($params) {
</strong><strong>    echo "Hello World!";
</strong><strong>}
</strong></code></pre>

Beautiful! Now the only thing we need is to register the action and execute the script!

<pre class="language-php" data-title="Example.php" data-line-numbers><code class="lang-php">&#x3C;?php

include_once './Apified.php';

$api = new Apified\Core([]); // Create a new instance of Apified
$ac = new Apified\Actions(); // Create a new instance of Apified Actions

// Example Function
function HelloWorld($params) {
    echo "Hello World!";
}

<strong>// Register a GET action.
</strong><strong>$ac->get(
</strong><strong>    'HelloWorld', // Action Name
</strong><strong>    'HelloWorld', // Function Name
</strong><strong>    [] // Arguments - we don't need any
</strong><strong>);
</strong>
<strong>$api->init(); // Execute the script
</strong></code></pre>

Now if you will go to `http://yourwebsite.com/?action=HelloWorld` (replace yourwebsite.com with your domain!) you'll notice that nothing happened...\
That's because we don't have URL Mode enabled! (See [#url-mode](modes.md#url-mode "mention"))\
To fix this, just add these two lines to our Apified config:

<pre class="language-php" data-title="Example.php" data-line-numbers><code class="lang-php">&#x3C;?php

include_once './Apified.php';

$api = new Apified\Core([ // Create a new instance of Apified
<strong>    "url.enabled": true,
</strong><strong>    "url.actionRequired": true
</strong>]); 
$ac = new Apified\Actions(); // Create a new instance of Apified Actions

// Example Function
function HelloWorld($params) {
    echo "Hello World!";
}

// Register a GET action.
$ac->get(
    'HelloWorld', // Action Name
    'HelloWorld', // Function Name
    [] // Arguments - we don't need any
);

$api->init(); // Execute the script
</code></pre>

Now refresh the page and see the result!

If try remove the `?action=HelloWorld` from the URL. A `{"error":"No action specified"}` should show up. To disable the message change `true` to `false` in `"url.actionRequired": true`.
