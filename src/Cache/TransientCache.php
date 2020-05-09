<?php
/**
 * Created by PhpStorm.
 * User: alpipego
 * Date: 28.02.2018
 * Time: 14:19
 */
declare(strict_types=1);

namespace Alpipego\AWP\DI\Cache;

use Alpipego\AWP\DI\ContainerInterface;
use Alpipego\AWP\DI\Exception\ContainerCacheException;

final class TransientCache extends AbstractCache implements CacheInterface
{
    public function set(ContainerInterface $container): bool
    {
        return set_site_transient($this->key(), $this->serialize($container), 0);
    }

    public function get(): ContainerInterface
    {
        $serializedContainer = get_site_transient($this->key());
        if ($serializedContainer === false) {
            throw new ContainerCacheException('Container not found in cache');
        }

        return $this->unserialize($serializedContainer);
    }

    public function delete(): bool
    {
        return delete_site_transient($this->key());
    }

    public function has(): bool
    {
        return (bool)get_site_transient($this->key());
    }
}
