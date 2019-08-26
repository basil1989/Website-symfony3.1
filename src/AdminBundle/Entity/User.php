<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="job", type="string", length=255)
     */
    private $jobTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="organization", type="string", length=255)
     */
    private $organization;


    /**
     * @var string
     *
     * @ORM\Column(name="organizationAddress", type="string", length=255,nullable=true)
     */
    private $organisationAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="charityNumber", type="string", length=255,nullable=true)
     */
    private $charityNuber;

    /**
     * @var string
     *
     * @ORM\Column(name="workAdress", type="string", length=255)
     */
    private $workAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="workPostcode", type="string", length=255)
     */
    private $workPostcode;

    /**
     * @var string
     *
     * @ORM\Column(name="workTel", type="string", length=255)
     */
    private $workTelephone;


    /**
     * @var string
     *
     * @ORM\Column(name="taxUk", type="string", length=255)
     */
    private $taxUk;


    /**
     * @ORM\OneToMany(targetEntity="Application", mappedBy="user")
     *
     */
    private $applications;

    /**
     * @ORM\Column(name="oldid", type="integer", nullable=true)
     *
     */
    private $oldid;

	/**
	 * @ORM\Column(name="gdpr", type="integer", nullable=false)
	 *
	 */
	private $gdpr;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getJobTitle()
    {
        return $this->jobTitle;
    }

    /**
     * @param string $jobTitle
     */
    public function setJobTitle($jobTitle)
    {
        $this->jobTitle = $jobTitle;
    }

    /**
     * @return string
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * @param string $organization
     */
    public function setOrganization($organization)
    {
        $this->organization = $organization;
    }

    /**
     * @return string
     */
    public function getCharityNuber()
    {
        return $this->charityNuber;
    }

    /**
     * @param string $charityNuber
     */
    public function setCharityNuber($charityNuber)
    {
        $this->charityNuber = $charityNuber;
    }

    public function getCharityNumber()
    {
        return $this->charityNuber;
    }

    /**
     * @param string $charityNuber
     */
    public function setCharityNumber($charityNuber)
    {
        $this->charityNuber = $charityNuber;
    }

    /**
     * @return string
     */
    public function getWorkAddress()
    {
        return $this->workAddress;
    }

    /**
     * @param string $workAddress
     */
    public function setWorkAddress($workAddress)
    {
        $this->workAddress = $workAddress;
    }

    /**
     * @return string
     */
    public function getWorkPostcode()
    {
        return $this->workPostcode;
    }

    /**
     * @param string $workPostcode
     */
    public function setWorkPostcode($workPostcode)
    {
        $this->workPostcode = $workPostcode;
    }

    /**
     * @return string
     */
    public function getWorkTelephone()
    {
        return $this->workTelephone;
    }

    /**
     * @param string $workTelephone
     */
    public function setWorkTelephone($workTelephone)
    {
        $this->workTelephone = $workTelephone;
    }


    /**
     * @return string
     */
    public function getTaxUk()
    {
        return $this->taxUk;
    }

    /**
     * @param string $taxUk
     */
    public function setTaxUk($taxUk)
    {
        $this->taxUk = $taxUk;
    }


    /**
     * Set organizationAddress
     *
     * @param string $organizationAddress
     *
     * @return User
     */
    public function setOrganizationAddress($organizationAddress)
    {
        $this->organizationAddress = $organizationAddress;

        return $this;
    }

    /**
     * Get organizationAddress
     *
     * @return string
     */
    public function getOrganizationAddress()
    {
        return $this->organizationAddress;
    }

    /**
     * Set organisation
     *
     * @param string $organisation
     *
     * @return User
     */
    public function setOrganisation($organisation)
    {
        $this->organisation = $organisation;

        return $this;
    }

    /**
     * Get organisation
     *
     * @return string
     */
    public function getOrganisation()
    {
        return $this->organization;
    }

    /**
     * Get organisationAddress
     *
     * @return string
     */
    public function getOrganisationAddress()
    {
        return $this->organisationAddress;
    }

    /**
     * Set organisationAddress
     *
     * @param string $organisationAddress
     *
     * @return User
     */
    public function setOrganisationAddress($organisationAddress)
    {
        $this->organisationAddress = $organisationAddress;

        return $this;
    }

    /**
     * Add application
     *
     * @param \AdminBundle\Entity\Application $application
     *
     * @return User
     */
    public function addApplication(\AdminBundle\Entity\Application $application)
    {
        $this->applications[] = $application;

        return $this;
    }

    /**
     * Remove application
     *
     * @param \AdminBundle\Entity\Application $application
     */
    public function removeApplication(\AdminBundle\Entity\Application $application)
    {
        $this->applications->removeElement($application);
    }

    /**
     * Get applications
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getApplications()
    {
        return $this->applications;
    }

    /**
     * Get oldid
     *
     * @return integer
     */
    public function getOldid()
    {
        return $this->oldid;
    }

    /**
     * Set oldid
     *
     * @param integer $oldid
     *
     * @return User
     */
    public function setOldid($oldid)
    {
        $this->oldid = $oldid;

        return $this;
    }

	/**
	 * Get gdpr
	 *
	 * @return int
	 */
	public function getGdpr()
	{
		return $this->gdpr;
	}

	/**
	 * Set gdpr
	 *
	 * @param integer $gdpr
	 *
	 * @return User
	 */
	public function setGdpr($gdpr)
	{
		$this->gdpr = $gdpr;

		return $this;
	}
}
