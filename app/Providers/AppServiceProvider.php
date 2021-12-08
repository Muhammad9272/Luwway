<?php

namespace App\Providers;

use App;
use App\Classes\GeniusMailer;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Shipping;
use App\Models\Socialsetting;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {


        // Session::put('currency',561);
         
        $admin_lang = DB::table('admin_languages')->where('is_default','=',1)->first();
        App::setlocale($admin_lang->name);
        $gs=DB::table('generalsettings')->find(1);
        $seo=DB::table('seotools')->find(1);

        Config::set('mail.host', $gs->smtp_host);
        Config::set('mail.port', $gs->smtp_port);
        Config::set('mail.encryption', $gs->email_encryption);
        Config::set('mail.username', $gs->smtp_user);
        Config::set('mail.password', $gs->smtp_pass);
        
        //$categories=Category::with(['subs.childs'])->where('status','=',1)->get();
        $categories=Category::withCount(['subs','childs'])->where('status','=',1)->get();
       
        $socialsetting=Socialsetting::find(1);
        $currencies=Currency::all();
        $pages=DB::table('pages')->where('footer','=',1)->get();
        $freeshipping=Shipping::where('price',0)->get();
        
         $op=1;
        view()->composer('*',function($settings) use ($gs,$seo,$categories,$socialsetting,$currencies,$pages,$op,$freeshipping){


            if (Session::has('language')) 
            {
                $data = DB::table('languages')->find(Session::get('language'));
                $data_results = file_get_contents(public_path().'/assets/languages/'.$data->file);
                $lang = json_decode($data_results);           
            }
            else
            {
                $data = DB::table('languages')->where('is_default','=',1)->first();
                $data_results = file_get_contents(public_path().'/assets/languages/'.$data->file);
                $lang = json_decode($data_results);  
            }
            if (Session::has('currency')) $curr = Currency::find(Session::get('currency'));
            else $curr = Currency::where('is_default','=',1)->first();
     
            config([
                     'global.global_gs' => json_encode($gs),
                     'global.global_curr' =>json_encode($curr) ,
                  ]);
            
            $settings->with('op',$op);
            $settings->with('gs',$gs);
            $settings->with('seo',$seo );
            $settings->with('categories',$categories );  
            $settings->with('langg', $lang);
            $settings->with('socialsetting', $socialsetting);
            $settings->with('currencies', $currencies);
            $settings->with('footerpages', $pages);
            $settings->with('freeshipping', $freeshipping);


        


            //$settings->with('curr',$curr);
            if (!Session::has('popup')) 
            {
                $settings->with('visited', 1);
            }
            Session::put('popup' , 1);

        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        Collection::macro('paginate', function($perPage, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);
            return new LengthAwarePaginator(
                $this->forPage($page, $perPage),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });

    }
}
