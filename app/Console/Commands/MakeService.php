<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name} {--r|--repository}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Service with optional Repository';

    protected $files;

    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $createRepository = $this->option('repository');

        $servicePath = app_path("Services/{$name}/{$name}Service.php");
        $repoInterfacePath = app_path("Repositories/{$name}/Interfaces/{$name}RepositoryInterface.php");
        $repoPath = app_path("Repositories/{$name}/{$name}Repository.php");

        $this->makeDirectory(dirname($servicePath));
        if (!$this->files->exists($servicePath)) {
            $this->files->put($servicePath, $this->getServiceStub($name));
            $this->logInfoMessage("green", "Service [<options=bold>{$servicePath}</>] created successfully.");
        } else {
            $this->logInfoMessage("red", "Service [<options=bold>{$servicePath}</>] already exists.");
        }

        if ($createRepository) {
            $this->makeDirectory(dirname($repoInterfacePath));
            $this->makeDirectory(dirname($repoPath));

            if (!$this->files->exists($repoInterfacePath)) {
                $this->files->put($repoInterfacePath, $this->getRepositoryInterfaceStub($name));
                $this->logInfoMessage("green", "Repository Interface [<options=bold>{$repoInterfacePath}</>] created successfully.");
            } else {
                $this->logInfoMessage("red", "Repository Interface [<options=bold>{$repoInterfacePath}</>] already exists.");
            }

            if (!$this->files->exists($repoPath)) {
                $this->files->put($repoPath, $this->getRepositoryStub($name));
                $this->logInfoMessage("green", "Repository [<options=bold>{$repoPath}</>] created successfully.");
            } else {
                $this->logInfoMessage("red", "Repository [<options=bold>{$repoPath}</>] already exists.");
            }

            $this->registerRepositoryBinding($name);
        }
    }

    public function makeDirectory($path)
    {
        if (!$this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0755, true);
        }
    }

    protected function getServiceStub($name)
    {
        return <<<EOT
<?php

namespace App\Services\\{$name};

use App\Repositories\\{$name}\Interfaces\\{$name}RepositoryInterface;

class {$name}Service
{
    protected \${$name}Repository;

    public function __construct({$name}RepositoryInterface \${$name}Repository)
    {
        \$this->{$name}Repository = \${$name}Repository;
    }

    /**
     * Get all {$name} records.
     */
    public function getAll()
    {
        return \$this->{$name}Repository->getAll();
    }

    /**
     * Create a new {$name}.
     * 
     * @param array \$data
     */
    public function create(array \$data)
    {
        return \$this->{$name}Repository->create(\$data);
    }

    /**
     * Find a {$name} by ID.
     * 
     * @param int \$id
     */
    public function findById(int \$id)
    {
        return \$this->{$name}Repository->findById(\$id);
    }

    /**
     * Update a {$name} by ID.
     * 
     * @param int \$id
     * @param array \$data
     */
    public function updateById(int \$id, array \$data)
    {
        return \$this->{$name}Repository->updateById(\$id, \$data);
    }

    /**
     * Delete a {$name} by ID.
     * 
     * @param int \$id
     */
    public function deleteById(int \$id)
    {
        return \$this->{$name}Repository->deleteById(\$id);
    }
}
EOT;
    }

    protected function getRepositoryInterfaceStub($name)
    {
        return <<<EOT
<?php

namespace App\Repositories\\{$name}\Interfaces;

interface {$name}RepositoryInterface
{
    /**
     * Get all {$name} records.
     */
    public function getAll();

    /**
     * Create a new {$name} record.
     * 
     * @param array \$data
     */
    public function create(array \$data);

    /**
     * Find a record {$name} by ID.
     * 
     * @param int \$id
     */
    public function findById(int \$id);

    /**
     * Update a record {$name} by ID.
     * 
     * @param int \$id
     * @param array \$data
     */
    public function updateById(int \$id, array \$data);

    /**
     * Delete a record {$name} by ID.
     * 
     * @param int \$id
     */
    public function deleteById(int \$id);
}
EOT;
    }

    protected function getRepositoryStub($name)
    {
        return <<<EOT
<?php

namespace App\Repositories\\{$name};

use App\Models\\{$name};
use App\Repositories\\{$name}\Interfaces\\{$name}RepositoryInterface;

class {$name}Repository implements {$name}RepositoryInterface
{
    /**
     * Get all {$name} records.
     */
    public function getAll()
    {
        return {$name}::all();
    }

    /**
     * Create a new {$name} record.
     * 
     * @param array \$data
     */
    public function create(array \$data)
    {
        return {$name}::create(\$data);
    }

    /**
     * Find a record {$name} by ID.
     * 
     * @param int \$id
     */
    public function findById(int \$id)
    {
        return {$name}::findOrFail(\$id);
    }

    /**
     * Update a record {$name} by ID.
     * 
     * @param int \$id
     * @param array \$data
     */
    public function updateById(int \$id, array \$data)
    {
        \$model = {$name}::findOrFail(\$id);
        \$model->update(\$data);

        return \$model;
    }

    /**
     * Delete a record {$name} by ID.
     * 
     * @param int \$id
     */
    public function deleteById(int \$id)
    {
        \$model = {$name}::findOrFail(\$id);
        return \$model->delete();
    }
}
EOT;
    }

    protected function registerRepositoryBinding($name)
    {
        $appServiceProviderPath = app_path('Providers/AppServiceProvider.php');

        if ($this->files->exists($appServiceProviderPath)) {
            $interface = "App\\Repositories\\{$name}\\Interfaces\\{$name}RepositoryInterface";
            $repository = "App\\Repositories\\{$name}\\{$name}Repository";

            $bindingCode = "\$this->app->bind({$name}RepositoryInterface::class, {$name}Repository::class);";

            // Tambahkan use statement untuk namespace baru
            $useStatement = "use {$interface};\nuse {$repository};";

            $content = $this->files->get($appServiceProviderPath);

            // Tambah use statements jika belum ada
            if (strpos($content, $useStatement) === false) {
                $content = preg_replace(
                    '/(namespace [^\;]*;)/',
                    "$0\n\n{$useStatement}",
                    $content
                );
                $this->files->put($appServiceProviderPath, $content);
            }

            // Cek apakah binding sudah ada sebelumnya
            if (strpos($content, $bindingCode) === false) {
                $content = preg_replace(
                    '/(public function register\([^\)]*\)[\s\S]*?\{)/',
                    "$1\n        {$bindingCode}",
                    $content
                );

                $this->files->put($appServiceProviderPath, $content);

                $this->logInfoMessage("green", "Repository [<options=bold>{$bindingCode}</>] binding in AppServiceProvider successfully registered.");
            } else {
                $this->logInfoMessage("red", "Repository [<options=bold>{$bindingCode}</>] binding in AppServiceProvider already exists.");
            }
        } else {
            $this->error('AppServiceProvider.php not found.');
        }
    }

    protected function logInfoMessage(string $bgColor, $message): void
    {
        $this->newLine();
        $this->line("  <bg={$bgColor};fg=black> INFO </> <fg=default>{$message}");
        $this->newLine(1);
    }
}
