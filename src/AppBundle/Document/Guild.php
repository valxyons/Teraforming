<?php
/**
 * Created by PhpStorm.
 * User: valentin
 * Date: 25/08/16
 * Time: 19:42
 */
namespace AppBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
 class Guild
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
     protected $logo;

     /**
      * @MongoDB\ReferenceMany(targetDocument="Member", cascade={"all"})
      */
     protected $members;


     public function __construct()
    {
        $this->members = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set logo
     *
     * @param string $logo
     * @return $this
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
        return $this;
    }

    /**
     * Get logo
     *
     * @return string $logo
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Add member
     *
     * @param AppBundle\Document\Member $member
     */
    public function addMember(\AppBundle\Document\Member $member)
    {
        $this->members[] = $member;
    }

    /**
     * Remove member
     *
     * @param AppBundle\Document\Member $member
     */
    public function removeMember(\AppBundle\Document\Member $member)
    {
        $this->members->removeElement($member);
    }

    /**
     * Get members
     *
     * @return \Doctrine\Common\Collections\Collection $members
     */
    public function getMembers()
    {
        return $this->members;
    }
}
