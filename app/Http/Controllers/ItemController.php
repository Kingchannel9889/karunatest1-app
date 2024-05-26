<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;


class ItemController extends Controller
{
    public function index()
    {
        return view('items.index');
    }

    public function getData()
    {
        $items = Item::select(['id', 'name', 'price', 'details', 'status']);

        return DataTables::of($items)
            ->editColumn('status', function($item) {
                return $item->status ? 'Yes' : 'No';
            })
            ->addColumn('running_number', function($item) {
                static $runningNumber = 0;
                $runningNumber++;
                return $runningNumber;
            })
            ->addColumn('action', function($item) {
                return '
                    <a href="'.route('items.view', $item->id).'" class="btn btn-xs btn-primary">View</a>
                    <a href="'.route('items.edit', $item->id).'" class="btn btn-xs btn-warning">Edit</a>
                    <form action="'.route('items.destroy', $item->id).'" method="POST" style="display:inline-block;">
                        '.csrf_field().'
                        '.method_field('DELETE').'
                        <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm(\'Are you sure want to delete this item?\')">Delete</button>
                    </form>
                ';
            })
            ->make(true);
    }
    
    public function show($id)
        {
            $item = Item::findOrFail($id);
            return view('items.show', compact('item'));
        }

        public function destroy($id)
        {
            $item = Item::findOrFail($id);
            $item->delete();
            return redirect()->route('items.index')->with('success', 'Item deleted successfully');
        }

        public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'details' => 'required',
            'status' => 'required|boolean',
        ]);

        Item::create($request->all());

        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }

    
    public function view($id)
    {
 
        $item = Item::find($id);

       
        if (!$item) {
            return response()->json(['error' => 'Item not found'], 404);
        }

        return view('items.view', compact('item'));
    }

        public function edit($id)
    {
        
        $item = Item::findOrFail($id);
       
        return view('items.edit', compact('item'));
    }
    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'details' => 'required',
            'status' => 'required|boolean',
        ]);
        

        $item->update($request->all());
        
        $updatedItem = Item::findOrFail($id);

        $updatedTime = $updatedItem->updated_at->format('Y-m-d H:i:s');

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

}