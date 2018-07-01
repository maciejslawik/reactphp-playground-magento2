<?php
/**
 * File: SynchronousClient.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\ReactPhpPlayground\Standalone\Http;

use MSlwk\ReactPhpPlayground\Api\Data\HtmlInterface;
use MSlwk\ReactPhpPlayground\Api\Data\UrlInterface;
use MSlwk\ReactPhpPlayground\Model\Data\Html;
use MSlwk\TypeSafeArray\ObjectArray;
use MSlwk\TypeSafeArray\ObjectArrayFactory;

/**
 * Class SynchronousClient
 * @package MSlwk\ReactPhpPlayground\Standalone\Http
 */
class SynchronousClient implements ClientInterface
{
    /**
     * @var ObjectArrayFactory
     */
    private $objectArrayFactory;

    /**
     * SynchronousClient constructor.
     * @param ObjectArrayFactory $objectArrayFactory
     */
    public function __construct(ObjectArrayFactory $objectArrayFactory)
    {
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
            $html = $this->fileGetContentsWrapper($url);
            $htmlObjectArray->add(new Html($html));
        }
        return $htmlObjectArray;
    }

    /**
     * @codeCoverageIgnore
     * @param UrlInterface $url
     * @return bool|string
     */
    protected function fileGetContentsWrapper(UrlInterface $url)
    {
        $html = file_get_contents($url->getUrl());
        return $html;
    }
}
