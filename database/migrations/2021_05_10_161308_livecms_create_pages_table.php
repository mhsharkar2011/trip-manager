<?php

use App\LiveCMS\Models\Template;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class LivecmsCreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        {
            Schema::create('live_cms_pages', function (Blueprint $table) {
                $table->id();
                $table->string('route');
                $table->longText('template')->nullable();
                $table->unsignedInteger('template_checksum')->nullable();
                $table->string('path');
                $table->timestamps();
            });
    
            foreach ($this->getPages() as $tpl) {
                $template_content = $tpl['template'];
                
                if (View::exists($tpl['path'])) {
                    $template_content = file_get_contents(get_templates_path() . $tpl['path'] . '.blade.php');
                }
                
                Template::create([
                    'route' => $tpl['route'],
                    'template' => $template_content,
                    'path' => $tpl['path'],
                ]);
            }
        }
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('live_cms_pages');
    }


    public function getPages() {
        return [
            [
                'route' => 'home',
                'template' => 'home page',
                'path' => 'home',
            ],
        ];
    }    
}
