<?php
/**
 * File: ClientInterface.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\ReactPhpPlayground\Standalone\Http;

use MSlwk\TypeSafeArray\ObjectArray;

/**
 * Interface ClientInterface
 * @package MSlwk\ReactPhpPlayground\Standalone\Http
 */
interface ClientInterface
{
    /**
     * @param ObjectArray $urls
     * @return ObjectArray
     */
    public function getContent(ObjectArray $urls): ObjectArray;
}
