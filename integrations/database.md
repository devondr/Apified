# 🗄 Database

Apified uses PDO for compability.&#x20;

### Configuration

You need to configure Apified to use a Database. Add the following lines to you Apified config:

```php
"db.host" => "<database host>",
"db.port" => "<database port>",
"db.user" => "<database user>",
"db.password" => "<database password>",
"db.name" => "<database name>"
```

{% hint style="warning" %}
Replace `<database host> <database port> <database user>` `<database password>` `<database name>` with your Database host, port, username, password and name.
{% endhint %}

{% hint style="danger" %}
Never use `localhost` as a Database host! Use `127.0.0.1`

If you are using Docker, use the container name as the host.
{% endhint %}

### Query

Making queries is simple. Example:

```php
$api->db_query(`"SELECT * FROM table WHERE 1");
```

This returns an associative array.
