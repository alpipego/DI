<?php
/**
 * Created by PhpStorm.
 * User: alpipego
 * Date: 07.08.2017
 * Time: 12:47
 */
declare(strict_types=1);

namespace Alpipego\AWP\DI\Cache;

use Alpipego\AWP\DI\ContainerInterface;
use Alpipego\AWP\DI\Exception\ContainerCacheException;

final class PersistentCache extends AbstractCache implements CacheInterface
{
    public function set(ContainerInterface $container): bool
    {
        return wp_cache_set($this->key(), $container, $this->group, 0);
    }

    public function get(): ContainerInterface
    {
        $serializedContainer = wp_cache_get($this->key(), $this->group);
        if ($serializedContainer === false) {
            throw new ContainerCacheException('Container not found in cache');
        }

        return $this->unserialize($serializedContainer);
    }

    public function delete(): bool
    {
        return wp_cache_delete($this->key(), $this->group);
    }

    public function has(): bool
    {
        return (bool)wp_cache_get($this->key(), $this->group);
    }
}
