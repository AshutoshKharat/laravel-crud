<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

use App\Models\City;
use App\Models\State;
use App\Models\Country;

class CountryStateCitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Country 1: USA
        $usa = Country::create(['name' => 'USA']);
        $california = State::create(['name' => 'California', 'country_id' => $usa->id]);
        $newYork = State::create(['name' => 'New York', 'country_id' => $usa->id]);

        City::create(['name' => 'Los Angeles', 'state_id' => $california->id]);
        City::create(['name' => 'San Francisco', 'state_id' => $california->id]);
        City::create(['name' => 'New York City', 'state_id' => $newYork->id]);

        // Country 2: India
        $india = Country::create(['name' => 'India']);
        $maharashtra = State::create(['name' => 'Maharashtra', 'country_id' => $india->id]);
        $gujarat = State::create(['name' => 'Gujarat', 'country_id' => $india->id]);

        City::create(['name' => 'Mumbai', 'state_id' => $maharashtra->id]);
        City::create(['name' => 'Pune', 'state_id' => $maharashtra->id]);
        City::create(['name' => 'Ahmedabad', 'state_id' => $gujarat->id]);

        // Country 3: Canada
        $canada = Country::create(['name' => 'Canada']);
        $ontario = State::create(['name' => 'Ontario', 'country_id' => $canada->id]);
        $quebec = State::create(['name' => 'Quebec', 'country_id' => $canada->id]);

        City::create(['name' => 'Toronto', 'state_id' => $ontario->id]);
        City::create(['name' => 'Ottawa', 'state_id' => $ontario->id]);
        City::create(['name' => 'Montreal', 'state_id' => $quebec->id]);

        // Country 4: Australia
        $australia = Country::create(['name' => 'Australia']);
        $newSouthWales = State::create(['name' => 'New South Wales', 'country_id' => $australia->id]);
        $victoria = State::create(['name' => 'Victoria', 'country_id' => $australia->id]);

        City::create(['name' => 'Sydney', 'state_id' => $newSouthWales->id]);
        City::create(['name' => 'Melbourne', 'state_id' => $victoria->id]);

        // Country 5: UK
        $uk = Country::create(['name' => 'United Kingdom']);
        $england = State::create(['name' => 'England', 'country_id' => $uk->id]);
        $scotland = State::create(['name' => 'Scotland', 'country_id' => $uk->id]);

        City::create(['name' => 'London', 'state_id' => $england->id]);
        City::create(['name' => 'Edinburgh', 'state_id' => $scotland->id]);
    }
}
