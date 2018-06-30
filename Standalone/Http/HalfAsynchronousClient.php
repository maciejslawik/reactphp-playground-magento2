<?php
/**
 * File: HalfAsynchronousClient.php
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
 * Class HalfAsynchronousClient
 * @package MSlwk\ReactPhpPlayground\Standalone\Http
 */
class HalfAsynchronousClient implements ClientInterface
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
     * HalfAsynchronousClient constructor.
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

        for ($i = 0; $i < ($urls->count() / 2); $i++) {
            $this->createRequestDefinition($urls->offsetGet($i), $htmlObjectArray);
        }
        $this->loop->run();

        for ($i; $i < ($urls->count()); $i++) {
            $this->createRequestDefinition($urls->offsetGet($i), $htmlObjectArray);
        }
        $this->loop->run();

        return $htmlObjectArray;
    }

    /**
     * @param UrlInterface $url
     * @param ObjectArray $htmlObjectArray
     * @return void
     */
    private function createRequestDefinition(UrlInterface $url, ObjectArray &$htmlObjectArray): void
    {
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
}
