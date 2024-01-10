<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $tamp_value = Choice_template::where('user_id', Auth::id())->select('temp_value')->get()[0]->temp_value;
        // // dd();
        // View::share('tamp_value', $tamp_value);
        Schema::defaultStringLength(191);

        //Blade directive to convert Date Format.
        Blade::directive('format_date', function ($date) {
            if (!empty($date)) {
                return  Carbon::createFromTimestamp(strtotime($date))->format('Y-m-d');
                // $formatedDate = Carbon::now()->format('Y-m-d');
                // return $formatedDate;
            } else {
                return null;
            }
        });

        Blade::directive('num_format', function ($expression) {
            return "number_format($expression, 2, '.', ',')";
        });

        //Blade directive to display help text.
        Blade::directive('show_tooltip', function ($message) {
            return "<?php
                    echo '<i class=\"fa fa-info-circle text-info hover-q \" aria-hidden=\"true\" 
                    data-container=\"body\" data-toggle=\"popover\" data-placement=\"top\" 
                    data-content=\"' . $message . '\" data-html=\"true\" data-trigger=\"hover\"></i>';
                ?>";
        });

        Blade::directive('loader', function () {
            return '<div id="cover-spin">
            <div onclick="hideLoader()" style="position:absolute;right:30px;top:0px;color:black;font-size:58px;cursor:pointer;color:#C00;">×</div>
            </div>';
        });
    }
}
