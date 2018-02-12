<?php
use Google\Cloud\Logging\LoggingClient;

class GCPLogger extends AbstractLogger {
  public function __construct($config, $context) {
    $loggingClient = new LoggingClient([
      'keyFilePath' => @$config['logging']['gcp']['keyFilePath'],
      'projectId' => $config['logging']['gcp']['projectId']
    ]);
    $this->concreteLogger = $loggingClient->psrLogger($config['logging']['gcp']['logNamePrefix'] . '-' . $context);
  }
}

