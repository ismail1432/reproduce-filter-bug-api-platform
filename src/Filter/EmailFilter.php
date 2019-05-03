<?php


namespace App\Filter;


use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\AbstractContextAwareFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use Doctrine\ORM\QueryBuilder;

class EmailFilter extends AbstractContextAwareFilter
{
    protected function filterProperty(string $property, $value, QueryBuilder $qb, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null): void
    {
        if ('contact.email' !== $property) {
            return;
        }

        // otherwise filter is applied to order and page as well
        if (!$this->isPropertyEnabled($property, $resourceClass) || !$this->isPropertyMapped($property, $resourceClass)) {
            return;
        }

        $alias = $qb->getRootAliases()[0];

        $qb->innerJoin($alias.'.contact', 'contact');
        $expr = $qb->expr();
        $xor = $expr->orX();
        $xor->add($expr->like('contact.email', $expr->literal('%'.$value.'%')));
        $xor->add($expr->like('contact.professionalEmail', $expr->literal('%'.$value.'%')));

        $qb->andWhere($xor);

    }

    public function getDescription(string $resourceClass): array
    {
        return [
            'email' => [
                'property' => 'email',
                'type' => 'string',
                'required' => false,
                'swagger' => [
                    'description' => 'Filter using a beneficiary_contact.email OR beneficiary_contact.professionalEmail',
                    'name' => 'email',
                    'type' => 'string',
                ],
            ],
        ];
    }
}

