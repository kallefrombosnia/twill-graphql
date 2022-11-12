<?php

namespace Twill\Graphql\Commands;

use Illuminate\Console\Command;


class DeployCommand extends Command
{
    public $signature = 'twill:graphql:deploy 
                         {--force : Forces schema to deploy. Old file will get overwritten.}';

    public $description = 'Deploys Twill\'s GraphQL schemas';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {

        // Implement force logic later
        $force = $this->option('force');

        $lighthouse = config('lighthouse.schema.register');
        $local = base_path('vendor/kallefrombosnia/twill-graphql/src/schema.graphql');
        
        $local_twill = base_path('vendor/kallefrombosnia/twill-graphql/src/twill.graphql');
        $distant_twill = base_path('graphql/twill.graphql');

        // Check if lighthouse config is submitted
        if(!$lighthouse){

            $this->error('config/lighthouse.php doesn\'t exists. Run command below to publish the config file.');
            $this->newLine();
            $this->info('php artisan vendor:publish --tag=lighthouse-config');
            $this->newLine();
            
            return self::FAILURE;
        }

        // Assign lighouse default schema location to our own
        $distant_default = $lighthouse;

        try {

            // Check if folder exists
            if(!$this->folder_exist(dirname($distant_default))){

                // Try to create graphql directory
                if(!mkdir(dirname($distant_default), 0777, true)){

                    $this->error('Couldn\'t create ./graphql directory. Check permissions.');

                    return self::FAILURE;
                }
            }
            
            // Check if schema.graphql exists
            if($this->file_exist($distant_default)){

                // Compare file edit 
                if(!$this->file_compare($local, $distant_default)){

                    // Ask user to overwrite the file 
                    if ($this->confirm('This will overwrite schema in ' . realpath($distant_default) . '. Do you wish to continue?')) {

                        // Handle file copy when we overwrite file
                        if(copy($local, $distant_default)){

                            $this->comment(realpath($distant_default) . ' successfully deployed to ' . realpath($distant_default));

                        }else{

                            $this->error('Something went wrong while deploying to ' . $distant_default);

                            return self::FAILURE;
                        }
                    }

                }

            }else{

                // Handle file copy when file doesn't exists
                if(copy($local, $distant_default)){
                
                    $this->comment(realpath($distant_default) . ' successfully deployed to ' . realpath($distant_default));

                }else{

                    $this->error('Something went wrong while deploying to ' . realpath($distant_default));

                    return self::FAILURE;
                }
            }

            // Check if twill.graphql exists
            if($this->file_exist($distant_twill)){

                // Compare file edit 
                if(!$this->file_compare($local_twill, $distant_twill)){

                    // Ask user to overwrite the file 
                    if ($this->confirm('twill.schema differs from vendor twill.graphql file. Publishing will overwrite existing. ' . realpath($distant_twill) . '. Do you wish to continue?', false)) {

                        // Handle file copy when file doesn't exists
                        if(copy($local_twill, $distant_twill)){

                            $this->comment(realpath($local_twill) . ' successfully deployed to ' . realpath($distant_twill));

                        }else{

                            $this->error('Something went wrong while deploying to ' . realpath($distant_twill));

                            return self::FAILURE;
                        }
                    }

                }else{

                }

            }else{

                // Handle file copy when file doesn't exists
                if(copy($local_twill, $distant_twill)){

                    $this->comment(realpath($local_twill) . ' successfully deployed to ' . realpath($distant_twill));

                }else{

                    $this->error('Something went wrong while deploying to ' . realpath($distant_twill));

                    return self::FAILURE;
                }
            }
            
        } catch (\Exception $exception) {

            $this->error($exception->getMessage());

            return self::FAILURE;
        }
            
        return self::SUCCESS;
    }


    /**
     * Checks if a folder exist and return canonicalized absolute pathname (long version)
     * @param string $folder the path being checked.
     * @return string|bool returns the canonicalized absolute pathname on success otherwise FALSE is returned
     */
    private function folder_exist($folder) : string | bool
    {
        // Get canonicalized absolute pathname
        $path = realpath($folder);

        // If it exist, check if it's a directory
        return ($path !== false AND is_dir($path)) ? $path : false;
    }

    /**
     * Checks if a file exist and return canonicalized absolute pathname (long version)
     * @param string $file the path being checked.
     * @return string|bool returns the canonicalized absolute pathname on success otherwise FALSE is returned
     */
    private function file_exist($file) : string | bool
    {
        
        // Check if file exists
        return file_exists($file) ?  $file : false;
    }

    /**
     * Checks if a local and vendor files are equal (last time changed)
     * @param string $local the file path being checked.
     * @param string $distant the fiel path being checked.
     * @return bool returns bool
     */
    private function file_compare($local, $distant) : bool
    {

        // Check if file last edit time values are equal
        return filemtime($local) === filemtime($distant) ? true : false;
    }

}
