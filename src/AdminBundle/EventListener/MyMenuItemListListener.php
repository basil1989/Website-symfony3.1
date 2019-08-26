<?php
/**
 * Created by PhpStorm.
 * User: joseph
 * Date: 06.11.16
 * Time: 13:23
 */

namespace AdminBundle\EventListener;

use Avanzu\AdminThemeBundle\Event\SidebarMenuEvent;
use Avanzu\AdminThemeBundle\Model\MenuItemModel;
use Symfony\Component\HttpFoundation\Request;

class MyMenuItemListListener
{
    private $security;

    /**
     * MyMenuItemListListener constructor.
     * @param $security
     */
    public function __construct($security)
    {
        $this->security = $security;
    }

    public function onSetupMenu(SidebarMenuEvent $event)
    {
        $request = $event->getRequest();

        foreach ($this->getMenu($request) as $item) {
            $event->addItem($item);
        }
    }

    protected function getMenu(Request $request)
    {
        // Build your menu here by constructing a MenuItemModel array
        $menuItems = array();
        if ($this->security->isGranted('ROLE_SUPERADMIN')) {
            array_push(
                $menuItems,
                $page = new MenuItemModel(
                    '1',
                    'Static Pages',
                    'admin_page_index',
                    array(/* options */),
                    'iconclasses fa fa-file-text'
                )
            );
        }
        array_push(
            $menuItems,
            $users = new MenuItemModel(
                '3',
                'Users',
                'admin_user_index',
                array(/* options */),
                'iconclasses fa fa-user'
            )
        );
        array_push(
            $menuItems,
            $apps = new MenuItemModel(
                '4',
                'Applications',
                'admin_app_index',
                array(/* options */),
                'iconclasses fa fa-file'
            )
        );
        array_push(
            $menuItems,
            $cache = new MenuItemModel(
                '5',
                'Clear Cache',
                'admin_cache',
                array(/* options */),
                'iconclasses fa fa-exclamation-triangle'
            )
        );

        if ($this->security->isGranted('ROLE_SUPERADMIN')) {
            $page->addChild(
                new MenuItemModel(
                    '1', 'Pages', 'admin_page_index', array(/* options */), 'iconclasses  fa fa-file-text'
                )
            );
            $page->addChild(
                new MenuItemModel('2', 'Links', 'admin_link_index', array(/* options */), 'iconclasses fa fa-link')
            );
        }
        // Add some children

        // A child with an icon
//        $blog->addChild(new MenuItemModel('ChildOneItemId', 'ChildOneDisplayName', 'child_1_route', array(), 'fa fa-rss-square'));

        // A child with default circle icon
//        $blog->addChild(new MenuItemModel('ChildTwoItemId', 'ChildTwoDisplayName', 'child_2_route'));
        return $this->activateByRoute($request->get('_route'), $menuItems);
    }

    protected function activateByRoute($route, $items)
    {
        foreach ($items as $item) {
            if ($item->hasChildren()) {
                $this->activateByRoute($route, $item->getChildren());
            } else {
                if ($item->getRoute() == $route) {
                    $item->setIsActive(true);
                }
            }
        }

        return $items;
    }
}
