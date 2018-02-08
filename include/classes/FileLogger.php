<?php
class FileLogger extends AbstractLogger {
  public function __construct($config, $context) {
    $this->concreteLogger = new Katzgrau\KLogger\Logger($config['logging']['path'] . '/' . $context, $config['logging']['level']);
  }
}
