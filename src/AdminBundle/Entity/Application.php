<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Application
 *
 * @ORM\Table(name="application")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\ApplicationRepository")
 */
class Application
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var string
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;


    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="age", type="integer"  )
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255   )
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="illness", type="string", length=255   )
     */
    private $illness;

    /**
     * @var string
     *
     * @ORM\Column(name="purpose", type="string", length=255   )
     */
    private $purpose;

    /**
     * @var string
     *
     * @ORM\Column(name="amount", type="string", length=255  )
     */
    private $amount;

    /**
     * @var string
     *
     * @ORM\Column(name="Organisation", type="string", length=255  )
     */
    private $organisation;

    /**
     * @var string
     *
     * @ORM\Column(name="family", type="string", length=255  )
     */
    private $family;

    /**
     * @var bool
     *
     * @ORM\Column(name="nhs", type="boolean" )
     */
    private $nhs;

    /**
     * @var string
     *
     * @ORM\Column(name="steps", type="text" )
     */
    private $steps;

    /**
     * @var string
     *
     * @ORM\Column(name="wages", type="string", length=255  ,nullable=true)
     */
    private $wages;

    /**
     * @var string
     *
     * @ORM\Column(name="housing", type="string", length=255  ,nullable=true)
     */
    private $housing;

    /**
     * @var string
     *
     * @ORM\Column(name="tax", type="string", length=255  ,nullable=true)
     */
    private $tax;

    /**
     * @var string
     *
     * @ORM\Column(name="employment", type="string", length=255  ,nullable=true)
     */
    private $employment;

    /**
     * @var string
     *
     * @ORM\Column(name="incomesupport", type="string", length=255  ,nullable=true)
     */
    private $incomesupport;

    /**
     * @var string
     *
     * @ORM\Column(name="childbenefit", type="string", length=255  ,nullable=true)
     */
    private $childbenefit;

    /**
     * @var string
     *
     * @ORM\Column(name="childtax", type="string", length=255  ,nullable=true)
     */
    private $childtax;

    /**
     * @var string
     *
     * @ORM\Column(name="workingtaxcredit", type="string", length=255  ,nullable=true)
     */
    private $workingtaxcredit;

    /**
     * @var string
     *
     * @ORM\Column(name="incapacitybenefit", type="string", length=255  ,nullable=true)
     */
    private $incapacitybenefit;

    /**
     * @var string
     *
     * @ORM\Column(name="carersallowence", type="string", length=255  ,nullable=true)
     */
    private $carersallowence;

    /**
     * @var string
     *
     * @ORM\Column(name="personalindependence", type="string", length=255  ,nullable=true)
     */
    private $personalindependence;

    /**
     * @var string
     *
     * @ORM\Column(name="disability", type="string", length=255  ,nullable=true)
     */
    private $disability;

    /**
     * @var string
     *
     * @ORM\Column(name="disability2", type="string", length=255  ,nullable=true)
     */
    private $disability2;

    /**
     * @var string
     *
     * @ORM\Column(name="other", type="string", length=255  ,nullable=true)
     */
    private $other;

    /**
     * @var string
     *
     * @ORM\Column(name="rent", type="string", length=255  ,nullable=true)
     */
    private $rent;

    /**
     * @var string
     *
     * @ORM\Column(name="mortgages", type="string", length=255  ,nullable=true)
     */
    private $mortgages;

    /**
     * @var string
     *
     * @ORM\Column(name="housingcost", type="string", length=255  ,nullable=true)
     */
    private $housingcost;


    /**
     * @var string
     *
     * @ORM\Column(name="utilities", type="string", length=255  ,nullable=true)
     */
    private $utilities;

    /**
     * @var string
     *
     * @ORM\Column(name="food", type="string", length=255  ,nullable=true)
     */
    private $food;

    /**
     * @var string
     *
     * @ORM\Column(name="childcare", type="string", length=255  ,nullable=true)
     */
    private $childcare;


    /**
     * @var string
     *
     * @ORM\Column(name="liabilities", type="string", length=255  ,nullable=true)
     */
    private $liabilities;

    /**
     * @var string
     *
     * @ORM\Column(name="maintenance", type="string", length=255  ,nullable=true)
     */
    private $maintenance;


    /**
     * @var string
     *
     * @ORM\Column(name="fares", type="string", length=255  ,nullable=true)
     */
    private $fares;


    /**
     * @var string
     *
     * @ORM\Column(name="specialneeds", type="string", length=255  ,nullable=true)
     */
    private $specialneeds;


    /**
     * @var string
     *
     * @ORM\Column(name="weekincome", type="string", length=255  )
     */
    private $weekincome;

    /**
     * @var string
     *
     * @ORM\Column(name="weekexpenditure", type="string", length=255  )
     */
    private $weekexpenditure;


    /**
     * @var string
     *
     * @ORM\Column(name="savings", type="string", length=255 )
     */
    private $savings;


    /**
     * @var string
     *
     * @ORM\Column(name="taxUk", type="string", length=255)
     */
    private $taxUk;


    /**
     * @var string
     *
     * @ORM\Column(name="othercomment", type="text"  ,nullable=true )
     */
    private $othercomment;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="applications")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $user;


    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255  ,nullable=true)
     */
    private $status = 'pending';


    /**
     * @var string
     *
     * @ORM\Column(name="statusDate", type="datetime",  nullable=true)
     */
    private $statusChangeDate;

    /**
     * @ORM\Column(name="oldid", type="integer" ,nullable=true)
     *
     */
    private $oldid;

    /**
     * @ORM\Column(name="locked", type="boolean" ,nullable=true)
     *
     */
    private $locked = false;

    /**
     * Application constructor.
     * @param string $date
     */
    public function __construct()
    {
        $this->date = new \DateTime('now');
    }


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
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Application
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get age
     *
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set age
     *
     * @param integer $age
     *
     * @return Application
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Application
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get illness
     *
     * @return string
     */
    public function getIllness()
    {
        return $this->illness;
    }

    /**
     * Set illness
     *
     * @param string $illness
     *
     * @return Application
     */
    public function setIllness($illness)
    {
        $this->illness = $illness;

        return $this;
    }

    /**
     * Get purpose
     *
     * @return string
     */
    public function getPurpose()
    {
        return $this->purpose;
    }

    /**
     * Set purpose
     *
     * @param string $purpose
     *
     * @return Application
     */
    public function setPurpose($purpose)
    {
        $this->purpose = $purpose;

        return $this;
    }

    /**
     * Get amount
     *
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set amount
     *
     * @param string $amount
     *
     * @return Application
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get organisation
     *
     * @return string
     */
    public function getOrganisation()
    {
        return $this->organisation;
    }

    /**
     * Set organisation
     *
     * @param string $organisation
     *
     * @return Application
     */
    public function setOrganisation($organisation)
    {
        $this->organisation = $organisation;

        return $this;
    }

    /**
     * Get family
     *
     * @return string
     */
    public function getFamily()
    {
        return $this->family;
    }

    /**
     * Set family
     *
     * @param string $family
     *
     * @return Application
     */
    public function setFamily($family)
    {
        $this->family = $family;

        return $this;
    }

    /**
     * Get nhs
     *
     * @return bool
     */
    public function getNhs()
    {
        return $this->nhs;
    }

    /**
     * Set nhs
     *
     * @param boolean $nhs
     *
     * @return Application
     */
    public function setNhs($nhs)
    {
        $this->nhs = $nhs;

        return $this;
    }

    /**
     * Get steps
     *
     * @return string
     */
    public function getSteps()
    {
        return $this->steps;
    }

    /**
     * Set steps
     *
     * @param string $steps
     *
     * @return Application
     */
    public function setSteps($steps)
    {
        $this->steps = $steps;

        return $this;
    }

    /**
     * Get wages
     *
     * @return string
     */
    public function getWages()
    {
        return $this->wages;
    }

    /**
     * Set wages
     *
     * @param string $wages
     *
     * @return Application
     */
    public function setWages($wages)
    {
        $this->wages = $wages;

        return $this;
    }

    /**
     * Get housing
     *
     * @return string
     */
    public function getHousing()
    {
        return $this->housing;
    }

    /**
     * Set housing
     *
     * @param string $housing
     *
     * @return Application
     */
    public function setHousing($housing)
    {
        $this->housing = $housing;

        return $this;
    }

    /**
     * Get tax
     *
     * @return string
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * Set tax
     *
     * @param string $tax
     *
     * @return Application
     */
    public function setTax($tax)
    {
        $this->tax = $tax;

        return $this;
    }

    /**
     * Get employment
     *
     * @return string
     */
    public function getEmployment()
    {
        return $this->employment;
    }

    /**
     * Set employment
     *
     * @param string $employment
     *
     * @return Application
     */
    public function setEmployment($employment)
    {
        $this->employment = $employment;

        return $this;
    }

    /**
     * Get incomesupport
     *
     * @return string
     */
    public function getIncomesupport()
    {
        return $this->incomesupport;
    }

    /**
     * Set incomesupport
     *
     * @param string $incomesupport
     *
     * @return Application
     */
    public function setIncomesupport($incomesupport)
    {
        $this->incomesupport = $incomesupport;

        return $this;
    }

    /**
     * Get childbenefit
     *
     * @return string
     */
    public function getChildbenefit()
    {
        return $this->childbenefit;
    }

    /**
     * Set childbenefit
     *
     * @param string $childbenefit
     *
     * @return Application
     */
    public function setChildbenefit($childbenefit)
    {
        $this->childbenefit = $childbenefit;

        return $this;
    }

    /**
     * Get childtax
     *
     * @return string
     */
    public function getChildtax()
    {
        return $this->childtax;
    }

    /**
     * Set childtax
     *
     * @param string $childtax
     *
     * @return Application
     */
    public function setChildtax($childtax)
    {
        $this->childtax = $childtax;

        return $this;
    }

    /**
     * Get workingtaxcredit
     *
     * @return string
     */
    public function getWorkingtaxcredit()
    {
        return $this->workingtaxcredit;
    }

    /**
     * Set workingtaxcredit
     *
     * @param string $workingtaxcredit
     *
     * @return Application
     */
    public function setWorkingtaxcredit($workingtaxcredit)
    {
        $this->workingtaxcredit = $workingtaxcredit;

        return $this;
    }

    /**
     * Get incapacitybenefit
     *
     * @return string
     */
    public function getIncapacitybenefit()
    {
        return $this->incapacitybenefit;
    }

    /**
     * Set incapacitybenefit
     *
     * @param string $incapacitybenefit
     *
     * @return Application
     */
    public function setIncapacitybenefit($incapacitybenefit)
    {
        $this->incapacitybenefit = $incapacitybenefit;

        return $this;
    }

    /**
     * Get carersallowence
     *
     * @return string
     */
    public function getCarersallowence()
    {
        return $this->carersallowence;
    }

    /**
     * Set carersallowence
     *
     * @param string $carersallowence
     *
     * @return Application
     */
    public function setCarersallowence($carersallowence)
    {
        $this->carersallowence = $carersallowence;

        return $this;
    }

    /**
     * Get personalindependence
     *
     * @return string
     */
    public function getPersonalindependence()
    {
        return $this->personalindependence;
    }

    /**
     * Set personalindependence
     *
     * @param string $personalindependence
     *
     * @return Application
     */
    public function setPersonalindependence($personalindependence)
    {
        $this->personalindependence = $personalindependence;

        return $this;
    }

    /**
     * Get disability
     *
     * @return string
     */
    public function getDisability()
    {
        return $this->disability;
    }

    /**
     * Set disability
     *
     * @param string $disability
     *
     * @return Application
     */
    public function setDisability($disability)
    {
        $this->disability = $disability;

        return $this;
    }

    /**
     * Get other
     *
     * @return string
     */
    public function getOther()
    {
        return $this->other;
    }

    /**
     * Set other
     *
     * @param string $other
     *
     * @return Application
     */
    public function setOther($other)
    {
        $this->other = $other;

        return $this;
    }

    /**
     * Get rent
     *
     * @return string
     */
    public function getRent()
    {
        return $this->rent;
    }

    /**
     * Set rent
     *
     * @param string $rent
     *
     * @return Application
     */
    public function setRent($rent)
    {
        $this->rent = $rent;

        return $this;
    }

    /**
     * Get mortgages
     *
     * @return string
     */
    public function getMortgages()
    {
        return $this->mortgages;
    }

    /**
     * Set mortgages
     *
     * @param string $mortgages
     *
     * @return Application
     */
    public function setMortgages($mortgages)
    {
        $this->mortgages = $mortgages;

        return $this;
    }

    /**
     * Get housingcost
     *
     * @return string
     */
    public function getHousingcost()
    {
        return $this->housingcost;
    }

    /**
     * Set housingcost
     *
     * @param string $housingcost
     *
     * @return Application
     */
    public function setHousingcost($housingcost)
    {
        $this->housingcost = $housingcost;

        return $this;
    }

    /**
     * Set water
     *
     * @param string $water
     *
     * @return Application
     */
    public function setWater($water)
    {
        $this->water = $water;

        return $this;
    }

    /**
     * Get water
     *
     * @return string
     */
    public function getWater()
    {
        return $this->water;
    }

    /**
     * Set gas
     *
     * @param string $gas
     *
     * @return Application
     */
    public function setGas($gas)
    {
        $this->gas = $gas;

        return $this;
    }

    /**
     * Get gas
     *
     * @return string
     */
    public function getGas()
    {
        return $this->gas;
    }

    /**
     * Set electricity
     *
     * @param string $electricity
     *
     * @return Application
     */
    public function setElectricity($electricity)
    {
        $this->electricity = $electricity;

        return $this;
    }

    /**
     * Get electricity
     *
     * @return string
     */
    public function getElectricity()
    {
        return $this->electricity;
    }

    /**
     * Get utilities
     *
     * @return string
     */
    public function getUtilities()
    {
        return $this->utilities;
    }

    /**
     * Set utilities
     *
     * @param string $utilities
     *
     * @return Application
     */
    public function setUtilities($utilities)
    {
        $this->utilities = $utilities;

        return $this;
    }

    /**
     * Get food
     *
     * @return string
     */
    public function getFood()
    {
        return $this->food;
    }

    /**
     * Set food
     *
     * @param string $food
     *
     * @return Application
     */
    public function setFood($food)
    {
        $this->food = $food;

        return $this;
    }

    /**
     * Get childcare
     *
     * @return string
     */
    public function getChildcare()
    {
        return $this->childcare;
    }

    /**
     * Set childcare
     *
     * @param string $childcare
     *
     * @return Application
     */
    public function setChildcare($childcare)
    {
        $this->childcare = $childcare;

        return $this;
    }

    /**
     * Get liabilities
     *
     * @return string
     */
    public function getLiabilities()
    {
        return $this->liabilities;
    }

    /**
     * Set liabilities
     *
     * @param string $liabilities
     *
     * @return Application
     */
    public function setLiabilities($liabilities)
    {
        $this->liabilities = $liabilities;

        return $this;
    }

    /**
     * Get maintenance
     *
     * @return string
     */
    public function getMaintenance()
    {
        return $this->maintenance;
    }

    /**
     * Set maintenance
     *
     * @param string $maintenance
     *
     * @return Application
     */
    public function setMaintenance($maintenance)
    {
        $this->maintenance = $maintenance;

        return $this;
    }

    /**
     * Get fares
     *
     * @return string
     */
    public function getFares()
    {
        return $this->fares;
    }

    /**
     * Set fares
     *
     * @param string $fares
     *
     * @return Application
     */
    public function setFares($fares)
    {
        $this->fares = $fares;

        return $this;
    }

    /**
     * Get specialneeds
     *
     * @return string
     */
    public function getSpecialneeds()
    {
        return $this->specialneeds;
    }

    /**
     * Set specialneeds
     *
     * @param string $specialneeds
     *
     * @return Application
     */
    public function setSpecialneeds($specialneeds)
    {
        $this->specialneeds = $specialneeds;

        return $this;
    }

    /**
     * Get weekincome
     *
     * @return string
     */
    public function getWeekincome()
    {
        return $this->weekincome;
    }

    /**
     * Set weekincome
     *
     * @param string $weekincome
     *
     * @return Application
     */
    public function setWeekincome($weekincome)
    {
        $this->weekincome = $weekincome;

        return $this;
    }

    /**
     * Get weekexpenditure
     *
     * @return string
     */
    public function getWeekexpenditure()
    {
        return $this->weekexpenditure;
    }

    /**
     * Set weekexpenditure
     *
     * @param string $weekexpenditure
     *
     * @return Application
     */
    public function setWeekexpenditure($weekexpenditure)
    {
        $this->weekexpenditure = $weekexpenditure;

        return $this;
    }

    /**
     * Get savings
     *
     * @return string
     */
    public function getSavings()
    {
        return $this->savings;
    }

    /**
     * Set savings
     *
     * @param string $savings
     *
     * @return Application
     */
    public function setSavings($savings)
    {
        $this->savings = $savings;

        return $this;
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
     * Get othercomment
     *
     * @return string
     */
    public function getOthercomment()
    {
        return $this->othercomment;
    }

    /**
     * Set othercomment
     *
     * @param string $othercomment
     *
     * @return Application
     */
    public function setOthercomment($othercomment)
    {
        $this->othercomment = $othercomment;

        return $this;
    }

    /**
     * @return string
     */
    public function getDisability2()
    {
        return $this->disability2;
    }

    /**
     * @param string $disability2
     */
    public function setDisability2($disability2)
    {
        $this->disability2 = $disability2;
    }

    /**
     * Get user
     *
     * @return \AdminBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set user
     *
     * @param \AdminBundle\Entity\User $user
     *
     * @return Application
     */
    public function setUser(\AdminBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        if ($this->status == 'approved') {
            return 'approved';
        }
        if ($this->status == 'rejected') {
            return 'rejected';
        }
        // Originally, pending meant the application had just been received.
        // To maintain database consistency, Pending will display as Waiting and viceversa.
        if ($this->status == 'pending') {
            return 'pending';
        }
        if ($this->status == 'waiting') {
            return 'waiting';
        }
        if ($this->status == 'withdrawn') {
            return 'withdrawn';
        }
        if ($this->status == 'pledged') {
            return 'pledged';
        }
        if ($this->status === null) {
            return 'pending';
        }
        if ($this->status == 0) {
            return 'rejected';
        }
        if ($this->status == 1) {
            return 'approved';
        }

        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
        $this->statusChangeDate = new \DateTime('now');
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
     * @return Application
     */
    public function setOldid($oldid)
    {
        $this->oldid = $oldid;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLocked()
    {
        if ($this->locked != true) {
            return false;
        }

        return true;
    }

    /**
     * @param mixed $locked
     */
    public function setLocked($locked)
    {
        $this->locked = $locked;
    }

    /**
     * @return string
     */
    public function getStatusChangeDate()
    {
        return $this->statusChangeDate;
    }

    /**
     * @param string $statusChangeDate
     */
    public function setStatusChangeDate($statusChangeDate)
    {
        $this->statusChangeDate = $statusChangeDate;
    }
}
