<?php

class NoteSeed extends Seeder {
    public function run() {
        $today=date("Y-m-d H:i:s");
        DB::table('note')->insert(
            array(
                array(
                    'note' => 'pierre',
                    'user' => 'Dupont',
                    'created_at' => $today,
                ),

                array(
                    'note' => 'ssssss',
                    'user' => 'Dupont',
                    'created_at' => $today,
                ),
            )
        );
    }
}