<?php

namespace App\View\Composers;

use Illuminate\View\View;

class SidebarComposer {

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view) {

        $classes = [
            "wrap" => "space-y-2 pb-2",
            'link' => "text-base text-gray-900 dark:text-gray-400 font-normal rounded-lg hover:bg-gray-100 hover:dark:text-gray-900 flex items-center p-2 group",
            'link-child' => "flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700",
            "link-text" => "ml-3 flex-1 whitespace-nowrap",
            "append" => "bg-gray-200 text-gray-800 ml-3 text-sm font-medium inline-flex items-center justify-center px-2 rounded-full",
            "prepend" => "w-6 h-6 text-[24px] text-gray-500 group-hover:text-gray-900 transition duration-75",
            "sub-indicator" => '<svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>'
        ];

        $menu = \Menu::make('MyNavBar', function ($menu) use ($classes) {
            $menu->add('<span class="' . $classes['link-text'] . '">Dashboard</span>', ['route' => 'dashboard'])
                ->prepend('<i class="tele tele-dashboard ' . $classes['prepend'] . '"></i>')
                // ->append('<span class="' . $classes['append'] . '">Pro</span>')
                ->link->attr(['class' => $classes['link']]);

            $menu->add('<span class="' . $classes['link-text'] . '">Managers</span>', 'user.managers.list')
                ->prepend('<i class="tele tele-user-manager ' . $classes['prepend'] . '"></i>')
                ->append($classes['sub-indicator'])
                ->nickname('managers')
                ->data('submenu_id', 'managers')
                ->link->attr(['class' => $classes['link'], 'data-submenu-target' => 'managers'])
                ->href('javascript:void()');

            $menu->managers->add('All Managers', ['route' => 'user.managers.list'])
                ->link->attr(['class' => $classes['link-child']]);

            $menu->managers->add('Add New', ['route' => 'home'])
                ->link->attr(['class' => $classes['link-child']]);

            $menu->add('<span class="' . $classes['link-text'] . '">Doctors</span>', 'user.doctors.list')
                ->prepend('<i class="tele tele-user-doctor ' . $classes['prepend'] . '"></i>')
                ->append($classes['sub-indicator'])
                ->nickname('doctors')
                ->data('submenu_id', 'doctors')
                ->link->attr(['class' => $classes['link'], 'data-submenu-target' => 'doctors'])
                ->href('javascript:void()');

            $menu->doctors->add('All Doctors', ['route' => 'user.doctors.list'])
                ->link->attr(['class' => $classes['link-child']]);

            $menu->doctors->add('Add New', ['route' => 'home'])
                ->link->attr(['class' => $classes['link-child']]);

            $menu->add('<span class="' . $classes['link-text'] . '">Patients</span>', 'user.patients.list')
                ->prepend('<i class="tele tele-user-patient ' . $classes['prepend'] . '"></i>')
                ->append($classes['sub-indicator'])
                ->nickname('users')
                ->data('submenu_id', 'users')
                ->link->attr(['class' => $classes['link'], 'data-submenu-target' => 'users'])
                ->href('javascript:void()');

            $menu->users->add('All Patients', ['route' => 'user.patients.list'])
                ->link->attr(['class' => $classes['link-child']]);

            $menu->users->add('Add New', ['route' => 'home'])
                ->link->attr(['class' => $classes['link-child']]);

            $menu->add('<span class="' . $classes['link-text'] . '">Support Agents</span>', 'user.agents.list')
                ->prepend('<i class="tele tele-user-support ' . $classes['prepend'] . '"></i>')
                ->append($classes['sub-indicator'])
                ->nickname('agents')
                ->data('submenu_id', 'agents')
                ->link->attr(['class' => $classes['link'], 'data-submenu-target' => 'agents'])
                ->href('javascript:void()');

            $menu->agents->add('All Support Agents', ['route' => 'user.agents.list'])
                ->link->attr(['class' => $classes['link-child']]);

            $menu->agents->add('Add New', ['route' => 'home'])
                ->link->attr(['class' => $classes['link-child']]);


            $menu->add('<span class="' . $classes['link-text'] . '">About</span>', 'about')
                ->prepend('<i class="ti ti-smart-home ' . $classes['prepend'] . '"></i>')
                ->link->attr(['class' => $classes['link']]);
        });

        $renderedMenu = $this->menuRender($menu->roots(), ['class' => 'space-y-2 pb-2'], ['class' => 'hidden submenu py-2 space-y-2']);

        $view->with('sidebar_menu', $renderedMenu);
    }

    public function menuRender($items = null, $attributes = [], $children_attributes = [], $item_attributes = [], $item_after_calback = null, $item_after_calback_params = []) {
        return '<ul' . \Lavary\Menu\Builder::attributes($attributes) . '>' . $this->render('ul', $items, $children_attributes, $item_attributes, $item_after_calback, $item_after_calback_params) . '</ul>';
    }


    public function render($type = 'ul', $menu_items = null, $children_attributes = [], $item_attributes = [], $item_after_calback = null, $item_after_calback_params = []) {
        $items = '';

        $item_tag = in_array($type, array('ul', 'ol')) ? 'li' : $type;

        foreach ($menu_items as $item) {
            if ($item->link) {
                $link_attr = $item->link->attr();
                if (is_callable($item_after_calback)) {
                    call_user_func_array($item_after_calback, [
                        $item,
                        &$children_attributes,
                        &$item_attributes,
                        &$link_attr,
                        &$item_after_calback_params,
                    ]);
                }
            }
            $all_attributes = array_merge($item_attributes, $item->attr());
            if (isset($item_attributes['class'])) {
                $all_attributes['class'] = $all_attributes['class'] . ' ' . $item_attributes['class'];
            }
            $items .= '<' . $item_tag . \Lavary\Menu\Builder::attributes($all_attributes) . '>';

            if ($item->link) {
                $items .= $item->beforeHTML . '<a' . \Lavary\Menu\Builder::attributes($link_attr) . (!empty($item->url()) ? ' href="' . $item->url() . '"' : '') . '>' . $item->title . '</a>' . $item->afterHTML;
            } else {
                $items .= $item->title;
            }

            if ($item->hasChildren()) {
                $isItemActive = false;
                if ($item->children()->where('isActive', true)->first() !== null) {
                    $isItemActive = true;
                }

                $unique_child_attr = $children_attributes;
                $unique_child_attr['id'] = $item->data('submenu_id');

                if ($isItemActive && strpos($unique_child_attr['class'], 'hidden') !== false) {
                    $unique_child_attr['class'] = str_replace('hidden', "", $unique_child_attr['class']);
                }

                $items .= '<' . $type . \Lavary\Menu\Builder::attributes($unique_child_attr) . '>';
                // Recursive call to children.
                $items .= $this->render($type, $item->children(), $children_attributes, $item_attributes, $item_after_calback, $item_after_calback_params);
                $items .= "</{$type}>";
            }

            $items .= "</{$item_tag}>";

            if ($item->divider) {
                $items .= '<' . $item_tag . \Lavary\Menu\Builder::attributes($item->divider) . '></' . $item_tag . '>';
            }
        }

        return $items;
    }
}
