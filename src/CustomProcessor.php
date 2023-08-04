<?php

namespace App;

use Rector\Core\Contract\Processor\FileProcessorInterface;
use Rector\Core\ValueObject\Application\File;
use Rector\Core\ValueObject\Configuration;
use RectorPrefix202308\Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

class CustomProcessor implements FileProcessorInterface
{
    // Use this with rector < 0.17.1
//    /**
//     * @param CustomInterface[] $rectors
//     */
//    public function __construct(private array $rectors)
//    {
//        var_dump($this->rectors);exit;
//        // result
////        array(1) {
////          [0]=>
////              object(App\CustomClass)#6753 (0) {
////          }
////        }
//    }

    // Use this with rector >= 0.17.1
    /**
     * @param CustomInterface[] $rectors
     */
    public function __construct(private iterable $rectors)
    {
        var_dump(iterator_to_array($this->rectors));exit;
        // result
//        array(0) {
//        }
    }

    public function supports(File $file,Configuration $configuration) : bool
    {
        return true;
    }

    public function process(File $file,Configuration $configuration) : array
    {
        foreach ($this->rectors as $rector) {
            $rector->method();
        }

        return [];
    }

    public function getSupportedFileExtensions() : array
    {
        return ['php'];
    }
}
