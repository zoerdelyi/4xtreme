<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->call('UsersTableSeeder');
      $this->call('BlocksSeeder');
      $this->call('BlocksTemplateSeeder');
      $this->call('PagesSeeder');
      $this->call('PagesTemplateSeeder');
      $this->call('MenusSeeder');
      $this->call('SettingsSeeder');
      $this->call('LevelsPermissionsSeeder');

      $this->call('CarBrandsSeeder');
      $this->call('CarTypesSeeder');
      $this->call('VisitorsSeeder');

      $this->call('BookingsCarsSeeder');
      $this->call('BookingsTiresSeeder');
      $this->call('ServicesCarsSeeder');
      $this->call('ServicesTiresSeeder');
      $this->call('BookingsServicesCarsSeeder');
      $this->call('BookingsServicesTiresSeeder');

      $this->call('OpeningHoursCarsSeeder');
      $this->call('OpeningHoursTiresSeeder');
      $this->call('WorkdaysSeeder');
      $this->call('BookingsSettingsSeeder');
      $this->call('BookingsSessionsSeeder');
    }
}
