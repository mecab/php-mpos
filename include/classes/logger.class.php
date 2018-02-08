<?php 

use Psr\Log\LogLevel;

class Logger {
  private $logger;
  private $logging = false;
  public function __construct($config, $context) {
    if (!$config['logging']['enabled']) {
      return;
    }
    $this->logger = new FileLogger($config, $context);
    $this->logging = true;
    $this->floatStartTime = microtime(true);
  }

  public function log($strType, $strMessage) {
    if (!$this->logging) {
      return;
    }
    // Logmask, we add some infos into the Logger
    $strMask = "[ %12s ] [ %8s | %-8s ] [ %7.7s ] : %s";
    $strIPAddress = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'unknown';
    $strPage = isset($_REQUEST['page']) ? $_REQUEST['page'] : 'none';
    $strAction = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'none';
    $strMessage = sprintf($strMask, $strIPAddress, $strPage, $strAction, number_format(round((microtime(true) - $this->floatStartTime) * 1000, 2), 2), $strMessage);
    $this->logger->log($strType, $strMessage);
  }
}
$log = new Logger($config, 'website');
