<?php

namespace App\Nova;

use App\Models\product_detailse;
use App\Nova\Actions\Actions;
use App\Nova\Actions\productactions;
use App\Nova\Actions\ProductStatusInStock;
use App\Nova\Actions\ProductStatusOutStock;
use App\Nova\Filters\ProductByCategory;
use Eminiarts\Tabs\Tab;
use Eminiarts\Tabs\Tabs;
use Eminiarts\Tabs\TabsOnEdit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Country;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;
use Spatie\NovaTranslatable\Translatable;
use R64\NovaFields\Row;


class Product extends Resource
{
    use TabsOnEdit;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\product::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'name',

    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {

        return [

            (  new Tabs('Products', [
                'Data'    => [

                    Translatable::make([
                        Text::make('name')->rules('required'),
                        ]),
                        BelongsTo::make('category')->rules('required'),
                        Select::make('status')->options(function (){
                            return \App\Models\product::productStatuses();
                        })->displayUsingLabels(),

                    Translatable::make([
                            Trix::make('desc')->rules('required'),

                        ]),
                        Image::make('image')->disk('public')->prunable()->creationRules('required') ,
//                    Badge::make('status' , function (){
//                        return \App\Models\product::productStatuses()[$this->status];
//                    })->map([
//                        'in stock' => 'success',
//                        'out of stock' => 'danger',
//                    ]),
                ],
                'Other Info' => [
                    Row::make('productDetailse', [
                         \R64\NovaFields\Select::make('Size')->options([
                        'S' => 'Small',
                        'M' => 'Medium',
                        'L' => 'Large',
                    ])->fieldClasses('w-full px-8 py-6')->displayUsingLabels(),
                    \R64\NovaFields\Number::make('price')->fieldClasses('w-full px-8 py-6')->min(1)->max(1000)->step(0.01)->rules('required') ,
                ])->fillUsing(function ($request,$model){

                    $model::saved(function ($model) use ($request){

                        $dataRows=$request->productdetailse?:[];

                       foreach ($dataRows as $data){
                           Log::info($data);
                           if(!$data['id']){
                               $product_detailse = new product_detailse();
                               $product_detailse->product_id= $model->id;
                           }else{
                               $product_detailse =  product_detailse::find($data['id']);
                               $product_detailse->updated_at= date("Y-m-d");

                           }
//                           $data=(object)$data;
                           Log::info($data['Size']);

                           $product_detailse->product_id= $model->id ;
                           $product_detailse->Size = $data['Size'];
                           $product_detailse->price= $data['price'];
                           $product_detailse->save();
                       }
                    });
                    }),
                        ]
            ]))->withToolbar(true),


        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [ new ProductByCategory()];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
   return [
new productactions()
   ];
    }

}
