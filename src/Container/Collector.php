<?php
/**
 * Created by PhpStorm.
 * User: Hikki
 * Date: 2018/8/19
 * Time: 22:36
 */

namespace JunkMan\Container;

use JunkMan\Pipeline\PipelineInterface;
use JunkMan\Pipeline\Sender;

date_default_timezone_set('Asia/Shanghai');

/**
 * Class Collector
 * @package JunkMan\Container
 */
class Collector
{
    private static $SERVER;
    private static $PORT;

    /**
     * suffix
     */
    const STREAM_SUFFIX = '.xt';

    /**
     * trace type
     */
    const TRACE_STREAM = 'stream';
    const TRACE_FLUSH = 'flush';
    const TRACE_SPOT = 'spot';
    const TRACE_ERR = 'error';

    /**
     * communication status
     */
    const STATUS_START = 'start';
    const STATUS_ING = 'ing';
    const STATUS_END = 'end';

    /**
     * trace file cut paragraph
     */
    const SIDE_LINE = 1;

    public $message = [
        'agent' => 'server',
        'status' => '',
        'title' => '',
        'time' => 0,
        'secret' => '',
        'temp_file' => '',
        'trace_file' => '',
        'trace_file_content' => '',
        'stream_type' => '',
        'extend' => ''
    ];

    private $status;
    private $time;
    private $secret;
    private $temp;
    private $stream_title;
    private $trace_file;
    private $trace_start;
    private $trace_end;
    private $trace_type;
    private $extend;

    private $SENDER;

    public function __construct()
    {
        $this->setTime(time());
    }

    public function setConfig($config)
    {
        self::$SERVER = $config['server'];
        self::$PORT = $config['port'];
    }

    /**
     * @return mixed
     */
    public function getSENDER()
    {
        $this->SENDER = Sender::getInstance(['server' => self::$SERVER, 'port' => self::$PORT]);
        return $this->SENDER;
    }

    /**
     * @return mixed
     */
    public function getTraceType()
    {
        return $this->trace_type;
    }

    /**
     * @param mixed $trace_type
     */
    public function setTraceType($trace_type)
    {
        $this->trace_type = $trace_type;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

    /**
     * @return mixed
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @param mixed $secret
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
    }

    /**
     * @return mixed
     */
    public function getTemp()
    {
        return $this->temp;
    }

    /**
     * @param mixed $temp
     */
    public function setTemp($temp)
    {
        $this->temp = $temp;
    }

    /**
     * @return mixed
     */
    public function getStreamTitle()
    {
        return $this->stream_title;
    }

    /**
     * @param mixed $stream_title
     */
    public function setStreamTitle($stream_title)
    {
        $this->stream_title = $stream_title;
    }

    /**
     * @return mixed
     */
    public function getTraceFile()
    {
        return $this->trace_file;
    }

    /**
     * @param mixed $trace_file
     */
    public function setTraceFile($trace_file)
    {
        $this->trace_file = $trace_file;
    }

    /**
     * @return mixed
     */
    public function getTraceStart()
    {
        return $this->trace_start;
    }

    /**
     * @param mixed $trace_start
     */
    public function setTraceStart($trace_start)
    {
        $this->trace_start = $trace_start;
    }

    /**
     * @return mixed
     */
    public function getTraceEnd()
    {
        return $this->trace_end;
    }

    /**
     * @param mixed $trace_end
     */
    public function setTraceEnd($trace_end)
    {
        $this->trace_end = $trace_end;
    }

    /**
     * @return mixed
     */
    public function getExtend()
    {
        return $this->extend;
    }

    /**
     * @param mixed $extend
     */
    public function setExtend($extend)
    {
        $this->extend = $extend;
    }
}