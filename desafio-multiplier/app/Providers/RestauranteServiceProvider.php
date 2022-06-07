<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RestauranteServiceProvider extends ServiceProvider
{
    /**
     * Retorna os serviços
     */
    public function getServices(){
        return [           
            'Cliente',
            'Mesa',
            'Cardapio',
            'Pedido',
        ];
    }

     /**
     * Retorna as factories
     */
    public function getFactories(){
        return [              
        ];
    }

    /**
     * Retorna os repositórios
     */
    public function getRepositories(){
        return [           
        ];
    }

    public function getWebhookServices(){
        return [                                    
        ];
    }
    
    public function bindServices($lista){
        foreach ($lista as $item){            
            $this->app->bind("App\Restaurante\\".$item."\\".$item."ServiceInterface", "App\Restaurante\\".$item."\\".$item."Service");    
        }
    }

    public function bindFactories($lista){
        foreach ($lista as $item){            
            $this->app->bind("App\Restaurante\\".$item."\\".$item."FactoryInterface", "App\Restaurante\\".$item."\\".$item."Factory");    
        }
    }

    public function bindRepositories($lista){
        foreach ($lista as $item){
            $this->app->bind("App\Restaurante\\".$item."\\".$item."RepositoryInterface", "App\Restaurante\\".$item."\\".$item."Repository");                
        }
    }

    public function bindWebhookServices($lista){
        foreach ($lista as $item){            
            $this->app->bind("App\Restaurante\Contract\Service\Webhook\\".$item."ServiceInterface", "App\Restaurante\Core\Service\Webhook\\".$item."Service");    
        }
    }
  

   

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $services = $this->getServices();
        $this->bindServices($services);

        $factories = $this->getFactories();
        $this->bindFactories($services);

        $repositories = $this->getRepositories();   
        $this->bindRepositories($repositories);

        // $webhookServices = $this->getWebhookServices();
        // $this->bindWebhookServices($webhookServices);       

       
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}