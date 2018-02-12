<?php
class LoggerFactory {
  public static function createLogger($config, $context) {
    if ($config['logging']['module'] == 'gcp') {
      return new GCPLogger($config, $context);
    }
    else if ($config['logging']['module'] == 'file') {
      return new FileLogger($config, $context);
    }
    else {
      die("Invalid logger module specified. Check \$config['logging']['logger']");
    }
  }
}
