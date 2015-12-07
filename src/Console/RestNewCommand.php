<?php

namespace imrealashu\laravelrest\Console;

use ClassPreloader\Config;
use Illuminate\Console\Command;

class RestNewCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rest:new {TransformerName}  {--bare}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new Transformer class';

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
        $transformer_name = $this->argument('TransformerName');
        $bare = $this->option('bare');
        $transformer_directory_name = config('laravel-rest-config.TransformerDirectoryName');

        if(file_exists(app_path($transformer_directory_name)) && $bare){
            $this->output->newLine(1);
            $this->info('Creating file...');
            $this->info('Transformer Created: '.app_path($transformer_directory_name.'/'.ucwords($transformer_name).'Transformer.php'));
            $this->transformerClassData($transformer_name, $transformer_directory_name);
        }else if(file_exists(app_path($transformer_directory_name)) && !$bare){
            if(file_exists(app_path($transformer_directory_name.'/'.$transformer_name.'Transformer.php'))){
                $this->warn('Warning: File'.$transformer_name.'Transformer.php already exists');
                $choice = $this->anticipate('Do you want to overwrite?', ['Yes', 'No']);

                if(strtolower($choice) == 'yes'){
                    $this->output->newLine(1);
                    $this->info('Overwriting files...');
                    $this->info('Transformer Created: '.app_path($transformer_directory_name.'/'.ucwords($transformer_name).'Transformer.php'));
                    $this->info('Controller Created: '.app_path('Http/Controllers/API/'.ucfirst(str_plural($transformer_name)).'Controller.php'));
                    $this->transformerClassData($transformer_name,$transformer_directory_name);
                    $this->transformerControllerData($transformer_name,$transformer_directory_name);
                    $this->output->newLine(1);
                }else{
                    $this->comment('Exiting...');
                    exit;
                }
            }else{
                $this->output->newLine(1);
                $this->info('Overwriting files...');
                $this->info('Transformer Created: '.app_path($transformer_directory_name.'/'.ucwords($transformer_name).'Transformer.php'));
                $this->info('Controller Created: '.app_path('Http/Controllers/API/'.ucfirst(str_plural($transformer_name)).'Controller.php'));
                $this->transformerClassData($transformer_name,$transformer_directory_name);
                $this->transformerControllerData($transformer_name,$transformer_directory_name);
                $this->output->newLine(1);
            }

        }else{
            $this->error('`'.$transformer_directory_name.'` is not exist! Please run `rest:install` and try again');
        }

    }
    public function transformerClassData($transformer_name, $transformer_directory_name){
        $data = "<?php \nnamespace ".$transformer_directory_name."\\Transformers;\n\nclass ".$transformer_name.'Transformer'." extends Transformer{\n\n\n\t/**\n\t* @param $".$transformer_name." array\n\t* @return array\n\t**/\n\tpublic function transform(".'$item'."){\n\n\treturn [\n\n\n\t ];\n\t}\n\n\t\n\t/**\n\t* @param $".$transformer_name." array\n\t* @return array\n\t**/public function transformLong(".'$item'."){\n\n\treturn [\n\n\n\t ];\n\t}\n}";
        file_put_contents(app_path($transformer_directory_name.'/'.ucwords($transformer_name).'Transformer.php'),$data);
    }
    public function transformerControllerData($transformer_name, $transformer_directory_name){
        $data = "<?php\n\nnamespace App\\Http\\Controllers\\API;\nuse ".$transformer_directory_name."\\Transformers\\".$transformer_name.";\n\nclass ".ucfirst(str_plural($transformer_name))." extends ApiController{\n\n"."protected $".$transformer_name."Transformer;\n\n\tfunction __construct(".$transformer_name."Transformer $".$transformer_name."Transformer){\n\t\t".'$this->'.$transformer_name."Transformer = $".$transformer_name."Transformer;\n\t}\n\npublic function index(){\n\n\t".'$data_array = [];'."\n\n\treturn ".'$this->'."respond([\n\t\t"."'data'".'=> $this->'.$transformer_name."Transformer->transformCollection(".'$data_array'.")\n\t\t]);\n\t}\n\npublic function show(".'$id'."){\n\n\t".'$data_array = [];'."\n\n\treturn ".'$this->'."respond([\n\t\t"."'data'".'=> $this->'.$transformer_name."Transformer->transformLong(".'$data_array'.")\n\t\t]);\n\t}\n\n}";
        file_put_contents(app_path('Http/Controllers/API/'.ucfirst(str_plural($transformer_name)).'Controller.php'),$data);
    }
}
