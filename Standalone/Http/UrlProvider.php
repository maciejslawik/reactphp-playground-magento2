<?php
/**
 * File: UrlProvider.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\ReactPhpPlayground\Standalone\Http;

use MSlwk\ReactPhpPlayground\Api\Data\UrlInterface;
use MSlwk\ReactPhpPlayground\Model\Data\Url;
use MSlwk\TypeSafeArray\ObjectArray;
use MSlwk\TypeSafeArray\ObjectArrayFactory;

/**
 * Trait UrlProvider
 * @package MSlwk\ReactPhpPlayground\Standalone\Http
 */
class UrlProvider
{
    /**
     * @var ObjectArrayFactory
     */
    private $objectArrayFactory;

    /**
     * UrlProvider constructor.
     * @param ObjectArrayFactory $objectArrayFactory
     */
    public function __construct(ObjectArrayFactory $objectArrayFactory)
    {
        $this->objectArrayFactory = $objectArrayFactory;
    }

    /**
     * @return ObjectArray
     */
    public function getUrls(): ObjectArray
    {
        $urls = [
            'https://magento.com',
            'https://marketplace.magento.com',
            'https://u.magento.com',
            'https://devdocs.magento.com',
            'https://github.com/magento/magento2',
            'https://pl.meet-magento.com/pl/'
        ];

        $urlObjectArray = $this->objectArrayFactory->create(UrlInterface::class);
        foreach ($urls as $url) {
            $urlObjectArray->add(new Url($url));
        }
        return $urlObjectArray;
    }
}
