<?php

namespace imrealashu\laravelrest\Console;

use Illuminate\Console\Command;

class RestInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rest:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Installs the basic scaffolding';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
//        config(['laravel-rest-config.TransformerDirectoryName' => 'Acme']);
//        $this->info(config('laravel-rest-config.TransformerDirectoryName'));

        $bar = $this->output->createProgressBar(5);


        $this->comment('+-----------------------------------------------------+');
        $this->comment('|               Welcome to Laravel Rest               |');
        $this->comment('+-----------------------------------------------------+');
        $input = $this->ask('Name your Transformer directory? Default: "Acme". Press enter to go with default name','Acme');

        if(!file_exists(app_path($input))){

            $bar->start();
            $this->info(' Creating Rest Transformer '.$input);

//            $this->info(' Installing Laravel Rest');

            $bar->advance();
            $this->info(' Creating directory');
            mkdir(app_path($input),0777, true);

            $bar->advance();
            $this->info(' Creating Transformers');
            $this->classData($input);

            $bar->advance();
            $this->info(' Updating Config');
            $this->changeConfig($input);


            $bar->finish();
            $this->info(' Finished!');
            $this->output->newLine(2);
            $this->info(' Installed Successfully');

//            config(['laravel-rest-config.TransformerDirectoryName' => $input]);

            $requirement = '"psr-4": {
            "'.$input.'\\\\": "app/'.$input.'",';

            $path_to_file = base_path('composer.json');
            $file_contents = file_get_contents('composer.json');
            $file_contents = str_replace('"psr-4": {',$requirement,$file_contents);
            file_put_contents($path_to_file,$file_contents);

        }else{
            $this->error('Directory already exists!!');
        }

    }
    private function classData($transformerName){
        $data = "<?php\nnamespace ".$transformerName."\\Transformers;\n\nabstract class Transformer{\n\t/**\n\t* @param array".' $items'."\n\t*@return array\n\t*/\n\tpublic function transformCollection(array ".'$items'."){\n\t\treturn array_map([".'$this'.", transform],".'$items'.");\n\t}\n\n\tpublic abstract function transform(".'$item'.");\n\tpublic abstract function transformLong(".'$item'.");\n}";
        file_put_contents(app_path($transformerName.'/Transformer.php'),$data);

    }
    private function changeConfig($input){
        $path_to_file = base_path('config/laravel-rest-config.php');
        $file_contents = file_get_contents('config/laravel-rest-config.php');
        $file_contents = str_replace("'TransformerDirectoryName' => ''","'TransformerDirectoryName' => '$input'",$file_contents);
        file_put_contents($path_to_file,$file_contents);
    }
}
