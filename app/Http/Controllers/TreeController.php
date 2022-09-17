<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TreeController extends Controller
{
    public function getRoot()
    {
        $roots = DB::select('select te.entry_id, te.parent_entry_id, tel.name from tree_entry as te join tree_entry_lang as tel on te.entry_id = tel.entry_id where parent_entry_id = 0');
        
        return view('welcome', compact('roots'));
    }
    public function getLevel($id)
    {
        $labels = DB::select('select te.entry_id, te.parent_entry_id, tel.name from tree_entry as te join tree_entry_lang as tel on te.entry_id = tel.entry_id where parent_entry_id = '.$id.'');
        return json_encode($labels);
    }
}
