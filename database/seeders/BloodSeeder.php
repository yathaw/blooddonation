<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blood;

class BloodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bloodLists =[
	        array('O', 'positive'),
	        array('O', 'negative'),

	        array('A', 'positive'),
	        array('A', 'negative'),

	        array('B', 'positive'),
	        array('B', 'negative'),

	        array('AB', 'positive'),
	        array('AB', 'negative')
        ];

        foreach ($bloodLists as $bloodList) {
	    	$blood = new Blood;
	    	$blood->type = $bloodList[0];
	    	$blood->status = $bloodList[1];
	    	$blood->save();
	    }
    }
}
