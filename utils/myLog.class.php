<?php 
class MyLog{
    private $log;

    private function __construct(string $filename){
        $this->log = new Monolog\Logger('name');
        $this->log->pushHandler(
            new Monolog\Handler\StreamHandler('logs/proyecto.log', Monolog\Logger::INFO));
    }
}
?>