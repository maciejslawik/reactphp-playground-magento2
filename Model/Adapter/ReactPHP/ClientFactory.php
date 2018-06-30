<?php
/**
 * File: ClientFactory.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\ReactPhpPlayground\Model\Adapter\ReactPHP;

use React\EventLoop\LoopInterface;
use React\HttpClient\Client;

/**
 * Class ClientFactory
 * @package MSlwk\ReactPhpPlayground\Model\Adapter\ReactPHP
 */
class ClientFactory
{
    /**
     * @param LoopInterface $loop
     * @return Client
     */
    public function create(LoopInterface $loop): Client
    {
        return new Client($loop);
    }
}
