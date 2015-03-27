<?php

namespace pi0\Cl1pBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * ClipRepository
 *
 */
class ClipRepository extends EntityRepository
{

    public function getBySlug($slug) {

        $v = $this->findOneBy(array(
            'slug'=>$slug
        ));

        if($v==null) {
            $v = new Clip();
            $v->setSlug($slug);
            $v->setTitle($slug);
            $v->setCreatedAt(new \DateTime());
            $v->setData(str_repeat("\r\n",16));
        }

        return $v;
    }


}
