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
            "link-text"=>"ml-3 flex-1 whitespace-nowrap",
            "append" => "bg-gray-200 text-gray-800 ml-3 text-sm font-medium inline-flex items-center justify-center px-2 rounded-full",
            "prepend" => "w-6 h-6 text-gray-500 group-hover:text-gray-900 transition duration-75",
        ];

        $menu = \Menu::make('MyNavBar', function ($menu) use ($classes) {
            $menu->add('<span class="'.$classes['link-text'].'">Dashboard</span>', ['route' => 'home'])
                ->append('<span class="'.$classes['append'].'">Pro</span>')
                ->prepend('<svg class="'.$classes['prepend'].'" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>')
                ->link->attr(['class' => $classes['link']]);

            $menu->add('<span class="'.$classes['link-text'].'">About</span>', 'about')
                ->prepend('<i class="ti ti-smart-home '.$classes['prepend'].'"></i>')
                ->link->attr(['class' => $classes['link']]);

            $menu->add('Services', 'services');
            $menu->add('Contact', 'contact');
        });

        $view->with('sidebar_menu', $menu);
    }
}
