<?php

namespace Birrols\BeerBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * BeersRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BeersRepository extends EntityRepository
{
    public function findAllViewByParams( $categoryIds=NULL, $typeId=NULL, 
            $countryId=NULL, $breweryId=NULL, $brewery=NULL, 
            $abvMin=NULL, $abvMax=NULL, $ibuMin=NULL, $ibuMax, $search )
    {
        $qb = $this->createQueryBuilder();
        $query = $qb->select('b.*, w.name brewery, w.user_admin_id, c.category, 
            t.type, p.name country, p.id country_id')
                ->from('Beers', 'b')
                ->innerJoin('b.brewery', 'w', 'ON')
                ->leftJoin('b.category', 'c', 'ON')
                ->leftJoin('b.type', 't', 'ON')
                ->leftJoin('b.country', 'p', 'ON')
                ->where('w.brewery');
        if( !empty($categoryIds) ) { //&& is_array($categoryIds) ) {
            $query->andWhere( $qb->expr()->in('c.id', ':categoryIds') )
                ->setParameter('categoryIds', $categoryIds);
        }
        if( !empty($typeId) ) { 
            $query->andWhere( $qb->expr()->eq('t.id', ':typeId') )
                ->setParameter('typeId', $typeId);
        }
        if( !empty($countryId) ) { 
            $query->andWhere( $qb->expr()->eq('p.id', ':countryId') )
                ->setParameter('countryId', $countryId);
        }
        if( !empty($breweryId) ) { 
            $query->andWhere( $qb->expr()->eq('w.id', ':breweryId') )
                ->setParameter('breweryId', $breweryId);
        }
        if( !empty($brewery) ) { 
            $search_array = preg_split( '/ /', $brewery );
            $orBrewery = new $qb->expr();
            $i = 0;
            foreach( $search_array as $search_term ) {
                $orBrewery = $orBrewery->orX( 
                        $qb->expr()->like( 'w.name', ':brewery' . $i )
                        );
                $query->setParameter('brewery' . $i, $search_term);
                $i++;
            }
            $query->andWhere( $orBrewery );
        }
        if( !empty($abvMin) ) { 
            $query->andWhere( $qb->expr()->gte('b.abv', ':abvMin') )
                ->setParameter('abvMin', $abvMin);
        }
        if( !empty($abvMax) ) { 
            $query->andWhere( $qb->expr()->lte('b.abv', ':abvMax') )
                ->setParameter('abvMax', $abvMax);
        }
        if( !empty($ibuMin) ) { 
            $query->andWhere( $qb->expr()->gte('b.ibu', ':ibuMin') )
                ->setParameter('ibuMin', $ibuMin);
        }
        if( !empty($ibuMax) ) { 
            $query->andWhere( $qb->expr()->lte('b.ibu', ':ibuMax') )
                ->setParameter('ibuMax', $ibuMax);
        }
        if( !empty($search) ) { 
            $search_array = preg_split( '/ /', $search );
            $orSearch = new $qb->expr();
            $i = 0;
            foreach( $search_array as $search_term ) {
                $orSearch = $orSearch
                    ->orX( $qb->expr()->like( 'b.name', ':search' . $i ) )
                    ->orX( $qb->expr()->like( 'b.description', ':search' . $i ) );
                $query->setParameter('search' . $i, $search_term);
                $i++;
            }
            $query->andWhere( $orSearch );
        }
//        $query = $this->getEntityManager()
//                ->createQuery('
//                    SELECT b.*, w.name brewery, w.user_admin_id, c.category, t.type, p.name country, p.auto_id country_id
//                    FROM beers b 
//                    INNER JOIN business w ON b.brewery_id = w.auto_id
//                    LEFT JOIN beer_categories c ON b.category_id = c.auto_id
//                    LEFT JOIN beer_types t ON  b.type_id = t.auto_id
//                    LEFT JOIN countries p ON w.country_id = p.auto_id
//                    WHERE w.brewery')
//                ->setParameter($key, $value);
//        return $query->getResult();
    }        
}
