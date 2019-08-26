<?php

namespace AdminBundle\Service;

use AdminBundle\Entity\User;
use Doctrine\ORM\Mapping\Entity;
use Psr\Cache\CacheItemInterface;
use Symfony\Component\Cache\Adapter\AbstractAdapter;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\Router;

class CacheAdapter
{
    protected $adapter;
    protected $container;
    protected $urlGenerate;


    /**
     * CacheAdapter constructor.
     * @param AbstractAdapter $adapter
     */
    public function __construct(AbstractAdapter $adapter, ContainerInterface $container)
    {
        $this->adapter = $adapter;
        $this->container = $container;
        $this->urlGenerate = $container->get('router');
    }

    /**
     * @param string $cacheName
     * @param int $elementId
     * @return bool
     */
    public function removeElementFromCache($cacheName, $elementId)
    {
        $cache = $this->adapter->getItem($cacheName);

        if (!$cache->isHit()) {
            return false;
        }

        $cache->set(
            $this->removeElement(
                $cache->get(),
                $elementId,
                $cacheName
            )
        );

        $this->adapter->save($cache);

        return true;
    }

    /**
     * @param array $cache
     * @param int $elementId
     * @return array
     */
    private function removeElement($cache, $elementId, $cacheName)
    {
        $result = [];

        foreach ($cache as $item) {
            if ($item[$cacheName.'Id'] != $elementId) {
                $result[] = $item;
            }
        }

        return $result;
    }

    /**
     * @param $cacheName
     * @param Entity $element
     * @return bool
     */
    public function addElementFromCache($cacheName, $element)
    {
        $cache = $this->adapter->getItem($cacheName);

        if (!$cache->isHit()) {
            return false;
        }

        $data = $this->removeElement($cache->get(), $element->getId(), $cacheName);

        if ($cacheName == 'app') {
            $data [] = $this->buildApp($element);
        } else {
            $data [] = $this->buildUser($element);
        }

        $cache->set($data);
        $this->adapter->save($cache);

        return true;
    }

    private function buildApp($element)
    {
        return [
            'appId' => $element->getId(),
            'name' => $element->getName(),
            'date' => $element->getDate()->format('d/m/y'),
            'status' => $element->getStatus(),
            'locked' => $element->getLocked(),
            'statusChangeDate' => is_a($element->getStatusChangeDate(), 'DateTime')
                ? $element->getStatusChangeDate()->format('d/m/Y') : '',
            'userName' => $element->getUser()->getUsername(),
            'admin_app_print' => $this->urlGenerate->generate(
                'admin_app_print',
                ['id' => $element->getId()],
                Router::ABSOLUTE_PATH
            ),
            'admin_app_edit' => $this->urlGenerate->generate(
                'admin_app_edit',
                ['id' => $element->getId()],
                Router::ABSOLUTE_PATH
            ),
            'admin_app_del' => $this->urlGenerate->generate(
                'admin_app_del',
                ['id' => $element->getId()],
                Router::ABSOLUTE_PATH
            ),
            'admin_app_approve' => $this->urlGenerate->generate(
                'admin_app_approve',
                ['id' => $element->getId()],
                Router::ABSOLUTE_PATH
            ),
            'admin_app_reject' => $this->urlGenerate->generate(
                'admin_app_reject',
                ['id' => $element->getId()],
                Router::ABSOLUTE_PATH
            ),
        ];
    }

    /**
     * @param User $element
     * @return array
     */
    private function buildUser($element)
    {
        $rolesString = '';
        foreach ($element->getRoles() as $role) {
            switch ($role) {
                case'ROLE_SUPERADMIN':
                    $rolesString .= 'SuperAdmin, ';
                    break;
                case'ROLE_ADMIN':
                    $rolesString .= 'Admin, ';
                    break;
                case'ROLE_USER':
                    $rolesString .= 'User, ';
                    break;
            }
        }

        return [
            'userId' => $element->getId(),
            'username' => $element->getUsername(),
            'email' => $element->getEmail(),
            'enabled' => $element->isEnabled(),
            'gdpr' => $element->getGdpr()? 'Yes': 'No', 
            'roles' => rtrim($role, ','),
            'admin_user_lock' => $this->urlGenerate->generate(
                'admin_user_lock',
                ['id' => $element->getId()],
                Router::ABSOLUTE_PATH
            ),
            'admin_user_unlock' => $this->urlGenerate->generate(
                'admin_user_unlock',
                ['id' => $element->getId()],
                Router::ABSOLUTE_PATH
            ),
            'admin_user_spromote' => $this->urlGenerate->generate(
                'admin_user_spromote',
                ['id' => $element->getId()],
                Router::ABSOLUTE_PATH
            ),
            'admin_user_promote' => $this->urlGenerate->generate(
                'admin_user_promote',
                ['id' => $element->getId()],
                Router::ABSOLUTE_PATH
            ),
            'admin_user_depromote' => $this->urlGenerate->generate(
                'admin_user_depromote',
                ['id' => $element->getId()],
                Router::ABSOLUTE_PATH
            ),
            'admin_user_edit' => $this->urlGenerate->generate(
                'admin_user_edit',
                ['id' => $element->getId()],
                Router::ABSOLUTE_PATH
            ),
            'admin_user_delete' => $this->urlGenerate->generate(
                'admin_user_delete',
                ['id' => $element->getId()],
                Router::ABSOLUTE_PATH
            ),
        ];
    }

    public function save(CacheItemInterface $item)
    {
        return $this->adapter->save($item);
    }

    public function clear()
    {
        return $this->adapter->clear();
    }

    public function getItem($name)
    {
        return $this->adapter->getItem($name);
    }
}
