<?php
/**
 * Created by PhpStorm.
 * User: alpipego
 * Date: 23.07.2017
 * Time: 11:03
 */

namespace Alpipego\AWP\DI;

use Psr\Container\ContainerExceptionInterface;

class ContainerException extends \InvalidArgumentException implements ContainerExceptionInterface
{

}
