<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\Interfaces\AttributeRepositoryInterface as AttributeRepository;
use Illuminate\Http\Request;

class AjaxAttributeController extends Controller
{
    protected $attributeRepository;
    public function __construct(AttributeRepository $attributeRepository)
    {
        $this->attributeRepository = $attributeRepository;
    }
    public function getAttribute(Request $request)
    {
        $payload = $request->all();
        $attributes = $this->attributeRepository->searchAttributes($payload['option']);
        $attributeMapped = $attributes->map(function ($attribute) {
            return [
                'id' => $attribute->id,
                'text' => $attribute->name,
            ];
        })->all();

        return response()->json(['items' => $attributeMapped]);
    }
}
