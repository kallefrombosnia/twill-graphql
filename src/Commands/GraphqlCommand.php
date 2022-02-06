<?php

namespace Twill\Graphql\Commands;

use Illuminate\Console\Command;


class GraphqlCommand extends Command
{
    public $signature = 'twill:graphql:deploy';

    public $description = 'Deploys Twill\'s default schema';

    public function handle(): int
    {
    
        $local = base_path('vendor\kallefrombosnia\twill-graphql\src\schema.graphql');
        $distant = base_path('graphql\schema.graphql');

        try {

            mkdir(dirname($distant), 0777, true);

            if(copy($local, $distant)){
                $this->comment('./graphql/schema.graphql successfully deployed to ' . $distant);
            }else{
                $this->error('Something went wrong while deploying to ./graphql/schema.graphql');
            }
            
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
            
        return self::SUCCESS;
    }
}
