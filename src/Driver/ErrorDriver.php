<?php
/**
 * Created by PhpStorm.
 * User: ydtg1
 * Date: 2018/9/2
 * Time: 17:29
 */
namespace JunkMan\Driver;

use JunkMan\Abstracts\Singleton;
use JunkMan\Container\Collector;
use JunkMan\E\IoException;
use JunkMan\E\OperateException;
use JunkMan\Instrument\Io;
use JunkMan\Pipeline\TcpSender;
use JunkMan\Resolver\StreamAnalyze;

/**
 * Class StreamDriver
 * @package JunkMan\Driver
 */
class ErrorDriver extends Singleton implements DriverInterface
{
    private $SENDER = null;

    /**
     * @var Collector
     */
    private $collector;

    public function execute($collector = null)
    {
        $this->collector = $collector;
        $file = $this->collector->getTemp() . Collector::STREAM_SUFFIX;
        $head = $this->collector->getHeader();
        try {
            if (!is_file($file)) {
                throw new IoException('not found stream file');
            }

            $this->SENDER = (new TcpSender(Collector::SERVER, Collector::PORT))->setHead($head);
            //trace
            $trace_file = $this->collector->getTraceFile();
            if (is_file($trace_file)) {
                $trace_file = Io::cutFile(
                    $trace_file,
                    $this->collector->getTraceStart() - 5,
                    $this->collector->getErrorMessage()['error_line'] + 5
                );
                $this->SENDER->write(['trace_file' => $trace_file]);
            }

            $this->SENDER->write($this->collector->getErrorMessage());
        } catch (\Exception $e) {
            throw new OperateException($e->getMessage());
        } finally {
            $this->SENDER = null;
            $this->collector = null;
            if (is_file($file)) {
                @unlink($file);
            }
        }
    }

}