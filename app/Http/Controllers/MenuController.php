<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Menu;

class MenuController extends Controller
{
    public function add_menu(Request $request)
    {
        $this->validate($request, [
            'menu_name' => 'required',
            'menu_price' => 'required',
            'time_ready' => 'required',
            'menu_image' => 'required',
            'menu_description' => 'required',
        ]);
        $menuImage = Storage::disk('public')->putFile('menusImage', $request->file('menu_image'));
        $menu = Menu::create([
            'menu_name' => $request->menu_name,
            'menu_price' => $request->menu_price,
            'time_ready' => $request->time_ready,
            'menu_image' => $menuImage,
            'menu_description' => $request->menu_description,
        ]);
        Alert::success($request->menu_name, 'Successfully Added To The Menu!');
        return redirect()->back();
    }

    public function delete_menu($id)
    {
        $menu = Menu::findOrFail($id);
        Storage::disk('public')->delete($menu->menu_image);
        $menu->delete();
        Alert::error($menu->menu_name, 'Successfully Deleted The Menu!');
        return redirect()->back();
    }

    public function update_menu(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);
        $imageInUpdate = $request->file('menu_image');
        if (empty($imageInUpdate)) {
            $updateMenu = Menu::whereId($id)->update([
                'menu_name' => $request->menu_name,
                'menu_price' => $request->menu_price,
                'time_ready' => $request->time_ready,
                'menu_description' => $request->menu_description,
            ]);
        } else {
            $updateMenuImage = Storage::disk('public')->putFile('menusImage', $request->file('menu_image'));
            $updateMenu = Menu::whereId($id)->update([
                'menu_name' => $request->menu_name,
                'menu_price' => $request->menu_price,
                'time_ready' => $request->time_ready,
                'menu_image' => $updateMenuImage,
                'menu_description' => $request->menu_description,
            ]);
            Storage::disk('public')->delete($menu->menu_image);
        }

        Alert::success($request->menu_name, 'Successfully Updated The Menu!');
        return redirect(route('admin.menus'));
    }
}
