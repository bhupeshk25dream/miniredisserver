<?php
class GSRedisServer {
    private $data = [];

    public function set($key, $value) {
        $this->data[$key] = $value;
        return "Done";
    }

    public function get($key) {
        return isset($this->data[$key]) ? $this->data[$key] : "(nil)";
    }
}

$redis_server = new GSRedisServer();

while (true) {
    $command = readline("Enter the command: ");
    $args = explode(" ", $command);
    
    if (empty($args)) {
        continue;
    }

    switch ($args[0]) {
        case "SET":
            if (count($args) !== 3) {
                echo "Invalid SET command.\n";
            } else {
                $key = $args[1];
                $value = implode(" ", array_slice($args, 2));
                //$value = $args[2];
                echo $redis_server->set($key, $value) . "\n";
            }
            break;

        case "GET":
            if (count($args) !== 2) {
                echo "Invalid GET command.\n";
            } else {
                $key = $args[1];
                echo $redis_server->get($key) . "\n";
            }
            break;

        case "QUIT":
            echo "Exiting\n";
            exit();
            break;

        default:
            echo "Invalid command. Only supported commands is SET, GET, QUIT\n";
            break;
    }
}

?>
