<?php
abstract class AbstractLogger {
  /**
   * An abstract class to provide the adaptor layer between logging functions
   * used inside mpos and PSR-3 compatible logger.
   *
   * Concrete implementations should set PSR-3 logging class to
   * $this->concreteLogger
   */

  protected $concreteLogger;
  protected $context;

  public function __construct($config, $context) {
      $this->context = $context;
  }

  public function log($strType, $strMessage) {
    switch ($strType) {
      case 'emerg':
        $this->concreteLogger->emergency($strMessage);
        break;
      case 'alert':
        $this->concreteLogger->alert($strMessage);
        break;
      case 'crit':
        $this->concreteLogger->critical($strMessage);
        break;
      case 'error':
        $this->concreteLogger->error($strMessage);
        break;
      case 'warn':
        $this->concreteLogger->warning($strMessage);
        break;
      case 'notice':
        $this->concreteLogger->notice($strMessage);
        break;
      case 'info':
        $this->concreteLogger->info($strMessage);
        break;
      case 'fatal':
        // The loglevel 'fatal' is not defined in PSR-3.
        // We map it to fatal for backward compatibility
        // that is the way KLogger did.
        //
        // See https://github.com/MPOS/php-mpos/blob/b7b45eb580dfd7f683540b519a66e14d3fe8321d/include/lib/KLogger.php#L47

        $this->concreteLogger->critical($strMessage);
        break;
      case 'debug':
        $this->concreteLogger->debug($strMessage);
        break;
      case '':
        $this->concreteLogger->critical($strMessage);
        break;
      }

    return true;
  }

  // Adaptors for old KLogger style logging function follow

  public function logEmerg($strMessage) {
    return $this->log('emerg', $strMessage);
  }

  public function logAlert($strMessage) {
    return $this->log('alert', $strMessage);
  }

  public function logCrit($strMessage) {
    return $this->log('crit', $strMessage);
  }

  public function logError($strMessage) {
    return $this->log('error', $strMessage);
  }

  public function logWarn($strMessage) {
    return $this->log('warn', $strMessage);
  }

  public function logNotice($strMessage) {
    return $this->log('notice', $strMessage);
  }

  public function logInfo($strMessage) {
    return $this->log('info', $strMessage);
  }

  public function logFatal($strMessage) {
    return $this->log('fatal', $strMessage);
  }

  public function logDebug($strMessage) {
    return $this->log('debug', $strMessage);
  }
}
