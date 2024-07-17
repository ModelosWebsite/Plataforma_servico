<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class BackupDatabase extends Command
{
    // Nome e descrição do comando
    protected $signature = 'backup:database';
    protected $description = 'Faz o backup do banco de dados e salva em uma pasta específica';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Iniciando o backup do banco de dados...');

        // Executa o comando de backup
        $result = Artisan::call('backup:run', [
            '--only-db' => true,
        ]);

        // Verifica se o backup foi bem sucedido
        if ($result === 0) {
            $this->info('Backup do banco de dados concluído.');
            // Mover o backup para a pasta específica
            $this->moveBackup();
        } else {
            $this->error('O backup do banco de dados falhou.');
        }
    }

    protected function moveBackup()
    {
        // Caminho da pasta de destino
        $destinationPath = storage_path('app/backups');

        // Certifique-se de que a pasta de destino existe
        if (!is_dir($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        // Caminho dos backups criados
        $sourcePath = storage_path('app/laravel-backup');

        // Mover os arquivos de backup
        $files = glob($sourcePath . '/*.zip'); // Ajuste conforme necessário
        foreach ($files as $file) {
            $fileName = basename($file);
            rename($file, $destinationPath . '/' . $fileName);
        }

        $this->info('Os backups foram movidos para a pasta ' . $destinationPath);
    }
}
