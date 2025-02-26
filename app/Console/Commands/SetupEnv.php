<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class SetupEnv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:setup-env';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $envExamplePath = base_path('.env.example');
        $envPath = base_path('.env');

        // Controlla se il file .env esiste già
        if (File::exists($envPath)) {
            $this->error('.env esiste già! Se vuoi sovrascriverlo, cancellalo prima.');
            return;
        }

        // Copia il file .env.example in .env
        File::copy($envExamplePath, $envPath);
        $this->info('.env creato con successo!');

        // Imposta i dati di connessione
        $dbHost = $this->ask('Inserisci il DB_HOST', '127.0.0.1');
        $dbPort = $this->ask('Inserisci il DB_PORT', '3306');
        $dbName = $this->ask('Inserisci il DB_DATABASE', 'laravel');
        $dbUser = $this->ask('Inserisci il DB_USERNAME', 'root');
        $dbPass = $this->secret('Inserisci il DB_PASSWORD');

        // Modifica il file .env con i dati forniti
        $this->updateEnv([
            'DB_HOST' => $dbHost,
            'DB_PORT' => $dbPort,
            'DB_DATABASE' => $dbName,
            'DB_USERNAME' => $dbUser,
            'DB_PASSWORD' => $dbPass,
        ]);
        
        $this->call('key:generate');

        $this->info('Configurazione .env completata!');
    }

    protected function updateEnv(array $data)
    {
        $envPath = base_path('.env');
        $envContent = File::get($envPath);
    
        foreach ($data as $key => $value) {
            $escaped = preg_quote($key, '/'); 
            $envContent = preg_replace("/^{$escaped}=.*/m", "{$key}={$value}", $envContent);
        }
    
        File::put($envPath, $envContent);
    }
}
