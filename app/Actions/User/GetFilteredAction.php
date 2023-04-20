<?php

namespace App\Actions\User;

use App\Filters\User\AgeFilter;
use App\Filters\User\GenderFilter;
use App\Filters\User\ReligionFilter;
use \App\Filters\User\NameFilter;

use App\Models\User;
use Illuminate\Pipeline\Pipeline;

class GetFilteredAction
{
    public function execute()
    {
        return app(Pipeline::class)
            ->send(User::query())
            ->through([
                NameFilter::class,
                GenderFilter::class,
                ReligionFilter::class,
                AgeFilter::class,
            ])
            ->thenReturn()
            ->get();
    }
}
