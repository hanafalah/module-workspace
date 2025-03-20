<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Zahzah\ModuleWorkspace\Enums\Workspace\WorkspaceStatus;
use Zahzah\ModuleWorkspace\Models\Workspace\Workspace;

return new class extends Migration
{
   use Zahzah\LaravelSupport\Concerns\NowYouSeeMe;

    private $__table;

    public function __construct(){
        $this->__table = app(config('database.models.Workspace', Workspace::class));
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        $table_name = $this->__table->getTable();
        if (!$this->isTableExists()){
            Schema::create($table_name, function (Blueprint $table) {
                $table->id();
                $table->string('uuid',36);
                $table->string('name',50)->nullable(false);
                $table->json('props')->nullable(true);
                $table->unsignedTinyInteger('status')->default(WorkspaceStatus::DRAFT->value)
                      ->comment('See '.addslashes(WorkspaceStatus::class));
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->__table->getTable());
    }
};
