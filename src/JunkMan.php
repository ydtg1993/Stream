<?php
/**
 * Created by PhpStorm.
 * User: Hikki
 * Date: 2018/11/22 0022
 * Time: 下午 2:27
 */

namespace JunkMan;

use JunkMan\Operation\OperateFlood;
use JunkMan\Operation\OperateSpot;
use JunkMan\Operation\OperateStream;

class JunkMan
{
    /**
     * project root path
     */
    const ROOT_PATH = __DIR__;

    /**
     * @var OperateStream
     */
    private static $STEAM;

    /**
     * @var OperateFlood
     */
    private static $FLOOD;

    /**
     * trace the code bloke.collect the GC stream
     *
     * @return OperateStream
     */
    public static function stream()
    {
        self::$STEAM = OperateStream::getInstance();
        return self::$STEAM;
    }

    /**
     * trace the code bloke.if your task executes too much time.
     * flush the stream of the trace block.
     *
     * @return OperateFlood
     */
    public static function flood()
    {
        self::$FLOOD = OperateFlood::getInstance();
        return self::$FLOOD;
    }

    /**
     * collect the variable
     *
     * @return OperateSpot
     */
    public static function spot()
    {
        return new OperateSpot();
    }
}