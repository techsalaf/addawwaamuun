<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThemeV4SettingsTable extends Migration
{
  public function up()
  {
    Schema::create('theme_v4_settings', function (Blueprint $table) {
      $table->id();
      
      $table->string('section')->nullable()->comment('Section name: hero, search, categories, etc');
      $table->string('key')->nullable()->comment('Setting key');
      $table->text('value')->nullable()->comment('Setting value');
      $table->text('description')->nullable();
      
      $table->timestamps();
      $table->unique(['section', 'key']);
    });

    Schema::create('theme_v4_hero_settings', function (Blueprint $table) {
      $table->id();
      $table->string('title')->nullable();
      $table->string('subtitle')->nullable();
      $table->longText('description')->nullable();
      $table->string('button_1_text')->nullable();
      $table->string('button_1_url')->nullable();
      $table->string('button_2_text')->nullable();
      $table->string('button_2_url')->nullable();
      $table->string('background_image')->nullable();
      $table->string('gradient_color_1')->default('1866d4');
      $table->string('gradient_color_2')->default('580ce3');
      $table->boolean('status')->default(true);
      $table->timestamps();
    });

    Schema::create('theme_v4_search_settings', function (Blueprint $table) {
      $table->id();
      $table->string('title')->nullable();
      $table->string('subtitle')->nullable();
      $table->string('search_placeholder')->nullable();
      $table->string('category_placeholder')->nullable();
      $table->string('button_text')->nullable();
      $table->boolean('status')->default(true);
      $table->timestamps();
    });

    Schema::create('theme_v4_cta_settings', function (Blueprint $table) {
      $table->id();
      $table->string('title')->nullable();
      $table->string('subtitle')->nullable();
      $table->longText('description')->nullable();
      $table->string('button_1_text')->nullable();
      $table->string('button_1_url')->nullable();
      $table->string('button_2_text')->nullable();
      $table->string('button_2_url')->nullable();
      $table->string('background_image')->nullable();
      $table->string('gradient_color_1')->default('1866d4');
      $table->string('gradient_color_2')->default('580ce3');
      $table->boolean('status')->default(true);
      $table->timestamps();
    });

    Schema::create('theme_v4_about_settings', function (Blueprint $table) {
      $table->id();
      $table->string('title')->nullable();
      $table->string('subtitle')->nullable();
      $table->longText('description')->nullable();
      $table->string('image')->nullable();
      $table->string('button_text')->nullable();
      $table->string('button_url')->nullable();
      $table->boolean('status')->default(true);
      $table->timestamps();
    });

    Schema::create('theme_v4_custom_content', function (Blueprint $table) {
      $table->id();
      $table->string('content_type')->nullable()->comment('Type: text, image, button, etc');
      $table->string('section')->nullable()->comment('Which section: hero, cta, features, etc');
      $table->string('position')->nullable()->comment('Position in section');
      $table->longText('content')->nullable();
      $table->string('image')->nullable();
      $table->string('link')->nullable();
      $table->integer('order')->default(0);
      $table->boolean('status')->default(true);
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('theme_v4_custom_content');
    Schema::dropIfExists('theme_v4_about_settings');
    Schema::dropIfExists('theme_v4_cta_settings');
    Schema::dropIfExists('theme_v4_search_settings');
    Schema::dropIfExists('theme_v4_hero_settings');
    Schema::dropIfExists('theme_v4_settings');
  }
}
