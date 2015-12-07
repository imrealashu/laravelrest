<?php

namespace imrealashu\LaravelRest;

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
        $data = '';
        $data .= '<?php';
        $data .= "\n";
        $data .= 'namespace '.$transformerName.'\Transformers;';
        $data .= "\n";

        $data .= 'abstract class Transformer{';
        $data .= "\n";
        $data .= '/**'."\n";
        $data .= '* @param array $items'."\n";
        $data .= '* @return array'."\n";
        $data .= '*/';
        $data .= "\n";
        $data .= 'public function transformCollection(array $items){'."\n";
        $data .= 'return array_map([$this,"transform"],$items);'."\n";
        $data .= '}';
        $data .= "\n";
        $data .= 'public abstract function transform($item);'."\n";
        $data .= 'public abstract function transformLong($item);'."\n";
        $data .= '}';

        file_put_contents(app_path($transformerName.'/Transformer.php'),$data);

    }
    private function changeConfig($input){
        $path_to_file = base_path('config/laravel-rest-config.php');
        $file_contents = file_get_contents('config/laravel-rest-config.php');
        $file_contents = str_replace("'TransformerDirectoryName' => ''","'TransformerDirectoryName' => '$input'",$file_contents);
        file_put_contents($path_to_file,$file_contents);
    }
}
