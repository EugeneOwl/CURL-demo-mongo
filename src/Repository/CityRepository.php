<?php

declare(strict_types = 1);

namespace App\Repository;


use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\DocumentRepository;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Doctrine\ODM\MongoDB\UnitOfWork;

class CityRepository extends DocumentRepository
{
    public function __construct(DocumentManager $dm, UnitOfWork $uow, ClassMetadata $classMetadata)
    {
        parent::__construct($dm, $uow, $classMetadata);
    }

    public function doesCityExist(string $cityName): bool
    {
        return !empty($this->findOneBy(["name" => $cityName]));
    }
}