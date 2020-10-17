<?php

namespace App\Console\Commands;

use App\Models\CovidCase;
use App\Imports\CovidImport;
use App\Models\CovidCaseState;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use App\Covid\CovidApi;
use Illuminate\Support\Facades\Storage;

class SeedCases extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'covid:seed-cases 
                            {--source= : Where get dataset api or file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        // Retrieve a specific option...
        $source = $this->option('source');

        if ($source == 'file') {
            $this->output->title('Iniciando Importação dos Dados');
            (new CovidImport)->withOutput($this->output)->import(Storage::path('caso.csv'));
            $this->output->success('Importação Concluida!');
        }

        if ($source == 'api') {
            $cases = new CovidApi;
            $this->output->title('Iniciando Importação dos Dados');
            $bar1 = $this->output->createProgressBar(count($cases->getCaseContirmedAndDeath()));

            $this->line('Api brasil.io');
            collect($cases->getCaseContirmedAndDeath())->each(function ($case) use ($bar1) {
                CovidCase::updateOrCreate([
                    'date' => $case['date'],
                    'city_ibge_code' => $case['city_ibge_code'],
                ], [
                    'state' => $case['state'],
                    'city' => $case['city'],
                    'place_type' => $case['place_type'],
                    'confirmed' => $case['confirmed'],
                    'deaths' => $case['deaths'],
                    'order_for_place' => $case['order_for_place'],
                    'is_last' => $case['is_last'],
                    'estimated_population_2019' => $case['estimated_population_2019'],
                    'estimated_population' => $case['estimated_population'],
                    'confirmed_per_100k_inhabitants' => $case['confirmed_per_100k_inhabitants'],
                    'death_rate' => $case['death_rate'],
                ]);

                $bar1->advance();
            });

            $bar1->finish();
            $this->line('Api brazil covid19');
            $bar2 = $this->output->createProgressBar(count($cases->getCaseForStates()));
            collect($cases->getCaseForStates())->each(function ($case) use ($bar2) {
                CovidCaseState::updateOrCreate(['uid' => $case['uid']], [
                    'uf' => $case['uf'],
                    'state' => $case['state'],
                    'cases' => $case['cases'],
                    'deaths' => $case['deaths'],
                    'refuses' => $case['refuses'],
                    'datetime' => Carbon::parse($case['datetime'])->format('Y-m-d H:i:s'),
                    'suspects' => $case['suspects'],
                ]);
                $bar2->advance();
            });
            $bar2->finish();
            $this->output->success('Importação Concluida!');
        }
    }
}
