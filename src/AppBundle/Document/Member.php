<?php
/**
 * Created by PhpStorm.
 * User: valentin
 * Date: 25/08/16
 * Time: 20:31
 */
namespace AppBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
 class Member
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

     /**
      * @MongoDB\Field(type="string")
      */
     protected $avatar;
     
     /**
      * @MongoDB\ReferenceMany(targetDocument="Character", cascade={"all"})
      */
     protected $characters;
     public function __construct()
    {
        $this->characters = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
        return $this;
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

    /**
     * Set avatar
     *
     * @param string $avatar
     * @return $this
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
        return $this;
    }

    /**
     * Get avatar
     *
     * @return string $avatar
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Add character
     *
     * @param AppBundle\Document\Character $character
     */
    public function addCharacter(\AppBundle\Document\Character $character)
    {
        $this->characters[] = $character;
    }

    /**
     * Remove character
     *
     * @param AppBundle\Document\Character $character
     */
    public function removeCharacter(\AppBundle\Document\Character $character)
    {
        $this->characters->removeElement($character);
    }

    /**
     * Get characters
     *
     * @return \Doctrine\Common\Collections\Collection $characters
     */
    public function getCharacters()
    {
        return $this->characters;
    }
}
