<?php
/**
 * Created by PhpStorm.
 * User: joseph
 * Date: 16.12.16
 * Time: 10:37
 */

namespace AdminBundle\EventListener;

use AdminBundle\Entity\Application;
use AdminBundle\Entity\User;
use AdminBundle\Event\CvsImportEvent;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraints\DateTime;

class ImportCvsListener
{
    private $em;

    /**
     * ImportCvsListener constructor.
     * @param $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }


    public function importUsers(CvsImportEvent $event)
    {
        $raw=$event->getData();
        if (strlen($raw)<100) {
            return new \Exception('Wrong file size');
        }
        $col=array();
        $linie=explode("\n", $raw);
        $datacsv=str_getcsv($linie[0], ';');
        foreach ($datacsv as $k=>$v) {
            $col[trim($v)]=$k;
        }

        foreach ($linie as $linia) {
            $data=str_getcsv($linia, ';');
            if (array_key_exists($col['email'], $data)) {
                if (($data[$col['email']] != 'email') && ($data[$col['email']] != '')) {
                    $user = $this->em->getRepository('AdminBundle:User')->findOneByEmail($data[$col['email']]);
                    if (!$user) {
                        $user = new User();

                        $user->setOldid($data[0]);
                        $n = $data[$col['name']];
                        $name = $this->em->getRepository('AdminBundle:User')->findOneByUsername($n);
                        if ($name) {
                            $name = true;
                            while ($name) {
                                $name = $this->em->getRepository('AdminBundle:User')->findOneByUsername($n);
                                $n = $n . '' . rand((int)0, (int)9999);
                            }
                        }

                        $user->setUsername($n);
                        $user->setEmail($data[$col['email']]);
                        $user->setCharityNuber($data[$col['charity_number']]);
                        $user->setJobTitle($data[$col['job_title']]);
                        $user->setOrganisation($data[$col['organization']]);
                        $user->setOrganisationAddress($data[$col['work_address']]);
                        $user->setWorkAddress($data[$col['work_address']]);
                        $user->setWorkPostcode($data[$col['work_postcode']]);
                        $user->setWorkTelephone($data[$col['work_telephone']]);
                        $user->addRole('ROLE_USER');
                        $user->setPassword(rand((int)0, (int)10000000000));
                        $user->setEnabled(true);
                        $this->em->persist($user);
                        $this->em->flush();
                    }
                }
            }
        }
    }

    public function importApplications(CvsImportEvent $event)
    {
        $raw = $event->getData();
        if (strlen($raw) < 100) {
            return new \Exception('Wrong file size');
        }
        $col = array();
        $linie = explode("\n", $raw);
        $datacsv = str_getcsv($linie[0], ';');
        foreach ($datacsv as $k => $v) {
            $col[trim($v)] = $k;
        }

        foreach ($linie as $linia) {
            $data = str_getcsv($linia, ';');
            foreach ($data as $k => $v) {
                $data[$k]=nl2br($v);
            }

            if (array_key_exists($col['caring_pro_id'], $data)) {
                if (($data[$col['caring_pro_id']] != 'caring_pro_id') && ($data[$col['caring_pro_id']] != '')) {
                    $app = $this->em->getRepository('AdminBundle:Application')->findOneByOldid($data[0]);
                    if (!$app) {
                        $app=new Application();
                        $app->setName($data[$col['name']]);
                        $user=$this->em->getRepository("AdminBundle:User")->findOneByOldid($data[$col['caring_pro_id']]);
                        $app->setOldid($data[0]);
                        $app->setUser($user);
                        $app->setAddress($data[$col['address']]);
                        $app->setIllness($data[$col['type_illness']]);
                        $app->setPurpose($data[$col['purpose_grant']]);
                        $app->setAmount($data[$col['amount_grant']]);
                        $app->setOrganisation($data[$col['organization']]);
                        $app->setWeekincome($data[$col['income_week']]);
                        $app->setWeekexpenditure($data[$col['expenditure_week']]);
                        $app->setFamily($data[$col['family_position']]);
                        $app->setSteps($data[$col['steps']]);
                        $app->setStatus($data[$col['approved']]);
                        $app->setWages($data[$col['wages']]);
                        $app->setHousing($data[$col['housing_benefit']]);
                        $app->setTax($data[$col['council_tax_benefit']]);
                        $app->setEmployment($data[$col['jobseeker_allowance']]);
                        $app->setIncomesupport($data[$col['income_support']]);
                        $app->setChildbenefit($data[$col['child_benefit']]);
                        $app->setChildtax($data[$col['child_tax_credit']]);
                        $app->setWorkingtaxcredit($data[$col['working_tax_credit']]);
                        $app->setIncapacitybenefit($data[$col['incapacity_benefit']]);
                        $app->setCarersallowence($data[$col['carer_allowance']]);
                        $app->setPersonalindependence($data[$col['rip']]);
                        $app->setDisability($data[$col['disability_allowance_care']]);
                        $app->setDisability2($data[$col['disability_allowance_mob']]);
                        $app->setOther($data[$col['industrial_disablement_allowance']]);
                        $app->setHousingcost($data[$col['housing_costs']]);
                        $app->setRent($data[$col['rent']]);
                        $app->setMortgages($data[$col['mortgages']]);
                        $app->setHousingcost($data[$col['council_tax']]);
                        $app->setUtilities((int)$data[$col['water']]+(int)$data[$col['water']]);
                        $app->setFood($data[$col['food_general']]);
                        $app->setChildcare($data[$col['childcare']]);
                        $maintenance=(int)$col['court_fines']+(int)$col['court_fines']+(int)$col['maintenance']+(int)$col['life_assurance']+(int)$col['hp_conditional']+(int)$col['tv_licence']+(int)$col['telephone'];
                        $app->setMaintenance($maintenance);
                        $app->setFares($data[$col['fares']]);
                        $app->setWeekincome($data[$col['total_weekly_income']]);
                        $app->setWeekexpenditure($data[$col['total_weekly_expenditure']]);
                        $app->setSavings($data[$col['savings']]);
                        $app->setDate(new \DateTime($data[$col['created_at']]));
                        $this->em->persist($app);
                        $this->em->flush();
                    }
                }
            }
        }
    }
}
