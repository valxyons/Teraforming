<?php
/**
 * Created by PhpStorm.
 * User: valentin
 * Date: 25/08/16
 * Time: 18:20
 */
namespace AppBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

include_once "include/remove_accents.php";
/**
 * @MongoDB\Document
 */
 class Game
 {
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $name;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $ucname;


     //Setter & Getter

     
    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this->setUcname(remove_accents(mb_strtoupper($name)));
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set ucname
     *
     * @param string $ucname
     * @return $this
     */
    public function setUcname($ucname)
    {
        $this->ucname = $ucname;
        return $this;
    }

    /**
     * Get ucname
     *
     * @return string $ucname
     */
    public function getUcname()
    {
        return $this->ucname;
    }
}
