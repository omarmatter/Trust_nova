<?php

namespace Acm\RepeatRow;

use App\Models\product_detailse;
use Illuminate\Support\Facades\Log;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;

class RepeatRow extends Field
{
    /**
     * The field's component.
     *
     * @var array[]
     */

    public function hues(array $fields)
    {
        return $this->withMeta(['hues' => $fields]);
    }

    public function options(array $fields)
    {
        return $this->withMeta(['options' => $fields]);
    }

    protected function fillAttributeFromRequest(NovaRequest $request,
                                                            $requestAttribute,
                                                            $model,
                                                            $attribute)
    {


        $data =json_decode($request->inputs , true);



        $model::saved(function ($model) use ($request ,$data) {
            foreach ( $data as $value) {
                $product_detailse = new product_detailse();
                $product_detailse->product_id = $model->id;
                $product_detailse->Size = $value['size'];
                $product_detailse->price = $value['price'];
                $product_detailse->save();

            }

        });
//        Log::error($model);
//        if ($request->exists($requestAttribute)) {
//            $model->{$attribute} = $request[$requestAttribute];
//
//        }
    }






    public $component = 'repeat-row';
}
