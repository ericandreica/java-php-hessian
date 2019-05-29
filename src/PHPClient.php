<?php
include_once("hessianPHP/HessianClient.php");

class PHPClient
{
    function __construct($urlServ)
    {
        echo "Client Hessian PHP: " . $urlServ . "\n";
        $proxy = new HessianClient($urlServ);
        $var = 1;
        while (true) {
            $this->menu();
            echo "Option: ";
            $op = stream_get_line(STDIN, 1024, PHP_EOL);
            $str = strval($op);
            switch ($str) {
                case "0":
                    echo "Exit...";
                    $var = 0;
                    break;
                case "1":
                    echo "List is: " . $proxy->listAll();
                    break;
                case "2":
                    echo "File name: ";
                    $name = stream_get_line(STDIN, 1024, PHP_EOL);
                    echo "Result: " . $proxy->getByName($name);
                    break;
                case "3":
                    echo "Content: ";
                    $content = stream_get_line(STDIN, 1024, PHP_EOL);
                    echo "Result: " . $proxy->getByContentString($content);
                    break;
                case "4":
                    echo "Content: ";
                    $bytes = stream_get_line(STDIN, 1024, PHP_EOL);
                    echo "Result: " . $proxy->getByContentBytes($bytes);
                    break;
                case "5":
                    echo "Hash: ";
                    $hash = stream_get_line(STDIN, 1024, PHP_EOL);
                    echo "Result: " . $proxy->getByHash($hash);
                    break;
                default:
                    echo "Bad input\n";
            }
            echo "\n";
            if ($var == '0')
                break;
        }
    }

    function menu()
    {
        echo "1:List\n";
        echo "2:Get by name\n";
        echo "3:Search by content as string\n";
        echo "4:Search by content as bytes\n";
        echo "5:Search by hash\n";
        echo "0:Exit\n";
    }
}

try {
    new PHPClient("http://localhost:9090/hess");
    //new PHPClient("http://localhost/PHPServer.php");
} catch (Exception $e) {
    echo "Error";
}

