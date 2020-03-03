<?php

namespace App\Services;

use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactoryInterface;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class Service
{

    /** @var ClassMetadataFactoryInterface */
    protected $class_meta_factory;

    /** @var ObjectNormalizer */
    protected $normalizer;

    /** @var Serializer */
    protected $serializer;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->class_meta_factory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $this->normalizer = new ObjectNormalizer($this->class_meta_factory);
        $this->serializer = new Serializer([$this->normalizer]);
    }
}