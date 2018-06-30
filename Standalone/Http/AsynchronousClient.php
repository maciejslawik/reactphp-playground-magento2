<?php
/**
 * File: AsynchronousClient.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\ReactPhpPlayground\Standalone\Http;

use MSlwk\ReactPhpPlayground\Api\Data\HtmlInterface;
use MSlwk\ReactPhpPlayground\Api\Data\UrlInterface;
use MSlwk\ReactPhpPlayground\Model\Data\Html;
use MSlwk\ReactPhpPlayground\Model\Adapter\ReactPHP\ClientFactory;
use MSlwk\TypeSafeArray\ObjectArray;
use MSlwk\TypeSafeArray\ObjectArrayFactory;
use React\EventLoop\LoopInterface;
use React\HttpClient\Response;

/**
 * Class AsynchronousClient
 * @package MSlwk\ReactPhpPlayground\Standalone\Http
 */
class AsynchronousClient implements ClientInterface
{
    /**
     * @var LoopInterface
     */
    private $loop;

    /**
     * @var ClientFactory
     */
    private $clientFactory;

    /**
     * @var ObjectArrayFactory
     */
    private $objectArrayFactory;

    /**
     * AsynchronousClient constructor.
     * @param LoopInterface $loop
     * @param ClientFactory $clientFactory
     * @param ObjectArrayFactory $objectArrayFactory
     */
    public function __construct(
        LoopInterface $loop,
        ClientFactory $clientFactory,
        ObjectArrayFactory $objectArrayFactory
    ) {
        $this->loop = $loop;
        $this->clientFactory = $clientFactory;
        $this->objectArrayFactory = $objectArrayFactory;
    }

    /**
     * @param ObjectArray $urls
     * @return ObjectArray
     */
    public function getContent(ObjectArray $urls): ObjectArray
    {
        $htmlObjectArray = $this->objectArrayFactory->create(HtmlInterface::class);
        /** @var UrlInterface $url */
        foreach ($urls as $url) {
            $client = $this->clientFactory->create($this->loop);
            $request = $client->request('GET', $url->getUrl());
            $request->on('response', function (Response $response) use (&$htmlObjectArray) {
                $data = '';
                $response->on(
                    'data',
                    function ($chunk) use (&$data) {
                        $data .= $chunk;
                    }
                )->on(
                    'end',
                    function () use (&$htmlObjectArray, &$data) {
                        $htmlObjectArray->add(new Html($data));
                    }
                );
            });
            $request->end();
        }
        $this->loop->run();
        return $htmlObjectArray;
    }
}
