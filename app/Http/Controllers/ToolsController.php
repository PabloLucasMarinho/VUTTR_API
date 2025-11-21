<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreToolRequest;
use App\Http\Resources\ToolsResource;
use App\Models\Tag;
use App\Models\Tool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ToolsController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $query = $request->user()->tools()->with('tags');

    if ($request->has('tag')) {
      $query->whereHas('tags', function ($q) use ($request) {
        $q->where('name', $request->tag);
      });
    }

    $tools = $query->get();

    return response()->json(ToolsResource::collection($tools));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreToolRequest $request)
  {
    $data = $request->validated();
    $tagsData = $data['tags'] ?? [];
    unset($data['tags']);

    $data['user_id'] = $request->user()->id;

    $tool = Tool::create($data);

    $tagsId = collect($tagsData)->map(function ($tagName) {
      return Tag::firstOrCreate(['name' => $tagName])->id;
    });

    $tool->tags()->sync($tagsId);

    return response()->json(new ToolsResource($tool), 201);
  }

  /**
   * Display the specified resource.
   */
  public function show(Tool $tool)
  {
    abort_if(Auth::id() != $tool->user_id, 403, 'Acesso negado');

    return response()->json(new ToolsResource($tool));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(StoreToolRequest $request, Tool $tool)
  {
    abort_if(Auth::id() != $tool->user_id, 403, 'Acesso negado');

    $data = $request->validated();
    $tagsData = $data['tags'] ?? [];
    unset($data['tags']);

    $tool->update($data);

    $tagsId = collect($tagsData)->map(function ($tagName) {
      return Tag::firstOrCreate(['name' => $tagName])->id;
    });

    $tool->tags()->sync($tagsId);

    return response()->json(new ToolsResource($tool));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Tool $tool)
  {
    abort_if(Auth::id() != $tool->user_id, 403, 'Acesso negado');

    $tool->delete();
    return response()->noContent();
  }
}
