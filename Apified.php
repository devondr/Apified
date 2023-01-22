<?php

namespace Apified;

class Core
{
    # Default settings
    private $defaultSettings = [
        'url.enabled' => false,
        'url.actionRequired' => false,
        'db.host' => null,
        'db.port' => null,
        'db.user' => null,
        'db.password' => null,
        'db.name' => null,
    ];

    # New settings
    private $settings = [];

    private $conn;

    public function __construct($settings = null)
    {
        $this->setup($settings);
    }

    public function setup($settings = null)
    {
        $this->settings = array_merge([], $this->defaultSettings);
        if ($settings != null) {
            foreach ($settings as $key => $value) {
                $this->settings[$key] = $value;
            }
            if (@$settings['db.host'] != null) {
                $this->conn = $this->setupDatabase($settings);
            }
        }
    }

    public function setupDatabase($settings)
    {
        $host = $settings['db.host'];
        $port = $settings['db.port'];
        $user = $settings['db.user'];
        $pass = $settings['db.password'];
        $db = $settings['db.name'];
        try {
            $conn = new \PDO("mysql:host=$host;port=$port;dbname=$db", $user, $pass);
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (\PDOException $e) {
            http_response_code(500);
            util_encode(["error" => "Could not connect to the database. This is a server-side problem, please contact the administrator with this message.", "message" => $e->getMessage()]);
            exit;
        }
    }

    public function db_query($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $result = $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }

    public function get($k)
    {
        return $this->settings[$k];
    }

    public function init()
    {
        $settings = $this->settings;

        if ($settings['url.enabled'] == true) {

            if ($settings['url.actionRequired'] == true) {
                if (!isset($_GET['action'])) {
                    http_response_code(400);
                    util_encode(['error' => 'No action specified']);
                    exit;
                }
                $ac_name = $_GET['action'];
                (new Actions())->exec($ac_name);
            }
        }
    }
}

$ac_array = [];

class Actions
{
    public function __construct()
    {
    }

    public function get($name, $function, $args = [])
    {
        global $ac_array;
        if (@$ac_array[$name] != null) {
            http_response_code(500);
            util_encode(['error' => "Action with name '$name' already exists"]);
            return;
        }
        $ac_array[$name] = ['function' => $function, 'args' => $args, 'method' => 'GET'];
    }

    public function post($name, $function, $args = [])
    {
        global $ac_array;
        if (@$ac_array[$name] != null) {
            http_response_code(500);
            util_encode(['error' => "Action with name '$name' already exists"]);
            return;
        }
        $ac_array[$name] = ['function' => $function, 'args' => $args, 'method' => 'POST'];
    }

    public function exec($name)
    {
        global $ac_array;
        if (@$ac_array[$name] == null) {
            http_response_code(404);
            util_encode(['error' => "Unknown action '$name'"]);
            return;
        }
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                if ($ac_array[$name]['method'] == 'GET') {
                    foreach ($ac_array[$name]['args'] as $arg) {
                        if (!isset($_GET[$arg])) {
                            http_response_code(400);
                            util_encode(['error' => "Missing argument '$arg'"]);
                            return;
                        }
                        $ac_params[$arg] = $_GET[$arg];
                    }
                } else {
                    http_response_code(405);
                    util_encode(['error' => 'Invalid method']);
                    return;
                }
                break;
            case 'POST':
                if ($ac_array[$name]['method'] == 'POST') {
                    $json = json_decode(file_get_contents('php://input'), true);
                    foreach ($ac_array[$name]['args'] as $arg) {
                        if (!isset($json[$arg])) {
                            http_response_code(400);
                            util_encode(['error' => "Missing argument '$arg'"]);
                            return;
                        }
                        $ac_params[$arg] = $json[$arg];
                    }
                } else {
                    http_response_code(405);
                    util_encode(['error' => 'Invalid method']);
                    return;
                }
                break;
        }
        $ac_array[$name]['function']($ac_params);
    }
}



# Utils
function util_encode($array = [], $echo = true)
{
    if ($echo)
        echo json_encode($array);
    else
        return json_encode($array);
}
