<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Actions\DestructiveAction;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;

class productactions extends DestructiveAction
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        if($fields->status== '0') {
            foreach ($models as $model) {
                $model->update([
                    'status' => '0'
                ]);
            }
            return Action::message('success update to in stock');
        }elseif ($fields->status== '1'){
            foreach ($models as $model) {
                $model->update([
                    'status' => '1'
                ]);
            }
            return  Action::message('success update to out in  stock');

        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Select::make('status')->options([
                '0' =>'in stock' ,
                '1' => 'out of stock'
            ])
        ];
    }
}
